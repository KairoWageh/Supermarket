<?php

namespace App\Http\Controllers\Api;



use App\Admin;
use App\Brand;
use App\Category;
use App\Company;

use App\Contact;
use App\Document;
use App\Follow;
use App\Like;
use App\Message;
use App\Qualification;
use App\HandGraduation;
use App\EmailType;
use App\Bank;

use App\Rate;
use App\Room;
use App\ServicePrice;
use App\SiteText;
use App\Skill;
use App\Slider;
use App\User;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
class ChatController extends Controller
{
    ////////send message
    public  function send_message(Request $request){
        $rules = [

            'form_id' => 'required',
            'to_id' => 'required',

            'message' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $user = User::where('id', $request->to_id)->first();
        if ($user == null) {
            return response(['message' => ' user you want to send him not found '], 422);
        }
        $roo=Room::whereIn('form_id',array($request->form_id,$request->to_id))
            ->whereIn('to_id',array($request->to_id,$request->form_id))
            ->first();

        if($roo){

            $message=new Message();
            $message->form_id=$request->form_id;
            $message->to_id=$request->to_id;
            $message->room_id=$roo->id;


                $message->message=$request->message;


            $message->save();

            $roo->form_id=$request->form_id;
            $roo->to_id=$request->to_id;
            $roo->last_message=$message->message;
            $roo->save();
            return response(['room'=>$roo,'data'=>$message],200);
        }

        $room= new Room();
        $room->form_id=$request->form_id;
        $room->to_id=$request->to_id;
        $room->save();
        $message=new Message();
        $message->form_id=$request->form_id;
        $message->to_id=$request->to_id;
        $message->room_id=$room->id;



            $message->message=$request->message;


        $message->save();
        $room->last_message=$message->message;
        $room->save();

        return response(['room'=>$roo,'data'=>$message],200);



    }

    public function all_rooms (Request $request)
    {
        $rules = [
            'user_id' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {

            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response(['message' => 'user not found '], 422);
            }
            $rooms = Room::where('form_id', $request->user_id)->orWhere('to_id', $request->user_id)->get();
            $i=0;
            foreach ($rooms as $room){
                $sender=User::where('id',$room->form_id)->first();
                $receiver=User::where('id',$room->to_id)->first();
                $rooms[$i]['sender_name']=$sender->name;
                $rooms[$i]['sender_phone']=$sender->phone;
                $rooms[$i]['sender_image']=$sender->image;
                $rooms[$i]['receiver_name']=$receiver->name;
                $rooms[$i]['receiver_phone']=$receiver->phone;
                $rooms[$i]['receiver_image']=$receiver->image;
                $i++;
            }
            return response(['data' => $rooms], 200);
        }
    }
////single room
    public function single_room(Request $request)
    {

        $rules = [
            'room_id' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
$room=Room::where('id',$request->room_id)->first();


            if ($room) {

                // Send To admin


                return response($room, 200);

            } else {
                return response([
                    'status' => false,
                    'message' => 'Insert fail',
                ], 404);

            }//insert


        }//validate


    }//end fun

}
