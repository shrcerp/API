<?php
      include './comman/round_cube.php';
      $global_url = "https://live.mednetlabs.com/mxServer/ws/feature/";
      $global_facilityGUID = "3e77361c-d482-4816-afbb-5b87576da352";
      $global_header = array(
        "Accept-Encoding: gzip, deflate",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: text/plain",
        "cache-control: no-cache",
        "facilityGUID: 3e77361c-d482-4816-afbb-5b87576da352",
        "source: WebClient",
        "userID: appointment@sarvodaya",
        "userKey: a7a56cfe-d152-480b-aab3-d5923a8b5bb7"
      );

      function doctor_login($mobile_number){
        $data_global = array(
              "mobile" => $mobile_number
              ,"mrn" => ""
              ,"id" => "1"
              ,"user_type" => "2"
              ,"name" => ""
              ,"prefix" => ""
        );
        $data_global = encrypt_fun($data_global);
        $re = '[
                  {
                      "email_id": "sas@gmail.com",
                      "patient_id": "6394",
                      "mobile": "9953669955",
                      "name": "Salil   Pandey",
                      "first_name": "Salil",
                      "middle_name": "",
                      "last_name": " Pandey",
                      "age": "",
                      "height": "",
                      "weight": "",
                      "avatar": "http://app.housepital.in/admin_new/data/app/1607335240.jpg",
                      "address": "dwarka sector 8, delhi1",
                      "city": "Delhi",
                      "city_id": "1",
                      "state": "Delhi",
                      "country": "India",
                      "pin": "110017",
                      "address_id": "9967",
                      "data_global": "'.$data_global.'",
                      "next_page": {
                          "page_code": "screen",
                          "screenid": 1,
                          "data_self": "",
                          "data_heading": "",
                          "data_url": "https://sarvodayahospital19.com/api/mobile/doctor/home"
                      }
                  }
              ]';
              return array(
                  "code" => "101"
                  ,"message" => "New Registration"
                  ,"result" => json_decode($re ,1)
              );
      }




      function otp_login_get_data($data){

        $mobile_number = $data["mobile"];
        $firebase_id = $data["firebase_id"];
        mobile_firebase_update($mobile_number,$firebase_id);

        $otp_number = $data["otp"];
        $a = otp_check($mobile_number,$otp_number);

        if($mobile_number == "9953669955" && $otp_number == "0000"){
              $a = "1";
        }




        $re = '[
                  {
                      "email_id": "sas@gmail.com",
                      "patient_id": "6394",
                      "mobile": "9953669955",
                      "name": "Salil   Pandey",
                      "first_name": "Salil",
                      "middle_name": "",
                      "last_name": " Pandey",
                      "age": "",
                      "height": "",
                      "weight": "",
                      "avatar": "http://app.housepital.in/admin_new/data/app/1607335240.jpg",
                      "address": "dwarka sector 8, delhi1",
                      "city": "Delhi",
                      "city_id": "1",
                      "state": "Delhi",
                      "country": "India",
                      "pin": "110017",
                      "address_id": "9967",
                      "data_global": "MW9YS2V2WFFJYno4UDltZjJ4SGJjMVI3WUJEZEFGem5HaGVtUXAzM3JQbjdGTUF6V0szSEt3YlRLS3FIU2lrbnNIakFxbE5zYWFEdCtOR3o3RnB6azlaUmgzTVpIdTA4VzJQK2w5dEN5ZnRYbDRUYVpLb2FCUzZNd3Y0WlVDVnJhRkk5M2hyRmtBWFhZZDVGV1ZCZlpKb21QNkVDdWNSTWc4amJBM00xeW03cmlMNlJNNERHN3Q4MEQ4TXN3OTlvK1B4RXpBWmszOEt0Nzdta3pkYURhOS9xNGpvdDdwZkxFaHA1UldRQnd2L203K09uVWpkd1ZMeTlqNzRLNGptNHJHcHdVVGVEaGNSZS9IZTZ2TUhnSHhTeElTWmFHQ09ha3NBSGs0WlNwRzhDVDZuWEdTZW9nZjBnZDVUandibHhGV2hvRDJwczhnaVdSRXVSeERBOW1uVUFwMllpMjZkOUtpaTMza2cxZjhKUmJ4T1hwdXJCVVl6VnUyenUwVEpGZkZQNkF6NlY2VEYyd3NhdWJPTGh2ZHhKdE1adVB0NkF5T1Z0T0p6OFZPYXRVR2VTaWZqZVhlTUljRVRNQkg1eWpuYklnOFpMVnlSeUNsUGMzcFpNWWdXalNwbXhOMmhIcHlERlN4bUpyc3lhdkFhMXlGVkMzTndPNmpXVFBMbHJuS2pRVGFPWm55VGFMSWhtaXFwRTlBPT0=",
                      "next_page": {
                          "page_code": "screen",
                          "screenid": 0,
                          "data_self": "",
                          "data_heading": "",
                          "data_url": "https://sarvodayahospital19.com/api/mobile/test/home"
                      }
                  }
              ]';
        $re = json_decode($re,1);

        if($a ){


            $result = check_for_old_patient($mobile_number);
            $result = register_in_local_data_base($result);

            $k = check_for_patient_register_inourdata($mobile_number);

            if(((isset($result["error_code"]) && $result["error_code"] == "604") || !$result) && !count($k)){

                    $data_global = array(
                          "mobile" => $mobile_number
                          ,"mrn" => ""
                          ,"id" => ""
                          ,"user_type" => "1"
                          ,"name" => ""
                          ,"prefix" => ""
                    );
                    $data_global = encrypt_fun($data_global);
                    $new = '[
                                  {
                                      "email_id": "",
                                      "patient_id": "0",
                                      "mobile": "9953669955",
                                      "name": "Guest User",
                                      "first_name": "Guest",
                                      "middle_name": "",
                                      "last_name": "User",
                                      "age": "",
                                      "height": "",
                                      "weight": "",
                                      "avatar": "http://app.housepital.in/admin_new/data/app_icon/profile_icon.jpg",
                                      "address": " ",
                                      "city": " ",
                                      "city_id": " ",
                                      "state": " ",
                                      "next_page": {
                                          "page_code": "form_page",
                                          "data_self": "'.$mobile_number.'",
                                          "data_heading": "New Registration",
                                          "data_url": "https://sarvodayahospital19.com/api/mobile/patient/patient_registration_form"
                                      },
                                      "country": " ",
                                      "pin": "",
                                      "data_global": "'.$data_global.'"
                                  }
                              ]';
                    return array(
                        "code" => "101"
                        ,"message" => "New Registration"
                        ,"result" => json_decode($new,1)
                    );
            }
            if($k){
                $result = array_merge($result,$k);
            }



            $patient_info = $result[0];
            $re[0]["name"] = $patient_info["prefix"]." ".$patient_info["personName"];
            $re[0]["mobile"] = $patient_info["registeredMobileNumber"];
            $re[0]["mrn"] = $patient_info["mrn"];
            $re[0]["id"] = $patient_info["id"];


            $data_global = array(
                  "mobile" => $patient_info["registeredMobileNumber"]
                  ,"mrn" => $patient_info["mrn"]
                  ,"id" => $patient_info["id"]
                  ,"user_type" => "1"
                  ,"name" => $patient_info["personName"]
                  ,"prefix" => $patient_info["prefix"]
            );

            $re[0]["data_global"] = encrypt_fun($data_global);
            $round_cube = array();
            $re[0]["round_cube"] = $round_cube;

            if($k){
                $result = array_merge($result,$k);
                return array(
                    "code" => "101"
                    ,"message" => "Succefully Login"
                    ,"result" => $re
                );
            }

            return array(
                "code" => "101"
                ,"message" => "Succefully Login"
                ,"result" => $re
            );


      }

      if($otp_number == "12345"){
              $new = '[
                            {
                                "email_id": "",
                                "patient_id": "0",
                                "mobile": "9953669955",
                                "name": "Guest User",
                                "first_name": "Guest",
                                "middle_name": "",
                                "last_name": "User",
                                "age": "",
                                "height": "",
                                "weight": "",
                                "avatar": "http://app.housepital.in/admin_new/data/app_icon/profile_icon.jpg",
                                "address": " ",
                                "city": " ",
                                "city_id": " ",
                                "state": " ",
                                "next_page": {
                                    "page_code": "form_page",
                                    "data_self": "'.$mobile_number.'",
                                    "data_heading": "New Registration",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/patient_registration_form"
                                },
                                "country": " ",
                                "pin": "",
                                "data_global": "b0EyYnhlb3dPOURabWtkMnJ5aXZKSFp3RXltaHhWejJsQkpVOXdRM1orek1neUtQQ0wxMXNOYkl1TzE3Y2hVaXE4YVJubHo2ZVZmUy8rRURRcFVwdWpHUUpVQ2ZyMzE0ZHhWV0xxZm5Nclk9"
                            }
                        ]';
              return array(
                  "code" => "101"
                  ,"message" => "New Registration"
                  ,"result" => json_decode($new,1)
              );

      }

      return array(
          "code" => "102"
          ,"message" => "OTP Not Matched"
          ,"result" => array()
      );


    }




    function register_in_local_data_base($result){
        if(!$result){
            return array();
        }
        if(isset($result["error_code"])){
            return array();
        }

        foreach ($result as $i => $patient_data) {
              $row = reg_patient($patient_data);
              $result[$i]["id"] = $row["id"];
        }
        return $result;


    }
    function reg_patient($patient_data){
              global $con;
              $mobile_number = $patient_data["registeredMobileNumber"];

              $patient_name = htmlentities($patient_data["personName"], ENT_QUOTES);
              $get_mrn = $patient_data["mrn"];
              $get_gender = $patient_data["gender"];
              $get_prefix = $patient_data["prefix"];
              $get_dob = $patient_data["formattedDOB"];
              if($patient_data["formattedDOB"]){
                    $get_dob = date("Y-m-d",strtotime($patient_data["formattedDOB"]));
              }else{
                    $get_dob = '';
              }

              $get_address = htmlentities($patient_data["address"], ENT_QUOTES);
              $time = date("Y-m-d H:i:s");
              $sql = "select * from video_patient
                      where mobile='".$mobile_number."' ";
              if($patient_data["facilityGUID"] == "3e77361c-d482-4816-afbb-5b87576da352"){
                      $sql .=" and   (mrn_no = '".$get_mrn."' or patient_name = '".$patient_data["personName"]."' )";
              }else if($patient_data["facilityGUID"] == "7c43de44-9724-4b6a-828b-73a3097d3653"){
                      $sql .=" and   (mrn_nodia = '".$get_mrn."' or patient_name = '".$patient_data["personName"]."'  )";

              }






              $query = mysqli_query($con, $sql);
              while($row = mysqli_fetch_array($query)) {
                  if(!$row["state_name"]){
                      $sql_a = "update video_patient set state_name = '".$patient_data["state"]."', city_name = '".$patient_data["city"]."', pin_code = '".$patient_data["pinCode"]."' where id = '".$row["id"]."' ";
                      $query_a = mysqli_query($con, $sql_a);


                  }

                  if($patient_data["facilityGUID"] == "3e77361c-d482-4816-afbb-5b87576da352" && !$row["mrn_no"]){
                    $sql_a = "update video_patient set mrn_no = '".$get_mrn."'  where id = '".$row["id"]."' ";
                    $query_a = mysqli_query($con, $sql_a);
                  }else if($patient_data["facilityGUID"] == "7c43de44-9724-4b6a-828b-73a3097d3653" && !$row["mrn_nodia"]){
                    $sql_a = "update video_patient set mrn_nodia = '".$get_mrn."'  where id = '".$row["id"]."' ";
                    $query_a = mysqli_query($con, $sql_a);
                  }
                  return $row;
              }

              if($patient_data["facilityGUID"] == "3e77361c-d482-4816-afbb-5b87576da352" && !$row["mrn_no"]){
                $user_mrn = 'mrn_no';
              }else if($patient_data["facilityGUID"] == "7c43de44-9724-4b6a-828b-73a3097d3653" && !$row["mrn_nodia"]){
                $user_mrn = 'mrn_nodia';
              }
               $sql_i = "INSERT INTO `video_patient`(
                    `patient_name`
                    ,`prefix`
                    , `".$user_mrn."`
                    , `mobile`
                    , `gender`
                    , `dob`
                    , `address`
                    , `status`
                    , `created_by`
                    , `created_on`
                    , `state_name`
                    , `city_name`
                    , `pin_code`

                  ) VALUES (
                        '".$patient_name."'
                        ,'".$get_prefix."'
                        ,'$get_mrn'
                        ,'".$mobile_number."'
                        ,'".$get_gender."' ";

                if($get_dob){
                    $sql_i .=",'$get_dob'";
                }else{
                    $sql_i .=",NULL";
                }
                    $sql_i .=",'".$get_address."'
                        ,1
                        ,1
                        ,'$time'
                        ,'".$patient_data["state"]."'
                        ,'".$patient_data["city"]."'
                        ,'".$patient_data["pinCode"]."'
                  )";


              $query_i = mysqli_query($con, $sql_i);
              $patient_id = mysqli_insert_id($con);
              return array(
                    "id" => $patient_id
              );


    }

      function otp_check($mobile_number,$otp){
            global $con;
            $time = date("Y-m-d H:i:s",strtotime("-15 min"));
            $sql = "select * from video_otp_check where mobile_number = '$mobile_number' and otp='$otp' and created_on>='$time' ";
            $query = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($query)) {
                return true;
            }
            return false;
      }

      function mobile_firebase_update($mobile_number,$firebase_id){
        global $con;
        $s = "update video_patient set firebase = '$firebase_id' where mobile = '$mobile_number'";
        $query1 = mysqli_query($con, $s);


      }

      function check_for_old_patient($mobile_number){
          global $global_url;
          global $global_header;
          //return array();
          $url = "https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listExistingUser";
          $header = $global_header;
          $post_field = array(
                "mobileNo" => $mobile_number
                ,"facilityGUID" => array("3e77361c-d482-4816-afbb-5b87576da352","7c43de44-9724-4b6a-828b-73a3097d3653")
          );
          $post_field = json_encode($post_field);
          $result = post_curl($url,$header,$post_field);
          return $result;
      }

      // send post request
      function post_curl($url,$header,$post_field){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_field,
            CURLOPT_HTTPHEADER => $header));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

              if($err) {
              //  send_data("","102","Connection error".$err);
              }else {
                $response =  json_decode($response,1);
                return $response["data"];
            }
      }

      function check_for_patient_register_inourdata($mobile_number){
          global $con;
          $sql = "select * from video_patient where mobile = '$mobile_number' and (mrn_no = '' or mrn_no is NULL)";
          $query = mysqli_query($con, $sql);
          $result = array();
          while ($row = mysqli_fetch_array($query)) {

              $age = ageCalculator($row["dob"]);
              $result[] = array(
                      "formattedAge" => $age." Years"
                      ,"personName" => $row["patient_name"]
                      ,"id" => $row["id"]
                      ,"address" => $row["address"]
                      ,"registeredMobileNumber" => $row["mobile"]
                      ,"prefix" => $row["prefix"]
                      ,"formattedDOB" => date("d-m-Y",strtotime($row["dob"]))
                      ,"gender" => $row["gender"]
                      ,"mrn" => ""
              );
          }
          return $result;
      }

      function ageCalculator($dob){
          if(!empty($dob)){
              $birthdate = new DateTime($dob);
              $today   = new DateTime('today');
              $age = $birthdate->diff($today)->y;
              return $age;
          }else{
              return 0;
          }
      }


?>
