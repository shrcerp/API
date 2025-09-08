<?php


    function add_insurance_stage_2_form_submit($data){

      global $con;
      $search = "";
      $data_global = $data["data_global"];
      $data_self = $data["data_self"];
      $elements = json_decode($data["elements"],1);

      foreach($elements as $i =>$val){
          add_2_s($val,$data_self["id"]);
      }



      return array(
          "code" => "101"
          ,"result" =>array()
          ,"message" => "successfully submitted"
      );

            //return $result;


    }
    function add_2_s($row,$doc_id){
            global $con;
            $row["value"] = str_replace("https://sarvodayahospital19.com/admin/data/app/","",$row["value"]);

            $sql = "update m_patient_document set value = '".$row["value"]."' , status = '1' where id = '$doc_id'";

            $query = cj_query($sql);
    }





?>
