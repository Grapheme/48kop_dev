<?php

class Admin48hoursActionsController extends BaseController {

    public static $name = 'admin_48hoursActions';
    public static $group = '48hours';
    public static $modname = '48hoursActions';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group."/actions", $class);
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

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'modname' => self::$modname,
            'rest' => self::$group."/actions",
            'tpl' => static::returnTpl('admin/actions'),
            'gtpl' => static::returnTpl(),
        );
        View::share('module', $this->module);
	}

	public function getIndex(){
		
		$actions = _48hoursAction::orderBy('id', 'desc')->get();
		return View::make($this->module['tpl'].'index', compact('actions'));
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
            'time' => Input::get('time'),

            'where' => Input::get('where'),
            'price' => Input::get('price'),
            'web' => Input::get('web'),
            'product_id' => Input::get('product'),
        );
        $input['date_time'] = date("Y-m-d", strtotime(Input::get('date_time')));

        ################################################
        ## Process image
        ################################################
        if (Allow::action('galleries', 'edit')) {
            $image_id = ExtForm::process('image', array(
                'image' => Input::get('image'),
                'return' => 'id'
            ));
            $input['photo'] = $image_id;
        }
        ################################################

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, _48hoursAction::$rules);
		if($validator->passes()) {

		    #$json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
		    #return Response::json($json_request,200);

			#self::saveNewsModel();
            $id = _48hoursAction::create($input)->id;

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

			$json_request['responseText'] = 'Мероприятие создано';
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
		
		$action = _48hoursAction::findOrFail($id);
		return View::make($this->module['tpl'].'edit', compact('action'));
	}

	public function postUpdate($id){

		if(!Request::ajax())
            return App::abort(404);

		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'desc' => Input::get('desc'),
            'time' => Input::get('time'),

            'where' => Input::get('where'),
            'price' => Input::get('price'),
            'web' => Input::get('web'),
            'product_id' => Input::get('product'),
        );
        $input['date_time'] = date("Y-m-d", strtotime(Input::get('date_time')));

        ################################################
        ## Process image
        ################################################
        if (Allow::action('galleries', 'edit')) {
            $image_id = ExtForm::process('image', array(
                'image' => Input::get('image'),
                'return' => 'id'
            ));
            $input['photo'] = $image_id;
        }
        ################################################

        $input['product_id'] = Input::get('product');
        
		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, _48hoursAction::$rules);
		if($validator->passes()) {

            if (_48hoursAction::find($id)->exists()) {

                _48hoursAction::find($id)->update($input);

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

			$json_request['responseText'] = 'Мероприятие обновлено';
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
	    $deleted = _48hoursAction::find($id)->delete();
		$json_request['responseText'] = 'Мероприятие удалено';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}

}


