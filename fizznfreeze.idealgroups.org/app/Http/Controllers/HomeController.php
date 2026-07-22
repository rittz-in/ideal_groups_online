<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // No auth required for customer-facing pages
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request, $table = null)
  {
    try {
      $categories = Category::where('status', 'active')
        ->whereHas('products', function ($q) {
          $q->where('status', 'active');
        })
        ->get();
      $products = Products::where('status', 'active')
        ->where('trending', true)
        ->get();
      return view('frontend.pages.home', compact('categories', 'products'));
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Invalid product ID.');
    }
  }
  public function product(Request $request, $category = 'all')
  {
    try {
      $categoryName = $category;
      $categories = Category::where('status', 'active')
        ->whereHas('products', function ($q) {
          $q->where('status', 'active');
        })
        ->get();

      $query = Products::where('status', 'active');

      // If 'all' or 'trending', show trending items
      if ($categoryName === 'all' || $categoryName === 'trending') {
        $query->where('trending', true);
        $categoryName = 'Trending';
      } else {
        $query->where('category_name', $categoryName);
      }

      $products = $query->get();

      return view('frontend.pages.product', compact('products', 'categories', 'categoryName'));
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Invalid product ID.');
    }
  }

  public function productDetail(Request $request, $id)
  {
    try {
      $decryptedId = decrypt($id);
      $product = Products::where('id', $decryptedId)
        ->where('status', 'active')
        ->first();

      if (!$product) {
        return redirect()
          ->back()
          ->with('error', 'Product not found.');
      }

      $categories = Category::where('status', 'active')
        ->whereHas('products', function ($q) {
          $q->where('status', 'active');
        })
        ->get();
      return view('frontend.pages.product_detail', compact('product', 'categories'));
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Invalid product ID.');
    }
  }

  public function search(Request $request)
  {
    $query = $request->get('q');
    $format = $request->get('format');

    $dbQuery = Products::where('status', 'active');

    if (!empty($query)) {
      $dbQuery->where('name', 'LIKE', "%{$query}%");
    }

    $products = $dbQuery->get();

    // Return JSON for AJAX requests
    if ($format === 'json' || $request->ajax()) {
      $formattedProducts = $products->map(function ($product) {
        return [
          'id' => $product->id,
          'encrypted_id' => encrypt($product->id),
          'name' => $product->name,
          'description' => $product->description,
          'category_name' => $product->category_name,
          'price' => $product->price,
          'discount_price' => $product->discount_price,
          'trending' => $product->trending,
          'image' => $product->product_image
            ? asset('storage/' . $product->product_image)
            : asset('FrontAssets/images/food1.png'),
        ];
      });

      return response()->json(['products' => $formattedProducts]);
    }

    // Fallback for non-AJAX requests
    return view('frontend.partials.product_list', compact('products'))->render();
  }
}
