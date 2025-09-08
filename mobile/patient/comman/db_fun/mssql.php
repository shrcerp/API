<?php

function cj_query($sql){
	global $con;
	//$query = mssql_query($sql);
	$query = sqlsrv_query($con,$sql);
	if(!$query){
		echo $sql;
	}
	return $query;
}

function cj_fetch_array($query){
	global $con;
	//$row = mssql_fetch_array($query);
	$row = sqlsrv_fetch_array($query);
	return $row;
}

function cj_insertid(){
	global $con;
	 $query= 'SELECT SCOPE_IDENTITY() AS last_insert_id';
     $query_result= sqlsrv_query($con,$query) or die('Query failed: '.$query." ".sqlsrv_errors());                                          
     $query_result= sqlsrv_fetch_array($query_result) or die('Query failed: '.$query." ".sqlsrv_errors());                      
     $id = $query_result["last_insert_id"];  
	//$id = sqlsrv_insert_id($con);
	return $id;
}

function cj_error(){
	global $con;
	$error = sqlsrv_errors();
	return $error;
}
function cj_rows($query){
	global $con;
	//$row = mssql_num_rows($query);
	$row = sqlsrv_num_rows($query);
	return $row;
}

?>