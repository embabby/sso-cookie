<?php 

namespace SSO\CookieLogin\Models;
use Illuminate\Database\Eloquent\Model;

use Cookie;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;




Class SSO extends Model {

	public function SSOLogin(){
		return $this->checkCookie() ? $this->checkAndValidateToken() : $this->redirectToLogin();
	}


	public function checkCookie()
    {

        return Cookie::get('user_token') !== null;
    }


    public function checkAndValidateToken()
    {
     	$response = Http::post(config('app.validate_token_url'), [
            'token' => Cookie::get('user_token'),
        ]);
        return $response->successful() ? $this->validToken($response) : $this->redirectToLogin();
    }


    public function validToken($response)
    {
        Auth::loginUsingId($response['user']['id']);
        return redirect()->route('home');

    }


    public function redirectToLogin()
    {
        $redirect = url()->current();
        $url = config('app.login_redirect_url').$redirect;
        return Redirect::away($url);
    }
}