<?php

class UsersTask {
	
	public function loadInitialAdmin() {
		$usr = new Usuario();
		$usr->nombre = "Test User";
		$usr->email = "admin@admin.com";
		$usr->password = "admin";
		$usr->role = "admin";

		global $__db_conn;
		$__db_conn = DBLayer::connect();
		if(!save_usuario($usr)) {
			Makiavelo::puts("Error while saving the admin user:");
			Makiavelo::puts(print_r($usr->errors, true));
		} else {
			Makiavelo::puts("Admin created!\n");
		}
		DBLayer::disconnect($__db_conn);
	}
}

?>