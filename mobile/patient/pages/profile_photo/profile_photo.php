<?php

    function upload_profile_photo($data){
    // print_r($data);
        global $con;
        global $upload_url ;
        $id = $data['data_global']['id'];
        $file = $data['file'];
        $query = "update video_patient set profile_photo='$file' where id=$id" ;
        $query_update = mysqli_query($con, $query);
    
        if ($query_update) {
            return array(
                "code" => "101"
                ,"message" => "upload successfull"
                ,"result" => array( "avatar" => $file)
            );
        } else {
            return array("code" => "102", "message" => "uploading failed", "result" => array("avatar" => ""));
      
        }
     }
?>



