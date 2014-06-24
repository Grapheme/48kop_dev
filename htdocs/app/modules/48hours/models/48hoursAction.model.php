<?php

class _48hoursAction extends BaseModel {

	protected $guarded = array();

	protected $table = '48hours_actions';

	public static $order_by = "48hours_actions.id DESC";

	public static $rules = array(
		'name' => 'required',
		'desc' => 'required',
	);

	public function tags($modname = false){
        if (!$modname)
            return false;

        return Tag::where('module', $modname)->where('unit_id', $this->id)->get();
	}

	public function photo() {

        return Photo::where('id', $this->photo)->first();
	}

	public function also_go_count() {

        return iWillGo::where('object_type', 'action')->where('object_id', $this->id)->count();
	}

}