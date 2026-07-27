<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;

use Illuminate\Support\Facades\Crypt;
use App\Models\OrderDetail;

class RazorpayController extends Controller
{
    // public function store(Request $request)
    // {
    //     $input = $request->all();
    //     // dd($input);
    //     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    //     $payment = $api->payment->fetch($input['razorpay_payment_id']);
    //     if (count($input) && !empty($input['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
    //             $orderDetail = OrderDetail::findOrFail($input['order_id']);
    //             // dd($orderDetail);

    //             if ($orderDetail) {
    //                 $orderDetail->transaction_id = $response['id'];
    //                 $orderDetail->order_status = 'Completed';

    //                 $orderDetail->response_code = json_encode((array) $response);

    //                 $orderDetail->save();
    //             }
    //             // Update the necessary fields of the OrderDetail model


    //             // $payment = Payment::create([
    //             //     'r_payment_id' => $response['id'],
    //             //     'method' => $response['method'],
    //             //     'currency' => $response['currency'],
    //             //     'user_email' => $response['email'],
    //             //     'amount' => $response['amount'] / 100,
    //             //     'json_response' => json_encode((array) $response)
    //             // ]);
    //         } catch (\Exception $e) {
    //             // dd($e->getMessage());

    //             return redirect()->route("site")->with('error', $e->getMessage());


    //         }
    //     }
    //     // return redirect()->route("site")->with('success', "Payment Done");
    //     return redirect()->route("product.success", ['orderNumber' => $orderDetail->orderNumber]);


    // }

    public function processPayment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

            $orderDetail = OrderDetail::findOrFail($input['order_id']);
            if ($orderDetail) {
                $orderDetail->transaction_id = $response['id'];
                $orderDetail->order_status = 'Completed';
                $orderDetail->response_code = json_encode((array) $response);
                $orderDetail->save();
            }

            // Redirect to success page with orderNumber
            return redirect()->route("product.success", ['orderNumber' => $orderDetail->orderNumber]);

        } catch (\Exception $e) {
            return redirect()->route("site")->with('error', $e->getMessage());
        }
    }
    public function payment_form($id)
    {
        $pagename['page_title'] = "checkout";
        // dd($id);
        $decrypted_id = Crypt::decrypt($id);
        $order_detail = OrderDetail::findOrFail($decrypted_id);
        $totalAmount = $order_detail->totalAmount;
        // dd($order_detail);

        return view('product.payment', compact('order_detail', 'pagename', 'totalAmount'));




    }
}
