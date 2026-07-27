<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\CouponCode\CreateCouponRequest;
use App\Http\Requests\CouponCode\UpdateCouponRequest;
use App\Services\CouponService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class CouponCodeController extends Controller
{
    protected CouponService $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;

    }
    public function index(Request $request)
    {

        return view('coupon_code.coupon_lists');

    }

    public function getAll()
    {
        $coupons = $this->couponService->getAllCoupons();
        return DataTables::of($coupons)->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);
            // dd($encryptedId);
            $updateButton = "<a class='btn btn-warning btn-sm '  href='" . route('app-coupon_code-edit', $encryptedId) . "'>
            <i class='fas fa-pencil-alt'></i></a>";
            // Delete Button
            $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-coupon_code-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $page_data['page_title'] = "Coupon";
        $page_data['form_title'] = "Add New Coupon";
        $coupon = '';
        $products = $this->couponService->getAllProducts();


        return view('coupon_code.coupon_code-create-edit', compact('page_data', 'products', 'coupon'));
    }

    public function store(CreateCouponRequest $request)
    {

        try {
            $CouponData['coupon_name'] = $request->get('coupon_title');
            $CouponData['coupon_code'] = $request->get('coupon_code');
            $CouponData['coupon_type'] = $request->get('coupon_type');
            $CouponData['amount'] = $request->get('coupon_amount');
            $CouponData['min_order_amount'] = $request->get('minimum_order');
            $CouponData['start_date'] = $request->get('start_date');
            $CouponData['end_date'] = $request->get('end_date');
            $CouponData['product_id'] = implode(",", $request->get('product'));
            $CouponData['per_user_uses'] = $request->get('per_user_use');
            $CouponData['status'] = $request->get('status') == 'on' ? true : false;

            $coupon = $this->couponService->create($CouponData);
            if (!empty($coupon)) {
                return redirect()->route("coupon_code.index")->with('success', 'Coupon  Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding Coupon');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("coupon_code.index")->with('error', 'Error while adding Coupon');
        }
    }

    public function edit($encrypted_id)
    {
        // dd('jkhjf');
        try {
            $id = decrypt($encrypted_id);
            $coupon = $this->couponService->getCoupon($id);
            $products = $this->couponService->getAllProducts();

            $page_data['page_title'] = "Coupon";
            $page_data['form_title'] = "Edit New Coupon";

            return view('coupon_code.coupon_code-create-edit', compact('page_data', 'products', 'coupon'));

        } catch (\Exception $error) {
            return redirect()->route("coupon_code.index")->with('error', 'Error while editing Coupon');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCouponRequest $request
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCouponRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            // $categoryData['categoryname'] = $request->get('categoryname');
            $CouponData['coupon_name'] = $request->get('coupon_title');
            $CouponData['coupon_code'] = $request->get('coupon_code');
            $CouponData['coupon_type'] = $request->get('coupon_type');
            $CouponData['amount'] = $request->get('coupon_amount');
            $CouponData['min_order_amount'] = $request->get('minimum_order');
            $CouponData['start_date'] = $request->get('start_date');
            $CouponData['end_date'] = $request->get('end_date');
            $CouponData['product_id'] = implode(",", $request->get('product'));
            $CouponData['per_user_uses'] = $request->get('per_user_use');
            $CouponData['status'] = $request->get('status') == 'on' ? true : false;

            $updated = $this->couponService->updateCoupon($id, $CouponData);

            if (!empty($updated)) {
                return redirect()->route("coupon_code.index")->with('success', 'Coupon Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating Coupon');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("coupon_code.index")->with('error', 'Error while editing Coupon');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $deleted = $this->couponService->deleteCoupon($id);
            if (!empty($deleted)) {
                return redirect()->route("coupon_code.index")->with('success', 'Coupon  Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Coupon');
            }
        } catch (\Exception $error) {
            return redirect()->route("coupon_code.index")->with('error', 'Error while editing Coupon');
        }
    }
}
