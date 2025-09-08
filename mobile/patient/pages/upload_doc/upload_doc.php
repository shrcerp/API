<?php

    function save_upload_doc($data){
      //print_r($data);

      $time = time();
  		$target_dir = "../../../admin/data/app/";
  		//$target_file = $target_dir .time();
  		$uploadOk = 1;
  		$imageFileType = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
  		// Check if image file is a actual image or fake image
  		$image_name = $time.".".$imageFileType;

  		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$image_name)) {

  				return array(
                      "code" => "101"
                      ,"message" => "upload successfull"
                      ,"result" => array( "file" => "https://sarvodayahospital.com/admin/data/app/".$image_name)
            );
  		  } else {
  				return array("code" => "102", "message" => "uploading failes", "result" => array("avatar" => ""));
  		  }


      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => array( "file" => "https://sarvodayahospital.com/api/mobile/images/correct_icon.png")
      );

  }



?>
