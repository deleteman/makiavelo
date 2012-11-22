<?php

class DBCreatorAction extends Action {

	public function execute($params) {
		Makiavelo::info("Creating Database...");
		$sql_folder_path = ROOT_PATH . Makiavelo::SQL_CREATE_TABLES_FOLDER;

		Makiavelo::puts("Creating database...");
		$conn = DBLayer::connect();
		$db_name = DBLayer::getDBName();
		$sql = "CREATE DATABASE `$db_name`";
		Makiavelo::puts($sql);
		Makiavelo::info("SQL to execute:");
		Makiavelo::info($sql . "\n");
		if(!mysql_query($sql, $conn)) {
			Makiavelo::info("ERROR creating db: " . mysql_error());
		}
		DBLayer::disconnect($conn);
	}
}

?>