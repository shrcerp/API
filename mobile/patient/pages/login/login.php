<?php

      function login_get_data($data){
            $mobile_number = $data["mobile"];
            $otp = mt_rand(1000,9999);
            $mobile_number = clear_mobile($mobile_number);
            $message = "$otp is your One Time Password to login into your Sarvodaya Healthcare account. Please do not share your OTP with anyone. Thank You";
            $message = urlencode($message);
            // $url = "https://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=sarvodayahbiz&Password=mfmy5236MF&SenderID=SRVDYA&EntityID=1701158056165732117&Phno=$mobile_number&TemplateID=1507166866175416818&Msg=$message";
            // //$url = "http://nimbusit.co.in/api/swsend.asp?username=t1sarvodayahospitalapi&password=Rabrakha2023&sender=SRVDYA&sendto=$mobile_number&templateID=1207161918227640061&message=".$message;
            // $ch = curl_init($url);

            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            // curl_close($ch);
            insert_otp($mobile_number,$otp);
            $a = array(
                "mobile" => $mobile_number

                ,"otp" => $otp
            );
            //echo json_encode($a);

            return array(
                "code" => "101"
                ,"message" => "OTP is send to your number"
                ,"result" => $a
            );
      }

      function clear_mobile($mobile){
         $mobile = preg_replace('/\s+/', '', $mobile);
         $mobile = str_replace('-', '', $mobile);
         $mobile = ltrim($mobile, '0');
         return $mobile;
      }

      function insert_otp($mobile_number,$otp){

          $time = date("Y-m-d H:i:s");
          $sql = "INSERT INTO
                  `video_otp_check`(mobile_number, `otp`, created_on)
                  VALUES ('".$mobile_number."','".$otp."' , '".$time."'  )";
          $query = cj_query($sql);
      }



?>
