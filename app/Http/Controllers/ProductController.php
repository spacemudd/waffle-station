<?php

namespace App\Http\Controllers;

use App\Models\Product; // تأكد من استيراد الموديل
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // جلب المنتج حسب الـ ID
        $product = Product::find($id);

        // إذا لم يتم العثور على المنتج
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found');
        }

        // تمرير المنتج إلى view
        return view('front.prodcut-details', compact('product'));
    }



    public function getItems(){
        $items = Product::all();
        return view('back.pages.products', compact('items'));
    }


}
