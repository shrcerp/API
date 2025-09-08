<?php

      include 'encrypt.php';



      function send_data($code,$message,$result = array()){


            echo json_encode(array("code" => $code, "message" => $message, "result" => $result));
            exit();

      }

      function save_response_api(){
          global $post_data;
          $user_id = "0";
          $user_type = "0";
          if(isset($post_data["data_global"]) && isset($post_data["data_global"]["id"])){

                    $user_id = $post_data["data_global"]["id"];


                $user_type = "0";
          }
          if(!$user_type){
              $user_id = 0;
          }
          $link = $_GET["link"];
          $post_data_e = json_encode($_POST);
          $sql = "INSERT INTO `api_call`(`user_id`, `user_type`, `link`, `post_data`, `response_data`, `status`, `created_by`) VALUES (
                '$user_id'
                ,'$user_type'
                ,'$link'
                ,'$post_data_e'
                ,NULL
                ,'1'
                ,'1'
          )";
          cj_query($sql);

      }
      function send_data_all($result){

            echo json_encode($result);
            exit();
      }

      function check_key_post($key,$type){

            if(isset($_POST[$key])){
                  if($type == 1 && !$_POST[$key]){
                      send_data("102", $key." - Empty value Not allowed");
                  }
                  if($key == "data_global" || $key == "data_self"){
                      return decrypt_fun($_POST[$key]);
                  }
                  return $_POST[$key];
            }
            if($type == 1){
                send_data("102", $key." - key Not found");
            }

      }

      function save_notification($data){
          /*
              $data = array(
                  "app_type" => "1"
                  ,"user_id" => "1"
                  ,"title" => "Heading"
                  ,"body" => "Message"
                  ,"icon" => "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png"
                  ,"firebase_id" => ""
                  ,"next_page" => "{
                      "page_code": "home",
                      "save_data_global": "1",
                      "data_self": " ",
                      "data_heading": "Home",
                      "data_url": "https://sarvodayahospital.com/api/mobile/patient/home"
                  }"
            );
            save_notification($data );

          */
          $sql = "INSERT INTO `mobile_notification`( `app_type`, `user_id`, `title`, `body`, `icon`, `is_notifcation_send`, `firebase_id`, `next_page_json`,  `status`, `created_by`) VALUES (
              '".$data["app_type"]."'
              ,'".$data["user_id"]."'
              ,'".$data["title"]."'
              ,'".$data["body"]."'
              ,'".$data["icon"]."'
              ,'0'
              ,'".$data["firebase_id"]."'
              ,'".$data["next_page"]."'
              ,'1'
              ,'1'
          )";
          cj_query($sql);
          return true;



      }





?>
