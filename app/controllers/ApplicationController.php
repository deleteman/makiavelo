<?php

 class ApplicationController extends MakiaveloController {

 	public $categories = array();
 	public $vertical_banner = "";
 	public $latest_comments = array();
 	public $unread_messages= 0;

 	public function __construct() {
 		$this->layout = HTTPRequest::is_ajax_request() ? null : "layout";
 	}	

 }
?>