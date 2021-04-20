<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessInformationRequest;
use App\Http\Requests\BusinessLogoRequest;
use App\Models\BusinessInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessInformationController extends Controller
{
    public function index()
    {
        return view('user.admin.business-information');
    }

    public function updatelogo(BusinessLogoRequest $request)
    {
        $businessInformation = BusinessInformation::findOrFail(1);

        $file = $request->file('business_logo')->store('public/business/');

        if($file){
                Storage::delete('public/'.$businessInformation->logo_path);
                $businessInformation->logo_path = Str::replaceFirst('public/', '', $file);
                $businessInformation->save();
                return redirect()->back()->with('message', 'Business Logo updated successfully!');
        }
    }

    public function updateInformation(BusinessInformationRequest $request)
    {
        $businessInformation = BusinessInformation::findOrFail(1);
        $businessInformation->name = $request->input('name');
        $businessInformation->contactNumber = $request->input('contactNumber');
        $businessInformation->email = $request->input('email');
        $businessInformation->city = $request->input('city');
        $businessInformation->address = $request->input('address');
        $businessInformation->display = $request->input('display');
        $businessInformation->google_map_src = $request->input('google_map_src');
        $businessInformation->save();

        return redirect()->back()->with('message', 'Business information updated successfully!');
    }
}
