<?php
    // echo $dev_url ;

    function get_home_data($data){
        global $dev_url;
        global $con;

        $mobile = $data["data_global"]["mobile"];
        $switch_selection = get_user_data($data["data_global"]["mobile"],$data["data_global"]["id"]);
        $get_tokens = get_tokens($data);

        $video_booking = get_video_booking_data($data["data_global"]["id"]);
        if($video_booking == ","){
            $video_booking = "";
        }
        $discharge = get_discharge_data($mobile);
        $patient_id = $data["data_global"]["id"];
        $new_layout = '';
        $reject_fun = get_reject_doc($patient_id);
        $r_fun = '';
        if(count($reject_fun[0]["elements"])){
            $r_fun = json_encode($reject_fun[0]).",";
        }
        $mobile_form = '';
        if($mobile == '99536699550'){
            $mobile_form = '  ,{
                    "title": "Sign In",
                    "sub_text": "",
                    "color":"#FFF0F7",
                    "image": "https://www.copperjam.com/admin/mobile_prototype/data/app/1663391371922.png",
                    "click_action": "1",
                    "next_page": {
                        "page_code": "form_page",
                        "data_self": "1",
                        "data_heading": "Sign In",
                        "data_url": "'.$dev_url.'form_a"
                    },
                    "elements": []
                },{
                    "title": "Time Out",
                    "sub_text": "",
                    "color":"#FFF0F7",
                    "image": "https://www.copperjam.com/admin/mobile_prototype/data/app/1663391371922.png",
                    "click_action": "1",
                    "next_page": {
                        "page_code": "form_page",
                        "data_self": "1",
                        "data_heading": "Time Out",
                        "data_url": "'.$dev_url.'form_time"
                    },
                    "elements": []
                },{
                        "title": "Sign Out",
                        "sub_text": "",
                        "color":"#FFF0F7",
                        "image": "https://www.copperjam.com/admin/mobile_prototype/data/app/1663391371922.png",
                        "click_action": "1",
                        "next_page": {
                            "page_code": "form_page",
                            "data_self": "1",
                            "data_heading": "Sign Out",
                            "data_url": "'.$dev_url.'form_sign"
                        },
                        "elements": []
                    }';
        }


        $date = date("Y-m-d");
        $sql = "SELECT * 
            FROM video_patient_banner 
            WHERE status = 1 ";

    $result_data_coupon = mysqli_query($con, $sql);
    $coupons_by_hospital = [
        "sarvodaya-hospital-greater-noida-west" => [],
        "sarvodaya-hospital-research-centre-sector-8" => []
    ];
    if ($result_data_coupon && mysqli_num_rows($result_data_coupon) > 0) {
        while ($row = mysqli_fetch_assoc($result_data_coupon)) {
            $hospital = $row['location'];
            $image = "https://sarvodayahospital19.com/admin/data/app/".$row['banner_image'];

            if ($hospital === "sarvodaya-hospital-greater-noida-west") {
                $coupons_by_hospital["sarvodaya-hospital-greater-noida-west"][] = $image;
            } elseif ($hospital === "sarvodaya-hospital-research-centre-sector-8") {
                $coupons_by_hospital["sarvodaya-hospital-research-centre-sector-8"][] = $image;
            } else {
                $coupons_by_hospital["sarvodaya-hospital-greater-noida-west"][] = $image;
                $coupons_by_hospital["sarvodaya-hospital-research-centre-sector-8"][] = $image;
            }
        }
    }




    // print_r(json_encode($all_coupons));
    // return;


    
        if($data["data_global"]["mobile"]){
          $video_booking = get_video_booking_data_new($data["data_global"]["id"]);
          if($video_booking == ","){
              $video_booking = "";
          }
          $payment_booking = payment_data_new($data["data_global"]["id"]);
          if($payment_booking == ","){
              $payment_booking = "";
          }

          $switch_selection = get_user_data_new($data["data_global"]["mobile"],$data["data_global"]["id"]);

          $data_record = array();
          $data_record["mrn"] = $data["data_global"]["mrn"];
          $data_record["patient_id"] = $data["data_global"]["id"];
          $data_record["patient_name"] = $data["data_global"]["name"];
          $data_record["mobile"] = $data["data_global"]["mobile"];
          $data_record = encrypt_fun($data_record);



          $result = '[

                    '.$switch_selection.',
                    '.$video_booking.'
                    '.$payment_booking.'
                    {
                        "title": "Our Offers",
                        "layout_code": "301",
                        "textcolor_code": "#000000",
                        "text_fontsize": "14",
                        "text_fontweight": "normal",
                        "sub_text": "",
                        "layout_des": "",
                        "image": "https://sarvodayahospital19.com/api/mobile/images/save20_2.png",
                        "timestamp": "10 Aug 2021",
                        "next_page": {},
                        "elements": 
                            '.json_encode($coupons_by_hospital).'
                        
                    },
                  
                    {
                        "title": "Book An Appointment",
                        "layout_code": "302",
                        "layout_des": "search_bar",
                        "sub_text": "",
                        "image": "https://d3ti1kcp1zfdnq.cloudfront.net/DR_AAYUSH_GUPTA_4e79c1943a.jpg",
                        "timestamp": "",
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "1",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "next_page": {
                        },
                        "elements": []
                    },
                    {
                      "title": "Document",
                      "layout_code": "303",
                      "layout_des": "button layout",
                      "sub_text": "",
                      "image": "",
                      "timestamp": "",
                      "click_action": "1",
                      "next_page": {},
                      "elements": [
                          {
                              "title": "My Report",
                              "sub_text": "",
                              "color": "#008fc5",

                              "image": "Reports",  

                              "click_action": "1",
                              "next_page": {
                                  "page_code": "view_data",
                                  "data_self": "'.$data_record.'",
                                  "data_heading": "My Reports",
                                  "data_url": "'.$dev_url.'my_reports"
                              },
                              "elements": []
                          },
                          {
                            "title": "Book Lab Test",
                            "sub_text": "",
                            "color": "#f58220",
                            "image": "LabTest",
                            "click_action": "1",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "1",
                                "data_heading": "My Booking",
                                "data_url": "'.$dev_url.'my_booking"
                            },
                            "elements": []
                        },
                        {
                            "title": "Pharmacy",
                            "sub_text": "",
                            "color": "#f58220",
                            "image": "Pharma",
                            "click_action": "1",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "1",
                                "data_heading": "My Prescription",
                                "data_url": "'.$dev_url.'my_prescription"
                            },
                            "elements": []
                        },
                        {
                            "title": "Health Check-up",
                            "sub_text": "",
                            "color": "#f58220",
                            "image": "Healthcheckup",
                            "click_action": "1",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "1",
                                "data_heading": "My Lab Report",
                                "data_url": "'.$dev_url.'my_labReport"
                            },
                            "elements": []
                        },
                        {
                            "title": "Diabitic Care",
                            "sub_text": "",
                            "color": "#f58220",
                            "image": "Diabitic",
                            "click_action": "1",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "1",
                                "data_heading": "My Discharge Summary",
                                "data_url": "'.$dev_url.'my_dischargeSummary"
                            },
                            "elements": []
                        },
                        {
                            "title": "Homecare",
                            "sub_text": "",
                            "color": "#f58220",
                            "image": "Homecare",
                            "click_action": "1",
                            "next_page": {
                                "page_code": "view_data",
                                "data_self": "1",
                                "data_heading": "My Discharge Summary",
                                "data_url": "'.$dev_url.'my_dischargeSummary"
                            },
                            "elements": []
                        }
                        
                        





                      ]
                    },
                   {
                        "title": "Health Insights",
                        "layout_code": "304",
                        "textcolor_code": "#000000",
                        "text_fontsize": "14",
                        "text_fontweight": "normal",
                        "sub_text": "Check how healthy people are around you",
                        "layout_des": "small card",
                        "image": "https://sarvodayahospital19.com/api/mobile/images/save20_2.png",
                        "timestamp": "10 Aug 2021",
                        "click_action": "1",
                        "next_page": {}
                    
                    },


                    {
                        "title": "Other Services",
                        "layout_code": "305",
                        "textcolor_code": "#000000",
                        "text_fontsize": "14",
                        "text_fontweight": "normal",
                        "sub_text": "",
                        "layout_des": "horizontal scroll",
                        "image": "",
                        "timestamp": "10 Aug 2021",
                        "next_page": {},
                        "elements": [
                            {
                                "title": "My Bills",
                                "sub_text": "",
                                "color": "#008fc5",
                                "image": "Bills",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            },
                            {
                                "title": "Medical Reports",
                                "sub_text": "",
                                "color": "#f58220",
                                "image": "Records",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                },
                                "elements": []
                            },
                            {
                                "title": "My Consent",
                                "sub_text": "",
                                "color": "#008fc5",
                                "image": "Myconcents",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            },
                            {
                                "title": "e-KYC",
                                "sub_text": "",
                                "color": "#f58220",
                                "image": "EKVYC",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                },
                                "elements": []
                            },
                            {
                                "title": "Attendant Pass",
                                "sub_text": "",
                                "color": "#f58220",
                                "image": "AttendantPass",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                },
                                "elements": []
                            }
                        ]
                    },
                    {
                        "title": "Upcoming Update",
                        "layout_code": "306",
                        "textcolor_code": "#000000",
                        "text_fontsize": "14",
                        "text_fontweight": "normal",
                        "sub_text": "",
                        "layout_des": "horizontal scroll big",
                        "image": "",
                        "timestamp": "10 Aug 2021",
                        "next_page": {},
                        "elements": [
                            {
                                "title": "",
                                "sub_text": "",
                                "color": "#008fc5",
                                "image": "",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            },
                            {
                                "title": "",
                                "sub_text": "",
                                "color": "#f58220",
                                "image": "",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                },
                                "elements": []
                            },
                            {
                                "title": "",
                                "sub_text": "",
                                "color": "#008fc5",
                                "image": "",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            },
                            {
                                "title": "",
                                "sub_text": "",
                                "color": "#f58220",
                                "image": "",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Booking",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_booking"
                                },
                                "elements": []
                            }
                        ]
                    },
                    {
                        "title": "Blogs",
                        "layout_code": "307",
                        "textcolor_code": "#000000",
                        "text_fontsize": "14",
                        "text_fontweight": "normal",
                        "sub_text": "",
                        "layout_des": "blog card",
                        "image": "",
                        "timestamp": "10 Aug 2021",
                        "next_page": {},
                        "elements": [
                            {
                                "title": "Dr. Dinesh Pendharkar",
                                "sub_title": "Cancer Care",
                                "body": "Beating Cancer with Modern Medicine: Latest Therapies, Timely Detection and Real Hope",
                                "sub_text": "Read More",
                                "color": "#008fc5",
                                "image": "blog_image",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            },
                            {
                                "title": "Dr. Dinesh Pendharkar",
                                "sub_title": "Cancer Care",
                                "body": "Beating Cancer with Modern Medicine: Latest Therapies, Timely Detection and Real Hope",
                                "sub_text": "Read More",
                                "color": "#008fc5",
                                "image": "blog_image",
                                "click_action": "1",
                                "next_page": {
                                    "page_code": "view_data",
                                    "data_self": "1",
                                    "data_heading": "My Reports",
                                    "data_url": "https://sarvodayahospital19.com/api/mobile/patient/my_reports"
                                },
                                "elements": []
                            }
                        ]
                    }

       
  '.$get_tokens.' 



                 
              ]';



        }

       
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => json_decode($result)
      );

    }

    function get_user_booking($id){
      $today_date = date("Y-m-d");
      $sql = "select
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.reference_id
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,c.complaint
            ,c.experiencing_since
            ,c.past_history
            ,c.sugar
            ,c.bp
            ,c.body_temperature
            ,c.spo
            ,d.name as doc_name
            ,d.profile
            ,d.designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            left join video_calling_booking_extra c on c.booking_id = a.id
            inner join sh_doctor_dev d on d.id = a.doctor_id
            where a.patient_id = '$patient_id' and a.status = '3' and a.booking_type = '1' and booking_date >= '$today_date' ORDER BY a.id  DESC";



    }

    function get_discharge_data($mobile){

      if($mobile != '9953669955'){
          //return '';
      }
      return '';
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.sarvodayahospital.com/App_api/get_discharge_info',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "facilityGUID" : "3e77361c-d482-4816-afbb-5b87576da352"
      ,"mobile" : "'.$mobile.'"
      }',
      CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Cookie: ci_session=v280bq1f78vqnn2c98r2clf80jepl5si'
      ),
      ));

      $response = curl_exec($curl);
      $d = json_decode($response,1);
      if(count($d['result'])){
        $row = $d['result'];
        $r = '{
                "image": "https://sarvodayahospital19.com//api/mobile/images/male_icon.png",
                "title": "Patient Discharge",
                "sub_text": "Patient Name - '.$row['name'].', IP - '.$row['ipd'].'",
                "sub_text_1": "",
                "click_action": "1",
                "timestamp": "",
                "next_page": {
                    "page_code": "web_view",
                    "data_self": "",
                    "data_heading": "'.$row['name'].'",
                    "data_url": "'.$row['link'].'"
                }
            }';
            $result = '{
                              "title": "",
                              "layout_code": "73",
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
                                  '.$r.'
                      ]
                    },';
            return $result;
      }
      return '';

    }

    function get_video_booking_data($patient_id){


      $today_date = date("Y-m-d");
      $sql = "select
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.reference_id
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,c.complaint
            ,c.experiencing_since
            ,c.past_history
            ,c.sugar
            ,c.bp
            ,c.body_temperature
            ,c.spo
            ,d.DoctorName as doc_name
            ,d.doctor_photo as profile
            ,d.CurrentDesignation as designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            left join video_calling_booking_extra c on c.booking_id = a.id
            inner join gw_doctor_info d on d.id = a.doctor_id
            where a.patient_id = '$patient_id' and a.status = '3' and a.booking_type = '2' and booking_date >= '$today_date' ORDER BY a.id  DESC";

        $query = cj_query($sql);
        $p = '';

        while($row = cj_fetch_array($query)){
          $is_video_start = "Not Started";
          if($row["is_video_start"] == "1"){
              $is_video_start = "In Progress";
          }else if($row["is_video_start"] == "2"){
              $is_video_start = "Call Complete";
          }

          $r = '{
                  "image": "'.$row["profile"].'",
                  "title": "Doctor Consultation",
                  "sub_text": "Booking Date : '.date("d M Y",strtotime($row["booking_date"])).' \nBooking Time : '.$row["booking_from"].' \nDoctor Name : '.$row["doc_name"].'",
                  "sub_text_1": "",
                  "click_action": "1",
                  "timestamp": "",
                  "next_page": {
                      "page_code": "web_video",
                      "data_self": "",
                      "data_heading": "Waiting Area",
                      "data_url": "https://sarvodayahospital19.com/video/patient_mobile.php?tid='.$row["id"].'"
                  }
              }';
            if($p){
                  $p = $p.",".$r;
            }else{

              $p = $r;
            }


        }

        $result = '';
            if($p){
              $result = '{
                                "title": "",
                                "layout_code": "73",
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
                                    '.$p.'
                        ]
                      },';
            }
        return $result;

    }

    function get_video_booking_data_new($patient_id){


      $today_date = date("Y-m-d");
      $sql = "select
      a.loc,
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.appointmentTokenNumber
            ,a.reference_id
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,c.complaint
            ,c.experiencing_since
            ,c.past_history
            ,c.sugar
            ,c.bp
            ,c.body_temperature
            ,c.spo
            ,d.DoctorName as doc_name
            ,d.gw_id
            ,d.doctor_photo as profile
            ,d.mednet_DepartmentName
            ,d.CurrentDesignation as designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            left join video_calling_booking_extra c on c.booking_id = a.id
            inner join gw_doctor_info d on d.gw_id = a.doctor_id
            where a.patient_id = '$patient_id' and a.status = '3'  and booking_date >= '$today_date' ORDER BY a.id  DESC";

        $query = cj_query($sql);
        $p = '';

        while($row = cj_fetch_array($query)){

          $value_amount = 'Paid Amount : '.$row["amount"].' Rs';
          $data_url = "https://sarvodayahospital19.com/admin/N/R?token=".base64_encode($row["id"]);

          $r = '{
                    "title": "'.ucwords(strtolower($row["doc_name"])).'",
                    "layout_code": "308",
                    "layout_des": "booking_card",
                    "sub_text": "'.date("d M Y",strtotime($row["booking_date"])).' - '.date("h:i a",strtotime($row["booking_from"])).'\n'.$value_amount.'",
                    "image": "'.$row["profile"].'",
                    "timestamp": "",
                    "hospital_loc"     => $row['loc'] == 'sarvodaya-hospital-greater-noida-west' ? "Sarvodaya Hospital Greater Noida West" : "Sarvodaya Hospital, Sector 8, Faridabad",
                    "appointment_token":"OPD Token No. : '.$row["appointmentTokenNumber"].'",
                    "sub_text1":"'.html_entity_decode($row["mednet_DepartmentName"]).'",
                    "is_online":"0",
                    "is_physical":"1",
                    "rating":"",
                    "review":"",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "1",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "pdf_view",
                        "data_self": "",
                        "data_heading": "'.$row["patient_name"].'",
                        "data_url": "'.$data_url.'"
                    },
                    "elements": []
                },';
            $p .= $r;


        }

        return $p;

    }

    function payment_data_new($patient_id){


      $today_date = date("Y-m-d");
      $sql = "select
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.appointmentTokenNumber
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.reference_id
            ,a.original_price
            ,a.discount_coupon_pre
            ,a.original_price
            ,a.discount_coupon_amount
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,a.patient_id
            ,b.mobile

            ,d.DoctorName as doc_name
            ,d.gw_id
            ,d.doctor_photo as profile
            ,d.mednet_DepartmentName
            ,d.CurrentDesignation as designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            inner join gw_doctor_info d on d.gw_id = a.doctor_id
            where a.patient_id = '$patient_id' and a.status = '1' and a.crm_id is not null  and booking_date >= '$today_date' ORDER BY a.id  DESC";

        $query = cj_query($sql);
        $p = '';

        while($row = cj_fetch_array($query)){

          $value_amount = 'Pay : '.$row["amount"].' Rs';
          $d_booking = "";
          if($row["discount_coupon_amount"]){
                  $d_booking = "<br>Fees :<span style='color:green;font-weight:bold; font-size:13px'> ".$row["amount"]." Rs</span>";
                  $d_booking .= "<span style='text-decoration:line-through; color:#757575;font-size:11px;margin-left:4px'> ".$row["original_price"]." Rs</span>";

          }
            $data_self = array();
            $data_self["booking_id"] = $row["id"];
            $data_self["mrn_no"] = $row["mrn_no"];
            $data_self["type"] = $row["booking_type"];
            $data_self["video_calling_price"] = $row["amount"];
            $data_self["patient_id"] = $row["patient_id"];
            $data_self["patient_name"] = $row["patient_name"];
            $data_self["mobile"] = $row["mobile"];
            $data_self = encrypt_fun($data_self);

          $data_url = "https://sarvodayahospital19.com/paymentgatway_physical/gpl_n.php?token=".$data_self;
          $r = '{
                    "title": "'.ucwords(strtolower($row["doc_name"])).'",
                    "layout_code": "220",
                    "layout_des": "search_bar",
                    "sub_text": "'.date("d M Y",strtotime($row["booking_date"])).' - '.date("h:i a",strtotime($row["booking_from"])).'<br>'.html_entity_decode($row["mednet_DepartmentName"]).''.$d_booking.'",
                    "image": "'.$row["profile"].'",
                    "timestamp": "",
                    "booking_date":"'.$row['booking_date'].'",
                    "sub_text1":"'.$value_amount.'",
                    "is_online":"0",
                    "is_physical":"1",
                    "rating":"",
                    "review":"",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "1",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "web_view",
                        "data_self": "'.$data_self.'",
                        "data_heading": "'.$row["patient_name"].'",
                        "data_url": "'.$data_url.'"
                    },
                    "elements": []
                },';
            $p .= $r;


        }

        return $p;

    }

    function get_video_booking_data1($patient_id){


      $today_date = date("Y-m-d");
      $sql = "select
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.reference_id
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,c.complaint
            ,c.experiencing_since
            ,c.past_history
            ,c.sugar
            ,c.bp
            ,c.body_temperature
            ,c.spo
            ,d.name as doc_name
            ,d.designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            left join video_calling_booking_extra c on c.booking_id = a.id
            inner join sh_doctor_dev d on d.id = a.doctor_id
            where a.patient_id = '$patient_id' and a.status = '3' and a.booking_type = '1' and booking_date >= '$today_date' ORDER BY a.id  DESC";


        $result = '';
        $query = cj_query($sql);

        while($row = cj_fetch_array($query)){
          $r = '{
                      "title": "'.$row["patient_name"].'",
                      "layout_code": "104",
                      "layout_des": "heading",
                      "sub_text": "",
                      "image": "http://app.housepital.in/admin_new/data/app/1623385727494.png",
                      "timestamp": "",
                      "web_link": "https://sarvodayahospital19.com/video/patient_profile.php?tid=564",
                      "web_view": "0",
                      "click_action": "1",
                      "web_view_heading": "Waiting Area",
                      "page_code": "5020",
                      "next_page": {
                          "page_code": "web_view",
                          "data_self": " ",
                          "data_heading": "Waiting Area",
                          "data_url": "https://sarvodayahospital19.com/video/patient_profile.php?tid=564"
                      },
                      "elements": [
                          [{
                              "layout_code": "104-1",
                              "title": "Booking Date",
                              "icon":"calendar",
                              "sub_text": "'.date("d M Y",strtotime($row["booking_date"])).'",
                              "sub_text_2": "'.$row["booking_from"].'",
                              "next_page":[]
                          },
                          {
                              "layout_code": "104-1",
                              "title": "Doctor",
                              "icon":"vaccine",
                              "sub_text": "'.$row["doc_name"].'",
                              "sub_text_2": "",
                              "next_page":[]
                          }],
                          [
                                {
                                  "layout_code": "104-1",
                                  "title": "Booking Type",
                                  "icon":"location_on_outlined",
                                  "sub_text": "Online Doctor Consultation",
                                  "sub_text_2": "",
                                  "next_page":[]
                              },{
                                  "layout_code": "104-1",
                                  "title": "Amount Paid",
                                  "icon":"attach_money_outlined",
                                  "sub_text": "Rs '.$row["amount"].'",
                                  "sub_text_2": "",
                                  "next_page":[]
                              }
                        ]
                      ]
                  },';

            $result .= $r;

        }

        return $result;

    }
    function get_user_data($mobile,$selected_id){
        global $con;
        global $dev_url;
        $sql = "SELECT * FROM `video_patient` where mobile = '$mobile'";
        $query = cj_query($sql);
        $result = ' {
            "title": "",
            "layout_code": "300",
            "text":"",
            "sub_text": "",
            "layout_des": "top_header",
            "image": "logo.png",
            "timestamp": "10 Aug 2021",
            "web_link": "",
            "web_view": "0",
            "click_action": "1",
            "web_view_heading": "",
            "page_code": "5020",
            "next_page": {},
            "button_list" : {
                "whatsapp" : "918860611481",
                "phone" : "918860611481",
                "notification" : "1"
            },
            "stack_children" : [
               {
                    "title": "Hi",
                    "layout_code": "103",
                    "layout_des": "dropdown",
                    "sub_text": "",
                    "image": "https://sarvodayahospital19.com//api/mobile/images/male_icon.png",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "member_id": "0",
                    "next_page": {
                        "page_code": "form_page",
                        "data_self": "'.$mobile.'",
                        "data_heading": "New Registration",
                        "data_url": "'.$dev_url.'patient_registration_form"
                    },
                    "value": "0",
                    "elements": []
                }
            ],
    }   
            
            
            
            ';

        $result = json_decode($result,1);

        $i = 0;
        $select_value = 0;
        $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png";
        while($row = cj_fetch_array($query)){
            $data_global_e = array(
                  "mobile" => $row["mobile"]
                  ,"mrn" => $row["mrn_no"]
                  ,"id" => $row["id"]
                  ,"name" => $row["patient_name"]
                  ,"prefix" => $row["prefix"]
            );
            $data_global_e = encrypt_fun($data_global_e);
            if($selected_id == $row["id"]){
                $select_value = $i;
                if($row["gender"] == "M"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/male_icon.png";
                }else if($row["gender"] == "F"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/female_icon.png";
                }
            }
            $result['stack_children'][0]["elements"][] = array(
                $i
                ,ucwords(strtolower($row["patient_name"]))
                ,$avatar_icon
                  ,$data_global_e
            );
            $i++;
        }
        $result['stack_children'][0]["image"] = $avatar_icon;

        $result['stack_children'][0]["elements"][] = array(
            $i
              ,"New"
              ,"new"
            ,"UGwrMUt1VkkxdmtHT0wrQUNJSkxDWWVRRTNJd1dSSWdYajVscVpCK0VjSnFSRFkrZ21GQWZkOFFMMUtQdzkxZGZqNnJ2cC9mWm0vSXBzdTRHRFJwTVF2SC9QRHp4NTI3QUp1R1BScjNNS253N1ludUJQWXBmVUtPTHJ6NGtvL1B6RVk1dFhqV0JHYlZvcmtxNUtzZ2JYbzJzeFZuMXJ3RDUzYzdTTloxc01XS3NCeGdYMkdtdmxZTXVyRHpFaTBJT0JOaG1LNGU1bXBiK0dkK1o4dGY3c1daaEF4ZkZIMnhkeUo0b2hCS0oxUm1qaVpKS1IrRW94aVFSRy9KbS9UTmpoWUc2L05xZlUvRk5zTVY1TG04Q3YwS0hNVUE2UTE2ZXdSVFgxRUF6UjdsSWNmZVB4WnZKYnpzMGRKV25JK01IQTlOb0NnQnhLYVR2cEpFRnF3c2Z1VmFqV2ltMlljb1cxZXZ5SGl2SS8zNU53Qk5TMVY3YVE5QlJWSnRJdmdlL1JSQlNBeWR0eUk3K2NIWDFvVkc3T2MvUEE5Wk45dnJxUFpzaFFGa1RzUmYrOVIycTNJTGNDRDJrZ0t3UzI1a3Y1Q0t3SHRvWERWL0pwSFZ0QkFabGt5SlZpYWw5dlNvdjMwZzk3UWJ0a1VoQVFBUUdZTGpnb0lhMGQ1OE9GZjh0U0dyOU96bWFFR1Q4RXVobEhZSGVnPT0="

        );

        $result['stack_children'][0]["value"] =   (string)$select_value;

        return json_encode($result);
    }

    function get_user_data_new($mobile,$selected_id){
        global $dev_url;
      /*

      {
          "title": "Our Medical Experts are here for you.",
          "subtitle": "",
          "layout_code": "214",
          "layout_des": "text",
          "font_size" : "16",
          "font_weight" : "400"
      },
      {
          "title": "Get quality medical care and treatment with us",
          "subtitle": "treatment with us.",
          "layout_code": "214",
          "layout_des": "text",
          "font_size" : "20",
          "font_weight" : "700"
      },
      {
          "title": "Find the required doctor and schedule your appointment now.",
          "subtitle": "appointment now.",
          "layout_code": "214",
          "layout_des": "text",
          "font_size" : "13",
          "font_weight" : "400"
      },

      */
        global $con;
        $sql = "SELECT * FROM `video_patient` where mobile = '$mobile'";
        $query = cj_query($sql);
        $result = '{
            "title": "",
            "layout_code": "300",
            "text":"",
            "sub_text": "",
            "layout_des": "top_header",
            "image": "logo.png",
            "timestamp": "10 Aug 2021",
            "web_link": "",
            "web_view": "0",
            "click_action": "1",
            "web_view_heading": "",
            "page_code": "5020",
            "next_page": {},
            "button_list" : {
                "whatsapp" : "918860611481",
                "phone" : "918860611481",
                "notification" : "1"
            },
            "stack_children" : [
               {
                    "title": "Hi",
                    "layout_code": "103",
                    "layout_des": "dropdown",
                    "sub_text": "",
                    "image": "https://sarvodayahospital19.com//api/mobile/images/male_icon.png",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "form_page",
                        "data_self": "9953669955",
                        "data_heading": "New Registration",
                        "data_url": "'.$dev_url.'patient_registration_form"
                    },
                    "elements": [],
                    "value": "0"
                }
            ]
        }';

        $result = json_decode($result,1);

        $i = 0;
        $select_value = 0;
        $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png";
        while($row = cj_fetch_array($query)){
            $data_global_e = array(
                  "mobile" => $row["mobile"]
                  ,"mrn" => $row["mrn_no"]
                  ,"id" => $row["id"]
                  ,"user_type" => "1"
                  ,"name" => $row["patient_name"]
                  ,"prefix" => $row["prefix"]
            );
            $data_global_e = encrypt_fun($data_global_e);
            if($selected_id == $row["id"]){

                $select_value = $i;
                if($row["gender"] == "M"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/male_icon.png";
                }else if($row["gender"] == "F"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/female_icon.png";
                }
            }else{
              $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png";
            }
            $result["stack_children"][0]["elements"][] = array(
                $i
                ,ucwords(strtolower($row["patient_name"]))
                ,$avatar_icon
                  ,$data_global_e
            );
            $i++;
        }
        $result["stack_children"][0]["image"] = $avatar_icon;

        $result["stack_children"][0]["elements"][] = array(
            $i
              ,"New"
              ,"new"
            ,"UGwrMUt1VkkxdmtHT0wrQUNJSkxDWWVRRTNJd1dSSWdYajVscVpCK0VjSnFSRFkrZ21GQWZkOFFMMUtQdzkxZGZqNnJ2cC9mWm0vSXBzdTRHRFJwTVF2SC9QRHp4NTI3QUp1R1BScjNNS253N1ludUJQWXBmVUtPTHJ6NGtvL1B6RVk1dFhqV0JHYlZvcmtxNUtzZ2JYbzJzeFZuMXJ3RDUzYzdTTloxc01XS3NCeGdYMkdtdmxZTXVyRHpFaTBJT0JOaG1LNGU1bXBiK0dkK1o4dGY3c1daaEF4ZkZIMnhkeUo0b2hCS0oxUm1qaVpKS1IrRW94aVFSRy9KbS9UTmpoWUc2L05xZlUvRk5zTVY1TG04Q3YwS0hNVUE2UTE2ZXdSVFgxRUF6UjdsSWNmZVB4WnZKYnpzMGRKV25JK01IQTlOb0NnQnhLYVR2cEpFRnF3c2Z1VmFqV2ltMlljb1cxZXZ5SGl2SS8zNU53Qk5TMVY3YVE5QlJWSnRJdmdlL1JSQlNBeWR0eUk3K2NIWDFvVkc3T2MvUEE5Wk45dnJxUFpzaFFGa1RzUmYrOVIycTNJTGNDRDJrZ0t3UzI1a3Y1Q0t3SHRvWERWL0pwSFZ0QkFabGt5SlZpYWw5dlNvdjMwZzk3UWJ0a1VoQVFBUUdZTGpnb0lhMGQ1OE9GZjh0U0dyOU96bWFFR1Q4RXVobEhZSGVnPT0="

        );

        $result["stack_children"][0]["value"] =   (string)$select_value;
        // $result["stack_children"][0]["member_id"] =   (string)$select_value;

      //  $result["value"] =   (string)$select_value;
      //  $result["member_id"] =   (string)$select_value;


        return json_encode($result);
    }

    function get_reject_doc($patient_id){

      $sql = "select a.m_document_id,a.id,a.reject_reason,a.status,a.value,b.document_name,b.document_type,a.is_confirm from m_patient_document a
              inner join m_document b on b.id = a.m_document_id
              where a.video_patient_id = '$patient_id' and document_type = '1' and a.status = '3'";
      $query = cj_query($sql);
      $result =
      '[
            {
                "title": "",
                "layout_code": "73",
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
      while($row = cj_fetch_array($query)){
            if($row["document_type"] == "1"){
                $row["value"] = "https://sarvodayahospital19.com/admin/data/app/".$row["value"];
            }

            $is_confirm = "Pending for Approval";
            if($row["is_confirm"] == "1"){
                $is_confirm = "Approved";
            }

            $ext = pathinfo($row["value"], PATHINFO_EXTENSION);

            if($row["status"] == "3"){
                $is_confirm = "Rejected - ".$row["reject_reason"];
                $data_self_e = array(
                      "m_document_id" => $row["m_document_id"]
                      ,"id" => $row["id"]

                );
                $data_self_e = encrypt_fun($data_self_e);
                $next_page = array(
                  "page_code" => "form_page",
                  "data_self" => $data_self_e,
                  "data_heading" => "Upload  - ".$row["document_name"],
                  "data_url" => $_SESSION['link']."reject_document_form"
                );
                $click_action = "1";
            }else if($ext == "png" || $ext == "jpeg" || $ext == "jpg"){
                $next_page = array(
                  "page_code" => "web_view",
                  "data_self"=> "",
                  "data_heading"=> $row["document_name"],
                  "data_url"=> "https://sarvodayahospital19.com/api/web_view.php?token=".$row["value"]
                );
                $click_action = "1";
            }else{
                $next_page = array(
                  "page_code" => "pdf_view",
                  "data_self" => "",
                  "data_heading" => $row["document_name"],
                  "data_url" => $row["value"]
                );
                $click_action = "2";

            }

           $r= '{
                "image": "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                "title": "'.$row["document_name"].'",
                "sub_text": "'.$is_confirm.'",
                "sub_text_1": "",
                "click_action": "'.$click_action.'",
                "timestamp": "",
                "next_page": '.json_encode($next_page).'
            }';
            $r = json_decode($r,1);
            $result[0]["elements"][] = $r;
      }
      return $result;

    }

      function check_for_admission($patient_id){

      $sql = "select * from video_patient where id = '$patient_id' and is_addmission = '1'";
      $query = cj_query($sql);
      $result = '[
                    {
                        "title": "",
                        "layout_code": "73",
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

                ]
              }
            ]';
      $result = json_decode($result,1);
      while($row = cj_fetch_array($query)){

      }



    }



    function get_tokens($data){
        $mrn = $data['data_global']['mrn'];
        $mrn_sql = "";
        if (!empty($data['data_self']['location'])) {
            $location = $data["data_self"]["location"];
            if ($location == 'sarvodaya-hospital-greater-noida-west') {
                $mrn_sql = "AND b.mrn_nodia = '$mrn'";
            } else {
                $mrn_sql = "AND b.mrn_no = '$mrn'";
            }
        } else {
            $mrn_sql = "AND (
                (b.mrn_no IS NOT NULL AND b.mrn_no != '' AND TRIM(b.mrn_no) = '$mrn')
                OR
                ((b.mrn_no IS NULL OR b.mrn_no = '') AND TRIM(b.mrn_nodia) = '$mrn')
            )";
        }

        $today_date = date("Y-m-d");
    
        $sql = "SELECT a.booking_from, a.booking_to, a.booking_type, a.is_video_start, a.booking_date,a.amount, a.interest, a.id, a.status, a.created_on, a.appointmentTokenNumber, a.reference_id, b.prefix, b.patient_name, b.mrn_no, b.gender, b.dob, b.address, c.complaint, c.experiencing_since, c.past_history, c.sugar, c.bp, c.body_temperature, c.spo, d.DoctorName AS doc_name, d.gw_id, d.doctor_photo AS profile, d.mednet_DepartmentName, d.CurrentDesignation AS designation FROM video_patient_transaction a INNER JOIN video_patient b ON b.id = a.patient_id LEFT JOIN video_calling_booking_extra c ON c.booking_id = a.id INNER JOIN gw_doctor_info d ON d.gw_id = a.doctor_id WHERE a.status = '3' $mrn_sql AND a.booking_date >= '$today_date' ORDER BY a.id DESC";

        $query = cj_query($sql);
        if (!$query || mysqli_num_rows($query) == 0) {
            return "";
        }

        

        $token_json = [];
        while ($row = cj_fetch_array($query)) {
         

     
        
            $value_amount = 'Paid Amount : '.$row["amount"].' Rs';
            $data_url = "https://sarvodayahospital19.com/admin/N/R?token=" . base64_encode($row["id"]);
            

            $token_json[] = [
                "title" => ucwords(strtolower($row["doc_name"])),
                "layout_code" => "308",
                "appointment_time" => date("h:i a",strtotime($row["booking_from"])),
                "appointment_date" => date("d M Y",strtotime($row["booking_date"])),
                "hospital_loc"     => $row['loc'] == 'sarvodaya-hospital-greater-noida-west' ? "Sarvodaya Hospital Greater Noida West" : "Sarvodaya Hospital, Sector 8, Faridabad",
                "appointment_loc" => $row['doctor_room'],
                "appointment_token" => $row['appointmentTokenNumber'],
                "doctor" => $row['doc_name'],
                "nursing_loc" => $row['nursing_station'],
                "nursing_token" => $row['nursingtoken'],
                "radiology_loc" => "",
                "radiology_token" => "",
                "lab_loc" => "",
                "lab_token" => "",
                "paid_amount" => $row["amount"],
                "layout_des" => "search_bar",
                "sub_text" => "",
                "image" => $row["profile"],
                "timestamp" => "",
                "sub_text1" => html_entity_decode($row["mednet_DepartmentName"]),
                "is_online" => "0",
                "is_physical" => "1",
                "rating" => "",
                "review" => "",
                "web_link" => "",
                "web_view" => "0",
                "click_action" => "1",
                "web_view_heading" => "",
                "page_code" => "5020",
                "next_page" => [
                    "page_code" => "web_view",
                    "data_self" => "",
                    "data_heading" => $row["patient_name"],
                    "data_url" => $data_url
                ],
                "elements" => []
            ];
        }

    
        

            return ',' . json_encode($token_json);
    }

    // function get_tokens($data) {
    //     $mrn = $data['data_global']['mrn'];
    //     $mrn_sql = "";

    //     if (!empty($data['data_self']['location'])) {
    //         $location = $data["data_self"]["location"];
    //         if ($location == 'sarvodaya-hospital-greater-noida-west') {
    //             $mrn_sql = "AND b.mrn_nodia = '$mrn'";
    //         } else {
    //             $mrn_sql = "AND b.mrn_no = '$mrn'";
    //         }
    //     } else {
    //         $mrn_sql = "AND (
    //             (b.mrn_no IS NOT NULL AND b.mrn_no != '' AND TRIM(b.mrn_no) = '$mrn')
    //             OR
    //             ((b.mrn_no IS NULL OR b.mrn_no = '') AND TRIM(b.mrn_nodia) = '$mrn')
    //         )";
    //     }

    //     $today_date = date("Y-m-d");

    //     $sql = "SELECT a.booking_from, a.booking_to, a.booking_type, a.is_video_start, a.booking_date,
    //                 a.amount, a.interest, a.id, a.status, a.created_on, a.appointmentTokenNumber,
    //                 a.reference_id, b.prefix, b.patient_name, b.mrn_no, b.gender, b.dob, b.address,
    //                 c.complaint, c.experiencing_since, c.past_history, c.sugar, c.bp, c.body_temperature,
    //                 c.spo, d.DoctorName AS doc_name, d.gw_id, d.doctor_photo AS profile,
    //                 d.mednet_DepartmentName, d.CurrentDesignation AS designation
    //             FROM video_patient_transaction a
    //             INNER JOIN video_patient b ON b.id = a.patient_id
    //             LEFT JOIN video_calling_booking_extra c ON c.booking_id = a.id
    //             INNER JOIN gw_doctor_info d ON d.gw_id = a.doctor_id
    //             WHERE a.status = '3' $mrn_sql AND a.booking_date >= '$today_date'
    //             ORDER BY a.id DESC";

    //     $query = cj_query($sql);

    //     if (!$query || mysqli_num_rows($query) == 0) {
    //         return ""; // nothing to add
    //     }

    //     $token_json = [];
    //     while ($row = cj_fetch_array($query)) {
    //         $data_url = "https://sarvodayahospital19.com/admin/N/R?token=" . base64_encode($row["id"]);

    //         $token_json[] = [
    //             "title" => ucwords(strtolower($row["doc_name"])),
    //             "layout_code" => 308,
    //             "appointment_time" => date("h:i a", strtotime($row["booking_from"])),
    //             "appointment_date" => date("d M Y", strtotime($row["booking_date"])),
    //             "appointment_token" => $row['appointmentTokenNumber'],
    //             "doctor" => $row['doc_name'],
    //             "nursing_token" => "",
    //             "lab_token" => "",
    //             "radiology_token" => "",
    //             "paid_amount" => $row["amount"],
    //             "layout_des" => "search_bar",
    //             "sub_text" => "",
    //             "image" => $row["profile"],
    //             "timestamp" => "",
    //             "sub_text1" => html_entity_decode($row["mednet_DepartmentName"]),
    //             "is_online" => "0",
    //             "is_physical" => "1",
    //             "rating" => "",
    //             "review" => "",
    //             "web_link" => "",
    //             "web_view" => "0",
    //             "click_action" => "1",
    //             "web_view_heading" => "",
    //             "page_code" => "5020",
    //             "next_page" => [
    //                 "page_code" => "web_view",
    //                 "data_self" => "",
    //                 "data_heading" => $row["patient_name"],
    //                 "data_url" => $data_url
    //             ],
    //             "elements" => []
    //         ];
    //     }

    //     $result = [
    //         "token_details" => $token_json
    //     ];

    //     return ',' . json_encode($result); 
    // }

  

  
?>
