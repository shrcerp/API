<?php





    function get_my_followups($data){
      //print_r($data);
      $result = '[
                            {
                                "title": "No Follow-ups Found",
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
                            }
                        ]';
      $result = json_decode($result,1);
      return array(
          "code" => "101"
          ,"message" => "No Reports Found"
          ,"result" => $result
      );

  }



?>
