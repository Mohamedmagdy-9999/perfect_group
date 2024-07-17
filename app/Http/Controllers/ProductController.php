<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'category_id' => 'required',
            'image' => 'required',
            'desc' => 'required',
            'name' => 'required',
        ]);

        
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = $request->desc;

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('admin/products', $name);
            $product->image = $name;
        }


        $product->save();
        
       
        return back()->with('message' , 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([

            'category_id' => 'required',
            'desc' => 'required',
            'name' => 'required',
        ]);

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('admin/products', $name);
           
        }
        
        $product =  Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = $request->desc;
        if(!empty($name))
        {
            $imagePath = public_path('admin/products/' .$product->image);
            if(file_exists($imagePath))
            {
                unlink($imagePath);
            }
            $product->image = $name;
        }
      
        $product->save();
        
       
        return back()->with('message' , 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product =  Product::FindOrFail($id);
        $imagePath = public_path('admin/peoducts/' .$product->image);

        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }

       $product->delete();
        
        return back()->with('message' , 'تم الحذف بنجاح');
    }
}
