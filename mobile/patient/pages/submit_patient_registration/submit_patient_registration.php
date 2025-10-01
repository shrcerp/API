<?php

      function submit_patient_registration($data){
          global $con;
          $elements = json_decode($data["elements"],1);

          $mobile =$data['data_global']["mobile"];
          $Prefix = get_elments_from_heading("Prefix",$elements);

          $patient_name = get_elments_from_heading("Patient Name",$elements);
          $Gender = get_elments_from_heading("Gender",$elements);
          $Address = get_elments_from_heading("Address",$elements);
          $dob = get_elments_from_heading("Date Of Birth",$elements);
          $state_id = get_elments_from_heading("State",$elements);
          $state_name = "";
          $state_list = $elements[5]["configuration"]["option_value"];
          foreach($state_list as $n => $n_v){
              if($state_id == $n_v[0]){
                    $state_name = $n_v[1];
                    break;
              }
          }

          $city_name = get_elments_from_heading("City",$elements);
          $pin_code = get_elments_from_heading("Pin Code",$elements);

          if(check_for_registration($patient_name,$mobile)){
            return array(
                  "code" => "102",
                  "message" => "Patient Already Registed",
                  "result" => array()
            );
          }

          $sql = "INSERT INTO `video_patient`(`prefix`, `patient_name`, `mobile`, `gender`, `dob`, `address`, `status`, `created_by`,state_name,city_name,pin_code) VALUES (
                '$Prefix'
                ,'$patient_name'
                ,'$mobile'
                ,'$Gender'
                ,'$dob'
                ,'$Address'
                ,'1'
                ,'2'
                ,'$state_name'
                ,'$city_name'
                ,'$pin_code'
          )";
          $query = cj_query($sql);
          $patient_id = mysqli_insert_id($con);
          $get_patient_data = get_patient_data($patient_id);
          $patient_data = array(
                "mobile" => $get_patient_data["mobile"]
                ,"mrn" => $get_patient_data["mrn_no"]
                ,"id" => $get_patient_data["id"]
                ,"user_type" => "1"
                ,"name" => $get_patient_data["patient_name"]
                ,"prefix" => $get_patient_data["prefix"]
            );
            $data_global_e = encrypt_fun($patient_data);
        //   $data_global_e = encrypt_fun($get_patient_data);
          $login_data = '[
                              {
                                  "email_id": "",
                                  "patient_id": "0",
                                  "mobile": "9953669955",
                                  "name": "'.$get_patient_data["patient_name"].'",
                                  "first_name": "'.$get_patient_data["patient_name"].'",
                                  "middle_name": "",
                                  "last_name": "",
                                  "age": "",
                                  "height": "",
                                  "weight": "",
                                  "avatar": "http://app.housepital.in/admin_new/data/app_icon/profile_icon.jpg",
                                  "address": " ",
                                  "city": " ",
                                  "city_id": " ",
                                  "state": " ",
                                  "next_page": {
                                      "page_code": "home",
                                      "data_self": "",
                                      "data_heading": "",
                                      "data_url": "https://sarvodayahospital.com/api/mobile/test/home"
                                  },
                                  "country": " ",
                                  "pin": "",
                                  "data_global": "'.$data_global_e.'"
                              }
                          ]';
          return array(
                "code" => "101",
                "message" => "Successfully submitted",
                "result" => json_decode($login_data,1)
          );

      }
      function get_elments_from_heading($title,$elements){

          foreach ($elements as $i => $value) {
              if($value["title"] == $title){
                  return $value["value"];
              }
          }
          return "";
      }
      function get_patient_data($id){
          global $con;
        $sql = "select * from video_patient where id='$id'";
        $query = mysqli_query($con, $sql);
        while($row = mysqli_fetch_array($query)) {
            return $row;
        }
      }
      function check_for_registration($name,$mobile){
          global $con;
        $sql = "select * from video_patient where patient_name='$name' and mobile = '$mobile'";
        $query = mysqli_query($con, $sql);
        while($row = mysqli_fetch_array($query)) {
            return 1;
        }
        return 0;
      }

?>
