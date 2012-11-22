<?php

class HomeController extends ApplicationController {

	public function indexAction() {
		$entity_list = list_post();
		if(!user_logged_in()) {
			$this->render(array("entity_list" => $entity_list));
		} else {
			$this->redirect_to(post_list_path());
		}
	}
}

?>