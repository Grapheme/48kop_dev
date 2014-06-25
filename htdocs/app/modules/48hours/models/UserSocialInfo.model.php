<?php

class UserSocialInfo extends BaseModel {

	protected $guarded = array();

	protected $table = 'user_social_info';

	public static $order_by = "id DESC";

	public static $rules = array(
		'profile' => 'required',
		#'desc' => 'required',
	);

}