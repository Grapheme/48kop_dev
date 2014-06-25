<?php

class Public48hoursController extends BaseController {

    public static $name = '48hours';
    public static $group = '48hours';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        #Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::post("/ajax/i-will-go", $class."@iWillGo");
        	Route::post("/ajax/send-to-friend", $class."@sendToFriend");
        #});
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    /****************************************************************************/
    
	public function __construct(){
        ##
	}

	public function iWillGo(){
        
        $profile_id  = Input::get('profile_id');
        $object_type = Input::get('object_type');
        $object_id   = Input::get('object_id');

        $also_go = false;

        $obj = iWillGo::where('profile_id', $profile_id)
            ->where('object_type', $object_type)
            ->where('object_id', $object_id)
            ->first();

        if (is_null($obj)) {
            iWillGo::create(array(
                'profile_id' => $profile_id,
                'object_type' => $object_type,
                'object_id' => $object_id,
            ));

            #return $count;
        } else {
            $also_go = true;
            #return false;
        }

        $count = iWillGo::where('object_type', $object_type)
            ->where('object_id', $object_id)
            ->count();

		$json_request = array('status'=>0, 'responseText'=>'', 'count' => 0, 'also_go' => 0);
		$json_request['total'] = (int)$count;
		$json_request['also_go'] = (int)$also_go;
		$json_request['status'] = 1;
		return Response::json($json_request, 200);
	}
    

	public function sendToFriend(){

		$json_request = array('status'=>0, 'responseText'=>'');

        $email       = Input::get('email');
        $object_type = Input::get('object_type');
        $object_id   = Input::get('object_id');

        #/*
        $obj = false;
        switch ($object_type) {
            case 'place':

                $obj = Place::where('id', $object_id)->first()->toArray();
                #Helper::d($obj);
                Mail::send('emails.send_to_friend_place', $obj, function($message) use ($email) {
                    $message->from(Config::get('mail.sender'));
                    $message->subject('Привет!');
                    $message->to($email);
                });

                break;

            case 'action':

                $obj = _48hoursAction::where('id', $object_id)->first()->toArray();
                #Helper::d($obj);
                Mail::send('emails.send_to_friend_action', $obj, function($message) use ($email) {
                    $message->from(Config::get('mail.sender'));
                    $message->subject('Привет!');
                    $message->to($email);
                });

                break;

            case 'advice':

                $obj = Advice::where('id', $object_id)->first()->toArray();
                #Helper::d($obj);
                Mail::send('emails.send_to_friend_advice', $obj, function($message) use ($email) {
                    $message->from(Config::get('mail.sender'));
                    $message->subject('Привет!');
                    $message->to($email);
                });

                break;
        }

        if ( !is_null($obj) ) {
            
        }
        #*/
        
		$json_request['responseText'] = "Сообщение успешно отправлено";
		#$json_request['responseText'] = "$email / $object_type / $object_id";
		$json_request['status'] = 1;
		return Response::json($json_request, 200);
	}
   
}


