<?php

class Place extends BaseModel {

	protected $guarded = array();

	protected $table = '48hours_places';

	public static $order_by = "places.id DESC";

	public static $rules = array(
		'name' => 'required',
		#'desc' => 'required',
	);


	public function tags($modname = false) {
        if (!$modname)
            return null;

        return Tag::where('module', $modname)->where('unit_id', $this->id)->get();
	}

	public function photo() {

        return Photo::where('id', $this->photo)->first();
	}

}