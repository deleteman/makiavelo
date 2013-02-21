<?php

class Migration {

	abstract public function up();
	abstract public function down();

	protected function alter_table($tname, $params) {
		global $__db_conn;
		foreach($params as $operation => $parms) {
			switch($operation) {
				case "add_field":
					$new_field = $parms[0];
					$type = $parms[1];
					$sql = "ALTER TABLE $tname add column $new_field $type";
				break;
				case "drop_field":
					$new_field = $parms;
					$sql = "ALTER TABLE $tname drop column $new_field ";
				break;
				default:
				break;
			}
			DBLayer::query($sql);

		}	
	}
}


?>