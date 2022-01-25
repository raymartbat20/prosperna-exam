<?php

namespace App\Http\Controllers;

use App\Product;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use Illuminate\Http\Request;
use App\Traits\PaypalPayment;
use PayPal\Api\PaymentExecution;
use App\Http\Requests\PaymentRequest;

class CheckoutController extends Controller
{
    protected $paypal;

    public function __construct()
    {
        $this->paypal = new PaypalPayment();
    }

    /**
     * User Checkout
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function checkout(Request $request)
    {
        $data['product'] = Product::first();

        return view('checkout.index',$data);
    }

    /**
     * Submit payment using paypal
     * 
     * @param Request $request
     * 
     * @return redirect
     */
    public function handlePayment(PaymentRequest $request)
    {
        $product = Product::first();
        $this->paypal->setPayer();
        $item1 = $this->paypal->setNewItem($product->name,$product->price,rand(000000,999999));
        $this->paypal->setItemList(array($item1));
        $this->paypal->setDetails($product->price,0,0);
        $this->paypal->setAmount($product->price);
        $this->paypal->setTransaction();
        $this->paypal->setRedirectUrls(route('checkout.success.payment'),route('checkout.cancel.payment'));
        $payment = $this->paypal->payment();
        $payment->create($this->paypal->apiContext);
        return redirect($payment->getApprovalLink());
    }

    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
  
    public function paymentSuccess(Request $request)
    {
        
                $apiContext = $this->paypal->apiContext;
                $paymentId = request('paymentId');
                $payment = Payment::get($paymentId, $apiContext);
            
                $execution = new PaymentExecution();
                $execution->setPayerId(request('PayerID'));
            
                try {
                    $payment->execute($execution, $apiContext);
                    try {
                        $payment = Payment::get($paymentId, $apiContext);
                    } catch (\Exception $ex) {
            
                        dd($ex->getMessage());
                    }
                } catch (\Exception $ex) {
                    dd($ex->getMessage());
                }

                // Add logic here to save the transacion on the database
                
                return redirect()->route("product.index")->with('success','Order Successfully!');
    }
}
