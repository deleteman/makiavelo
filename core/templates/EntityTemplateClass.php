<?php

class [NAME] extends MakiaveloEntity {
	[ATTRIBUTES]

	static public $validations = array([VALIDATIONS]);
	public function __set($name, $val) {
		$this->$name = $val;
	}

	public function __get($name) {
		return $this->$name;
	}
}