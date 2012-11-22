<?php

class MakiaveloEntity {
	protected $errors;

	public function __get_entity_name() {
		return Makiavelo::camel_to_underscore(get_class($this));
	}

	public function is_new() {
		return ($this->id == null);
	}

	public function load_from_array($arr) {
		Makiavelo::info("Inside load_from_array....");
		foreach($arr as $attr => $value) {
			Makiavelo::info("Setting {$attr} to {$value}");
			$this->$attr = $value;
			Makiavelo::info("getting {$attr} to {$this->$attr}");
		}
	}

	public function validate() {
		Makiavelo::info("== Validating model ==");

		$class_name = get_class($this);
		$reflect = new ReflectionClass($class_name);
		$properties = $reflect->getProperties();
		$validates = true;
		foreach($properties as $prop) {
			$attr = $prop->getName();
			$value = $this->$attr;
			Makiavelo::info("-- Validating attr: " . $attr);
			if(!isset($class_name::$validations[$attr])) {
				Makiavelo::info("-- No validation set");
				continue;
			}
			$this->errors[$attr] = array();
			foreach($class_name::$validations[$attr] as $validator) {
				Makiavelo::info("-- Validation: " . $validator);
				$validator_class = ucwords($validator) . "Validator";
				$v = new $validator_class;
				if(!$v->validate($value)) {
					$this->errors[$attr][] = $attr . " " . $v->errorMsg();
					$validates = false;
				}
			}
		}
		Makiavelo::info("== Validation result == ");
		Makiavelo::info(print_r($this->errors, true));
		return $validates;
	}
	
	public function __set($name, $val) {
		$this->$name = $val;
	}

	public function __get($name) {
		return $this->$name;
	}
}

?>