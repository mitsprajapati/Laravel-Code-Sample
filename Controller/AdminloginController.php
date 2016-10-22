<?php

namespace App\Http\Controllers\administrator;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Hash;
use Admin;

class AdminloginController extends Controller{
    public function __construct() {
        
    }

    /**
     * Function : getIndex()
     * Purpose  : To Render Login Page for Admin
     * @author  : Punit Gajjar
     * @date-Created : 13th Oct 2016
     */
    public function getIndex() {

        //echo config('constants.ADMIN_TEXT');exit;

        if (Auth::guard('admin')->check()) {
            return Redirect::to(config('constants.ADMIN_TEXT') . 'dashboard');
        } else {
            return View::make('layouts.admin.login2');
        }
    }


    /*
     * Function :   postLoginadmin()
     * Purpose  :   called when Admin login is attempted
     * @author  :   Punit Gajjar
     * @date-Created : 5th July 2016
     */
    public function postLoginadmin($data = 'null') {        //self::Logout();
        
        $validator = Validator::make(array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        ), array(
            'email' => 'required|email',
            'password' => 'required'
        ));
        
        $loggedin = 0;
        
        if (Auth::guard('admin')->check()) {
            $loggedin = 1;
        }
        
        if ($validator->fails()) {
            $messages = $validator->messages()->first();
            return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $messages);
        } else if ($loggedin == 1) {
            $messages = 'Current';
            return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $messages);
        } else {

            $credentials = [
                "email" => Input::get("email"),
                "password" => Input::get("password")
            ];


            $remember = (Input::has('remember')) ? true : false;

            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                return Redirect::to(config('constants.ADMIN_TEXT') . 'dashboard');
            } else {
                $message = "Invalid Email/Password";
                return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $message);
            }
        }
    }
    /*
     * Function :   getLogout()
     * Purpose  :   For Logout From Admin Panel
     * @author  :   Punit Gajjar
     * @date-Created : 4th July 2016
     */
    public function getLogout() {
        Auth::guard('admin')->logout();
        Session::flush();
        return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('success_message' , "Logout successfull..!!");
    }

    /*
    * Function : postForgotpassword()
    * purpose : To send mail for forgot password link and procced
    * input : email
    * output : success/error
    * @author  :   Punit Gajjar
    * @date-Created : 13th Oct 2016
     */
    public function postForgotpassword() {
        //Remove space begin and after from input
        //Get Input Email For Forget passsword mail
        $data = array_map('trim',Input::all());
        $validator = Validator::make(array(
            'forgotemail' => Input::get('forgotemail')
        ), array(
            'forgotemail' => 'required|exists:admin_info,email'
        ));

        if ($validator->fails()) {

            $messages = EMAIL_NOT_FOUND;
            return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $messages);
        } else {

            $result_forgot = Adminlogin::postForgotlink($data);

            if ($result_forgot) {
                $message = RESET_PASSWORD_LINK_MAIL_SENT;
                return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $message);
            } else {
                $message = ERROR_TRY_AGAIN_LATER;
                return Redirect::to(config('constants.ADMIN_TEXT') . 'login')->with('login_message', $message);
            }
        }
    }
}
