<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Veritrans\Veritrans;
use App\User;
use JWTAuth;
use App\Order;
use App\OrderItem;
use App\Product;

class VeritransController extends Controller
{

  public function __construct(){
    Veritrans::$serverKey = 'SB-Mid-server-rJbj1YxY9qZ1k7SjgDh39vHI';
    Veritrans::$isProduction = false;
  }

  public function vtweb(Request $request,$order_id)
  {
      $user = JWTAuth::toUser();

      $order = Order::where('id',$order_id)->first();
      $address_id = $order->shipment_address_id;
      $address = $user->useraddress->where('id',$address_id)->first();
      $order_items = $order->orderitems;
      $errors = array();

      foreach($order_items as $item){
        $product = $item->products;
      }

      $price = (int)$order->total_price;
      $vt = new Veritrans;
      $transaction_details = array(
          'order_id' => $order_id,
          'gross_amount'  => $price
      );
      // Populate items
      $items = [];

      foreach($order_items as $item){
        $product_details = $item->products;

        $product_stock = Product::find($item->product_id)->product_qty;
        $product_name = Product::find($item->product_id)->product_name;
        if($item->qty <= $product_stock){
          $temp = array(
            'product_id' => $product_details->product_id,
            'price' => $item->price,
            'quantity' => $item->qty,
            'name' => $product_details->product_name
          );
          array_push($items,$temp);
        } else {
          array_push($errors,'Sorry! Our stock for '.$product_name.' is not enough.');
        }

      }
      // Populate customer's billing address
      $billing_address = array(
          'first_name' => $user['name'],
          'last_name' => "",
          'address'           => $address->address,
          'phone'                 => $user['phone'],
          'country_code'  => 'IDN'
          );
      // Populate customer's shipping address
      $shipping_address = array(
          'first_name'    => $user['name'],
          'last_name'     => "",
          'address'       => $address->address,
          'phone'             => $address->phone,
          'country_code'=> 'IDN'
          );
      // Populate customer's Info
      $customer_details = array(
          'first_name'            => $user['name'],
          'last_name'             => "",
          'email'                     => $user['email'],
          'phone'                     => $user['phone'],
          'billing_address' => $billing_address,
          'shipping_address'=> $shipping_address
          );
      // Data yang akan dikirim untuk request redirect_url.
      // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
      $transaction_data = array(
          'payment_type'          => 'vtweb',
          'vtweb'                         => array(
              'credit_card_3d_secure' => true
          ),
          'transaction_details'=> $transaction_details,
          'item_details'           => $items,
          'customer_details'   => $customer_details
      );

      try
      {
        if(count($errors)>0){
          return response(['msg' => $errors],400);
        } else {
          $vtweb_url = $vt->vtweb_charge($transaction_data);
          return response(['url' => $vtweb_url],200);
        }
      }
      catch (Exception $e)
      {
          return response(['err' => $e->getMessage],500);
      }
    }

    public function notification(Request $request)
    {
       $vt = new Veritrans;

        $result = $request;
        $order_id = $request->order_id;
        $totalprice = Order::find($order_id)->value('total_price');

        $order_items = OrderItem::where('order_id',$order_id)->get();

        foreach($order_items as $item){
          $mod = Product::find($item->product_id);
          $mod->product_qty -= $item->qty;
          $mod->product_sold += $item->qty;
          $mod->save();
        }

        Order::find($order_id)->update([
          'order_status' => 'On Process',
          'payment_date' => date('Y-m-d'),
          'payment_amount' => $totalprice,
          'shipment_status' => 'Packaging',
          'payment_status' => 'Verified'
        ]);

        return response(['msg'=>'success'],200);
    }
}
