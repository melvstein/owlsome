<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfilePhotoRequest;
use App\Http\Requests\ProfileInfoRequest;
use App\Models\CityShippingFee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Order;


class ProfileController extends Controller
{
    public function index(){
        $oncartCount = Order::oncartCount();
        $cities = CityShippingFee::list();
        if(auth()->user()->role == "Admin"){
            return view("user.admin.profile", compact(['cities']));
        }elseif(auth()->user()->role == "Staff"){
            return view("user.staff.profile", compact(['cities']));
        }else{
            return view("user.customer.profile", compact('oncartCount', 'cities'));
        }

    }

    public function editProfilePhoto(ProfilePhotoRequest $request){

        $user = User::findOrFail(auth()->user()->id);

        $file = $request->file('profile_photo')->store('public/user/'.Str::lower(auth()->user()->role));

        if($file){
                Storage::delete('public/'.auth()->user()->profile_photo_path);
                $user->profile_photo_path = Str::replaceFirst('public/', '', $file);
                $user->save();
                return redirect()->back()->with('message', 'Profile photo updated successfully!');
        }
    }

    public function editProfileInfo(ProfileInfoRequest $request)
    {
        /* $validated = $request->validated(); */

        /* $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'contactNumber' => 'required|string|min:11|max:11|unique:users,contactNumber,'.auth()->user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status_code' => JsonResponse::HTTP_NOT_ACCEPTABLE,
                'error' => $validator->errors(),
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        if($validated_data = $validator->validated())
        {
            $user = User::find(auth()->user()->id);
            $user->firstName = $validated_data['firstName'];
            $user->middleName = $validated_data['middleName'];
            $user->lastName = $validated_data['lastName'];
            $user->contactNumber = $validated_data['contactNumber'];
            $user->email = $validated_data['email'];
            $user->city = $validated_data['city'];
            $user->address = $validated_data['address'];
            $user->save();

            return response()->json([
                'status_code' => JsonResponse::HTTP_OK,
                'message' => 'Profile information updated successfully!',
                'data' => $user,
            ], JsonResponse::HTTP_OK);
        } */

        $user = User::findOrFail(auth()->user()->id);
        $user->firstName = $request->input('firstName');
        $user->middleName = $request->input('middleName');
        $user->lastName = $request->input('lastName');
        $user->contactNumber = $request->input('contactNumber');
        $user->email = $request->input('email');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('message', 'Profile information updated successfully!');

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        /* if (Hash::check($request->current_password, auth()->user()->password)) {
            if(Hash::check($request->password, auth()->user()->password))
            {
                return redirect()->back()->withErrors("!");
            }else{
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('message', 'Password saved successfully!');
            }
        }else{
            return redirect()->back()->withErrors('Wrong current password!');
        } */

        if (Hash::check($request->current_password, auth()->user()->password)) {
            User::findOrFail(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
            return redirect()->back()->with('message', 'Password updated successfully!');

        }else{
            return redirect()->back()->withErrors('Your current password is incorrect!');
        }
    }
}
