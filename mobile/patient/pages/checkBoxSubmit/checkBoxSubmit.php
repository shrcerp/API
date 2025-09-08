<?php

    function checkBoxSubmit_fun($data){
      global $con;
      $data_self = $data["data_self"];
      $data_global = $data["data_global"];
      $elements = json_decode($data["element"],1);

      $video_patient_transaction_id = $data_self["video_patient_transaction_id"];
      $doctor_id = $data_self["doctor_id"];

      $sql = "select * from video_patient_transaction where id = '$video_patient_transaction_id'";

      $query = cj_query($sql);
      $initial_data = mysqli_fetch_array($query);
      $now_time = date("H:i:s");

      foreach($elements as $i => $v){

            $id = $v["id"];
            if($v["value"]){

                  if($id == "1" && !$initial_data["check_in_time"]){
                      $sql1 = "update  video_patient_transaction set check_in_time = '$now_time' where id = '$video_patient_transaction_id'";
                      $query1 = cj_query($sql1);
                  }else if($id == "2"  && !$initial_data["in_consultation_time"]){
                    check_out_other_person($doctor_id,$video_patient_transaction_id);
                    $sql1 = "update  video_patient_transaction set in_consultation_time = '$now_time' where id = '$video_patient_transaction_id'";
                    $query1 = cj_query($sql1);
                  }
            }

      }


      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => array()
      );

    }

    function check_out_other_person($doctor_id,$video_patient_transaction_id){
                global $con;
                $date = date("Y-m-d");
                $now_time = date("H:i:s");
              echo  $sql = "select * from video_patient_transaction where id != '$video_patient_transaction_id' and in_consultation_time is not NULL and check_out_time is NULL and date='$date' and doctor_id = '$doctor_id'";
                $result = array();
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)) {
                      $s_update = "update video_patient_transaction set check_out_time = '$now_time' where id = '".$row["id"]."'";
                      $query = cj_query($s_update);
                }

                return true;
    }




?>
