<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScriptFinancialsRequest;
use App\ScriptFinancials;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class ScriptFinancialsController extends BaseApiController
{
    public function index(ScriptFinancialsRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_script_financials = ScriptFinancials::latest();
            $arrTbl_Script_Financials = $tbl_script_financials->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_financials' => $arrTbl_Script_Financials];
        $this->_sendResponse($response, 'tbl_script_financials listing Success');
    }

    public function store(ScriptFinancialsRequest $request)
    {
        try{
            $tbl_script_financials = ScriptFinancials::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_financials' => $tbl_script_financials];
        $this->_sendResponse($response, 'tbl_script_financials created success');
    }

    public function show($id)
    {
        try{
            $tbl_script_financials = ScriptFinancials::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_financials' => $tbl_script_financials];
        $this->_sendResponse($response, 'tbl_script_financials found success');
    }

    public function update(ScriptFinancialsRequest $request, $id)
    {
        try{
            $tbl_script_financials = ScriptFinancials::findOrFail($id);
            $tbl_script_financials->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_script_financials' => $tbl_script_financials];
        $this->_sendResponse($response, 'tbl_script_financials update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_script_financials = ScriptFinancials::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['tbl_script_financials' => $tbl_script_financials];
        $this->_sendResponse($response, 'tbl_script_financials delete successfully');
    }
}
