<?php

    function get_online_doctor_list($data){

      global $con;
      $time = date("Y-m-d H:i:s",strtotime("-15 min"));
      $sql = "select * from sh_doctor_dev where is_video_booking = 1 ";
      $query = cj_query($sql);
      $result = '[{
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
                        "data_self": "",
                        "data_heading": "Search Result",
                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/search_doctor"
                    },
                    "elements": []
                }]';
      $result = json_decode($result,1);
      while($row = cj_fetch_array($query)){
            $a = '{
                      "title": "'.$row["name"].'",
                      "name": "'.$row["name"].'",
                      "layout_code": "44",
                      "text": "'.$row["designation"].'",
                      "description": "'.$row["designation"].'",
                      "sub_text": "'.$row["designation"].'",
                      "layout_des": "button layout",
                      "image": "https://sarvodayahospital.com/admin/data/app/'.$row["profile"].'",
                      "timestamp": "05 Mar 2021",
                      "web_link": "",
                      "web_view": "0",
                      "click_action": "1",
                      "web_view_heading": "",
                      "page_code": "5020",
                      "height_change": "0",
                      "model_window_open": "2",
                      "model_element": [],
                      "next_page": {
                          "page_code": "web_view",
                          "data_self": "",
                          "data_heading": "Vaccination",
                          "data_url": "https://sarvodayahospital.com/vaccination-booking"
                      },
                      "elements": []
                  }';

            $a = ' {
                      "title": "'.$row["name"].'",
                      "layout_code": "87",
                      "layout_des": "search_bar",
                      "sub_text": "'.html_entity_decode($row["designation"]).'",
                      "image": "https://sarvodayahospital.com/admin/data/app/'.$row["profile"].'",
                      "timestamp": "",
                      "sub_text1":"Available from 20 june 2021",
                      "rating":"4.4",
                      "review":"No Reviews",
                      "web_link": "",
                      "web_view": "0",
                      "click_action": "1",
                      "web_view_heading": "",
                      "page_code": "5020",
                      "next_page": {
                          "page_code": "web_view",
                          "data_self": "",
                          "data_heading": "'.$row["name"].'",
                          "data_url": "https://sarvodayahospital.com/doctorpage_mobile/'.$row["id"].'/?token='.encrypt_fun($data["data_global"]).'&p=1"
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



    }



?>
