<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class IndexController extends Controller
{
    public function openHomePage(Request $request){
        $products = Product::all();
        return view('site.index', compact('products'));
    }
    public function getProductDetails(Request $request){
        return view('site.product_details');
    }

    public function openCartPage(){
        return view('site.cart');
    }

    public function openCheckoutPage(){
        return view('site.checkout');
    }

    public function addProductIntoCart(Request $request){
        $product_id = $request->product_id;

        $product = Product::find($product_id);
        if( !$product ){
            return response()->json([
                "error"=>"Unable to get product"
            ], 404);
        }
        $cart = session()->get('cart');
        session()->forget('cart');

        $productId = $product->id;
        if( !$cart  ){
            $cart = [
                $productId => [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->price,
                    'image' => $product->gallery ? $product->gallery->image : '',
                ]
            ];

            session()->put('cart', $cart);
        }
        if(isset($cart[$productId])){
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
        }
        else{
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->gallery ? $product->gallery->image : '',
            ];
            session()->put('cart', $cart);
        }

        $cartTotalItems = count($cart);
        return response()->json([
            'products' => $cart,
            'cart_total_items' => $cartTotalItems
        ], 201);

        //return $request->product_id;
    }

    public function calculateCartItems(){
        $cart = session()->get('cart');
        $cartTotalItems = count($cart);
        return response()->json([
            'cart_total_items' => $cartTotalItems
        ], 201);
    }
}
