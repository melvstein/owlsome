<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AccountIdsGenerator;
use App\Models\CityShippingFee;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = CityShippingFee::list();

        return view('auth.register', compact(['cities']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {

        $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'contactNumber' => 'required|string|min:11|max:11|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $accountIdGenerator = new AccountIdsGenerator();
        Auth::login($user = User::create([
            'accountId' => $accountIdGenerator->generatedAccountId(),
            'role' => "Customer",
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'contactNumber' => $request->contactNumber,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
