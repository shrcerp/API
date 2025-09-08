<?php


    function add_insurance_stage_2_form_submit($data){

      global $con;
      $search = "";
      $data_global = $data["data_global"];
      if($data_global["id"] == "0"){
          $data_global["id"] = "3";
      }
      $elements = json_decode($data["elements"],1);

      foreach($elements as $i =>$val){

              add_2_s($val,$data_global["id"]);


      }



      return array(
          "code" => "101"
          ,"result" =>array()
          ,"message" => "successfully submitted"
      );

            //return $result;


    }
    function add_2_s($row,$patient_id){
            global $con;
            $status = '4';
            if($row["value"]){
                $row["value"] = str_replace("https://sarvodayahospital19.com/admin/data/app/","",$row["value"]);
                $status = 1;
            }else{
                $row["value"] = " ";
            }

            $sql = "INSERT INTO `m_patient_document`(`video_patient_id`, `m_document_id`, `value`, `status`, `created_by`) VALUES (
                  '$patient_id'
                  ,'".$row["key"]."'
                  ,'".$row["value"]."'
                  ,'".$status."'
                  ,'1'
            )";
            $query = cj_query($sql);
    }





?>
