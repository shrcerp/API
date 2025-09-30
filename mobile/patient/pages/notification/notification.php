<?php

    function get_notification_data($data){



      $user_id = $data["data_global"]["id"];
      $sql = "select * from mobile_notification where user_id = '$user_id' and app_type = '1' order by id desc";
      $query = cj_query($sql);
      $elements = array();
      while($row = cj_fetch_array($query)){
            $next_page = $row["next_page_json"];
            $click_action = 1;
            if(!$next_page){
                $next_page = "{}";
                  $click_action = "0";
            }
            $r = '{
                "image": "'.$row["icon"].'",
                "title": "'.$row["title"].'",
                "sub_text": "'.$row["body"].'",
                "sub_text_1": "",
                "id": "'.$row["id"].'",
                "is_read" : "'.$row["status"].'",
                "click_action": "'.$click_action.'",
                "timestamp": "",
                "next_page": '.$next_page.'
            }';
            $elements[] = json_decode($r,1);
      }

     

      $result = '[
                    {
                        "title": "",
                        "layout_code": "314",
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
                                "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                                "title": "Welcome to Sarvodaya Hospital",
                                "sub_text": "We are delighted to have you among us. On behalf of all the members and the management, we would like to extend our warmest welcome and good wishes!",
                                "sub_text_1": "",
                                "id": "2",
                                "is_read" : "1",
                                "click_action": "0",
                                "timestamp": "",
                                "next_page": {
                                    "page_code": "edit_profile",
                                    "data_self": "U1pkTW1XQ0xXZU1BYUNlVVo5TWtXZz09",
                                    "data_heading": "Lab Report",
                                    "data_url": "http://app.housepital.in/admin_new/Mobile/history_inner"
                                }
                            }
                ]
              }
            ]';
            $result =  json_decode($result,1);
            if(count($elements)){
                  $result[0]["elements"] = $elements;
            }
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

    }



?>
