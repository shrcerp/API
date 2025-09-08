<?php

      function order_medicien($data_global){
        $data_self = encrypt_fun($data_global);
        $form = '{
                        "code": "101",
                        "message": "Success",
                        "result": {
                            "submit_form_url": "https://sarvodayahospital.com/api/mobile/patient/order_medicine_submit",
                            "elements": [
                                {
                                    "title": "Add Prescription",
                                    "text": "",
                                    "layout_code": "208",
                                    "layout_dis": "imageupload",
                                    "configuration": [],
                                    "value": ""
                                }
                            ],
                            "hp_Points": "10",
                            "submit_button_name": "Save",
                            "submit_button_background_color": "#FFFFFF",
                            "submit_button_font_color": "#000000",
                            "submit_button_border_color": "#666666",
                            "data_self": " ",
                            "next_page": {
                              "page_code": "screen",
                              "screenid": "1",
                              "save_data_global": "0",
                              "data_self": " ",
                              "data_heading": "Notification",
                              "data_url": "https://sarvodayahospital.com/api/mobile/patient/notification"
                            }
                        }
                    }';

            return json_decode($form,1);


      }

?>
