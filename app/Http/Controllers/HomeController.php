<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $oncartCount = Order::oncartCount();
        $category = $request->category;

        if(!$request->exists('category'))
        {
            $category = "All";
            $products = Product::paginate(6);
        }else
        {
            $category = $category;
            $products = Product::where('category', $category)->paginate(6);
        }

        $productCategories = ProductCategory::all();
        return view('home', compact(['products', 'productCategories', 'category', 'oncartCount']));
    }

    public function searchResult(Request $request)
    {
        $oncartCount = Order::oncartCount();
        $product_count = Product::count();
        $query = $request->input('query');

        $products = Product::search($query)->paginate($product_count);

        return view('search-result', compact(['products', 'query', 'oncartCount']));
    }

    public function contactUsView(Request $request)
    {
        $oncartCount = Order::oncartCount();
        return view('contactUs', compact(['oncartCount']));
    }
}
