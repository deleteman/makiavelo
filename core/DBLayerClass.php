<?php

class DBLayer {

	public static $config = array();

	public static function connect() {
		Makiavelo::info("Connecting to database...");
		DBLayer::loadConfiguration();
		$__db_conn = null;
		if(DBLayer::$config['name'] != "") {
			$__db_conn = mysql_connect(DBLayer::$config['host'], DBLayer::$config['user'], DBLayer::$config['pwd']);
			if(!$__db_conn) {
				Makiavelo::error("Can't connect to database, using configuration: ");
				Makiavelo::error(print_r(DBLayer::$config, true));
				Makiavelo::error("MYSQL ERROR::" . mysql_error());
			}
		}
		DBLayer::selectDB();
		return $__db_conn;
	}

	public static function selectDB() {
		if(!mysql_select_db(DBLayer::$config['name'])) {
			Makiavelo::info("Error selecting database: ");
			Makiavelo::info(mysql_error());
		}
	}

	public static function disconnect($conn) {
		Makiavelo::info("Closing database connection...");
		mysql_close($conn);
	}

	public static function getDBName() {
		return DBLayer::$config['name'];
	}

	private static function loadConfiguration() {
		Makiavelo::info("Loading database configuration file: ");
		$database_yml = ROOT_PATH . Makiavelo::DATABASE_CONFIGURATION;

		Makiavelo::info($database_yml);
		$parser = new YAMLParser();
		$config = $parser->parsePath($database_yml);
		Makiavelo::info("Configuration loaded: ");
		Makiavelo::info(print_r($config, true));
		DBLayer::$config = $config[Makiavelo::getCurrentEnv()];
	}

}


?>