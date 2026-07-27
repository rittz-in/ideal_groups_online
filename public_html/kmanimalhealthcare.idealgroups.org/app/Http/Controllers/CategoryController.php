<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }
    public function index(Request $request)
    {

        return view('category.list');

    }

    public function getAll()
    {
        $category = $this->categoryService->getAllCategory();
        return DataTables::of($category)->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);
            // dd($encryptedId);
            $updateButton = "<a class='btn btn-warning btn-sm '  href='" . route('app-category-edit', $encryptedId) . "'>
            <i class='fas fa-pencil-alt'></i></a>";
            // Delete Button
            $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-category-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $page_data['page_title'] = "Category";
        $page_data['form_title'] = "Add New Category";
        $category = '';
        // $parent_categories = Category::whereNull("parent_id")->get();

        return view('category.category-create-edit', compact('page_data', 'category'));
    }

    public function store(CreateCategoryRequest $request)
    {

        try {

            $dataslug = $request->get('name');
            $words = explode(" ", $dataslug);
            $slug_url = implode("-", $words);

            $CategoryData['name'] = $request->get('name');
            $CategoryData['slug_url'] = $slug_url;
            $CategoryData['description'] = $request->get('description');
            $CategoryData['status'] = $request->get('status') == 'on' ? 'active' : 'inactive';

            $category = $this->categoryService->create($CategoryData);
            if (!empty($category)) {
                return redirect()->route("categorys.index")->with('success', 'Category Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding Category');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("categorys.index")->with('error', 'Error while adding Category');
        }
    }

    public function edit($encrypted_id)
    {
        // dd('jkhjf');
        try {
            $id = decrypt($encrypted_id);
            $category = $this->categoryService->getCategory($id);

            $page_data['page_title'] = "Category";
            $page_data['form_title'] = "Edit New Category";


            // $parent_categories = Category::whereNull("parent_id")->get();
            // dd($category);
            return view('category.category-create-edit', compact('page_data', 'category'));

        } catch (\Exception $error) {
            return redirect()->route("categorys.index")->with('error', 'Error while editing Category');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            // $categoryData['categoryname'] = $request->get('categoryname');
            $dataslug = $request->get('name');
            $words = explode(" ", $dataslug);
            $slug_url = implode("-", $words);

            $CategoryData['name'] = $request->get('name');
            $CategoryData['slug_url'] = $slug_url;
            $CategoryData['description'] = $request->get('description');
            $CategoryData['status'] = $request->get('status') == 'on' ? 'active' : 'inactive';




            $updated = $this->categoryService->updateCategory($id, $CategoryData);

            if (!empty($updated)) {
                return redirect()->route("categorys.index")->with('success', 'Category Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating Category');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("categorys.index")->with('error', 'Error while editing Category');
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
            $deleted = $this->categoryService->deleteCategory($id);
            if (!empty($deleted)) {
                return redirect()->route("categorys.index")->with('success', 'Category Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Category');
            }
        } catch (\Exception $error) {
            return redirect()->route("categorys.index")->with('error', 'Error while editing Category');
        }
    }
}
