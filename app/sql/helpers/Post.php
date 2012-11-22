<?php

function save_post($entity) {
	if(!$entity->is_new()) {
		return update_post($entity);
	} else {
			
		if($entity->validate()) {
			global $__db_conn;	

			$sql = "INSERT INTO post(created_at,updated_at,title,content,owner_id) values (':created_at:',':updated_at:',':title:',':content:',':owner_id:')";

			$sql = str_replace(":created_at:", Date("Y-m-d"), $sql);
			$sql = str_replace(":updated_at:", Date("Y-m-d"), $sql);

			preg_match_all("/:([a-zA-Z_0-9]*):/", $sql, $matches);
			foreach($matches[1] as $attr) {
				$sql = str_replace(":$attr:", $entity->$attr, $sql);
			}
			mysql_query($sql, $__db_conn);
			$entity->id = mysql_insert_id($__db_conn);
			return true;
		} else {
			return false;
		}
	}

}


function update_post($en) {
	if($en->validate()) {
		global $__db_conn;	

		$sql = str_replace(":id:", $en->id, "UPDATE post SET id=':id:',created_at=':created_at:',updated_at=':updated_at:',title=':title:',content=':content:',owner_id=':owner_id:' WHERE id = :id:"); #'UPDATE tipo_buque set name="' . $en->name .'" WHERE id=' . $en->id;

		$sql = str_replace(":updated_at:", Date("Y-m-d"), $sql);


		preg_match_all("/:([a-zA-Z_0-9]*):/", $sql, $matches);
		foreach($matches[1] as $attr) {
			$sql = str_replace(":$attr:", $en->$attr, $sql);
		}
		mysql_query($sql, $__db_conn);
		return true;
	} else {
		return false;
	}


}

function delete_post($entity_id) {
	global $__db_conn;
	$sql = str_replace(":id:", $entity_id, "DELETE FROM post WHERE id = :id:"); #DELETE FROM tipo_buque WHERE id = " . $entity_id;

	if(!mysql_query($sql, $__db_conn)) {
		echo mysql_error();
	}
}

function load_post($id) {
	return load_post_where("id = $id");
}

function load_post_where($where) {
	global $__db_conn;

	$sql =  "SELECT * FROM post WHERE $where"; #SELECT * FROM tipo_buque WHERE id = " . $id;

	$result = mysql_query($sql, $__db_conn);
	if(mysql_num_rows($result) > 0) {
		$row = mysql_fetch_assoc($result);
		$new = new Post();
		$new->load_from_array($row);
		return $new;
	} else {
		return null;
	}
}

/** 
Retrieves a list of Post
@order = Optional, can be an array of keys or just a single key to order by the results
@limit = Optional
*/
function list_post($order = null, $limit = null) {
	global $__db_conn;	

	$sql = "SELECT * FROM post";
	if($order != null) {
		$order_str = $order;
		if(is_array($order)) {
			$order_str = implode(",", $order);
		}
		$sql .= " order by $order_str";
	}

	if($limit != null) {
		$sql .= " limit $limit";
	}

	$result = mysql_query($sql, $__db_conn);
	$results = array();

	while($row = mysql_fetch_assoc($result)) {
		$tmp = new Post();
		$tmp->load_from_array($row);
		$results[] = $tmp;
	}

	return $results;

}


?>