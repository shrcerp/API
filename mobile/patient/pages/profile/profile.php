<?php

    function get_profile_data($data){
      
      $name = array_key_exists('name',$data["data_global"]) ? $data["data_global"]["name"] : $data["data_global"]["patient_name"] ;
      $mrn = array_key_exists('mrn',$data["data_global"]) ? $data["data_global"]["mrn"] : $data["data_global"]["mrn_no"] ;
      

      $result = '[
                    {
                        "title": "'.$name.'",
                        "layout_code": "76",
                        "title_heading": "icon_person",
                        "sub_text_heading": "icon_service",
                        "sub_text": "User",
                        "sub_text_2_heading": "icon_person",
                        "sub_text_2": "'.$data["data_global"]["mobile"].'",
                        "sub_text_3_heading": "icon_money",
                        "sub_text_3_text": "'.$mrn.'",
                        "star_rating": "5",
                        "star_rating_text": "Cumulative",
                        "layout_des": "user_profile",
                        "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                        "timestamp": "22 Feb 2021",
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "0",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "edit_icon": "0",
                        "edit_icon_heading": "icon_edit",
                        "next_page": {
                            "page_code": "form_page",
                            "data_self": "MDFjVEp2aFh4Qll5QXFoME81emNOQT09",
                            "data_heading": "Personal Information",
                            "data_url": "http://app.housepital.in/admin_new/Mobile_staff/form_personalinfo"
                        },
                        "elements": []
                    },
                    {
                          "type":"",
                          "layout_code":"102",
                          "header_title": "",
                          "sub_heading": "",
                          "image": "http://app.housepital.in/admin_new/data/mobile/1605676475049.png",
                          "ok_button":"0",
                          "next_page1": [],
                          "elements":[
                              {
                                  "image": "https://app.housepital.in/admin_new/data/app_icon/lab.png",
                                  "title": "My Reports",
                                  "sub_text": "",
                                  "is_icon_right": "1",
                                  "icon_color":"#388fc5",
                                  "title_color":"#388fc5",
                                  "click_action": "1",
                                  "timestamp": "",
                                  "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                  }
                              },
                              {
                                  "image": "https://app.housepital.in/admin_new/data/app_icon/order-icon.png",
                                  "title": "My Booking",
                                  "sub_text": "",
                                  "is_icon_right": "1",
                                  "icon_color":"#388fc5",
                                  "title_color":"#388fc5",
                                  "click_action": "1",
                                  "timestamp": "",
                                  "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                  }
                              },
                              {
                                  "image": "https://sarvodayahospital.com/api/mobile/images/doc_icon_2.png",
                                  "title": "Discharge Summary",
                                  "sub_text": "",
                                  "is_icon_right": "1",
                                  "icon_color":"#388fc5",
                                  "title_color":"#388fc5",
                                  "click_action": "1",
                                  "timestamp": "",
                                  "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "Discharge Summary",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/discharge_summary"
                                  }
                              }
                          ]
                      }

        ]';
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => json_decode($result,1)
      );

    }



?>
