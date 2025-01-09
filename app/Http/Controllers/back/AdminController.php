<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice; 
class AdminController extends Controller
{
    public function showInvoices(){
        $invoices = Invoice::all();
        return view('back.pages.invoices', compact('invoices'));
    }

    public function showUsers(){
        //
    }

    public function socialMedia(){
        //
    }
}
