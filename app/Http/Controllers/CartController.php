<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

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


    public function createOrder(Request $request)
    {

        $vd = session('validatedData');
        $usr = session('user');


        $favSauceString = implode(', ', $vd['fav_sauce']);
        Order::create([
            'main_product' => $vd['productName'],
            'second_product' => $vd['second_product'],
            'booking_date' => $vd['booking_date'],
            'request_date' => $vd['booking_date'],
            'additional' => $vd['additional'],
            'fav_sauce' => $favSauceString, // استخدام السلسلة النصية
            'total_price' => $vd['total_price'],
            'user_id' => auth()->id(),
        ]);
    
        return redirect('/test-noon');
    }
    


}
