<?php

    function vaccination_info($data){

             $data_global = $data["data_global"];
             $result = '[{
                             "title": "My Vaccination Booking",
                             "layout_code": "15",
                             "sub_text": "",
                             "sub_text_1": "",
                             "layout_des": "small text",
                             "image": "https://sarvodayahospital.com/api/mobile/images/today_booking.jpg",
                             "timestamp": "",
                             "web_link": "",
                             "web_view": "0",
                             "click_action": "1",
                             "web_view_heading": "",
                             "page_code": "5020",
                             "next_page": {
                                 "page_code": "view_data",
                                 "data_self": "",
                                 "data_heading": "My Vaccination Booking",
                                 "data_url": "https://sarvodayahospital.com/api/mobile/patient/vaccination_booking"
                             }
                         },

                         {
                             "title": "Book Vaccination",
                             "layout_code": "7",
                             "sub_text_1": "",
                             "sub_text": "",
                             "layout_des": "small text",
                             "image": "https://sarvodayahospital.com/api/mobile/images/today_video_booking.png",
                             "timestamp": "",
                             "web_link": "",
                             "web_view": "0",
                             "click_action": "1",
                             "web_view_heading": "",
                             "page_code": "5020",
                             "next_page": {
                                 "page_code": "web_view",
                                 "data_self": "",
                                 "data_heading": "Book Vaccination",
                                 "data_url": "https://sarvodayahospital.com/vaccination-booking-mobile?token='.$data_global["id"].'&v=8"
                             }
                         }
                       ]
                   ';

            $result = '{
            "title": "",
            "layout_code": "73",
            "layout_des": "info_card",
            "sub_text": "",
            "image": "",
            "timestamp": "",
            "web_link": "",
            "web_view": "0",
            "click_action": "1",
            "web_view_heading": "",
            "page_code": "5020",
            "next_page": [],
            "elements": '.$result.'
          }';

             $result = json_decode($result);
             return array(
                "code" => "101"
                ,"message" => "success"
                ,"result" => array($result)
             );



    }







?>
