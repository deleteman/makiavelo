<?php

class MigrationGenerator {

	public function execute($params) {
		$migration_name = $params[0];
		$filename = Makiavelo::camel_to_underscore($migration_name);	
		$timestamp = time();

		$migration_fname = $timestamp."_".$filename.".php";
		Makiavelo::puts("Generating migration file...$migration_fname\n");
		$fp = @fopen(ROOT_PATH . "/" .Makiavelo::MIGRATIONS_FOLDER . "/" . $migration_fname, "w");
		if($fp) {
			fwrite($fp, "<?php \n //Write here your migration code...\n ?>");
			fclose($fp);
		}
	}

}



?>