<?php

class User extends MakiaveloEntity {
	private $id; //type: integer
private $created_at; //type: datetime
private $updated_at; //type: datetime
private $username; //type: string
private $email; //type: string
private $password; //type:srting
private $role; //type:string
private $is_checked; //type:boolean


	static public $validations = array("name" => array("presence"),
										"email" => array("presence", "email"),
										"password" => array("presence"));
	public function __set($name, $val) {
		$this->$name = $val;
	}

	public function __get($name) {
		if(!isset($this->$name)) {
			return null;
		} else {
			 return $this->$name;
		}
	}
}