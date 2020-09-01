<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScriptNewslinksRequest;
use App\ScriptNewslinks;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class ScriptNewslinksController extends BaseApiController
{
    public function index(ScriptNewslinksRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_script_newslinks = ScriptNewslinks::latest();
            $arrTbl_Script_Newslinks = $tbl_script_newslinks->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_newslinks' => $arrTbl_Script_Newslinks];
        $this->_sendResponse($response, 'tbl_script_newslinks listing Success');
    }

    public function store(ScriptNewslinksRequest $request)
    {
        try{
            $tbl_script_newslinks = ScriptNewslinks::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_newslinks' => $tbl_script_newslinks];
        $this->_sendResponse($response, 'tbl_script_newslinks created success');
    }

    public function show($id)
    {
        try{
            $tbl_script_newslinks = ScriptNewslinks::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_newslinks' => $tbl_script_newslinks];
        $this->_sendResponse($response, 'tbl_script_newslinks found success');
    }

    public function update(ScriptNewslinksRequest $request, $id)
    {
        try{
            $tbl_script_newslinks = ScriptNewslinks::findOrFail($id);
            $tbl_script_newslinks->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_newslinks' => $tbl_script_newslinks];
        $this->_sendResponse($response, 'tbl_script_newslinks update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_script_newslinks = ScriptNewslinks::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['tbl_script_newslinks' => $tbl_script_newslinks];
        $this->_sendResponse($response, 'tbl_script_newslinks delete successfully');
    }
}
