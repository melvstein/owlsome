<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccountIdsGenerator;
use App\Models\CityShippingFee;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\ShippingDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user.admin.users', compact('users'));
    }

    public function details($id){
        $cities = CityShippingFee::list();
        $orderDetails = User::orderDetails($id);
        $user = User::userDetails($id);
        return view('user.admin.user-details', compact('cities', 'orderDetails', 'user'));
    }

    public function addUser(){
        $cities = CityShippingFee::list();
        return view('user.admin.add-user')->with(['cities' => $cities]);
    }

    public function store(AddUserRequest $request)
    {
        $accountIdGenerator = new AccountIdsGenerator();
        User::create([
            'accountId' => $accountIdGenerator->generatedAccountId(),
            'role' => $request->role,
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'contactNumber' => $request->contactNumber,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('message', 'User created successfully!');
    }

    public function activation($id)
    {
        $user = User::findOrFail($id);
        if($user->status == 'Active')
        {
            $user->status = "Deactivated";
            $user->save();
            return redirect()->back()->with('message', 'User deactivated successfully!');
        }else{
            $user->status = "Active";
            $user->save();
            return redirect()->back()->with('message', 'User activated successfully!');
        }

    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::where('user_id', $id)
                        ->where(function($query){
                            $query->Where('isCheckout', true)
                            ->orWhere('isShipped', true)
                            ->orWhere('isDelivered', true);
                        })->get();
        /* dd($orders); */
        if($orders->count() === 0)
        {
            Order::where('user_id', $id)->delete();
            Storage::delete('public/'.$user->profile_photo_path);
            $user->delete();
            return redirect()->back()->with('message', 'User deleted successfully!');
        }else
        {
            return redirect()->back()->withErrors("You can't delete user that already has an orders!");
        }
    }

    public function liveStatus($user_id)
    {
        // get user data
        $user = User::find($user_id);

        // check online status
        if (Cache::has('user-is-online-' . $user->id))
            $status = 'Online';
        else
            $status = 'Offline';

        // check last seen
        if ($user->last_seen != null)
            $last_seen = "Active " . Carbon::parse($user->last_seen)->diffForHumans();
        else
            $last_seen = "No Data";

        // response
        return response()->json([
            'status' => $status,
            'last_seen' => $last_seen,
        ]);
    }
}
