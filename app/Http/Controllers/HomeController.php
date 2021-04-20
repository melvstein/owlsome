<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Mail;

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

    public function contactUsSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'contactNumber' => 'required|min:11|max:11',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $details = [
                'name' => $request->name,
                'email' => $request->email,
                'contactNumber' => $request->contactNumber,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

        /* dd($details['email']); */
        Mail::to('owlsome2021@gmail.com')->send(new ContactUsMail($details));

        return redirect()->back()->with('message', 'Mail Sent Successfully, Thank you!');
    }
}
