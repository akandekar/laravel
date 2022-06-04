<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Responce extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function SendData($data,$total=NULL)
    {
        return response()->json(
            [
            'Status'=>true,
            'TotalRecord'=>$total,
            'Msg'=>'Get Record Successful',
            'Data'=>$data
            ]
        );
    }

    public function SendNoData()
    {
        return response()->json(
            [
            'Status'=>true,
            'Msg'=>'No Data Found',
            'Data'=>[]
            ]
        );
    }

    public function SendError($error)
    {
        return response()->json(
            [
            'Status'=>false,
            'Msg'=>$error,
            ]
        );
    }

    public function SendResponse($msg,$data=null)
    {
        return response()->json(
            [
            'Status'=>true,
            'Msg'=>$msg,
            'Data'=>$data
            ]
        );
    }

}
