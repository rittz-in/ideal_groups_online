<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Table;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\QrCodeService;
use App\Services\UpiPaymentService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\Category\CategoryRequest;
use App\Services\TablesService;
use App\Http\Requests\Table\TableRequest;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\File;

class TablesController extends Controller
{
  protected $tablesService;
  protected $qrCodeService;

  public function __construct(TablesService $tablesService, QrCodeService $qrCodeService)
  {
    $this->tablesService = $tablesService;
    $this->qrCodeService = $qrCodeService;
    $this->middleware('permission:table-list|table-create|table-edit|table-delete', ['only' => ['index', 'show']]);
    $this->middleware('permission:table-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:table-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:table-delete', ['only' => ['destroy']]);
  }

  public function index()
  {
    $data = $this->tablesService->getAllTables();
    return view('content.apps.tables.list', compact('data'));
  }

  public function getAll()
  {
    $tables = $this->tablesService->getAllTables();
    return DataTables::of($tables)
      ->addColumn('status', function ($row) {
        if ($row->status == 'active') {
          return '<span class="badge bg-label-success">Active</span>';
        } else {
          return '<span class="badge bg-label-danger">Inactive</span>';
        }
      })
      ->addColumn('actions', function ($row) {
        $encryptedId = encrypt($row->id);
        $qrButton =
          "<a data-bs-toggle='tooltip' title='QR Code' data-bs-delay='400' class='btn-sm border-info' href='" .
          route('app-tables-qr', $encryptedId) .
          "'><i class='text-info ti ti-qrcode'></i></a>";
        $updateButton =
          "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn-sm border-warning' href='" .
          route('app-tables-edit', $encryptedId) .
          "'><i class='text-warning' data-feather='edit'></i></a>";
        $deleteButton =
          "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class=' btn-sm border-danger confirm-delete' data-idos='$encryptedId' href='" .
          route('app-tables-destroy', $encryptedId) .
          "'><i class='text-danger' data-feather='trash-2'></i></a>";
        return $qrButton . ' ' . $updateButton . ' ' . $deleteButton;
      })
      ->rawColumns(['actions', 'status'])
      ->make(true);
  }

  public function create()
  {
    $page_data['page_title'] = 'Table';
    $page_data['form_title'] = 'Add New Table';
    $table = '';
    return view('content.apps.tables.create-edit', compact('page_data', 'table'));
  }

  public function store(TableRequest $request)
  {
    try {
      $data = $request->validated();
      $data['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';

      $table = $this->tablesService->create($data);

      if ($table) {
        return redirect()
          ->route('app-tables-list')
          ->with('success', 'Table Created Successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Creating Table');
      }
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', $e->getMessage());
    }
  }

  public function edit($encrypted_id)
  {
    $id = decrypt($encrypted_id);
    $table = $this->tablesService->getTable($id);
    $page_data['page_title'] = 'Table';
    $page_data['form_title'] = 'Edit Table';
    return view('content.apps.tables.create-edit', compact('page_data', 'table'));
  }

  public function update(TableRequest $request, $encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $data = $request->validated();
      $data['status'] = $request->get('status') == 'active' ? 'active' : 'inactive';

      $updated = $this->tablesService->updateTable($id, $data);

      if ($updated) {
        return redirect()
          ->route('app-tables-list')
          ->with('success', 'Table Updated Successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Updating Table');
      }
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', $e->getMessage());
    }
  }

  public function destroy($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $deleted = $this->tablesService->deleteTable($id);
      if ($deleted) {
        return redirect()
          ->route('app-tables-list')
          ->with('success', 'Table Deleted Successfully');
      } else {
        return redirect()
          ->back()
          ->with('error', 'Error while Deleting Table');
      }
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', $e->getMessage());
    }
  }

  /**
   * Show QR code for a table
   */
  public function showQrCode($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $table = Table::findOrFail($id);
      $qrCode = $this->qrCodeService->generateTableQrCode($table);
      $qrUrl = config('app.url') . '/home/' . $table->table_number;

      return view('content.apps.tables.qr-code', compact('table', 'qrCode', 'qrUrl'));
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Error generating QR code: ' . $e->getMessage());
    }
  }

  /**
   * Download QR code as image
   */
  public function downloadQrCode($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $table = Table::findOrFail($id);
      $path = $this->qrCodeService->saveTableQrCode($table);

      return response()->download(public_path($path), 'table_' . $table->table_number . '_qr.png');
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Error downloading QR code: ' . $e->getMessage());
    }
  }

  /**
   * Print all QR codes
   */
  public function printAllQrCodes()
  {
    $tables = Table::where('status', 'active')->get();
    $qrCodes = [];

    foreach ($tables as $table) {
      $qrCodes[] = [
        'table' => $table,
        'qr' => $this->qrCodeService->generateTableQrCode($table),
        'url' => config('app.url') . '/home/' . $table->table_number,
      ];
    }

    return view('content.apps.tables.print-qr-codes', compact('qrCodes'));
  }

  /**
   * Show Payment QR management page
   */
  public function paymentQr()
  {
    $qrPath = PaymentSetting::getVal('payment_qr_code');
    return view('content.apps.tables.payment-qr', compact('qrPath'));
  }

  /**
   * Update Payment QR code
   */
  public function updatePaymentQr(Request $request)
  {
    $request->validate([
      'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'upi_id' => 'required|string|max:100',
      'merchant_name' => 'required|string|max:100',
    ]);

    // Save UPI ID and Merchant Name
    PaymentSetting::setVal('payment_upi_id', $request->upi_id);
    PaymentSetting::setVal('payment_merchant_name', $request->merchant_name);

    if ($request->hasFile('qr_code')) {
      // Delete old QR code if exists
      $oldPath = PaymentSetting::getVal('payment_qr_code');
      if ($oldPath && File::exists(public_path($oldPath))) {
        File::delete(public_path($oldPath));
      }

      // Upload new QR code
      $imageName = 'payment_qr_' . time() . '.' . $request->qr_code->extension();
      $request->qr_code->move(public_path('assets/img/qr'), $imageName);
      $newPath = 'assets/img/qr/' . $imageName;

      PaymentSetting::setVal('payment_qr_code', $newPath);
    }

    return redirect()
      ->back()
      ->with('success', 'Payment settings updated successfully.');
  }

  /**
   * Delete Payment QR code
   */
  public function deletePaymentQr()
  {
    $qrPath = PaymentSetting::getVal('payment_qr_code');
    if ($qrPath && File::exists(public_path($qrPath))) {
      File::delete(public_path($qrPath));
    }

    PaymentSetting::setVal('payment_qr_code', null);

    return redirect()
      ->back()
      ->with('success', 'Payment QR Code deleted successfully.');
  }

  /**
   * Generate dynamic UPI payment QR code
   */
  public function generatePaymentQr(Request $request)
  {
    try {
      $request->validate([
        'amount' => 'nullable|numeric|min:0',
      ]);

      $upiService = new UpiPaymentService();
      $qrData = $upiService->generateGenericPaymentQr(null, null, $request->amount);

      return response()->json([
        'success' => true,
        'data' => $qrData,
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => $e->getMessage(),
        ],
        500
      );
    }
  }
}
