<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\PaymentSetting;

class UpiPaymentService
{
  /**
   * Generate UPI payment URL
   *
   * @param string $upiId
   * @param string $name
   * @param float $amount
   * @param string $note
   * @return string
   */
  public function generateUpiUrl($upiId, $name, $amount, $note = '')
  {
    // UPI URL format: upi://pay?pa=<UPI_ID>&pn=<NAME>&am=<AMOUNT>&cu=INR&tn=<NOTE>
    // Keep it short to avoid QR code overflow
    $params = [
      'pa' => $upiId, // Payee address (UPI ID)
      'pn' => mb_substr($name, 0, 20), // Payee name (limit to 20 chars)
      'am' => number_format($amount, 2, '.', ''), // Amount
      'cu' => 'INR', // Currency
    ];

    // Keep transaction note short to avoid QR overflow
    if (!empty($note)) {
      $params['tn'] = mb_substr($note, 0, 30); // Limit to 30 chars
    }

    $queryString = http_build_query($params);
    return 'upi://pay?' . $queryString;
  }

  /**
   * Generate QR code image data URL for UPI payment
   *
   * @param string $upiUrl
   * @return string
   */
  public function generateQrCode($upiUrl)
  {
    $options = new QROptions([
      'version' => QRCode::VERSION_AUTO, // Auto-detect version based on data
      'outputType' => QRCode::OUTPUT_IMAGE_PNG,
      'eccLevel' => QRCode::ECC_L, // Lowest error correction for smaller QR
      'scale' => 8, // Reduced scale for better compatibility
      'imageBase64' => true,
    ]);

    $qrcode = new QRCode($options);
    return $qrcode->render($upiUrl);
  }

  /**
   * Generate UPI QR code for an order
   *
   * @param float $amount
   * @param string $orderNumber
   * @return array
   */
  public function generateOrderPaymentQr($amount, $orderNumber)
  {
    $upiId = PaymentSetting::getVal('payment_upi_id');
    $merchantName = PaymentSetting::getVal('payment_merchant_name', 'Restaurant');

    if (!$upiId) {
      throw new \Exception('UPI ID not configured. Please set up payment settings.');
    }

    // Keep note short - just last 6 digits of order number
    $shortOrderNumber = substr($orderNumber, -6);
    $note = 'Order ' . $shortOrderNumber;
    $upiUrl = $this->generateUpiUrl($upiId, $merchantName, $amount, $note);
    $qrCode = $this->generateQrCode($upiUrl);

    return [
      'upi_id' => $upiId,
      'merchant_name' => $merchantName,
      'amount' => $amount,
      'order_number' => $orderNumber,
      'upi_url' => $upiUrl,
      'qr_code' => $qrCode,
    ];
  }

  /**
   * Generate generic UPI QR code
   *
   * @param string|null $upiId
   * @param string|null $merchantName
   * @param float|null $amount
   * @return array
   */
  public function generateGenericPaymentQr($upiId = null, $merchantName = null, $amount = null)
  {
    $upiId = $upiId ?: PaymentSetting::getVal('payment_upi_id');
    $merchantName = $merchantName ?: PaymentSetting::getVal('payment_merchant_name', 'Restaurant');

    if (!$upiId) {
      throw new \Exception('UPI ID not configured. Please set up payment settings.');
    }

    // Keep note minimal for generic payments
    $note = $amount ? 'Pay ' . $amount : 'Payment';
    $upiUrl = $this->generateUpiUrl($upiId, $merchantName, $amount ?: 0, $note);
    $qrCode = $this->generateQrCode($upiUrl);

    return [
      'upi_id' => $upiId,
      'merchant_name' => $merchantName,
      'amount' => $amount,
      'upi_url' => $upiUrl,
      'qr_code' => $qrCode,
    ];
  }
}
