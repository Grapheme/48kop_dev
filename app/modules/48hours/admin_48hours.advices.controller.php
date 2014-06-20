<?php

class Admin48hoursAdvicesController extends BaseController {

    public static $name = 'admin_48hoursAdvices';
    public static $group = '48hours';
    public static $modname = '48hoursAdvices';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group."/advices", $class);
        });
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
        return array();
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        ##
    }
        
    /****************************************************************************/
    
	public function __construct(){

		$this->beforeFilter('48hours');

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'modname' => self::$modname,
            'rest' => self::$group."/advices",
            'tpl' => static::returnTpl('admin/advices'),
            'gtpl' => static::returnTpl(),
        );

        View::share('module', $this->module);
	}

	public function getIndex(){
		
		$advices = Advice::orderBy('id', 'desc')->get();
		return View::make($this->module['tpl'].'index', compact('advices'));
	}

    /************************************************************************************/

	public function getCreate(){

		return View::make($this->module['tpl'].'create');
	}

	public function postStore(){

		if(!Request::ajax())
            return App::abort(404);
            
		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'desc' => Input::get('desc'),
        );

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, Advice::$rules);
		if($validator->passes()) {

		    #$json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
		    #return Response::json($json_request,200);

			#self::saveNewsModel();
            $id = Advice::create($input)->id;

            ################################################
            ## Process tags
            ################################################
            if (Allow::action('tags', 'edit')) {
                ExtForm::process('tags', array(
                    'module'  => self::$modname,
                    'unit_id' => $id,
                    'tags'    => Input::get('tags'),
                ));
            }
            ################################################

			$json_request['responseText'] = 'Совет создан';
			$json_request['redirect'] = link::auth( $this->module['rest'] );
			$json_request['status'] = TRUE;
		} else {
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request,200);
	}

    /************************************************************************************/
    
	public function getEdit($id){
		
		$advice = Advice::findOrFail($id);
		return View::make($this->module['tpl'].'edit', compact('advice'));
	}

	public function postUpdate($id){

		if(!Request::ajax())
            return App::abort(404);

		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'desc' => Input::get('desc'),
        );

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, Advice::$rules);
		if($validator->passes()) {

            if (Advice::find($id)->exists()) {

                Advice::find($id)->update($input);

                ################################################
                ## Process tags
                ################################################
                if (Allow::action('tags', 'edit')) {
                    ExtForm::process('tags', array(
                        'module'  => self::$modname,
                        'unit_id' => $id,
                        'tags'    => Input::get('tags'),
                    ));
                }
                ################################################
            }

			$json_request['responseText'] = 'Совет обновлен';
			#$json_request['redirect'] = link::auth( $this->module['rest'] );
			$json_request['status'] = TRUE;
		} else {
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request, 200);
	}

    /************************************************************************************/

	public function deleteDestroy($id){

		if(!Request::ajax())
            return App::abort(404);

		$json_request = array('status'=>FALSE, 'responseText'=>'');
	    $deleted = Advice::find($id)->delete();
		$json_request['responseText'] = 'Совет удален';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}

}


