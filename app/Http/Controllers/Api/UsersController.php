<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UsersRequest;
use App\Users;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use Illuminate\Support\Facades\Hash;

class UsersController extends AppController
{
    /*public function index(UsersRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $Users = Users::latest();
            $arrUsers = $Users->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $arrUsers];
        $this->_sendResponse($response, 'Users listing Success');
    }*/

    public function store(UsersRequest $request)
    {
        try{
            $validFields = [
                'user_name' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email|unique:tbl_users',
                'password' => 'required',
            ];
            $messages = [];
            $this->checkValidate($request,$validFields,$messages);

            $userObj = New Users();
            $userObj->user_name = $request->user_name;
            $userObj->user_mobile = $request->mobile;
            $userObj->user_email = $request->email;
            $userObj->password = Hash::make($request->password);
            $userObj->auth_token = $this->_generateToken();
            $userObj->user_status = 'active';
            $userObj->created_by = 'self';
            $userObj->last_updated_by = $userObj->created_by;
            if(!$userObj->save()){
                $this->_sendErrorResponse(417,'user registration un-successfully');
            }
            $response = ['Users' => $userObj];
            $this->_sendResponse($response, 'user registration successfully');
        } catch (\Exception $exception){
            dd($exception);
            $this->_sendErrorResponse(500);
        }
    }
/*
    public function show($id)
    {
        try{
            $Users = Users::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users found success');
    }

    public function update(UsersRequest $request, $id)
    {
        try{
            $Users = Users::findOrFail($id);
            $Users->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users update success');
    }

    public function destroy($id)
    {
        try{
            $Users = Users::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users delete successfully');
    }*/
}
