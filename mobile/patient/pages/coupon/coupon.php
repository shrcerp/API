<?php

    function get_coupon_data($data){
        global $con;
        $date = date("Y-m-d");
        // print_r(json_encode($data));
        // return;
        $data_global = $data["data_global"];
        $coupon_code = $_POST["coupon_code"];
        $location = $data["data_self"]["location"];
        // print_r($data["data_self"]);
        // echo $location;
        // $location = 'sarvodaya-hospital-research-centre-sector-8';
        $sql = "select * from video_patient_coupon where coupon_code = '$coupon_code' and status = 1 and start_date <= '$date' and end_date >= '$date' and FIND_IN_SET('$location', location)";
        $result_data = mysqli_query($con, $sql);
        $row_a = mysqli_fetch_assoc($result_data);
        if(!is_array($row_a)){
            $a = array(
                "code" => "102"
                ,"message" => "Coupon Not Found"
                ,"result" =>  array()
            );
            echo json_encode($a);
            exit();
        }
        $discount_per = $row_a["discount_per"];

      $doc_id = $_POST["doc_id"];
      $doctor_info = get_doctor_info($doc_id, $location);
      $patient_id = $data_global["id"];
      $doctor_info = get_doctor_info($doc_id,$location);
    //   print_r($doctor_info);
      $doctor_tariff = bookingdoctor_amount($doctor_info['RegNumber'],"",$location);
      $video_calling_price =$doctor_tariff['NEW_VISIT_AMOUNT'];
      $result = array(
          "discount_per" => $discount_per
          ,"discount_id" => $row_a["id"]
          ,"discount_coupon" => $_POST["coupon_code"]
          ,"video_calling_price" => $video_calling_price
          ,"calling_price" => round($video_calling_price * (100-$discount_per)/100)
          ,"time" => time()
      );
      $token_encrypt =  encrypt_fun($result);
        
        return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" =>  array(
            'discount_token' =>$token_encrypt,
            'discount_per' => $discount_per,
            'loc' => $location,
          )
        );
    }

    function get_doctor_info($doc_id, $loc){
        global $con;
    //    $loc = $_POST["loc"];
        $sql = "select a.*,b.registration_number as RegNumber,b.doctorid as mednet_doctor_id,b.mx_department from gw_doctor_info a
               inner join gw_doctor_hospital b on b.gw_id  = a.gw_id
               where b.hospital_id = '$loc' and a.gw_id= '$doc_id' ";
        
       $query = mysqli_query($con, $sql);
       $result = array();
       while ($row = mysqli_fetch_array($query)) {
           return $row;
       }
       return array();
    }
 function bookingdoctor_amount($doctor_registration_no,$mrn, $loc){
    $curl = curl_init();
    // $loc = $_POST["loc"];

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