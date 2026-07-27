<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductVariant\CreateProductVarientRequest;
use App\Http\Requests\ProductVariant\UpdateProductVariantRequest;
use App\Services\ProductVariantService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class ProductVariantController extends Controller
{
    protected ProductVariantService $productVariantService;

    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;

    }
    public function index(Request $request)
    {

        return view('product_variants.varient_list');

    }

    public function getAll()
    {
        $productVarient = $this->productVariantService->getAllProductVarients();

        return DataTables::of($productVarient)->addColumn('actions', function ($row) {
            //  static $id = 1;
            $encryptedId = encrypt($row->id);

            //  $id++;
            // dd($encryptedId);

            $updateButton = "<a class='btn btn-warning btn-sm '  href='" . route('app-product_variants-edit', $encryptedId) . "'>
            <i class='fas fa-pencil-alt'></i></a>";

            // Delete Button
            $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-product_variants-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $page_data['page_title'] = "Product Varient";
        $page_data['form_title'] = "Add New Product Varient";
        $product_varients = '';
        $varientTypes = '';

        return view('product_variants.create-edit', compact('page_data', 'product_varients', 'varientTypes'));
    }

    public function store(CreateProductVarientRequest $request)
    {

        try {

            $ProductVariantData['varient_name'] = $request->get('variant_name');
            $varientAdd = $this->productVariantService->create($ProductVariantData);

            $varient_types = $request->get('varient_type');
            foreach ($varient_types as $varient_type) {
                $ProductVariantType['varient_id'] = $varientAdd->id;
                $ProductVariantType['variant_sizes'] = $varient_type;


                $varientTypeAdd = $this->productVariantService->addVariantType($ProductVariantType);
            }



            if (!empty($varientAdd)) {
                return redirect()->route("product_variants.index")->with('success', 'Product Varient Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding Product Varient');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product_variants.index")->with('error', 'Error while adding Product Varient');
        }
    }

    public function edit($encrypted_id)
    {
        try {

            $id = decrypt($encrypted_id);
            $product_varients = $this->productVariantService->getProductVarients($id);
            $varientTypes = $this->productVariantService->getVarientsTypes($product_varients->id);

            $page_data['page_title'] = "Product Varient";
            $page_data['form_title'] = "Edit New Product Varient";

            return view('product_variants.create-edit', compact('page_data', 'product_varients', 'varientTypes'));

        } catch (\Exception $error) {
            return redirect()->route("product_variants.index")->with('error', 'Error while editing Product');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductVariantRequest $request
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductVariantRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $varientName = $request->get('variant_name');

            $ProductVarientName['varient_name'] = $varientName;

            $updateRecords = $this->productVariantService->updateProductVarient($id, $ProductVarientName);



            $deleted_ids = explode(',', $request->get('deleted_ids'));

            if (!empty($deleted_ids) && count($deleted_ids) > 0) {
                foreach ($deleted_ids as $key => $value) {
                    if (!empty($value)) {
                        $deleted = $this->productVariantService->deleteVarientTypes($value);
                    }
                }
            }



            $content_index = $request->get('content_index');

            $varient_types = $request->get('varient_type');
            foreach ($request->get('content_index') as $key => $value) {


                $VarientData['varient_id'] = $id;
                $VarientData['variant_sizes'] = $varient_types[$key];


                $detailsKey = $request->get('detail_index')[$key];

                if ($request->get('detail_index')[$key]) {
                    $records = $this->productVariantService->updateVarientsTypes($detailsKey, $VarientData);
                } else {
                    $records = $this->productVariantService->addVariantType($VarientData);
                }
            }


            if (!empty($records)) {
                return redirect()->route("product_variants.index")->with('success', 'Product Varients Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating Product');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product_variants.index")->with('error', 'Error while editing Product Varients');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $deleted = $this->productVariantService->deleteProductVarient($id);
            if (!empty($deleted)) {
                return redirect()->route("product_variants.index")->with('success', 'Product Varient Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Product Varient');
            }
        } catch (\Exception $error) {
            return redirect()->route("product_variants.index")->with('error', 'Error while editing Product Varient');
        }
    }

    public function RemoveProductImage($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $deleted = $this->productVariantService->deleteProductImage($id);

            if (!empty($deleted)) {
                // return redirect()->route("product.index", )->with('success', 'Product Images Deleted Successfully');
                return redirect()->back()->with('success', 'Product Images Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Product Images');
            }
        } catch (\Exception $error) {
            return redirect()->route("product.index")->with('error', 'Error while editing Product Images');
        }
    }


    public function getSubParentCategory($id)
    {

        $getSubParentCategories = $this->productVariantService->getAllSubCategory($id); // Adjust the relationship name as needed

        if (count($getSubParentCategories) > 0) {
            $catType['cate_type'] = "Sub Category";
            $html = view('product.sub_category_html', compact('catType', 'getSubParentCategories'))->render();
            return response()->json($html);
        } else {
            $catType['cate_type'] = "";
            $html = view('product.sub_category_html', compact('catType', 'getSubParentCategories'))->render();
            return response()->json($html);
        }




        // return response()->json(['records' => $records]);
    }
}
