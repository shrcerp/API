<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");



    if(!isset($_GET["link"])){
        exit();
    }
    $page = $_GET["link"];
    if(!file_exists("pages/$page/".$page."_info.json")){
        exit("404");
    }
    // get information about API
    $api_info = json_decode(file_get_contents("pages/$page/".$page."_info.json"),1);
    include "comman/comman.php";
    include "comman/dbConnection.php";
    include "comman/db_fun/mysqli.php";



    $post_data = array();
    foreach ($api_info["keys"] as $key => $value) {
        if(!isset($value["type"])){
            $value["type"] = 1;
        }
        $post_data[$value["key_name"]] = check_key_post($value["key_name"], $value["type"]);
    }
    save_response_api();
    // calling function
    $result = array();
    foreach ($api_info["layouts"] as $key => $row) {
        include "pages/$page/".$row["name"].".php"; // calling page name
        $function_name = $row["function"]; // getting function name
        
        $a = $function_name($post_data); // calling dynamic function
        if(isset($row["is_merge"]) && $row["is_merge"]){
            $result = array_merge($result,$a);
        }else{
            send_data_all($a);
        }
    }
    send_data("101", "Success", $result);

?>
