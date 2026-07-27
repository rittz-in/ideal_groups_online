<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }
    public function index(Request $request)
    {

        return view('user.users-management');

    }

    public function getAll()
    {
        $user = $this->userService->getAllUser();
        return DataTables::of($user)->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);
            // dd($encryptedId);
            $updateButton = "<a class='btn btn-warning btn-sm '  href='" . route('app-user-edit', $encryptedId) . "'><i class='fas fa-pencil-alt'></i></a>";

            // Delete Button
            $deleteButton = "<a class='btn btn-danger btn-sm' onclick='return deleteConfirm()'  href='" . route('app-user-destroy', $encryptedId) . "'><i class='fas fa-trash-alt'></i></a>";

            return $updateButton . " " . $deleteButton;
        })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $page_data['page_title'] = "User";
        $page_data['form_title'] = "Add New User";
        $user = '';
        return view('user.user-create-edit', compact('page_data', 'user'));
    }

    public function store(CreateUserRequest $request)
    {

        try {
            $UserData['name'] = $request->get('name');
            $UserData['email'] = $request->get('email');
            $UserData['password'] = Hash::make($request->get('password'));
            $UserData['phone'] = $request->get('mobile');

            $UserData['address'] = $request->get('address');
            // $UserData['created_by'] = auth()->user()->id;
            $UserData['status'] = $request->get('status') == 'on' ? true : false;
            $UserData['is_admin'] = $request->get('status') == 'on' ? true : false;

            $user = $this->userService->create($UserData);
            if (!empty($user)) {
                return redirect()->route("users.index")->with('success', 'User Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding User');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("users.index")->with('error', 'Error while adding User');
        }
    }

    public function edit($encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            $user = $this->userService->getUser($id);

            // $restaurant = $this->restaurantsService->getRestaurant($id);
            // $CategoryData = explode(',', $restaurant->categories_id);
            // dd($CategoryData);
            $page_data['page_title'] = "User";
            $page_data['form_title'] = "Edit New User";
            // $Category = Category::whereNull('deleted_at')->where('status', '1')->get();
            // $ResPhotos = explode(",", $restaurant->restaurant_photos);
            // $ResMenuPhotos = explode(",", $restaurant->restaurant_menu_photo);
            return view('user.user-create-edit', compact('page_data', 'user'));

        } catch (\Exception $error) {
            return redirect()->route("users.index")->with('error', 'Error while editing User');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $encrypted_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);
            // $userData['username'] = $request->get('username');
            $UserData['name'] = $request->get('name');
            $UserData['email'] = $request->get('email');

            if ($request->get('password') != null && $request->get('password') != '') {
                $UserData['password'] = Hash::make($request->get('password'));
            }
            $UserData['phone'] = $request->get('mobile');
            $UserData['address'] = $request->get('address');
            $UserData['status'] = $request->get('status') == 'on' ? true : false;
            $UserData['is_admin'] = $request->get('status') == 'on' ? true : false;

            $updated = $this->userService->updateUser($id, $UserData);

            if (!empty($updated)) {
                return redirect()->route("users.index")->with('success', 'User Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating User');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route("users.index")->with('error', 'Error while editing User');
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
            $deleted = $this->userService->deleteUser($id);
            if (!empty($deleted)) {
                return redirect()->route("users.index")->with('success', 'Users Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting Users');
            }
        } catch (\Exception $error) {
            return redirect()->route("users.index")->with('error', 'Error while editing Users');
        }
    }
}