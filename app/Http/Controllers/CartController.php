<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
   public function store(Request $request)
   {
        $product = Product::find($request->input(key:'productId'));
        $quantity = (int) $request->input('quantity');
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'quantity' => $quantity, // Default quantity
            'attributes' => [
                'image' => $product->image, // صورة المنتج
            ]
        ]);
        

        return redirect()->route(route:'home')->with('message', 'Successfully added');
   }
    
    

    

    public function viewCart()
    {
        
        $cartItems = Cart::getContent();
        return view('front.pages.cart', compact('cartItems'));
    }
}
