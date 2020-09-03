<?php

namespace App\Http\Controllers\Api;

use App\App;
use App\Users;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AppController extends BaseApiController
{
    public function checkValidate($request, $validFields, $messages = [])
    {
        $validator = Validator::make($request->all(), $validFields, $messages);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                $this->_sendErrorResponse(400, $validator->getMessageBag()->first($key));
            }
        }
    }

    public function checkValidateArray($request, $validFields, $messages = [])
    {
        $validator = Validator::make($request, $validFields, $messages);
        $errorArray = [];
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                array_push($errorArray, $validator->getMessageBag()->first($key));
            }
        }
        return $errorArray;
    }

    public function login(request $request)
    {
        $validator = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $this->checkValidate($request, $validator);
        try {
            if (!Auth::attempt(['user_email' => request('email'), 'password' => request('password')])) {
                $this->_sendErrorResponse(401, "Incorrect Email or Password.");
            }
            $userObj = Auth::user();
            $response = ['user' => $userObj];
            $this->_sendResponse($response, "You are successfully login into system.");
        } catch (Exception $exception) {
            dd($exception);
            $this->_sendErrorResponse(500);
        }
    }

   /* public function change_password(request $request)
    {
        $users = $request->get('users');
        $is_app = $request->has('is_app') ? $request->is_app : 0;
        $validator = [
            'password' => 'required|min:6'
        ];
        if($is_app != 1){
            $validator = array_add($validator,'old_password','required|min:6');
        }

        $this->checkValidate($request,$validator);
        try {
            if($is_app == 1){
                $password = Hash::make($request->password);
                $users->update(['password' => $password, 'is_password_change' => 1]);
            } else {
                if (Hash::check($request->old_password, $users->password) == $users->password) {
                    $password = Hash::make($request->password);
                    $users->update(['password' => $password, 'is_password_change' => 1]);
                } else {
                    $this->_sendErrorResponse(400, "You'r old password is not match, please insert correct password");
                }
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], 'Password successfully Changed');
    }

    public function forgot_password(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $this->_sendErrorResponse(400, "The email field is required, The email must be a valid email address");
        }
        try {
            $email = $request->has('email') ? $request->email : NULL;
            $role = $request->has('role') ? $request->role : NULL;
            if(!empty($role) && $role == "customer") {
                $role_ids = [7];
            } else if(!empty($role) && $role == "web") {
                $role_ids = [3,4];
            } else if(!empty($role) && $role == "delivery_agent") {
                $role_ids = [6,9];
            } else if(!empty($role) && $role == "admin") {
                $role_ids = [1,2];
            } else {
                $this->_sendErrorResponse(400);
            }
            $userObj = Users::where('user_name', $email)->whereIn('role_id',$role_ids)->first();
            if (!empty($userObj)) {
                $reset_password_token = $this->_generateToken();
                $userObj->reset_password_token = $reset_password_token;
                $userObj->save();

                // Mail sender code start
                $email_file_stucture = 'email.forgot_password';
                $mail_values = [];
                $sender_email_id = $request->email;
                $email_subject = 'Password Reset Link - reternX.com';
                Helpers::Mail_send_common($email_file_stucture, $mail_values, $sender_email_id, $email_subject, $userObj);
                // Mail sender code end
            } else {
                $this->_sendErrorResponse(404, 'This Email-ID is does not exist into database!');
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], "A message to reset your password has been sent to your email address.");
    }

    public function resetpassword(request $request)
    {
        $validator = [
            'password' => 'required|min:6',
            'reset_password_token' => 'required'
        ];
        $this->checkValidate($request, $validator);
        try {
            $pass = $request->has('password') ? $request->password : "123456";
            $reset_password_token = $request->has('reset_password_token') ? $request->reset_password_token : NULL;
            $check_reset_token = Users::findUserBy('reset_password_token', $reset_password_token);
            if (!empty($check_reset_token)) {
                $password = Hash::make($pass);
                Users::updateUserBy(array('id' => $check_reset_token->id), array('password' => $password, 'reset_password_token' => NULL,'is_password_change' => 1));
            } else {
                $this->_sendErrorResponse(404, 'Your reset password token is mismatch');
            }
        } catch (Exception $exception) {
            $this->_sendErrorResponse(500);
        }
        $this->_sendResponse([], "You'r Password is successfully reset!");
    }*/

}
