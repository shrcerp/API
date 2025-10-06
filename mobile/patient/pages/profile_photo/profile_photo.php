<?php

function upload_profile_photo($data){
    // print_r($data);
    global $con;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
    if (isset($_FILES['image']) ) {
        
        $id = $data['data_global']['id'];
        $uploadDir = 'data/';
        // $uploadDir = __DIR__ . '/data/'; 
        $uploadDir = __DIR__ . '/../../data/';

        
      
        $uploadPath = $uploadDir . basename($_FILES['image']['name']);
        // print_r($uploadPath);
        // return;
      
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $query = "update video_patient set profile_photo='$uploadPath' where id=$id" ;
            $query_update = mysqli_query($con, $query);
        
        
            if ($query_update) {
                echo json_encode([
                    "success" => true,
                    "message" => "Photo uploaded successfully",
                    "result" => []
                ]);
            } else {
                echo json_encode([
                   "success" => false,
                    "message" => "Please try again",
                    "result" => []
                ]);
            }
        
        } else {
            echo json_encode(['success' => false, "result" => [], 'message' => 'Failed to upload image.']);
        }
    } else {
        echo json_encode(['success' => false, "result" => [], 'message' => 'No image file received']);
    }

     }
?>



