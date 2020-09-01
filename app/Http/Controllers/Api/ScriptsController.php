<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScriptsRequest;
use App\Scripts;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class ScriptsController extends BaseApiController
{
    public function index(ScriptsRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_scripts = Scripts::latest();
            $arrtbl_scripts = $tbl_scripts->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $arrtbl_scripts];
        $this->_sendResponse($response, 'Scripts listing Success');
    }

    public function store(ScriptsRequest $request)
    {
        try{
            $tbl_scripts = Scripts::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts created success');
    }

    public function show($id)
    {
        try{
            $tbl_scripts = Scripts::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts found success');
    }

    public function update(ScriptsRequest $request, $id)
    {
        try{
            $tbl_scripts = Scripts::findOrFail($id);
            $tbl_scripts->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_scripts = Scripts::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['Scripts' => $tbl_scripts];
        $this->_sendResponse($response, 'Scripts delete successfully');
    }
}
