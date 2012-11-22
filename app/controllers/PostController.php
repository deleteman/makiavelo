<?php

 class PostController extends ApplicationController {

 	public function newAction() {
		$entity = new Post();
		$entity->owner_id = current_user()->id;
		$this->render(array("entity" => $entity));
	}

	public function deleteAction() {
		delete_post($this->request->getParam("id"));
		$this->flash->success("Delete successfull!");
		$this->redirect_to(post_list_path());
	}

	public function editAction() {
		$tb = load_post($this->request->getParam("id"));

		$this->render(array("entity" => $tb));
	}

	public function showAction() {
		$id = $this->request->getParam("id");
		$ent = load_post($id);
		$this->render(array("entity" => $ent));
	}

	public function createAction() {
		$entity = new Post();
		$entity->load_from_array($this->request->getParam("post"));
		if(save_post($entity)) {
			$this->flash->success("New Post added!");
			$this->redirect_to(post_list_path());
		} else {
			$this->render(array("entity" => $entity), "new");
		}
	}

	public function indexAction() {
		$entity_list = list_post();
		$this->render(array("entity_list" => $entity_list));
	}


 }


?>