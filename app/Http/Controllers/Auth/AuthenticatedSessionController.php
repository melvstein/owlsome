<?php

namespace App\Http\Controllers\Auth;

use App\Events\AuthenticationProviderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AccountIdsGenerator;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(auth()->user()->role == "Admin"){
            return redirect('admin/user/dashboard');
        }elseif(auth()->user()->role == "Staff"){
            return redirect('staff/dashboard');
        }else{
            return redirect(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerOrLoginUser($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerOrLoginUser($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function _registerOrLoginUser($data)
    {
        $accountIdGenerator = new AccountIdsGenerator();
        $user = User::where('email', $data->email)->first();
        if(!$user)
        {
            $generatedPassword = User::generatedPassword();
            $user = new User();
            $user->accountId = $accountIdGenerator->generatedAccountId();
            $user->name = $data->name;
            $user->contactNumber = "09".User::generatedFakeContactNumber();
            $user->email = $data->email;
            $user->password = Hash::make($generatedPassword);
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();

            event(new AuthenticationProviderEvent($user, $generatedPassword));
        }

        Auth::login($user);
    }
}
