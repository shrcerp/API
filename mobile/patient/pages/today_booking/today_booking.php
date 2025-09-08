<?php
    function add_tag(){

    }

    function today_booking_data($data){


      $data_self = $data["data_self"];
      $doctor_id = $data_self["doctor_id"];

        $data_self_e = encrypt_fun($data_self);
        $today_date = date("Y-m-d");
      global $con;
      $sql = "SELECT a.id,a.status,a.booking_from,a.booking_to,a.booking_date,b.patient_name,b.prefix,b.mobile
              ,a.check_in_time
              ,a.check_out_time
              ,a.in_consultation_time
              FROM `video_patient_transaction` a
              inner join video_patient b on b.id = a.patient_id
              where a.doctor_id = '$doctor_id' and booking_type = '2' and (a.status = '1' or a.status = '9') and a.booking_date = '$today_date'";
      $query = mysqli_query($con, $sql);
      $result = array();
      while ($row = mysqli_fetch_array($query)) {

        $first_letter = strtoupper($row["patient_name"][0]);
        $name = $row["prefix"]." ".$row["patient_name"];
        $chip = array();
        $element = array();
        $check_in_time = "";
        $check_out_time = "";
        $in_consultation_time = "";
        $booking_time = date("h:i a",strtotime($row["booking_from"]));
        if($row["status"] == "3"){
          $chip[] = array(
              "title" => "online"
              ,"color" =>"#406343"
          );
        }else if($row["status"] == "9"){
          $chip[] = array(
              "title" => "Call Center"
              ,"color" =>"#ff3478"
          );
        }

        if($row["check_in_time"]){
          $chip[] = array(
              "title" => "Checked In"
              ,"color" =>"#3D56B2"
          );
          $check_in_time = date("h:i a",strtotime($row["check_in_time"]));
        }else{
            $element[] = array(
              "id" => "1",
              "title" =>  "Checked In",
              "value" =>  false,
              "layout_code" =>  "1"
            );

        }


        if($row["in_consultation_time"]){
          $chip[] = array(
              "title" => "In Consultation"
              ,"color" =>"#FF7878"
          );
        }else {
          $element[] = array(
            "id" => "2",
            "title" =>  "In Consultation",
            "value" =>  false,
            "layout_code" =>  "1"
          );
        }

        if($row["check_out_time"]){
          $chip[] = array(
              "title" => "Checked Out"
              ,"color" =>"#ED50F1"
          );
        }else {
          /*
          $element[] = array(
            "id" => "3",
            "title" =>  "Checked Out",
            "value" =>  false,
            "layout_code" =>  "1"
          );
          */
        }

        $data_self_api = array(
            "video_patient_transaction_id" => $row["id"]
            ,"doctor_id" => $doctor_id
        );
        $data_self_api_e = encrypt_fun($data_self_api);



        $r = '{
                      "title": "'.$name.'",
                      "layout_code": "118",
                      "layout_des": "search_bar",
                      "text":"'.$row["mobile"].'",
                      "sub_text": "",
                      "image": "'.$first_letter.'",
                      "timestamp": "",
                      "sub_text1": "",
                      "sub_text2": "",
                      "chip": '.json_encode($chip).',
                      "time": [
                          {
                          "title":"'.$booking_time.'",
                          "color":"#ff3478"
                          },
                          {
                          "title":"Check In : '.$check_in_time.'",
                          "color":"#ff3478"
                          },
                          {
                          "title":"Wait Time : 0hr 33min",
                          "color":"#ff3478"
                          }
                      ],
                      "web_link": "",
                      "web_view": "0",
                      "click_action": "1",
                      "web_view_heading": "",
                      "page_code": "5020",
                      "next_page":  {
                          "page_code": "view_data",
                          "data_self": "'.$data_self_e.'",
                          "data_heading": "Booking",
                          "data_url": "https://sarvodayahospital.com/api/mobile/doctor/today_booking"
                      },
                      "is_popup":"1",
                      "api_url":"https://sarvodayahospital.com/api/mobile/doctor/checkBoxSubmit",
                      "api_data_self":"'.$data_self_api_e.'",
                      "elements": '.json_encode($element).'
                  }';

            $result[] = json_decode($r,1);

      }

      return array(
        "code" => "101"
        ,"message" => "Success"
        ,"result" => $result
      );



      $result = '[
                            {
                        "title": "Mrs. Neelu Sharma",
                        "layout_code": "118",
                        "layout_des": "search_bar",
                        "text":"9953669977",
                        "sub_text": "",
                        "image": "N",
                        "timestamp": "",
                        "sub_text1": "",
                        "sub_text2": "",
                        "chip": [
                            {
                            "title":"online",
                            "color":"#ff3478"
                            },
                            {
                            "title":"In Consultation",
                            "color":"#ee7f33"
                            }
                        ],
                        "time": [
                            {
                            "title":"10:57 AM",
                            "color":"#ff3478"
                            },
                            {
                            "title":"Check In : 10:57 AM",
                            "color":"#ff3478"
                            },
                            {
                            "title":"Wait Time : 0hr 33min",
                            "color":"#ff3478"
                            }
                        ],
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "1",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "next_page":  {
                            "page_code": "view_data",
                            "data_self": "1",
                            "data_heading": "Today Booking",
                            "data_url": "https://sarvodayahospital.com/api/mobile/doctor/today_booking"
                        },
                        "is_popup":"1",
                        "api_url":"https://sarvodayahospital.com/api/mobile/doctor/checkBoxSubmit",
                        "api_data_self":"1",
                        "elements": [
                            {
                                "id":"1",
                                "title": "Checked In",
                                "value": false,
                                "layout_code": "1"
                            },
                            {
                                "id":"1",
                                "title": "Checked Out",
                                "value": false,
                                "layout_code": "1"
                            }
                        ]
                    },{
                            "title": "Mrs. Neelu Sharma",
                            "layout_code": "118",
                            "layout_des": "search_bar",
                            "text":"9953669977",
                            "sub_text": "",
                            "image": "N",
                            "timestamp": "",
                            "sub_text1": "",
                            "sub_text2": "",
                            "chip": [
                                {
                                "title":"online",
                                "color":"#ff3478"
                                },
                                {
                                "title":"In Consultation",
                                "color":"#ff3478"
                                },
                                {
                                "title":"Checked In",
                                "color":"#ff3478"
                                },
                                {
                                "title":"Checked Out",
                                "color":"#ff3478"
                                }
                            ],
                            "time": [
                                {
                                "title":"10:57 AM",
                                "color":"#ff3478"
                                },
                                {
                                "title":"Check In : 10:57 AM",
                                "color":"#ff3478"
                                },
                                {
                                "title":"Wait Time : 0hr 33min",
                                "color":"#ff3478"
                                }
                            ],
                            "web_link": "",
                            "web_view": "0",
                            "click_action": "1",
                            "web_view_heading": "",
                            "page_code": "5020",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "",
                                "data_heading": "Dr. Natasha Mittal",
                                "data_url": "https://sarvodayahospital.com/doctorpage_mobile/31/?token=MG12NEp3bDFQUGlNQTE4bFJwQkg1aXZzQU5pdVd0S3h4c2hBUjVYYjlYS21OTytCd1dWK2xUcEZNQXJ5QmhtTXBsTGdrUGVscXJsUmh2MkNXQmVNSkNtSTB0YkxSU2FsQUZkcnhHY0xYMWwxWEJHZEliUzVub1BldWVEWk94SDc=&p=3"
                            },
                            "is_popup":"0",
                            "api_url":"https://sarvodayahospital.com/checkBoxSubmit",
                            "api_data_self":"1",
                            "elements": [
                                {
                                    "id":"1",
                                    "title": "Checked Box",
                                    "value": false,
                                    "layout_code": "1"
                                }
                            ]
                        }
        ]';

      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => json_decode($result)
      );

    }




?>
