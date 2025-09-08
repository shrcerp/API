<?php


    function get_my_insurance(){

      $result = '[
                    {
                        "title": "",
                        "layout_code": "73",
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
                                "image": "https://www.copperjam.com/admin/mobile_prototype/data/app/1663585936003.png",
                                "title": "Add Insurance",
                                "sub_text": "Add Document for pre-admission",
                                "click_action": "1",
                                "timestamp": "",
                                "next_page": {
                                      "page_code": "form_page",
                                      "data_self": "",
                                      "data_heading": "Submit your Documents",
                                      "data_url": "https://sarvodayahospital19.com/api/mobile/patient/add_insurance_stage_2"
                                }
                            },

                            {
                                "title": "My Document Status",
                                "sub_text": "",
                                "image": "https://www.copperjam.com/admin/mobile_prototype/data/app/1663391371922.png",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Document Status",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_document"
                                },
                                "elements": []
                            }
                ]
              }
            ]';

            $result =  json_decode($result,1);
            return array(
                "code" => "101"
                ,"result" => $result
                ,"messages" => "success"
                ,"back_page" => array(
                  "page_code" => "screen",
                  "screenid" => "2",
                  "data_heading"=> "Home",
                  "data_url"=> "https://sarvodayahospital19.com/api/mobile/patient/home"
                )
            );

            //return $result;


    }


?>
