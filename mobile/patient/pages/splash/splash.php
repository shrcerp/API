<?php

    function get_splash($data){

    $result = '{"next_page": {
                "page_code": "screen",
                "screenid": 0,
                "data_self": "",
                "data_heading": "",
                "data_url": "https://sarvodayahospital19.com/api/mobile/patient/home"
            }}';
      $result = json_decode($result,1);
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

    }
?>
