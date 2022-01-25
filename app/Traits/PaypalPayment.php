<?php

namespace App\Traits;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use Illuminate\Support\Str;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;

class PaypalPayment
{
    public $apiContext;
    protected $redirectUrls;
    protected $payer;
    protected $transaction;
    protected $itemList;
    protected $details;
    protected $amount;
    public $total;

    public function __construct()
    {
        $this->apiContext = new ApiContext(new OAuthTokenCredential(config('paypal.client_id'),config('paypal.secret')));
    }

    /**
     * @param string $method
     * 
     * @return PayPal\Api\Payer
     */
    public function setPayer($method = "paypal")
    {
        $payer = new Payer();
        $payer->setPaymentMethod($method);
        $this->payer = $payer;
        return $payer;
    }

    /**
     * @param string name
     * @param string price
     * @param int qty
     * @param string currency
     * @param int sku
     * 
     * @return PayPal\Api\Item
     */
    public function setNewItem($name,$price,$sku,$qty = 1,$currency = 'PHP')
    {
        $item = new Item();

        $item->setName($name)
        ->setCurrency($currency)
        ->setQuantity($qty)
        ->setSku($sku) // Similar to `item_number` in Classic API
        ->setPrice($price);

        return $item;
    }

    /**
     * @param array $items
     * 
     * @return PayPal\Api\ItemList
     */
    public function setItemList($items)
    {
        $itemList = new ItemList();
        $itemList->setItems($items);
        $this->itemList = $itemList;
        return $itemList;
    }

    /**
     * @param string returnUrl
     * @param string cancelUrl
     * 
     * @return PayPal\Api\RedirectUrls
     */
    public function setRedirectUrls($returnUrl, $cancelUrl)
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($returnUrl)
            ->setCancelUrl($cancelUrl);

        $this->redirectUrls = $redirectUrls;
        return $redirectUrls;
    }

    /**
     * @param int $subTotal
     * @param int $tax
     * @param int $shipping
     * 
     * @return PayPal\Api\Details;
     */
    public function setDetails($subTotal,$tax = 0, $shipping = 0)
    {
        $details = new Details();
        $this->details = $details->setShipping($shipping)
                ->setTax($tax)
                ->setSubtotal($subTotal);

        return $details;
    }

    /**
     * @param int $total
     * @param PaylPal\Api\Details $details
     * @param string $currency
     * 
     * @return PayPal\Api\Amount
     */
    public function setAmount($total,$currency = "PHP")
    {
        $amount = new Amount();
        $amount->setCurrency($currency)
        ->setTotal($total)
        ->setDetails($this->details);
        $this->amount = $amount;
        return $amount;
    }


    /**
     * @param int $amount
     * @param array $itemList
     * @param string $description
     * 
     * @return PayPal\Api\Transaction
     */
    public function setTransaction($description = "Payment description")
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->amount)
            ->setItemList($this->itemList)
            ->setDescription($description)
            ->setInvoiceNumber(uniqid());
        $this->transaction = $transaction;
        return $transaction;
    }

    /**
     * @param PayPal\Api\Payer $payer
     * @param PayPal\Api\RedirectUrls $redirectUrls
     * @param PayPal\Api\Transaction $transaction
     * @param string $intent
     * 
     * @return PayPal\Api\Payment
     */
    public function payment($intent = "sale")
    {
        $payment = new Payment();
        $payment->setIntent($intent)
            ->setPayer($this->payer)
            ->setRedirectUrls($this->redirectUrls)
            ->setTransactions(array($this->transaction));
        
        return $payment;
    }
}