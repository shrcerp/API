<?php


    function add_insurance_form_submit_fun($data){

      global $con;
      $data["elements"] = json_decode($data["elements"],1);
      $va_patient_id = $data["data_global"]["id"];
      $insurance_company = $data["elements"][0]["value"];
      $reference_name = $data["elements"][1]["value"];
      $expire_date = $data["elements"][2]["value"];

      $sql = "INSERT INTO `va_patient_insurance`(`va_patient_id`, `m_panel_id`, `reference_name`, `expire_date`, `status`, `created_by`) VALUES (
            '$va_patient_id'
            ,'$insurance_company'
            ,'$reference_name'
            ,'$expire_date'
            ,'1'
            ,'1'
      ) ON DUPLICATE KEY UPDATE reference_name = '$reference_name'";

      $query = cj_query($sql);

      return array(
          "code" => "101"
          ,"result" => array()
          ,"message" => "Successfully Submitted"
      );

            //return $result;


    }


?>
