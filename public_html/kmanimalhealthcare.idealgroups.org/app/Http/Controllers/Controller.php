<?php

namespace App\Http\Controllers;


use App\Mail\DynamicEmail;
use App\Models\TempAddcart;
use App\Models\Product;
use App\Models\OrderDetail;



use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendProductInvoice($type = '', $user_ids = [], $other = [])
    {
        $emailTemplate = $type;
        if ($emailTemplate == "Product Invoice") {

            $UserGuestId = $user_ids;
            $user_email = $other;

            $logoUrl = asset('siteassets/images/km-healthcare-logo.png');

            $items = TempAddcart::where('guest_id', $UserGuestId)->get();
            $template = "<body style='font-family: Arial, sans-serif; margin: 0; padding: 0;'>
                <div style='background-color: #ffffff; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #dddddd;'>
                    <div style='text-align: center; margin-bottom: 20px;'>
                        <h3 style='margin: 0; padding: 5px; font-size: 25px;'>
                            <img src='$logoUrl' alt='Company Logo' style='height: auto; width: 100px;'>
                        </h3>
                    </div>
                    <table style='width: 100%; border-collapse: collapse;'>
                        <thead>
                            <tr style='background-color: #f5f5f5;'>
                                <th style='padding: 10px; border: 1px solid #dddddd;'>Product</th>
                                <th style='padding: 10px; border: 1px solid #dddddd;'>Item Name</th>
                                <th style='padding: 10px; border: 1px solid #dddddd;'>Quantity</th>
                                <th style='padding: 10px; border: 1px solid #dddddd;'>Amount</th>
                                <th style='padding: 10px; border: 1px solid #dddddd;'>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>";

            $totalAmount = 0;
            foreach ($items as $item) {
                $productinfo = Product::where('id', $item->product_id)->first();
                $productImageUrl = asset($productinfo->featured_image);

                $totalAmount += $item->total_amount;

                $template .= "<tr>
                    <td style='padding: 10px; border: 1px solid #dddddd; text-align: center;'>
                        <img src='$productImageUrl' alt='Product Image' style='width: 60px; height: auto;'>
                    </td>
                    <td style='padding: 10px; border: 1px solid #dddddd;'>$productinfo->product_name</td>
                    <td style='padding: 10px; border: 1px solid #dddddd; text-align: center;'>$item->quntity</td>
                    <td style='padding: 10px; border: 1px solid #dddddd; text-align: right;'>$item->amount</td>
                    <td style='padding: 10px; border: 1px solid #dddddd; text-align: right;'>$item->total_amount</td>
                   
                </tr>";
            }
            $template .= "<tr>
                    <td colspan='4' style='padding: 10px; border: 1px solid #dddddd; text-align: right; font-weight: bold;'>Total Amount</td>
                    <td style='padding: 10px; border: 1px solid #dddddd; text-align: right; font-weight: bold;'>Rs.$totalAmount</td>
                </tr>";

            $template .= "</tbody></table>";
            $template .= "<p><a href=\"" . route('site') . "\">KM Animal Health Care</a></p>";
            $template .= "</div></body>";





            \Mail::to(trim($user_email))->send(new DynamicEmail("Order Details", $template, $other = ''));
        }

    }


    /*---------  Admin Email -------*/

    public function sendAdminEmail($type = '', $user_ids = [], $other = [])
    {
        $emailTemplate = $type;
        if ($emailTemplate == "Admin Email") {

            $UserGuestId = $user_ids;
            $user_email = "viveklimbani1998@gmail.com";

            $ClientInfo = OrderDetail::where('guest_id', $UserGuestId)->first();



            $logoUrl = asset('siteassets/images/km-healthcare-logo.png');

            $items = TempAddcart::where('guest_id', $UserGuestId)->get();
            $template = "<body style='font-family: Arial, sans-serif; margin: 0; padding: 0;'>
                 <div style='background-color: #ffffff; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #dddddd;'>
                     <p>$ClientInfo->fname. .$ClientInfo->lname has ordered with the products listed below:</p>
                     <div style='text-align: center; margin-bottom: 20px;'>
                         <h3 style='margin: 0; padding: 5px; font-size: 25px;'>
                             <img src='$logoUrl' alt='Company Logo' style='height: auto; width: 100px;'>
                         </h3>
                     </div>
                     <table style='width: 100%; border-collapse: collapse;'>
                         <thead>
                             <tr style='background-color: #f5f5f5;'>
                                 <th style='padding: 10px; border: 1px solid #dddddd;'>Product</th>
                                 <th style='padding: 10px; border: 1px solid #dddddd;'>Item Name</th>
                                 <th style='padding: 10px; border: 1px solid #dddddd;'>Quantity</th>
                                 <th style='padding: 10px; border: 1px solid #dddddd;'>Amount</th>
                                 <th style='padding: 10px; border: 1px solid #dddddd;'>Total Amount</th>
                             </tr>
                         </thead>
                         <tbody>";

            $totalAmount = 0;
            foreach ($items as $item) {
                $productinfo = Product::where('id', $item->product_id)->first();
                $productImageUrl = asset($productinfo->featured_image);

                $totalAmount += $item->total_amount;

                $template .= "<tr>
                     <td style='padding: 10px; border: 1px solid #dddddd; text-align: center;'>
                         <img src='$productImageUrl' alt='Product Image' style='width: 60px; height: auto;'>
                     </td>
                     <td style='padding: 10px; border: 1px solid #dddddd;'>$productinfo->product_name</td>
                     <td style='padding: 10px; border: 1px solid #dddddd; text-align: center;'>$item->quntity</td>
                     <td style='padding: 10px; border: 1px solid #dddddd; text-align: right;'>$item->amount</td>
                     <td style='padding: 10px; border: 1px solid #dddddd; text-align: right;'>$item->total_amount</td>
                    
                 </tr>";
            }
            $template .= "<tr>
                     <td colspan='4' style='padding: 10px; border: 1px solid #dddddd; text-align: right; font-weight: bold;'>Total Amount</td>
                     <td style='padding: 10px; border: 1px solid #dddddd; text-align: right; font-weight: bold;'>Rs.$totalAmount</td>
                 </tr>";

            $template .= "</tbody></table>";
            $template .= "<p><a href=\"" . route('site') . "\">KM Animal Health Care</a></p>";
            $template .= "</div></body>";





            \Mail::to(trim($user_email))->send(new DynamicEmail("Order Details", $template, $other = ''));
        }

    }


}
