<?php

    function get_splash($data){
        global $dev_url;
    $result = '{"next_page": {
                "page_code": "screen",
                "screenid": 0,
                "data_self": "",
                "data_heading": "",
                "data_url": "'.$dev_url .'home"
            }}';
      $result = json_decode($result,1);
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

    }
?>
