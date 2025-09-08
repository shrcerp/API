<?php
function cj_query($sql){
	global $con;
	$query = mysqli_query($con,$sql);
	if(!$query){
		echo "Query fail -".$sql;
		echo "error -".cj_error();
	}
	return $query;
}

function cj_fetch_array($query){
	global $con;
	$row = mysqli_fetch_assoc($query);
	return $row;
}

function cj_insertid(){
	global $con;
	$id = mysqli_insert_id($con);
	return $id;
}

function cj_error(){
	global $con;
	$error = mysqli_error($con);
	return $error;
}
function cj_rows($query){
	global $con;
	$row = mysqli_num_rows($query);
	return $row;
}

?>
