<?php

    function select_hospital_list(){

      $data_self_8 = encrypt_fun(array("location" => "sarvodaya-hospital-research-centre-sector-8"));
      $data_self_nodia = encrypt_fun(array("location" => "sarvodaya-hospital-greater-noida-west"));

      $result = '[{
          "title": "Select Your Hospital",
          "layout_code": "1",
          "layout_des": "info_card",
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
            "title": "",
            "layout_code": "5",
            "textcolor_code": "#000000",
            "text_fontsize": "14",
            "text_fontweight": "normal",
            "sub_text": "Sarve Santu Niramaya - Good Health for All",
            "layout_des": "small text",
            "image": "https://sarvodayahospital19.com/api/mobile/images/sarvodaya_Sector_8.png",
            "timestamp": "10 Aug 2021",
            "web_link": "",
            "web_view": "0",
            "click_action": "1",
            "web_view_heading": "",
            "page_code": "5020",
            "next_page": {
                "page_code": "view_data",
                "data_self": "'.$data_self_8.'",
                "data_heading": "Sarvodaya Hospital, Sector-8",
                "data_url": "https://sarvodayahospital19.com/api/mobile/patient/all_doctor_list"
            }
        },{
              "title": "",
              "layout_code": "5",
              "textcolor_code": "#000000",
              "text_fontsize": "14",
              "text_fontweight": "normal",
              "sub_text": "Sarve Santu Niramaya - Good Health for All",
              "layout_des": "small text",
              "image": "https://sarvodayahospital19.com/api/mobile/images/sarvodaya_nodia.png",
              "timestamp": "10 Aug 2021",
              "web_link": "",
              "web_view": "0",
              "click_action": "1",
              "web_view_heading": "",
              "page_code": "5020",
              "next_page": {
                  "page_code": "view_data",
                  "data_self": "'.$data_self_nodia.'",
                  "data_heading": "Sarvodaya Hospital, Greater Noida",
                  "data_url": "https://sarvodayahospital19.com/api/mobile/patient/all_doctor_list"
              }
          }]';

      $result = json_decode($result);

      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );



    }



?>
