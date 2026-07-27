<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\Category;

use App\Models\ProductVarients;
use App\Models\VarientsTypes;
use App\Models\VarientsTypesDetails;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class HomeController extends Controller
{

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService, ProductService $productService, Request $request)
    {

        $this->categoryService = $categoryService;
        $this->productService = $productService;


        //$guestId = $request->session()->get('guestId');



        View::share('categories', $this->categoryService->getMainCategory());

    }


    public function checkGuestId($guest_id, Request $request)
    {
        $guestId = $guest_id;

        $storeGuestId = $request->session()->put('guestId', $guestId);

    }

    public function index()
    {

        $pagename['page_title'] = "Home";

        return view('site.index', compact('pagename'));
    }



    public function products()
    {
        $categories = $this->categoryService->getMainCategory();
        return view('site.product_bkp_24_04_2024', compact('categories'));
    }


    public function Categoryproducts($slug_url)
    {

        // $categories = $this->categoryService->getMainCategory();
        $categoryName = $this->categoryService->getCategoryNames($slug_url);

        $pagename['page_title'] = $categoryName->name;

        //$products = $this->productService->getCategoryProducts();
        $product_count = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('categories.slug_url', '=', $slug_url)
            ->count();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('categories.slug_url', '=', $slug_url)
            ->get();


        $varients = DB::table('product_varients')->whereNull('deleted_at')->get();
        $varients_types = DB::table('varients_types')->whereNull('deleted_at')->get();


        if ($product_count > 0) {

            $productRanges = [];

            foreach ($products as $product) {
                if ($product->product_type == "Varient") {
                    $variantPrices = DB::table('varients_types_details')->where('product_id', $product->id)->get();

                    $minPrice = $variantPrices->min('price');
                    $maxPrice = $variantPrices->max('price');

                    $productRanges[] = [
                        'product_id' => $product->id,
                        'min_price' => $minPrice,
                        'max_price' => $maxPrice,
                        'product_type' => $product->product_type
                    ];

                } else {

                    $productRanges[] = [
                        'product_id' => $product->id,
                        'min_price' => $product->discount_price,
                        'max_price' => $product->price,
                        'product_type' => $product->product_type

                    ];

                }




            }


        }

        return view('site.product', compact('pagename', 'products', 'product_count', 'categoryName', 'varients', 'varients_types', 'productRanges'));
    }

    public function productDetails($product_slug, Request $request)
    {
        $guestId = $request->session()->get('guestId');



        $products = DB::table('products')->where('slug_url', $product_slug)->first();

        $pagename['page_title'] = $products->product_name;


        $productsMainImages = DB::table('product_images')->where('product_id', $products->id)->get();

        $provarientImages = DB::table('varients_types_details')->where('product_id', $products->id)->get();


        $productsImages = array_merge($productsMainImages->toArray(), $provarientImages->toArray());

        $countCartPoducts = DB::table('temp_addcarts')->where('guest_id', $guestId)->where('order_status', 'Pending')->whereNull('deleted_at')->count();



        if ($products->product_type == "Varient") {

            $varients = DB::table('product_varients')->whereNull('deleted_at')->get();
            $varients_types = DB::table('varients_types')->whereNull('deleted_at')->get();

            $variantPrices = DB::table('varients_types_details')
                ->join('varients_types', 'varients_types_details.varient_type_id', '=', 'varients_types.id')
                ->select('varients_types_details.*', 'varients_types.variant_sizes as variant_sizes')
                ->where('varients_types_details.product_id', '=', $products->id)
                ->get();

            $minPrice = $variantPrices->min('price');
            $maxPrice = $variantPrices->max('price');

            $productInfo = $variantPrices->first();
            $productRanges = [
                'product_id' => $products->id,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'discount_price' => $productInfo->discount_price,
                'variant_sizes' => $productInfo->varient_type_id,
                'images' => $productInfo->images,
                'product_type' => $products->product_type,
            ];

        } else {

            if ($products->discount_price != '') {
                $productPrice = $products->discount_price;
            } else {
                $productPrice = $products->price;
            }


            $minPrice = $productPrice;
            $productRanges = [
                'product_id' => $products->id,
                'min_price' => $minPrice,
                'max_price' => $products->price,
                'discount_price' => $products->discount_price,
                'variant_sizes' => '',
                'images' => '',
                'product_type' => $products->product_type,
            ];

            $varients = [];
            $varients_types = [];

            //dd($productRanges);

        }

        return view('site.product_details', compact('pagename', 'products', 'productRanges', 'varients', 'varients_types', 'productsImages', 'countCartPoducts'));
    }

    public function productsizePriceInfo($sizeId, $productId)
    {

        $variantPrices = DB::table('varients_types_details')->where(['product_id' => $productId, 'varient_type_id' => $sizeId])->first();
        $price = $variantPrices->price;
        $discountPrice = $variantPrices->discount_price;

        //dd($variantPrices);

        //$ProductVariantImage = $variantPrices->images;

        $ProductVariantImage = asset($variantPrices->images);




        $varientImage = '<div class="carousel-item active"><img src="' . $ProductVariantImage . '" class="d-block w-100" alt="Slide 1"></div>';


        $productsMainImages = DB::table('product_images')->where('product_id', $productId)->get();
        $provarientImages = DB::table('varients_types_details')->where('product_id', $productId)->get();

        $productsImages = array_merge($productsMainImages->toArray(), $provarientImages->toArray());



        $varientSliderImages = [];
        foreach ($productsImages as $productsImage) {
            $varientSliderImages['images'][] = asset($productsImage->images);
        }



        if ($variantPrices) {
            $responseData = [
                'price' => $price,
                'discountPrice' => $discountPrice,
                'varientImage' => $varientImage,
                'sliderImages' => $varientSliderImages,
            ];
            return response()->json(['success' => 'success', 'priceData' => $responseData]);

        } else {
            return response()->json(['error' => 'Variant price not found for the given size and product.'], 404);
        }



    }


    public function kmNutonic(Request $request)
    {
        $pagename['page_title'] = "KM Tonic";

        return view('product.km-nutonic', compact('pagename'));

    }

    public function imGrosty(Request $request)
    {
        $pagename['page_title'] = "Im Grosty";

        return view('product.im-grosty', compact('pagename'));

    }

    public function vitPremixB(Request $request)
    {

        $pagename['page_title'] = "The Vit Premix - B";
        return view('product.vit-premix', compact('pagename'));

    }
    public function vitPremixL(Request $request)
    {

        $pagename['page_title'] = "The Vit Premix - L";
        return view('product.vit-premixl', compact('pagename'));

    }


    public function myOrders(Request $request)
    {
        $pagename['page_title'] = "My Orders";

        $userId = $request->session()->get('userId');

        $orders = DB::table('order_details')
            ->join('temp_addcarts', 'order_details.guest_id', '=', 'temp_addcarts.guest_id')
            ->join('products', 'temp_addcarts.product_id', '=', 'products.id')
            ->leftJoin('varients_types', 'temp_addcarts.variant_size', '=', 'varients_types.id')
            ->select('order_details.*', 'temp_addcarts.*', 'varients_types.*', 'products.product_name as ProductName', 'products.featured_image as ProductImage')
            ->where('order_details.user_id', '=', $userId)
            ->where('order_details.order_status', '=', "Completed")
            ->get();



        return view('user.front_user_orders', compact('pagename', 'orders'));


    }

    public function myProfile(Request $request)
    {

        $pagename['page_title'] = "My Profile";

        $userId = $request->session()->get('userId');

        $userInfo = DB::table('users')->where('id', $userId)->first();


        return view('user.front_user_profile', compact('pagename', 'userInfo'));


    }


}


