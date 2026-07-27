<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\OrderDetail;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;

    }
    public function index(Request $request)
    {

        return view('product.list');

    }



    public function getAll()
    {
        $products = $this->productService->getAllProducts();

        return DataTables::of($products)->addColumn('actions', function ($row) {
            static $id = 1;
            $encryptedId = encrypt($row->id);
            $id++;
            // dd($encryptedId);

            $updateButton = "<a class='btn btn-warning btn-sm '  href='" . route('app-product-edit', $encryptedId) . "'>
            <i class='fas fa-pencil-alt'></i></a>";

            // Delete Button
            $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-product-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $page_data['page_title'] = "Product";
        $page_data['form_title'] = "Add New Product";
        $categories = $this->productService->getCategoies();
        $sub_categories = [];
        $product = '';
        $productsImages = '';

        $productVarients = $this->productService->getProductVarients();

        $VarientTypeDetails = [];


        return view('product.create-edit', compact('page_data', 'product', 'productsImages', 'categories', 'sub_categories', 'productVarients', 'VarientTypeDetails'));
    }

    public function store(CreateProductRequest $request)
    {

        try {

            $dataslug = $request->get('product_name');
            $words = explode(" ", $dataslug);
            $slug_url = implode("-", $words);

            $ProductData['product_name'] = $request->get('product_name');
            $ProductData['slug_url'] = $slug_url;
            $ProductData['short_description'] = $request->get('short_description');
            $ProductData['description'] = $request->get('description');
            $ProductData['category_id'] = $request->get('category');
            $ProductData['sub_cat_id'] = $request->get('sub_category');
            $ProductData['price'] = $request->get('price');
            $ProductData['discount_price'] = $request->get('discount_price');
            $ProductData['product_type'] = $request->get('product_type');
            $ProductData['product_varient_id'] = $request->get('varient_name');
            $ProductData['status'] = $request->get('status') == 'on' ? true : false;

            if ($request->hasFile('feature_image')) {
                $featureimageName = time() . '.' . $request->feature_image->getClientOriginalExtension();
                $request->feature_image->move(public_path('images/product_images'), $featureimageName);
                $ProductData['featured_image'] = 'images/product_images/' . $featureimageName;
            }



            $user = $this->productService->create($ProductData);



            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName();
                    $photo->move(public_path('images/product_images'), $imageName);

                    $ProductImages = [
                        'images' => 'images/product_images/' . $imageName,
                        'product_id' => $user->id
                    ];
                    $this->productService->addProductImage($ProductImages);

                }

            }

            $product_type = $request->get('product_type');

            if ($product_type == "Varient") {
                $varient_id = $request->get('varient_name');
                $varientType = $request->get('varient_type');
                $varientPrice = $request->get('varientPrice');
                $varientDiscountPrice = $request->get('varientDiscountPrice');



                foreach ($varientType as $key => $value) {
                    if ($varientType[$key] != '') {
                        $ProductVarientDetails['product_id'] = $user->id;
                        $ProductVarientDetails['varient_type_id'] = $varientType[$key];
                        $ProductVarientDetails['price'] = $varientPrice[$key];
                        $ProductVarientDetails['discount_price'] = $varientDiscountPrice[$key];

                        if ($request->hasFile('varient_images')) {
                            $varient_images = $request->file('varient_images');

                            $varientImageName = time() . '_' . $varient_images[$key]->getClientOriginalName();
                            $varient_images[$key]->move(public_path('images/product_varients'), $varientImageName);
                            $ProductVarientDetails['images'] = 'images/product_varients/' . $varientImageName;
                        }


                        $this->productService->addVarientTypeDetails($ProductVarientDetails);

                    }

                }



            }


            if (!empty($user)) {
                return redirect()->route("product.index")->with('success', 'Product Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding Product');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.index")->with('error', 'Error while adding Product');
        }
    }

    public function edit($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $categories = $this->productService->getCategoies();



            $product = $this->productService->getProduct($id);
            $productsImages = $this->productService->getProductImage($id);

            $sub_categories = $this->productService->getParentCategoies($product->category_id);

            $productVarients = $this->productService->getProductVarients();


            $VarientTypeDetails = DB::table('varients_types_details')
                ->leftjoin('varients_types', 'varients_types_details.varient_type_id', '=', 'varients_types.id')
                ->select('varients_types_details.id as detailsId', 'varients_types.id', 'varients_types.variant_sizes', 'varients_types_details.price', 'varients_types_details.discount_price', 'varients_types_details.images')
                ->where('varients_types_details.product_id', '=', $id)
                ->get();


            // $VarientTypeDetails = $this->productService->getVarientTypeDetails($id);






            $page_data['page_title'] = "Product";
            $page_data['form_title'] = "Edit New Product";

            return view('product.create-edit', compact('page_data', 'product', 'productsImages', 'categories', 'sub_categories', 'productVarients', 'VarientTypeDetails'));

        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.index")->with('error', 'Error while editing Product');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $dataslug = $request->get('product_name');
            $words = explode(" ", $dataslug);
            $slug_url = implode("-", $words);

            $ProductData['product_name'] = $request->get('product_name');
            $ProductData['slug_url'] = $slug_url;
            $ProductData['description'] = $request->get('description');
            $ProductData['category_id'] = $request->get('category');
            $ProductData['sub_cat_id'] = $request->get('sub_category');
            $ProductData['price'] = $request->get('price');
            $ProductData['discount_price'] = $request->get('discount_price');
            $ProductData['product_type'] = $request->get('product_type');
            $ProductData['product_varient_id'] = $request->get('varient_name');
            $ProductData['status'] = $request->get('status') == 'on' ? true : false;

            $updated = $this->productService->updateProduct($id, $ProductData);


            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName(); // You may want to change the naming logic
                    $photo->move(public_path('images/product_images'), $imageName);

                    $ProductImages = [
                        'images' => 'images/product_images/' . $imageName,
                        'product_id' => $id // Assuming 'id' is the primary key of the product
                    ];
                    $this->productService->addProductImage($ProductImages);

                }

            }

            $product_type = $request->get('product_type');
            if ($product_type == "Varient") {
                $varient_id = $request->get('varient_name');
                $varientType = $request->get('varient_type');
                $varientPrice = $request->get('varientPrice');
                $varientDiscountPrice = $request->get('varientDiscountPrice');
                $dId = $request->get('detailsId');


                foreach ($varientType as $key => $value) {
                    if ($varientType[$key] != '') {
                        $ProductVarientDetails['product_id'] = $id;
                        $ProductVarientDetails['varient_type_id'] = $varientType[$key];
                        $ProductVarientDetails['price'] = $varientPrice[$key];
                        $ProductVarientDetails['discount_price'] = $varientDiscountPrice[$key];

                        $detailsId = $dId[$key];
                        // dump($detailsId);
                        // dump(key_exists($key, $request->varient_images));


                        /*------------- Druvilbhai Code ------------*/

                        // if (key_exists($key, $request->varient_images)) {

                        //     $varient_images = $request->file('varient_images');
                        //     // dd($varient_images);
                        //     $varientImageName = time() . '_' . $varient_images[$key]->getClientOriginalName();
                        //     // dump($varient_images, $key);
                        //     $varient_images[$key]->move(public_path('images/product_varients'), $varientImageName);
                        //     $ProductVarientDetails['images'] = 'images/product_varients/' . $varientImageName;
                        // }

                        /*------------- End Druvilbhai Code ------------*/


                        $this->productService->updateVarientTypeDetails($detailsId, $ProductVarientDetails);

                    }

                }

            }





            if (!empty($updated)) {
                return redirect()->route("product.index")->with('success', 'Product Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating Product');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("product.index")->with('error', 'Error while editing Product');
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

            $deleted = $this->productService->deleteProduct($id);
            if (!empty($deleted)) {
                return redirect()->route("product.index")->with('success', 'Product Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Product');
            }
        } catch (\Exception $error) {
            return redirect()->route("product.index")->with('error', 'Error while editing Product');
        }
    }

    public function RemoveProductImage($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $deleted = $this->productService->deleteProductImage($id);

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

        $getSubParentCategories = $this->productService->getAllSubCategory($id); // Adjust the relationship name as needed

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


    public function getproductVarientTypes($id)
    {

        $getProductVarientTypes = $this->productService->getProductVarientType($id); // Adjust the relationship name as needed


        if (count($getProductVarientTypes) > 0) {
            $VarientType['type'] = "VarientType";
            $html = view('product.varient_types_html', compact('VarientType', 'getProductVarientTypes'))->render();
            return response()->json($html);
        } else {
            $VarientType['type'] = "";
            $html = view('product.varient_types_html', compact('VarientType', 'getProductVarientTypes'))->render();
            return response()->json($html);
        }




        // return response()->json(['records' => $records]);
    }


    public function orderIndex()
    {
        return view('order.list');
    }
    public function getAllOrder()
    {
        $order = OrderDetail::get();
        // return DataTables::of($order)->make(true)
        return DataTables::of($order)->addColumn('actions', function ($row) {
            // dd($row);
            $encryptedId = encrypt($row->id);



            $updateButton = "<a class='btn btn-success btn-sm '  href='" . route('app-order-edit', $encryptedId) . "'>
            <i class='fas fa-pencil-alt'></i></a>";

            // Delete Button
            // $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-product-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton;
        })->rawColumns(['actions'])->make(true);
        ;
    }
    public function editOrder($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $order = OrderDetail::find($id);

            $page_data['page_title'] = "order";
            $page_data['form_title'] = "View  order";
            return view('order.create-edit', compact('page_data', 'order', ));
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("order.index")->with('error', 'Error while editing order');

        }
    }

}
