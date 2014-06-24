<?php

class Admin48hoursPlacesController extends BaseController {

    public static $name = 'admin_48hoursPlaces';
    public static $group = '48hours';
    public static $modname = '48hoursPlaces';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group."/places", $class);
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
            'rest' => self::$group."/places",
            'tpl' => static::returnTpl('admin/places'),
            'gtpl' => static::returnTpl(),
        );
        View::share('module', $this->module);
	}

	public function getIndex(){
		
		$places = Place::orderBy('id', 'desc')->get();
		return View::make($this->module['tpl'].'index', compact('places'));
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
            'type' => Input::get('type'),
            'metro' => Input::get('metro'),
            'desc' => Input::get('desc'),
        );

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
		$validator = Validator::make($input, Place::$rules);
		if($validator->passes()) {

		    #$json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
		    #$json_request['responseText'] = "<pre>" . print_r($input, 1) . "</pre>";
		    #return Response::json($json_request, 200);

			#self::saveNewsModel();
            $id = Place::create($input)->id;

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

            ################################################
            ## Process gallery
            ################################################
            if (Allow::action('galleries', 'edit')) {
                ExtForm::process('gallery', array(
                    'module'          => self::$modname,
                    'unit_id'         => $id,
                    'gallery_id'      => Input::get('gallery_id'),
                    'uploaded_images' => Input::get('uploaded_images'),
                ));
            }
            ################################################

			$json_request['responseText'] = 'Место создано';
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
		
		$place = Place::findOrFail($id);
        $gallery = Rel_mod_gallery::where('module', $this->module['modname'])->where('unit_id', $id)->first();
		return View::make($this->module['tpl'].'edit', compact('place', 'gallery'));
	}

	public function postUpdate($id){

		if(!Request::ajax())
            return App::abort(404);

		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'type' => Input::get('type'),
            'metro' => Input::get('metro'),
            'desc' => Input::get('desc'),
        );

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

	    #$json_request['responseText'] = "<pre>" . print_r($input, 1) . "</pre>";
        #return Response::json($json_request, 200);

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, Place::$rules);
		if($validator->passes()) {

            if (Place::find($id)->exists()) {

                Place::find($id)->update($input);

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

                ################################################
                ## Process gallery
                ################################################
                if (Allow::action('galleries', 'edit')) {
                    ExtForm::process('gallery', array(
                        'module'          => self::$modname,
                        'unit_id'         => $id,
                        'gallery_id'      => Input::get('gallery_id'),
                        'uploaded_images' => Input::get('uploaded_images'),
                    ));
                }
                ################################################
            }
            
			$json_request['responseText'] = 'Место обновлено';
            #$json_request['responseText'] = "<pre>" . print_r($tags, 1) . "</pre>";
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
	    $deleted = Place::find($id)->delete();
		$json_request['responseText'] = 'Место удалено';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}

}


