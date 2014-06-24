<?php

class _48hoursTag extends Tag {

	protected $guarded = array();

	#protected $table = 'tags';

	#public static $order_by = "created_at DESC";

    /*
	public static $rules = array(
		'module' => 'required',
		'unit_id' => 'required|integer',
		'tag' => 'required|min:3|max:64',
	);
    */

    public function place() {
        return $this->hasMany('Place', 'id', 'unit_id');
    }
    
    public function action() {
        return $this->hasMany('_48hoursAction', 'id', 'unit_id');
    }

    public function advice() {
        return $this->hasMany('Advice', 'id', 'unit_id');
    }

    public function wheretobuy() {
        return $this->hasMany('Wheretobuy', 'id', 'unit_id');
    }

}