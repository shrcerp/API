<?php

    function get_history_data($data){



      $result = '[
                          {
                              "title": "",
                              "layout_code": "001",
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
                              "elements": [

                                  {
                                      "title": "Booking History",
                                      "image": "https://app.housepital.in/admin_new/data/app_icon/order-icon.png",
                                      "color": "#FFBF00",
                                      "next_page": {
                                        "page_code": "view_data",
                                        "data_self": "1",
                                        "data_heading": "My Booking",
                                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/my_booking"
                                      }
                                  },
                                  {
                                      "title": "Lab Report",
                                      "image": "https://app.housepital.in/admin_new/data/app_icon/lab.png",
                                      "color": "#1E90FF",
                                      "next_page": {
                                        "page_code": "edit_profile",
                                        "data_self": "1",
                                        "data_heading": "My Reports",
                                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/my_reports"
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
