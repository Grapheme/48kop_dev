<?php

class Admin48hoursMenuController extends BaseController {

    public static $name = '48hoursMenu';
    public static $group = '48hours';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        ##
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
        return array(
        	'view'   => 'Отображать в меню',
/*
        	'places_view'   => 'Места - Просмотр',
        	'places_create' => 'Места - Создание',
        	'places_edit'   => 'Места - Редактирование',
        	'places_delete' => 'Места - Удаление',
        
        	'actions_view'   => 'Мероприятия - Просмотр',
        	'actions_create' => 'Мероприятия - Создание',
        	'actions_edit'   => 'Мероприятия - Редактирование',
        	'actions_delete' => 'Мероприятия - Удаление',

        	'advices_view'   => 'Советы - Просмотр',
        	'advices_create' => 'Советы - Создание',
        	'advices_edit'   => 'Советы - Редактирование',
        	'advices_delete' => 'Советы - Удаление',

        	'wheretobuy_view'   => 'Где купить - Просмотр',
        	'wheretobuy_create' => 'Где купить - Создание',
        	'wheretobuy_edit'   => 'Где купить - Редактирование',
        	'wheretobuy_delete' => 'Где купить - Удаление',
*/
        );
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        return array(
        	'name' => self::$name,
        	'group' => self::$group,
            'title' => '48 часов',
            'visible' => '1',
        );
    }

    ## Menu elements of the module
    public static function returnMenu() {
        /*
        ## With child links
        return array(
        	'name' => self::$name,
        	'group' => self::$group,
        	'title' => '48 часов', #trans('modules.pages.menu_title'), 
        	'link' => '#',
            'class' => 'fa-star-o', 
            'show_in_menu' => 1,
            'menu_child' => array(
                array(
                	'title' => 'Места',
                    'link' => self::$group . "/places",
                    'class' => 'fa-crosshairs', 
                ),
                array(
                	'title' => 'Мероприятия',
                    'link' => self::$group . "/actions",
                    'class' => 'fa-ticket', 
                ),
                array(
                	'title' => 'Советы',
                    'link' => self::$group . "/advices",
                    'class' => 'fa-comments-o', 
                ),
                array(
                	'title' => 'Где купить?',
                    'link' => self::$group . "/wheretobuy",
                    'class' => 'fa-shopping-cart', 
                ),
            ),
        );
        #*/
        #/*
        ## Without child links
        return array(
            array(
            	'title' => 'Места',
                'link' => self::$group . "/places",
                'class' => 'fa-crosshairs', 
                'permit' => 'view',
            ),
            array(
            	'title' => 'Мероприятия',
                'link' => self::$group . "/actions",
                'class' => 'fa-ticket', 
                'permit' => 'view',
            ),
            array(
            	'title' => 'Советы',
                'link' => self::$group . "/advices",
                'class' => 'fa-comments-o', 
                'permit' => 'view',
            ),
            array(
            	'title' => 'Где купить?',
                'link' => self::$group . "/wheretobuy",
                'class' => 'fa-shopping-cart', 
                'permit' => 'view',
            ),
        );
        #*/
    }

        
    /****************************************************************************/
    
	public function __construct(){
        ##
	}
}


