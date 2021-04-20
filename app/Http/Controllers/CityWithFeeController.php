<?php

namespace App\Http\Controllers;

use App\Models\CityShippingFee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CityRequest;

class CityWithFeeController extends Controller
{
    public function index()
    {
        $cities = CityShippingFee::list();
        return view('user.'. Str::lower(auth()->user()->role) .'.cities-fee', compact(['cities']));
    }

    public function addNewCity(CityRequest $request)
    {
       /*  $validator = Validator::make($request->all(),[
            'city' => "required|string|max:255|unique:cities_shipping_fee",
            'fee' => "integer|required"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "status_code" => JsonResponse::HTTP_NOT_ACCEPTABLE,
                "error" => $validator->errors(),
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        CityShippingFee::create([
            'city' => $request->city,
            'shipping_fee' => $request->fee,
        ]);

        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'message' => $request->city." added successfully!",
        ], JsonResponse::HTTP_OK); */

        CityShippingFee::create([
            'city' => $request->city,
            'shipping_fee' => $request->fee,
        ]);

        return redirect()->back()->with(['message' => $request->city." added successfully!"]);
    }

    public function updateCity(Request $request, $id)
    {
        $validated = $request->validate([
            'city' => 'required|unique:cities_shipping_fee,city,'.$id.'|max:255',
            'fee' => 'required',
        ]);

        CityShippingFee::findOrFail($id)->update([
            'city' => $request->city,
            'shipping_fee' => $request->fee,
        ]);

        return redirect()->back()->with('message', "Updated Successfully!");
    }

    public function deleteCity($id)
    {
        CityShippingFee::findOrFail($id)->delete();
        return redirect()->back()->with('message', "Deleted Successfully!");
    }
}
