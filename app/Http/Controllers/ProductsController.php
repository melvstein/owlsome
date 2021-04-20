<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ShippingDetails;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.products', compact('products'));
        }else{
            return view('user.staff.products', compact('products'));
        }
    }

    public function addProductView()
    {
        $categories = ProductCategory::all();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.add-product', compact('categories'));
        }else{
            return view('user.staff.add-product', compact('categories'));
        }
    }

    public function editProductView($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.edit-product', compact(['product', 'categories']));
        }else{
            return view('user.staff.edit-product', compact(['product', 'categories']));
        }
    }

    public function category()
    {
        $categories = ProductCategory::all();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.category', compact('categories'));
        }else{
            return view('user.staff.category', compact('categories'));
        }
    }

    public function addCategory(CategoryRequest $request)
    {
        ProductCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'Category added successfully!');
    }

    public function editCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:product_categories,name,'.$id.'|max:255',
        ]);

        ProductCategory::findOrFail($id)->update([
            'name' =>   $request->name,
        ]);

        return redirect()->back()->with('message', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();

        return redirect()->back()->with('message', 'Category deleted successfully!');
    }

    public function addProduct(ProductRequest $request)
    {
        $realFileName = $request->file('product_image')->getClientOriginalName();
        $newFileName = time().".".$realFileName;
        /* dd($newFileName); */
        $img = Image::make($request->file('product_image'))->resize(600, 600);

        $img->save('storage/products/'.$newFileName, 60);
        /* dd($img); */
        Product::create([
            'category' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'units' => $request->units,
            'details' => $request->details,
            'description' => $request->description,
            'image_path' => 'products/'.$newFileName,
        ]);

        return redirect()->back()->with('message', 'Product added successfully!');
    }

    public function updateProduct(Request $request, $id)
    {
        Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'price' => 'required|integer',
            'units' => 'required|string',
            'details' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Product::findOrFail($id)->update([
            'category' =>   $request->category,
            'name' =>   $request->name,
            'price' =>   $request->price,
            'units' =>   $request->units,
            'details' =>   $request->details,
            'description' =>   $request->description,
        ]);

        return redirect()->back()->with('message', 'Product updated successfully!');
    }

    public function updateImage(Request $request, $id)
    {
        Validator::make($request->all(), [
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        Storage::delete('public/'.$product->image_path);

        $realFileName = $request->file('product_image')->getClientOriginalName();
        $newFileName = time().".".$realFileName;
        /* dd($newFileName); */
        $img = Image::make($request->file('product_image'))->resize(600, 600);

        $img->save('storage/products/'.$newFileName, 60);

        Product::findOrFail($id)->update([
            'image_path' => 'products/'.$newFileName,
        ]);

        return redirect()->back()->with('message', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $order = Order::where('product_id', $id);
        $orders = Order::where('product_id', $id)->get();
        $orderIdCount = Order::selectRaw('count(order_id) as orderIdCount, order_id')->groupBy('order_id')->get();

        foreach($orderIdCount as $count)
        {
            if($count->orderIdCount == 1)
            {
                foreach($orders as $data)
                {
                    if($count->order_id == $data->order_id)
                    {
                        ShippingDetails::where('order_id', $data->order_id)->delete();
                        /* dd($data->order_id); */
                    }
                }
            }
        }

        Storage::delete('public/'.$product->image_path);
        $order->delete();
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully!');
    }

}
