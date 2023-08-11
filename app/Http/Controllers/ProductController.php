<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::get();
        return view('products', ['products' => $products]);
    }

    public function buy_product($id)
    {
        $product = Product::where('id', $id)->first();
        if(is_object($product))
        {
            $stripe_intent = auth()->user()->createSetupIntent();
            return view('buy_product', ['product' => $product, 'stripe_intent' => $stripe_intent]);
        }
        else
        {
            return view('404');
        }
    }

    public function make_payment(Request $request)
    {
        $input = $request->all();
        $product = Product::where('id', $input['product'])->first();
        try
        {
            $payment = $request->user()->newSubscription($input['product'], $product->product_id)->create($input['token']);
            if(is_object($payment))
            {
                return view('payment_success');
            }
            else
            {
                return view('payment_failure', ['message' => 'Something went wrong']);
            }
        }
        catch(\Exception $e)
        {
            return view('payment_failure', ['message' => $e->getMessage()]);
        }
    }

    public function payment_failure()
    {
        return view('payment_failure', ['message' => 'Something went wrong']);
    }

    public function payment_success()
    {
        return view('payment_success');
    }
}
