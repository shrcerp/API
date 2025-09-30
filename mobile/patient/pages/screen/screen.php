<?php

      function get_screen_data(){
              echo '{
                    "code": "101",
                    "message": "successful",
                    "result": {
                        "title": "",
                        "layout_code": "17",
                        "layout_des": "bottomnavigation",
                        "totalpage":"5",
                        "currentindex":"0",
                        "sub_text": "",
                        "image": "https://app.housepital.in/admin_new/data/mobile/1607338181259.png",
                        "next_page": [],
                        "elements": [
                            
                            {
                                "id":"0",
                                "icon":"Home-g",
                                "tab_title":"Home",
                                "activeicon":"Home-g_b",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"home",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"lib/assets/logo/logo_white.png",
                                "data_heading": "Home"
                            },{
                                "id":"1",
                                "icon":"Reports-g",
                                "tab_title":"Reports",
                                "activeicon":"Reports-g_b",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"my_reports",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"Home",
                                "data_heading": "Reports"
                            },
                            {
                                "id":"2",
                                "icon":"",
                                "tab_title":"AI",
                                "activeicon":"",
                                "tab_center":"1",
                                "pagecode":"home",
                                "data_url":"home",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"Home",
                                "data_heading": "Home"
                            },{
                                "id":"3",
                                "icon":"Prescription-g",
                                "tab_title":"Prescription",
                                "activeicon":"Prescription-g_b",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"my_prescription",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"lib/assets/logo/logo_white.png",
                                "data_heading": "Prescription"
                            },
                            {
                                "id":"4",
                                "icon":"Profile-g",
                                "tab_title":"Profile",
                                "activeicon":"Profile-g_b",
                                "tab_center":"0",
                                "pagecode":"home",
                                "data_url":"profile",
                                "data_self":"",
                                "data_heading_type":"text",
                                "data_heading_image":"Home",
                                "data_heading": "Profile"
                            }
                        ]
                    }
                }
                ';
                exit();
      }



?>
