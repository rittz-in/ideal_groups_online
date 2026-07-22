<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\Table;

class QrCodeService
{
  /**
   * Generate QR code for a table
   */
  public function generateTableQrCode(Table $table, string $baseUrl = null): string
  {
    $baseUrl = $baseUrl ?? config('app.url');
    $url = $baseUrl . '/home/' . $table->table_number;

    $options = new QROptions([
      'outputType' => QRCode::OUTPUT_IMAGE_PNG,
      'eccLevel' => QRCode::ECC_M,
      'scale' => 10,
      'imageBase64' => true,
      'addQuietzone' => true,
      'quietzoneSize' => 2,
    ]);

    $qrcode = new QRCode($options);
    return $qrcode->render($url);
  }

  /**
   * Generate QR code as SVG
   */
  public function generateTableQrCodeSvg(Table $table, string $baseUrl = null): string
  {
    $baseUrl = $baseUrl ?? config('app.url');
    $url = $baseUrl . '/home/' . $table->table_number;

    $options = new QROptions([
      'outputType' => QRCode::OUTPUT_MARKUP_SVG,
      'eccLevel' => QRCode::ECC_M,
      'addQuietzone' => true,
      'quietzoneSize' => 2,
      'svgViewBoxSize' => 100,
    ]);

    $qrcode = new QRCode($options);
    return $qrcode->render($url);
  }

  /**
   * Save QR code to file
   */
  public function saveTableQrCode(Table $table, string $baseUrl = null): string
  {
    $baseUrl = $baseUrl ?? config('app.url');
    $url = $baseUrl . '/home/' . $table->table_number;

    $options = new QROptions([
      'outputType' => QRCode::OUTPUT_IMAGE_PNG,
      'eccLevel' => QRCode::ECC_M,
      'scale' => 15,
      'imageBase64' => false, // Output raw binary PNG, not base64 data URI
      'addQuietzone' => true,
      'quietzoneSize' => 4,
    ]);

    $qrcode = new QRCode($options);
    $filename = 'table_' . $table->table_number . '_qr.png';
    $path = storage_path('app/public/qrcodes/' . $filename);

    // Create directory if not exists
    if (!file_exists(storage_path('app/public/qrcodes'))) {
      mkdir(storage_path('app/public/qrcodes'), 0755, true);
    }

    file_put_contents($path, $qrcode->render($url));

    return 'storage/qrcodes/' . $filename;
  }
}
