<?php

function cj_query($sql){
	$query = mysql_query($sql);
	return $query;
}

function cj_fetch_array($query){
	$row = mysql_fetch_array($query);
	return $row;
}

function cj_insertid(){
	$id = mysql_insert_id();
	return $id;
}

function cj_error(){
	$error = mysql_errno();
	return $error;
}
function cj_rows($query){
	$row = mysql_num_rows($query);
	return $row;
}

 

?>