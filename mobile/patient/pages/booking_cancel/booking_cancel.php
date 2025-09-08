<?php
    

    function booking_cancel_function($data){

      $global_header = array(
        "Accept-Encoding: gzip, deflate",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: text/plain",
        "cache-control: no-cache",
        "facilityGUID: 3e77361c-d482-4816-afbb-5b87576da352",
        "source: WebClient",
        "userID: appointment@sarvodaya",
        "userKey: a7a56cfe-d152-480b-aab3-d5923a8b5bb7",
        "mednetOAuthApiToken: 607e2bb49932eedc15e24b0694dd7556732c909d",
        "loggedInUserID: -1"
      );


      $data_self = $data["data_self"];
      $booking_id = $data_self["booking_id"];
      $type = $data["type"];
      $data_self_e = encrypt_fun($data_self);
      $today_date = date("Y-m-d");
      global $con;
      $created_on=date("Y-m-d h:i:s");
      $message = "";
      $sql_get = "SELECT a.id,a.status,a.amount, a.booking_from,a.booking_to,a.booking_date,a.payment_date,b.patient_name,b.prefix,b.mobile, a.mednet_json,a.mednet_response_json, a.reference_id ,a.check_in_time,a.check_out_time,a.in_consultation_time
      FROM `video_patient_transaction` a
      inner join video_patient b on b.id = a.patient_id
      where a.id = '$booking_id' and (a.status = '1' or a.status = '9') and a.booking_date < DATE_ADD(a.booking_date, INTERVAL 3 DAY) ";
      $query_get = mysqli_query($con, $sql_get);
      $row_get = mysqli_fetch_array($query_get);
      
      $processed = stripslashes(trim($row_get['mednet_response_json'], '"'));
      $mednet_json = json_decode($processed, true);
      // $mednet_json = $row_get['mednet_json'] ;
      // Fetch txnHeaderID
      $txn_no = $mednet_json['txnHeaderID'] ?? null;
      if($row_get['payment_date'] != null ){
        $date_diff = dateDiffInDays($row_get['payment_date'], $today_date);
        if($date_diff > 3){
          // return array(
          //     "code" => "102"
          //     ,"message" => 'Booking Cancel Failed'
          //     ,"result" => array(
          //         "title" => "Booking Cancel",
          //         "layout_code" => $row_get['payment_date'],
          //         "layout_des" => $today_date,
          //         "sub_text" => $date_diff,
          //         "txn_no" => $txn_no,
          //         "message" => "Booking cannot be cancelled after 3 days of payment date."
          //     )
          // );
          // $refund_url = "http://mednet.anshuhospitals.in:8080/mednet/api/billing/createCreditNote" ;
          // $refund_post = '{ 
          //   "txnHeaderID": $txn_no,
          //   "creditNoteAmount": $row_get['amount'],
          //   "creditNoteType" : "P"
          // }' ;
          // $result = get_curl($refund_url,"POST",$global_header, $refund_post);
        }else{
          // $url = "http://mednet.anshuhospitals.in:8080/mednet/ws/patientBillingWS/cancelUnwantedBill/txnHeaderID/".$txn_no;
          // get_curl($url,"GET",$global_header);
          $row_get['amount'] =8 ;
          $refund_url = "http://mednet.anshuhospitals.in:8080/mednet/api/billing/createCreditNote" ;
          $refund_post = '{ 
            "txnHeaderID": "'.$txn_no.'",
            "creditNoteAmount": "'.$row_get['amount'].'",
            "creditNoteType" : "P"
          }' ;
          $result = get_curl($refund_url,"POST",$global_header, $refund_post);
          return array(
              "code" => "102"
              ,"message" => 'Booking Cancel Failed'
              ,"result" => array(
                  "title" => "Booking Cancel",
                  "layout_code" => $row_get['payment_date'],
                  "layout_des" => $today_date,
                  "sub_text" => $date_diff,
                  "txn_no" => $txn_no,
                  "result" => $result,
                  "message" => "Booking cannot be cancelled after 3 days of payment date."
              )
          );
        }

      }

      // if($type == "cancel_amount"){

      //   $insert_sql = "INSERT INTO `video_booking_cancel` (`booking_id`, `status`, `created_by`, `created_on`) VALUES ('".$booking_id."', '1', '1', '".$created_on."')";
      //   $insert_query = mysqli_query($con, $insert_sql);
        
      //   $message = "Booking Cancelled Successfully. Refund will be initiated and credited within next 7-10 working days. ";
      // }else{
      //   $message = "Booking Cancelled Successfully.";
      // }
        
      $sql = "UPDATE `video_patient_transaction` SET status = '5' WHERE id = '$booking_id'" ;
    //   $query = mysqli_query($con, $sql);
      $result = array();
    //   while ($row = mysqli_fetch_array($query)) {

    //   }
        $rand = rand(10, 100);
        $result = array(
            "title" => "Booking Cancel",
            "layout_code" => "000",
            "layout_des" => "booking_cancel",
            "sub_text" => "9". $rand .$booking_id."6",
            "message" => $message
        );

        return array(
            "code" => "101"
            ,"message" => 'Success'
            ,"result" => $result
        );
    }

    function dateDiffInDays($date1, $date2) {
      $diff = strtotime($date2) - strtotime($date1);
      return abs(round($diff / 86400));  // 86400 seconds = 1 day
    }

    function get_curl($url,$req_type, $header = [], $post_data =[]) {
      $curl = curl_init();
  
      curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $req_type,
          CURLOPT_HTTPHEADER => $header,
      ));

      if (in_array(strtoupper($req_type), ['POST', 'PUT', 'PATCH']) && !empty($post_data)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($post_data) ? http_build_query($post_data) : $post_data);
      }
  
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
  
      if ($err) {
          return array(); // error handling
      } else {
          $decoded = json_decode($response, true);
          return $decoded["data"] ?? $decoded; // fallback to full response if "data" key doesn't exist
      }
    }
    

?>