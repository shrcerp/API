<?php

    function get_cart_data($data){



    $result = '[
      {
        "title": "No New Order Found",
        "layout_code": "31",
        "textcolor_code": "#000000",
        "text_fontsize": "16",
        "text_fontweight": "normal",
        "sub_text": "No New Order Found",
        "layout_des": "small text",
        "image": "http://app.housepital.in/admin_new/data/mobile/1623216384615.png",
        "timestamp": "10 Aug 2021",
        "web_link": "",
        "web_view": "0",
        "click_action": "0",
        "web_view_heading": "",
        "page_code": "5020",
        "next_page": []
        }
]';
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => json_decode($result,1)
      );

    }



?>
