<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AnnouncementsRequest;
use App\Tbl_announcements;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class AnnouncementsController extends BaseApiController
{
    public function index(AnnouncementsRequest $request)
    {
        $limit = isset($request->limit) ? $request->limit : config('app.default_limit');
        try{
            $tbl_announcements = Tbl_announcements::latest();
            $arrTbl_announcements = $tbl_announcements->paginate($limit);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_announcements' => $arrTbl_announcements];
        $this->_sendResponse($response, 'tbl_announcements listing Success');
    }

    public function store(AnnouncementsRequest $request)
    {
        try{
            $tbl_announcements = Tbl_announcements::create($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_announcements' => $tbl_announcements];
        $this->_sendResponse($response, 'tbl_announcements created success');
    }

    public function show($id)
    {
        try{
            $tbl_announcements = Tbl_announcements::findOrFail($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_announcements' => $tbl_announcements];
        $this->_sendResponse($response, 'tbl_announcements found success');
    }

    public function update(AnnouncementsRequest $request, $id)
    {
        try{
            $tbl_announcements = Tbl_announcements::findOrFail($id);
            $tbl_announcements->update($request->all());
        } catch (\Exception $exception){
            $this->_sendErrorResponse(500);
        }
        $response = ['tbl_announcements' => $tbl_announcements];
        $this->_sendResponse($response, 'tbl_announcements update success');
    }

    public function destroy($id)
    {
        try{
            $tbl_announcements = Tbl_announcements::destroy($id);
        } catch (\Exception $exception){
            $this->_sendErrorResponse(204);
        }
        $response = ['tbl_announcements' => $tbl_announcements];
        $this->_sendResponse($response, 'tbl_announcements delete successfully');
    }
}
