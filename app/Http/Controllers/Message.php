<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageModel;
use App\Http\Controllers\Responce;
use Validator;
use App\Models\User;

class Message extends Responce
{

    public function getMessage(Request $request)
    {
       // print_r($request);
            
        if ($data = 
            MessageModel::whereIn('from',[$request->from,$request->to])
            ->whereIn('to',[$request->from,$request->to])
            ->get()
            ->toArray()
        )
        {
            return $this->SendData($data,count($data));
        }
        else
        {
            return $this->SendNoData();
        }
    }


    public function storeMessage(Request $request)
    {
        $message = new MessageModel();
        $validation = Validator::make($request->all(),$message->rules);
        if ($validation->fails())
        {
            $errors = collect($validation->errors());
            $error  = $errors->unique()->first();

            return $this->SendError($error[0]);
        }


        if ( $message->fill($request->all())->save() ) 
        {
            return $this->SendResponse('Message Send successfully',$request->all());
        }
        else
        {
            return $this->SendError('Message not Send');
        }
    }

    public function updateMessage(Request $request,$id)
    {
        $message = new MessageModel();
        $validation = Validator::make($request->all(),$message->rules);

        if ($validation->fails())
        {
            $errors = collect($validation->errors());
            $error  = $errors->unique()->first();

            return $this->SendError($error[0]);
        }

        if ( $message = MessageModel::find($id) ) 
        {
            if ($message->fill($request->all())->save())
            {
                return $this->SendResponse('Message updated successfully',$request->all());
            }
            else
            {
                return $this->SendError('Message not updated');
            }
        }
        else
        {
            return $this->SendError('Message not found');
        }

    }

    public function destroy($id)
    {
        if ($data = MessageModel::find($id)) 
        {
            if ($data->delete())
            {
                return $this->SendResponse('Message deleted successfully',$data);
            }
            else
            {
                return $this->SendError('Message not deleted successfully');
            }
            
        }
        else
        {
            return $this->SendError('Message not found');
        }
    }

    public function members()
    {
       if($data=User::get()->toArray())
       {
            return $this->SendResponse("Get users successfully",$data,count($data));
       }
       else
       {
            return $this->SendError('No Member found');
       }
    }
}
