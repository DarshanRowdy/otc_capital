<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrdersRequest;
use App\Orders;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class OrdersController extends BaseApiController
{
    public function index(OrdersRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_orders = Orders::latest();
            $arrTbl_Orders = $tbl_orders->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $arrTbl_Orders];
        $this->_sendResponse($response, 'tbl_orders listing Success');
    }

    public function store(OrdersRequest $request)
    {
        try{
            $tbl_orders = Orders::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders created success');
    }

    public function show($id)
    {
        try{
            $tbl_orders = Orders::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders found success');
    }

    public function update(OrdersRequest $request, $id)
    {
        try{
            $tbl_orders = Orders::findOrFail($id);
            $tbl_orders->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_orders = Orders::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['tbl_orders' => $tbl_orders];
        $this->_sendResponse($response, 'tbl_orders delete successfully');
    }
}
