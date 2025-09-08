<?php

      function get_screen_data(){
              echo '{
                    "code": "101",
                    "message": "successful",
                    "result": {
                        "title": "",
                        "layout_code": "17",
                        "layout_des": "bottomnavigation",
                        "totalpage":"3",
                        "currentindex":"1",
                        "sub_text": "",
                        "image": "https://app.housepital.in/admin_new/data/mobile/1607338181259.png",
                        "next_page": [],
                        "elements": [
                            
                            {
                                "id":"0",
                                "icon":"notification",
                                "tab_title":"Notification",
                                "activeicon":"notification_active",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"notification",

                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"lib/assets/logo/logo_white.png",
                                "data_heading": "Notification"
                            },{
                                "id":"1",
                                "icon":"logo_icon",
                                "tab_title":"Home",
                                "activeicon":"logo_icon",
                                "tab_center":"1",
                                "pagecode":"home",
                                "data_url":"home",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"Home",
                                "data_heading": "Home"
                            },{
                                "id":"2",
                                "icon":"user_whitecircle",
                                "tab_title":"Profile",
                                "activeicon":"user_whitecircle_active",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"profile",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"lib/assets/logo/logo_white.png",
                                "data_heading": "Profile"
                            }
                        ]
                    }
                }
                ';
                exit();
      }



?>
