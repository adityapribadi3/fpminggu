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

        $temp = array(
          'product_id' => $product_details->product_id,
          'price' => $item->price,
          'quantity' => $item->qty,
          'name' => $product_details->product_name
        );
        array_push($items,$temp);

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
          $vtweb_url = $vt->vtweb_charge($transaction_data);
          return response(['url' => $vtweb_url]);
      }
      catch (Exception $e)
      {
          return response(['err' => $e->getMessage]);
      }
    }

    public function notification()
    {
        $vt = new Veritrans;
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);
        if($result){
        $notif = $vt->status($result->order_id);
        }
        error_log(print_r($result,TRUE));

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        if ($transaction == 'capture') {
          // For credit card transaction, we need to check whether transaction is challenge by FDS or not
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              // TODO set payment status in merchant's database to 'Challenge by FDS'
              // TODO merchant should decide whether this transaction is authorized or not in MAP
              echo "Transaction order_id: " . $order_id ." is challenged by FDS";
              }
              else {
              // TODO set payment status in merchant's database to 'Success'
              echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
              }
            }
          }
        else if ($transaction == 'settlement'){
          // TODO set payment status in merchant's database to 'Settlement'
          echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
          }
          else if($transaction == 'pending'){
          // TODO set payment status in merchant's database to 'Pending'
          echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
          }
          else if ($transaction == 'deny') {
          // TODO set payment status in merchant's database to 'Denied'
          echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }
        $totalprice = Order::find($order_id)->value('total_price');

        $order_items = OrderItem::where('order_id',$order_id)->get();

        foreach($order_items as $item){
          $mod = Product::find($item->product_id);
          $mod->product_qty -= $item->qty;
          $mod->product_sold += $item->qty;
          $mod->save();
        }

        Order::find($order_id)->update([
          'order_status' => $transaction,
          'payment_date' => date('Y-m-d'),
          'payment_amount' => $totalprice,
          'shipment_status' => 'On Process',
          'payment_status' => 'Verified'
        ]);

        return response(['msg'=>'success'],200);
    }
}
