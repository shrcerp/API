<?php

      function order_medicine_submit($data){
            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

            $patient_id = $data["data_global"]["id"];
            $elements = json_decode($data["elements"],1);
            $date = date("Y-m-d");
            $time = date("H:m:s");
            $sql = "INSERT INTO `video_patient_transaction`(booking_type, `patient_id`, `amount`, `interest`, `booking_from`, `booking_to`, `booking_date`, `doctor_id`, `status`, `created_by`) VALUES (
                  '3'
                  ,'$patient_id'
                  ,'0'
                  ,'Order Medicine'
                  ,'".$time."'
                  ,'00:00:00'
                  ,'".$date."'
                  ,'197'
                  ,'1'
                  ,'1'
            )";
            $query = cj_query($sql);
            $video_patient_transaction_id = cj_insertid();

            foreach($elements as $i => $value){
                  if($value["value"]){
                      $value["value"] = str_replace("https://sarvodayahospital.com/admin/data/app/","",$value["value"]);
                      $sql = "INSERT INTO `video_medical_prescription`(`medical_image`, `patient_id`, `video_patient_transaction_id`, `status`, `created_by`) VALUES (
                          '".$value["value"]."'
                          ,'".$patient_id."'
                          ,'".$video_patient_transaction_id."'
                          ,'1'
                          ,'1'
                      )";
                      $query = cj_query($sql);
                  }
            }

            $data = array(
                        "app_type" => "1"
                        ,"user_id" => "$patient_id"
                        ,"title" => "Medicine Order Received"
                        ,"body" => "Medicine Order is Successfully Placed on ".date("d M Y", strtotime($date))." at ".date("h:i a").", our team will call to confirm the order"
                        ,"icon" => "https://app.housepital.in/admin_new/data/app_icon/medicien.png"
                        ,"firebase_id" => ""
                        ,"next_page" =>''
                  );
          save_notification($data);
            return array(
                  "code" => "101"
                  ,"result" => array("video_patient_transaction_id" => $video_patient_transaction_id)
                  ,"message" => "success"
                  );
      }

?>
