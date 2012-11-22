<?php

class MakiaveloCore {

	private $code_mappings = array(
		Makiavelo::RESPONSE_CODE_OK => "handleOK",
		Makiavelo::RESPONSE_CODE_NOT_FOUND => "handleNotFound",
		Makiavelo::RESPONSE_CODE_FORBIDDEN => "handleForbidden"
		);
	private $rHandler;
	private $controller;

	public function __construct($r) {
		$this->rHandler = $r;
	}

	public function handleResponseCode($code) {

		Makiavelo::info("Handling response code: $code");
		if (array_key_exists($code, $this->code_mappings)) {
			$method = $this->code_mappings[$code];
			$this->$method();
		} else {
			$this->handleNotFound();
		}
	}

	private function handleOK() {
		$get_params = $this->getQueryStringParams();
		$this->controller = $this->getController($this->rHandler->getController());
		$this->controller->handleRequest($get_params, $_POST, $this->rHandler->getNamedParams());
		$methodName = $this->rHandler->getActionName() . "Action";
		Makiavelo::info("Method to execute: {$methodName}");
		$this->controller->setAction($this->rHandler->getActionName());
		$this->controller->$methodName();
	}

	/** 
		Grabs the parameters sent via GET.
		Thanks for the htaccess file, the $_GET array doens't have them anymore, so we
		need to use the REQUEST_URI key.
	**/
	private function getQueryStringParams() {
		$url = explode("?", $_SERVER['REQUEST_URI']);
		if(!isset($url[1])) {
			return array();
		} else {
			$ret = array();
			$params = $url[1];
			$params = explode("&", $params);
			foreach($params as $value_key) {
				$parts = explode("=", $value_key);
				$ret[$parts[0]] = $parts[1];
			}
			return $ret;
		}
	}

	private function handleNotFound() {
		$this->renderNoRouteError();
	}

	private function handleForbidden() {
		$path = $this->rHandler->getLoginPath();
		if($path == null ){
			$path = $this->rHandler->getRootPath();
		}
		header("Location: $path");
	}


	public function renderNoRouteError() {
		header("HTTP/1.0 404 Not Found");
	}

	
	public function getController($c_name) {
		try {
			$name = $c_name . "Controller";
			$c = new $name;
		} catch (Exception $e) {
			$c = null;
		}
		return $c;
	}
}



?>