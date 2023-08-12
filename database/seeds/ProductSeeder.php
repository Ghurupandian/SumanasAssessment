<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $products = $stripe->products->all();
        if(count($products))
        {
            foreach($products as $product)
            {
                if(isset($product->default_price) && $product->default_price != '' && $product->active == 1)
                {
                    $check_product = Product::where('product_id', $product->default_price)->get()->count();
                    if($check_product == 0)
                    {
                        $price = $stripe->prices->retrieve(
                            $product->default_price,
                            []
                        );
                        if(is_object($price))
                        {
                            $data['name'] = $product->name;
                            $data['product_id'] = $product->default_price;
                            $data['price'] = $price->unit_amount / 100;
                            $data['description'] = $product->description;
                            Product::create($data);
                        }
                    }
                }
            }
        }
    }
}
