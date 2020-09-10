<?php

namespace SSOCookie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use SSOCookie\Models\SSO;





class CookieLoginController extends Controller
{

    public function login(Request $request)
    {
    	 $sso = new SSO;
    	 return $sso->SSOLogin();
        // return $this->checkCookie() ? $this->checkAndValidateToken() : $this->redirectToLogin();
    }


}
