<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('product',compact('categories'));
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
            'product' => 'required',
            'price' =>'required',
            'category'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $product = new Product;
        $product->user_id = Auth::user()->id;
        $product->name = $request->product;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images/'), $imageName);
        $product->image = $imageName;
        $product->save();

        return redirect()->route('product.index')->with('success','Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function ApiList(Request $request)
    {
        $category = $request->get('category') ;
       $q = Product::select('products.*','categories.name as category_name')
                        ->join('categories','categories.id','=','products.category_id')
                        ->where('products.user_id',Auth::id());
        if(!empty($category)){

            $q->where('products.category_id',$category);
         }               
        $products =  $q->get();
        return $products;               
    }
}
