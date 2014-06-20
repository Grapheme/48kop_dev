<?php

class iWillGo extends BaseModel {

	protected $guarded = array();

	protected $table = 'i_will_go';

	public static $order_by = "id DESC";

	public static $rules = array(
		'profile_id' => 'required',
		'object_type' => 'required',
		'object_id' => 'required',
	);

}