<?php

    function get_all_doctor_list($data){
      global $con;
      $search = "";
      $data_global = $data["data_global"];
      if(isset($data["data_self"])){
          $location = $data["data_self"]["location"];
      }
      $time = date("Y-m-d H:i:s",strtotime("-15 min"));

       $sql = "select * from gw_doctor_info  where OnlineAppointment = 1 and status = 1 ";
        if($location){
            $sql .= " and FIND_IN_SET('$location',hospitals) ";
        }



      //$query = cj_query($sql);




      $result = '[{
                    "title": "'.$search.'",
                    "layout_code": "1",
                    "layout_des": "search_bar",
                    "sub_text": "",
                    "image": "",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": [],
                    "elements": []
                },{
                    "title": "Search Doctors..",
                    "layout_code": "57",
                    "layout_des": "search_bar",
                    "sub_text": "",
                    "image": "",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",

                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "'.$location.'",
                        "data_heading": "Search Result",
                        "data_url": "https://sarvodayahospital19.com/api/mobile/patient/search_doctor"
                    },
                    "elements": []
                }]';
      $result = json_decode($result,1);
      $a = '';

    //  if($location == 'sarvodaya-hospital-greater-noida-west'){
          $query = cj_query($sql);

          while($row = cj_fetch_array($query)){
          //  $location = $row["location"];
              $is_in_person = "1";
              $is_video  = 0;
              $a = ' {
                        "title": "'.ucwords(strtolower($row["DoctorName"])).'",
                        "layout_code": "106",
                        "layout_des": "search_bar",
                          "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["CurrentDesignation"])))).'",
                        "image": "'.$row["doctor_photo"].'",
                        "timestamp": "",
                        "sub_text1":"'.html_entity_decode($row["mednet_DepartmentName"]).'",
                        "is_online":"'.$is_video.'",
                        "is_physical":"'.$is_in_person.'",
                        "rating":"",
                        "review":"",
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "1",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "next_page": {
                            "page_code": "web_view",
                            "data_self": "",
                            "data_heading": "'.$row["DoctorName"].'",
                            "data_url": "https://sarvodayahospital19.com/doctorpage_mobile_1/'.$row["gw_id"].'/?token='.encrypt_fun($data["data_global"]).'&p='.rand(1,100).'&n='.base64_encode($location).'"
                        },
                        "elements": []
                    }';

              $a = json_decode($a,1);
              if($a){
                  $result[] = $a;
              }

          }
          return array(
              "code" => "101"
              ,"message" => "Success"
              ,"result" => $result
          );


      //}


      $doctor_list = get_doctor_list();
      foreach($doctor_list as $i => $row){
          $is_in_person = "1";
          $is_video  = 0;
          $a = ' {
                    "title": "'.ucwords(strtolower($row["fullName"])).'",
                    "layout_code": "106",
                    "layout_des": "search_bar",
                    "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["qualification"])))).'",
                    "image": "https://sarvodayahospital19.com/api/mobile/images/sarvodaya_mobile_logo.png",
                    "timestamp": "",
                    "sub_text1":"'.$row["departmentName"].'",
                    "is_online":"'.$is_video.'",
                    "is_physical":"'.$is_in_person.'",
                    "rating":"",
                    "review":"",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "1",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "web_view",
                        "data_self": "",
                        "data_heading": "'.$row["fullName"].'",
                        "data_url": "https://sarvodayahospital19.com/doctorpage_mobile_1/'.$row["doctorID"].'/?token='.encrypt_fun($data["data_global"]).'&p='.rand(1,100).'&n='.base64_encode($location).'"
                    },
                    "elements": []
                }';

          $a = json_decode($a,1);
          if($a){
              $result[] = $a;
          }


      }
      /*
      while($row = cj_fetch_array($query)){
      //  $location = $row["location"];
        $review = '';
        $is_video = "0";
        $is_in_person = "0";
        if($row["inperson_booking"] == 1){
              $is_in_person = "1";
        }
        if($row["is_video_booking"] == 1){
              $is_video = "1";
        }

        if(!$review){
            $review .= 'Avaliable';
        }

          $a = ' {
                    "title": "'.$row["name"].'",
                    "layout_code": "106",
                    "layout_des": "search_bar",
                      "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["designation"])))).'",
                    "image": "https://sarvodayahospital19.com/admin/data/app/'.$row["profile"].'",
                    "timestamp": "",
                    "sub_text1":"'.$row["menu_name"].'",
                    "is_online":"'.$is_video.'",
                    "is_physical":"'.$is_in_person.'",
                    "rating":"",
                    "review":"",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "1",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "web_view",
                        "data_self": "",
                        "data_heading": "'.$row["name"].'",
                        "data_url": "https://sarvodayahospital19.com/doctorpage_mobile/'.$row["id"].'/?token='.encrypt_fun($data["data_global"]).'&p='.rand(1,100).'&n='.base64_encode($location).'"
                    },
                    "elements": []
                }';

          $a = json_decode($a,1);
          if($a){
              $result[] = $a;
          }

    	}
      */

      if(!$a){
            $a = '{
                          "title": "Search Result Not Found",
                          "layout_code": "1",
                          "layout_des": "search_bar",
                          "sub_text": "",
                          "image": "",
                          "timestamp": "",
                          "web_link": "",
                          "web_view": "0",
                          "click_action": "0",
                          "web_view_heading": "",
                          "page_code": "5020",
                          "next_page": [],
                          "elements": []
                      }';
            $a = json_decode($a,1);
            if($a){
                $result[] = $a;
            }
      }

      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );



    }

    function get_doctor_list(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://live.mednetlabs.com/mxServer/ws/feature/mednetAppointment/V2/getDoctorAndDepartmentList',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "filter":"doctor"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'source: WebClient',
        'facilityGUID: 3e77361c-d482-4816-afbb-5b87576da352',
        'unitName: SARVODAYA HOSPITAL AND RESEARCH CENTRE',
        'userID: appointment@sarvodaya',
        'userKey: a7a56cfe-d152-480b-aab3-d5923a8b5bb7'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response,1);
        return json_decode($response['data'],1);


    }



?>