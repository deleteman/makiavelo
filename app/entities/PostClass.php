<?php

class Post extends MakiaveloEntity {
	private $id; //type: integer
private $created_at; //type: datetime
private $updated_at; //type: datetime
private $title; //type: string
private $content; //type: text
private $owner_id; //type: integer


	static public $validations = array("title"=> array('presence'),
"content"=> array('presence'),
"owner_id"=> array('presence'),
);
	public function __set($name, $val) {
		$this->$name = $val;
	}

	public function __get($name) {
		return $this->$name;
	}

	public function getOwner() {
		return load_user($this->owner_id);
	}
}