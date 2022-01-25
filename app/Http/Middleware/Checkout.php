<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;

class Checkout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = null;
        $product_slug = $request->route('product');

        if($product_slug){
            
            $product = Product::where('slug',$product_slug)->first();
            if($product){
                $request->merge(["product" => $product]);
                return $next($request);
            }

            $message = 'No Product found.';
        }

        $message = $message ?? 'Please select a product first';
        session()->flash('error',$message);
        return redirect()->route('product.index');
    }
}
