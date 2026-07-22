<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use Spatie\Permission\Models\Permission;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Services\CategoryService; 
use App\Http\Requests\Category\CategoryRequest; 

class CategoriesController extends Controller
{
    protected CategoryService $categoryService;
    protected RoleService $roleService;

    public function __construct(CategoryService $categoryService, RoleService $roleService)
    {
        $this->categoryService = $categoryService;
        $this->roleService = $roleService;
        // $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);



        // Permission::create(['name' => 'user-list', 'guard_name' => 'web', 'module_name' => 'Users']);
        // Permission::create(['name' => 'user-create', 'guard_name' => 'web', 'module_name' => 'Users']);
        // Permission::create(['name' => 'user-edit', 'guard_name' => 'web', 'module_name' => 'Users']);
        // Permission::create(['name' => 'user-delete', 'guard_name' => 'web', 'module_name' => 'Users']);



        // Permission::create(['name' => 'product-list', 'guard_name' => 'web', 'module_name' => 'Products']);
        // Permission::create(['name' => 'product-create', 'guard_name' => 'web', 'module_name' => 'Products']);
        // Permission::create(['name' => 'product-edit', 'guard_name' => 'web', 'module_name' => 'Products']);
        // Permission::create(['name' => 'product-delete', 'guard_name' => 'web', 'module_name' => 'Products']);


        // Permission::create(['name' => 'category-list', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-create', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-edit', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-delete', 'guard_name' => 'web', 'module_name' => 'Categories']);

        // Permission::create(['name' => 'order-list', 'guard_name' => 'web', 'module_name' => 'Orders']);
        // Permission::create(['name' => 'order-create', 'guard_name' => 'web', 'module_name' => 'Orders']);
        // Permission::create(['name' => 'order-edit', 'guard_name' => 'web', 'module_name' => 'Orders']);
        // Permission::create(['name' => 'order-delete', 'guard_name' => 'web', 'module_name' => 'Orders']);

        // Permission::create(['name' => 'role-list', 'guard_name' => 'web', 'module_name' => 'Roles']);
        // Permission::create(['name' => 'role-create', 'guard_name' => 'web', 'module_name' => 'Roles']);
        // Permission::create(['name' => 'role-edit', 'guard_name' => 'web', 'module_name' => 'Roles']);
        // Permission::create(['name' => 'role-delete', 'guard_name' => 'web', 'module_name' => 'Roles']);

        // $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:category-delete', ['only' => ['destroy']]);

        // Permission::create(['name' => 'category-list', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-create', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-edit', 'guard_name' => 'web', 'module_name' => 'Categories']);
        // Permission::create(['name' => 'category-delete', 'guard_name' => 'web', 'module_name' => 'Categories']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
      //  $data = Category::active()->get();
      $data = $this->categoryService->getAllCategory();
        return view('content.apps.categories.list', compact('data'));
    }


    public function getAll()
    {
        $users = $this->categoryService->getAllCategory();
        // dd($users->role);
        return DataTables::of($users)->addColumn('name', function ($row) {
            return $row->name;
        })->addColumn('description', function ($row) {
            return $row->description;
            
        })->addColumn('status', function ($row) {
            if ($row->status == 'active') {
                return '<span class="badge bg-label-success">Active</span>';
            } else {
                return '<span class="badge bg-label-danger">Inactive</span>';
            }
            
        })->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);
            // Update Button
            // $updateButton = "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn btn-warning'  href='" . route('app-users-edit', $encryptedId) . "'><i data-feather='edit'></i></a>";

            $updateButton = "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn-sm border-warning'  href='" . route('app-categories-edit', $encryptedId) . "'><i class='text-warning' data-feather='edit'></i></a>";

            // Delete Button
            // $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class='btn btn-danger confirm-delete' data-idos='.$encryptedId' id='confirm-color  href='" . route('app-users-destroy', $encryptedId) . "'><i data-feather='trash-2'></i></a>";

            $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class=' btn-sm border-danger confirm-delete' data-idos='$encryptedId' id='confirm-color  href='" . route('app-categories-destroy', $encryptedId) . "'><i class='text-danger' data-feather='trash-2'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions', 'status'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $page_data['page_title'] = "Category";
        $page_data['form_title'] = "Add New Category";
        $category = '';
        $categorieslist = $this->categoryService->getAllCategory();

        return view('.content.apps.categories.create-edit', compact('page_data', 'category', 'categorieslist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {

          // dd($request->all());

            $categoryData['name'] = $request->get('name');
            $categoryData['description'] = $request->get('description');
            $categoryData['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';
            $category = $this->categoryService->create($categoryData);

            if (!empty($category)) {
                return redirect()->route("app-categories-list")->with('success', 'Category Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding Category');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("app-categories-list")->with('error', 'Error while adding Category');
        }
    }

    public function edit($encrypted_id)
    {
        $id = decrypt($encrypted_id);

        $data = Category::find($id);
        $page_data['page_title'] = "Category";
        $page_data['form_title'] = "Edit Category";
        $category = $data;
        $categorieslist = $this->categoryService->getAllCategory();
        return view('.content.apps.categories.create-edit', compact('page_data', 'category', 'categorieslist'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    // public function edit($encrypted_id)
    // {
    //     try {
    //         $id = decrypt($encrypted_id);
    //         $category = $this->categoryService->getCategory($id);
    //         $page_data['page_title'] = "Category";
    //         $page_data['form_title'] = "Edit Category";

    //         $categorieslist = $this->categoryService->getAllCategory();
    //         $roles = $this->roleService->getAllRoles();
    //         $category->role = $category->getRoleNames()[0];
    //         // dd($$user->role);
    //         $data['reports_to'] = User::all();
    //         return view('.content.apps.categories.create-edit', compact('page_data', 'category', 'data', 'roles', 'categorieslist'));
    //     } catch (\Exception $error) {
    //         dd($error->getMessage());
    //         return redirect()->route("app-categories-list")->with('error', 'Error while editing Category');
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */


    public function update(CategoryRequest $request, $encrypted_id)
    {

        try {

            // dd($request->all());
            $id = decrypt($encrypted_id);
            // $userData['username'] = $request->get('username');
            $data['name'] = $request->get('name');
            $data['description'] = $request->get('description');
            $data['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';

            

            $updated = $this->categoryService->updateCategory($id, $data);

            if (!empty($updated)) {
                return redirect()->route('app-categories-list')->with('success', 'Category updated successfully');
            } else {

                return redirect()->back()->with('error', 'Error while Updating Category');
            }
            
           
    
            // $updated = $this->categoryService->updateCategory($id, $data);
            // if (!empty($updated)) {
            //     return redirect()->route("app-categories-list")->with('success', 'Category Updated Successfully');
            // } else {
            //     return redirect()->back()->with('error', 'Error while Updating Category');
            // }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("app-categories-list")->with('error', 'Error while editing Category');
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
                return redirect()->route("app-categories-list")->with('success', 'Category Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Category');
            }
        } catch (\Exception $error) {
            return redirect()->route("app-categories-list")->with('error', 'Error while editing Category');
        }
    }

}
