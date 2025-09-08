<?php

      function login_get_data(){

            $a = '{
                "id": "1",
                "app_name": "sarvodaya",
                "android_version": "2.0.1",
                "android_recommendUpdate": "1",
                "android_forceUpdate": "1",
                "ios_version": "2.0.1",
                "ios_recommendUpdate": "1",
                "ios_forceUpdate": "1",
                "android_paystore": "https://play.google.com/store/apps/details?id=hospital.healthcare.app",
                "ios_appstore": "https://apps.apple.com/us/app/sarvodaya-healthcare/id1598708931",
                "status": "1",
                "created_by": "583",
                "created_on": "2021-05-24 20:54:25",
                "updated_by": "583",
                "updated_on": null
            }';
            $a = json_decode( $a, 1 );
            //echo json_encode($a);

            return array(
                "code" => "101"
                ,"message" => "Success"
                ,"result" => $a
            );
      }





?>
