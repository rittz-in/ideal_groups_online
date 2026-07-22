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
use App\Models\Products;
use App\Services\ProductsService;
use App\Services\CategoryService;
use App\Models\Category;
use App\Http\Requests\Product\ProductRequest;

class ProductsController extends Controller
{
  protected ProductsService $productsService;
  protected RoleService $roleService;

  public function __construct(ProductsService $productsService, RoleService $roleService)
  {
    $this->productsService = $productsService;
    $this->roleService = $roleService;
    $this->middleware('permission:product-list|product-create|product-edit|product-delete', [
      'only' => ['index', 'show'],
    ]);
    $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:product-delete', ['only' => ['destroy']]);

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

    // Permission::create(['name' => 'product-list', 'guard_name' => 'web', 'module_name' => 'Products']);
    // Permission::create(['name' => 'product-create', 'guard_name' => 'web', 'module_name' => 'Products']);
    // Permission::create(['name' => 'product-edit', 'guard_name' => 'web', 'module_name' => 'Products']);
    // Permission::create(['name' => 'product-delete', 'guard_name' => 'web', 'module_name' => 'Products']);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    $categories = Category::where('status', 'active')->get();
    return view('content.apps.products.list', compact('categories'));
  }

  public function getAll(Request $request)
  {
    $query = Products::query();

    if ($request->has('category') && !empty($request->category)) {
      $query->where('category_name', $request->category);
    }

    $data = $query->get();
    // dd($data);
    // dd($users->role);
    return DataTables::of($data)
      ->addColumn('name', function ($row) {
        // dd($row);
        return $row->name;
      })
      ->addColumn('description', function ($row) {
        return $row->description;
      })
      ->addColumn('status', function ($row) {
        $checked = $row->status == 'active' ? 'checked' : '';
        return '<div class="form-check form-switch mb-0.5">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-id="' .
          encrypt($row->id) .
          '" ' .
          $checked .
          '>
                    </div>';
      })
      ->addColumn('price', function ($row) {
        return $row->price;
      })
      ->addColumn('discount_price', function ($row) {
        return $row->discount_price;
      })
      ->addColumn('category_name', function ($row) {
        return $row->category_name;

        // })->addColumn('product_image', function ($row) {
        //     return $row->product_image;
      })
      ->addColumn('actions', function ($row) {
        $encryptedId = encrypt($row->id);
        // Update Button
        // $updateButton = "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn btn-warning'  href='" . route('app-users-edit', $encryptedId) . "'><i data-feather='edit'></i></a>";

        $updateButton =
          "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn-sm border-warning'  href='" .
          route('app-products-edit', $encryptedId) .
          "'><i class='text-warning' data-feather='edit'></i></a>";

        // Delete Button
        // $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class='btn btn-danger confirm-delete' data-idos='.$encryptedId' id='confirm-color  href='" . route('app-users-destroy', $encryptedId) . "'><i data-feather='trash-2'></i></a>";

        $deleteButton =
          "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class=' btn-sm border-danger confirm-delete' data-idos='$encryptedId' id='confirm-color  href='" .
          route('app-products-destroy', $encryptedId) .
          "'><i class='text-danger' data-feather='trash-2'></i></a>";

        return $updateButton . ' ' . $deleteButton;
      })
      ->rawColumns(['actions', 'status'])
      ->make(true);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function create()
  {
    $page_data['page_title'] = 'Product';
    $page_data['form_title'] = 'Add New Product';
    $product = '';
    $productslist = $this->productsService->getAllProducts();
    $categories = Category::where('status', 'active')->get();

    return view('.content.apps.products.create-edit', compact('page_data', 'product', 'productslist', 'categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request)
  {
    try {
      // dd($request->all());

      $productData['name'] = $request->get('name');
      $productData['description'] = $request->get('description');
      $productData['price'] = $request->get('price');
      $productData['discount_price'] = $request->get('discount_price');

      // Get Category Name from ID
      $category = Category::find($request->get('category_id'));
      $productData['category_name'] = $category ? $category->name : null;

      if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $newName = $filename . '_' . time() . '.' . $image->getClientOriginalExtension();
        $productData['product_image'] = $image->storeAs('products', $newName, 'public');
      }

      $productData['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';
      $productData['trending'] = $request->has('trending');
      $product = $this->productsService->create($productData);

      if (!empty($product)) {
        return redirect()
          ->route('app-products-list')
          ->with('success', 'Product Added Successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Adding Product');
      }
    } catch (\Exception $error) {
      dd($error->getMessage());
      return redirect()
        ->route('app-products-list')
        ->with('error', 'Error while adding Product');
    }
  }

  public function edit($encrypted_id)
  {
    $id = decrypt($encrypted_id);

    $data = Products::find($id);
    $page_data['page_title'] = 'Product';
    $page_data['form_title'] = 'Edit Product';
    $product = $data;
    $productslist = $this->productsService->getAllProducts();
    $categories = Category::where('status', 'active')->get();

    return view('.content.apps.products.create-edit', compact('page_data', 'product', 'productslist', 'categories'));
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

  public function update(ProductRequest $request, $encrypted_id)
  {
    try {
      // dd($request->all());
      $id = decrypt($encrypted_id);
      // $userData['username'] = $request->get('username');
      $data['name'] = $request->get('name');
      $data['description'] = $request->get('description');
      $data['price'] = $request->get('price');
      $data['discount_price'] = $request->get('discount_price');
      $data['trending'] = $request->has('trending');

      // Get Category Name from ID
      $category = Category::find($request->get('category_id'));
      $data['category_name'] = $category ? $category->name : null;

      if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $newName = $filename . '_' . time() . '.' . $image->getClientOriginalExtension();
        $data['product_image'] = $image->storeAs('products', $newName, 'public');
      }

      $data['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';

      $updated = $this->productsService->updateProducts($id, $data);

      if (!empty($updated)) {
        return redirect()
          ->route('app-products-list')
          ->with('success', 'Product updated successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Updating Product');
      }
    } catch (\Exception $error) {
      dd($error->getMessage());
      return redirect()
        ->route('app-products-list')
        ->with('error', 'Error while editing Product');
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
      if ($this->productsService->deleteProducts($id)) {
        return redirect()
          ->route('app-products-list')
          ->with('success', 'Product Deleted Successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Deleting Product');
      }
    } catch (\Exception $error) {
      dd($error->getMessage());
      return redirect()
        ->route('app-products-list')
        ->with('error', 'Error while Deleting Product');
    }
  }

  public function deleteImage($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $product = Products::find($id);

      if ($product && $product->product_image) {
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($product->product_image)) {
          \Illuminate\Support\Facades\Storage::disk('public')->delete($product->product_image);
        }
        $product->product_image = null;
        $product->save();
        return response()->json(['success' => true]);
      }
      return response()->json(['success' => false]);
    } catch (\Exception $error) {
      dd($error->getMessage());
      return response()->json(['success' => false]);
    }
  }

  public function updateStatus(Request $request)
  {
    try {
      $id = decrypt($request->id);
      $product = Products::find($id);
      if ($product) {
        $product->status = $request->status == 'true' ? 'active' : 'inactive';
        $product->save();
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
      }
      return response()->json(['success' => false, 'message' => 'Product not found']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
  }
}
