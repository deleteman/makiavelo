<?php

class DBMigratorAction extends Action {

	public function execute($params) {
		$this->runMigrations();
	}

	private function runMigrations() {
		$latest_migration = $this->getLatestMigration();
		$last_migration = "";
		$m_folder = Makiavelo::MIGRATIONS_FOLDER;
		$d = dir($m_folder);
		while( ($entry = $d->read()) !== false) {
			if($entry[0] != ".") {
				$name_parts = explode("_", $entry);
				if(intval($name_parts[0]) > intval($latest_migration) ) {
					$this->runMigration($entry);	
					$last_migration = $name_parts[0];
				}
						
			}
		}
	}

	private function getLatestMigration() {
		$sql = "SELECT migration from migrations order by migration desc limit 1";
		$res = DBLayer::select($sql);
		$r = mysql_fetch_assoc($res);
		if($r['migration'] == "") {
			return 0;
		} else {
			return $r['migration'];
		}
	}

	private function runMigration($f_name) {
		include(Makiavelo::MIGRATIONS_FOLDER . "/" . $f_name . ".php");
		$parts = explode("_", $f_name);
		$migration_number = $parts[0];
		unset($parts[0]);
		$className = Makiavelo::underscore_to_camel(implode("_", $parts));
		$migration = new $className;
		$migration->up();

		$this->updateMigrationsTable($migration_number);
	}

	private function updateMigrationsTable($migration_number) {
		$sql = "INSERT INTO migrations (migration) values (".$migration_number.")";
		DBLayer::query($sql);
	}
}


?>