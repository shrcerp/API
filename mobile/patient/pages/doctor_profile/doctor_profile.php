<?php

    function get_doctor_data($data){
      global $con;
     
      $data_global = $data["data_global"];

        $doctor_id = $data['doctor_id'];
        $sql="select * from gw_doctor_info where gw_id=".$doctor_id ;
        $result_data = mysqli_query($con, $sql);
     
        $row = mysqli_fetch_assoc($result_data);
        $loc= $row['hospitals'];
        $doctor = [
            "doc_image"       => $row['doctor_photo'],
            "doc_name"        => $row['DoctorName'],
            "doc_designation" => $row['CurrentDesignation'],
            "doc_mednet_dept" => $row['mednet_DepartmentName'],
            "doc_mednet_id"   => $row['mednet_doctor_id'],
            "doc_reg_number"  => $row['RegNumber'],
        ];

        $mednet_doctor_data = get_booking_mednet_data($doctor['doc_mednet_id'],$loc);
        // $data_global =  decrypt_fun('MG12NEp3bDFQUGlNQTE4bFJwQkg1aXZzQU5pdVd0S3h4c2hBUjVYYjlYS21OTytCd1dWK2xUcEZNQXJ5QmhtTTFMWlFZVTlHVGJhUWhLUXZQajRMa1liNERtd1hlVER3YmRrN1VxTnJCYzNzaTFRcW81U0ZVcmkzNmdzTnpJM1hGYTRJK2NjbE5Ma2lzOFhFRE4ybzVBPT0=');
        $doctor_tariff = bookingdoctor_amount($doctor['doc_reg_number'],"",$loc);

        $today = date('Y-m-d');


      

        foreach ($mednet_doctor_data['data'] as $key => $dates_data) {

            $dates = date('Y-m-d', strtotime($dates_data['appointmentDate']));
            $shifts = [
                "morning"   => [],
                "afternoon" => [],
                "evening"   => []
            ];

            foreach ($dates_data['slotsList'] as $slotsList) {
                foreach ($slotsList['timeSlotList'] as $timeSlotList) {
                    $status = 1;
                    $is_booked = 0;

                    if (!($timeSlotList['status'] == "OPEN" && $timeSlotList['locked'] == false)) {
                        $status = 0;
                        $is_booked = 1;
                    }

                    $slot = [
                        "booking_start_time"      => $timeSlotList['appointmentTime'],
                        "booking_show_start_time" => date("h:i a", strtotime($timeSlotList['appointmentTime'])),
                        "booking_end_time"        => $timeSlotList['appointmentTime'],
                        "is_booked"               => $is_booked,
                        "appointmentTokenNumber"  => $timeSlotList['appointmentTokenNumber'],
                        "status"                  => $status,
                        "id"                      => $timeSlotList['appointmentID']
                    ];

                    // 🔑 Decide shift based on hour
                    $hour = (int)date("H", strtotime($timeSlotList['appointmentTime']));

                    if ($hour < 12) {
                        $shifts['morning'][] = $slot;
                    } elseif ($hour < 16) {
                        $shifts['afternoon'][] = $slot;
                    } else {
                        $shifts['evening'][] = $slot;
                    }
                }
            }

            $result[$dates] = [
                "shifts"    => $shifts,
            ];
        }


          $a = array(
                  "code" => "101"
                  ,"message" => "Success"
                  ,"result" => $result
          );


           $doctor_data = [
            "doc_image"       => $row['doctor_photo'],
            "doc_name"        => $row['DoctorName'],
            "doc_designation" => $row['CurrentDesignation'],
            "doc_mednet_dept" => $row['mednet_DepartmentName'],
            "doc_mednet_id"   => $row['mednet_doctor_id'],
            "doc_reg_number"  => $row['RegNumber'],
            "doc_information" => [
                "description"  => $row['Description'],
                "education"  => $row['Education'],
                "experience"  => $row['WorkExperience'],
                "awards_membership"  => $row['AwardRecognition'],
                "otherinfo"  => $row['OtherInformation']
            ],
            "booking_slots" => $result,
            "traiff" => $doctor_tariff['NEW_VISIT_AMOUNT']

           
        ];

        
        return array(
            "code" => "101",
            "message" => "Success",
            "result" => $doctor_data,
        );
    

    }

    function get_booking_mednet_data($doctorID,$loc){
        // $loc = $_POST["loc"];

        // $loc = 'sarvodaya-hospital-greater-noida-west';


        if($loc == 'sarvodaya-hospital-research-centre-sector-8'){
            $facilityGUID = '3e77361c-d482-4816-afbb-5b87576da352';
            $UNITID = 'SARVODAYA HOSPITAL AND RESEARCH CENTRE';
            $USER_ID = 'appointment@sarvodaya';
            $USER_KEY = 'a7a56cfe-d152-480b-aab3-d5923a8b5bb7';

        }else if($loc == 'sarvodaya-hospital-greater-noida-west'){

            $facilityGUID = '7c43de44-9724-4b6a-828b-73a3097d3653';
            $UNITID = 'SARVODAYA HOSPITAL - NOIDA';
            $USER_ID = 'user@sarvodaya-noida';
            $USER_KEY = 'ed5746b3-e532-43ce-b90d-c3caf9029751';


        }


          $curl = curl_init();




          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/doctorSlots',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"doctorID": "'.$doctorID.'","facilityGUID":"'.$facilityGUID .'",   "fromDate":"'.date('d-m-Y').'","noOfDays":"7"}
          ',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: text/plain'
            ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          return json_decode($response,1);
    }

    function bookingdoctor_amount($doctor_registration_no,$mrn,$loc){
      $curl = curl_init();
    //   $loc = $_POST["loc"];
        // $loc = 'sarvodaya-hospital-greater-noida-west';


      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.sarvodayahospital.com/App_api/get_patient_traiff',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
                                  "mrn" : "",
                                  "loc" : "'.$loc.'",
                                  "doctor_registration_no" : "'.$doctor_registration_no.'",
                                  "facilityGUID":"3e77361c-d482-4816-afbb-5b87576da352"
                              }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Cookie: ci_session=o4injjps7sm5ei71ljagqba8q9n6haf9'
        ),
      ));
      //echo $doctor_registration_no;
      $response1 = curl_exec($curl);

      curl_close($curl);
      $response1 =  json_decode($response1,1);
      return $response1['result'];

    }



?>