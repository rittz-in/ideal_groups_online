<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CategoryService;

class StressoLiteController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;


        View::share('categories', $this->categoryService->getMainCategory());

    }

    public function index(Request $request)
    {

        $pagename['page_title'] = "Stresso Lite";

        return view('product.stresso-lite', compact('pagename'));

    }
}
