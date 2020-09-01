<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UsersRequest;
use App\Users;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class UsersController extends BaseApiController
{
    public function index(UsersRequest $request)
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
    }

    public function store(UsersRequest $request)
    {
        try{
            $Users = Users::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Users' => $Users];
        $this->_sendResponse($response, 'Users created success');
    }

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
    }
}
