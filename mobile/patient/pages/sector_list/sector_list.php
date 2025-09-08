<?php

    function get_sector_list($data){

      $result = '[
        {
          "title": "Select  Hospital",
          "layout_code": "1",
          "textcolor_code": "#000000",
          "text_fontsize": "14",
          "text_fontweight": "normal",
          "sub_text": "Select  Hospital",
          "layout_des": "small text",
          "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
          "timestamp": "10 Aug 2021",
          "web_link": "",
          "web_view": "0",
          "click_action": "0",
          "web_view_heading": "",
          "page_code": "5020",
          "next_page": []
          },
          {
            "type": "",
            "layout_code": "102",
            "header_title": "",
            "sub_heading": "",
            "image": "http://app.housepital.in/admin_new/data/mobile/1605676475049.png",
            "ok_button": "0",
            "next_page1": [],
            "elements": [
                {
                    "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                    "title": "Sarvodaya Hospital & Research Centre, Sector-8, Faridabad",
                    "sub_text": "",
                    "is_icon_right": "1",
                    "icon_color": "#388fc5",
                    "title_color": "#388fc5",
                    "click_action": "1",
                    "timestamp": "",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "1",
                        "data_heading": "Sarvodaya Hospital Sector-8 ",
                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"

                    }
                },
                {
                    "image": "https://sarvodayahospital.com/admin/data/app/1553690903107.png",
                    "title": "Sarvodaya Hospital, Sector-19, Faridabad",
                    "sub_text": "",
                    "is_icon_right": "1",
                    "icon_color": "#388fc5",
                    "title_color": "#388fc5",
                    "click_action": "1",
                    "timestamp": "",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "1",
                        "data_heading": "Sarvodaya Hospital, Sector-19",
                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
                    }
                },
                {
                    "image": "https://sarvodayahospital.com/admin/data/app/1580699009768.png",
                    "title": "Sarvodaya Health Clinic, Greater faridabad",
                    "sub_text": "",
                    "is_icon_right": "1",
                    "icon_color": "#388fc5",
                    "title_color": "#388fc5",
                    "click_action": "1",
                    "timestamp": "",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "1",
                        "data_heading": "Sarvodaya Health Clinic, Greater faridabad",
                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
                    }
                },
                {
                    "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                    "title": "Sarvodaya Health Clinic, Mathura",
                    "sub_text": "",
                    "is_icon_right": "1",
                    "icon_color": "#388fc5",
                    "title_color": "#388fc5",
                    "click_action": "1",
                    "timestamp": "",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "T3ZhZkg3QitHellqcC9ac0NKSExpTE1pNWYvUVFoU2w3Q0plWmRVN2pZNmVKdWRPQityTE1TOFRxR3ZvUXFOOFc0b2xrdjlrdnFuYkNKdTRoeVJGN1FhRTZibHhBdm1kSE43aWhUVkNsbTdDbEZBZ1JnOGdVV3N2VTFvazlySHZlamhIRXhiWlRwT2pWN1RxZXF1NWVERmtMS2Y2OFZTZG5PVFpUaUxuS1Y3T3VKNHhTUmRtR3gwQ1pUTkFIN2VuODIyTkVNdStKZEYwVEwvYTAvbEI3L3NiYjBmWFZydFFITzZaRGovalA5a0FndEw1VjJvWTYraG9KY1J4aUVBMC9qcThMak1OeTVSZ05oc25qSXJkRmtvcXNvb0tuNkl6d3lqeVFVWW90a009",
                        "data_heading": "Sarvodaya Health Clinic, Mathura",
                        "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
                    }
                }
            ]
        }]';

        return array(
            "code" => "101"
            ,"message" => "Success"
            ,"result" => json_decode($result,1)
        );

        $sector_8 = array(
              "sector_name" => "sarvodaya-hospital-research-centre-sector-8"
        );

        $sector_19 = array(
              "sector_name" => "sarvodaya-hospital-sector-19"
        );

        $sector_health = array(
              "sector_name" => "sarvodaya-health-clinic"
        );

        $sector_medicentre = array(
              "sector_name" => "sarvodaya-medicentre"
        );


        $result = '[
          {
            "title": "Select  Hospital",
            "layout_code": "1",
            "textcolor_code": "#000000",
            "text_fontsize": "14",
            "text_fontweight": "normal",
            "sub_text": "Select  Hospital",
            "layout_des": "small text",
            "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
            "timestamp": "10 Aug 2021",
            "web_link": "",
            "web_view": "0",
            "click_action": "0",
            "web_view_heading": "",
            "page_code": "5020",
            "next_page": []
            },
            {
              "title": "",
              "layout_code": "2",
              "sub_text": "",
              "text": "Sarvodaya Hospital & Research Centre, Sector-8, Faridabad",
              "layout_des": "button layout",
              "image": "https://sarvodayahospital.com/admin/data/app/1553690903107.png",
              "timestamp": "05 Mar 2021",
              "web_link": "https://www.facebook.com/Sarvodayafaridabad/",
              "web_view": "0",
              "click_action": "1",
              "web_view_heading": "Sarvodaya Hospital & Research Centre, Sector-8, Faridabad",
              "page_code": "5020",
              "next_page": {
                  "page_code": "view_data",
                  "data_self": "1",
                  "data_heading": "Sarvodaya Hospital Sector-8 ",
                  "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"

              },
              "model_window_open": "2",
              "model_element": [],
              "elements": []
          },
          {
            "title": "",
            "layout_code": "2",
            "sub_text": "",
            "text": "Sarvodaya Hospital, Sector-19, Faridabad",
            "layout_des": "button layout",
            "image": "https://sarvodayahospital.com/admin/data/app/1580699009768.png",
            "timestamp": "05 Mar 2021",
            "web_link": "https://www.facebook.com/Sarvodayafaridabad/",
            "web_view": "0",
            "click_action": "1",
            "web_view_heading": "Sarvodaya Hospital, Sector-19",
            "page_code": "5020",
            "next_page": {
                "page_code": "view_data",
                "data_self": "T3ZhZkg3QitHellqcC9ac0NKSExpTE1pNWYvUVFoU2w3Q0plWmRVN2pZNmVKdWRPQityTE1TOFRxR3ZvUXFOOFc0b2xrdjlrdnFuYkNKdTRoeVJGN1FhRTZibHhBdm1kSE43aWhUVkNsbTdDbEZBZ1JnOGdVV3N2VTFvazlySHZlamhIRXhiWlRwT2pWN1RxZXF1NWVERmtMS2Y2OFZTZG5PVFpUaUxuS1Y3T3VKNHhTUmRtR3gwQ1pUTkFIN2VuODIyTkVNdStKZEYwVEwvYTAvbEI3L3NiYjBmWFZydFFITzZaRGovalA5a0FndEw1VjJvWTYraG9KY1J4aUVBMC9qcThMak1OeTVSZ05oc25qSXJkRmtvcXNvb0tuNkl6d3lqeVFVWW90a009",
                "data_heading": "Sarvodaya Hospital Sector-8",
                "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
            },
            "model_window_open": "2",
            "model_element": [],
            "elements": []
        },
        {
          "title": "",
          "layout_code": "2",
          "sub_text": "",
          "text": "Sarvodaya Health Clinic, Greater faridabad",
          "layout_des": "button layout",
          "image": "https://sarvodayahospital.com/admin/data/app/1580699690313.png",
          "timestamp": "05 Mar 2021",
          "web_link": "https://www.facebook.com/Sarvodayafaridabad/",
          "web_view": "0",
          "click_action": "1",
          "web_view_heading": "Sarvodaya Health Clinic, Greater faridabad",
          "page_code": "5020",
          "next_page": {
              "page_code": "view_data",
              "data_self": "1",
              "data_heading": "Sarvodaya Health Clinic, Greater faridabad",
              "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
          },
          "model_window_open": "2",
          "model_element": [],
          "elements": []
      },
      {
        "title": "",
        "layout_code": "2",
        "sub_text": "",
        "text": "Sarvodaya Health Clinic, Mathura",
        "layout_des": "button layout",
        "image": "https://sarvodayahospital.com/admin/data/app/1625314505355.png",
        "timestamp": "05 Mar 2021",
        "web_link": "https://www.facebook.com/Sarvodayafaridabad/",
        "web_view": "0",
        "click_action": "1",
        "web_view_heading": "Sarvodaya Health Clinic, Mathura",
        "page_code": "5020",
        "next_page": {
            "page_code": "view_data",
            "data_self": "T3ZhZkg3QitHellqcC9ac0NKSExpTE1pNWYvUVFoU2w3Q0plWmRVN2pZNmVKdWRPQityTE1TOFRxR3ZvUXFOOFc0b2xrdjlrdnFuYkNKdTRoeVJGN1FhRTZibHhBdm1kSE43aWhUVkNsbTdDbEZBZ1JnOGdVV3N2VTFvazlySHZlamhIRXhiWlRwT2pWN1RxZXF1NWVERmtMS2Y2OFZTZG5PVFpUaUxuS1Y3T3VKNHhTUmRtR3gwQ1pUTkFIN2VuODIyTkVNdStKZEYwVEwvYTAvbEI3L3NiYjBmWFZydFFITzZaRGovalA5a0FndEw1VjJvWTYraG9KY1J4aUVBMC9qcThMak1OeTVSZ05oc25qSXJkRmtvcXNvb0tuNkl6d3lqeVFVWW90a009",
            "data_heading": "Sarvodaya Health Clinic, Mathura",
            "data_url": "https://sarvodayahospital.com/api/mobile/patient/booking_doctor_list"
        },

        "model_window_open": "2",
        "model_element": [],
        "elements": []
    }


        ]';

        return array(
            "code" => "101"
            ,"message" => "Success"
            ,"result" => json_decode($result,1)
        );


    }




?>
