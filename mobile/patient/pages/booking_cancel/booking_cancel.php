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
   
      $sql_get = "SELECT a.response,a.id,a.status,a.amount, a.booking_from,a.booking_to,a.booking_date,a.payment_date,b.patient_name,b.prefix,b.mobile, a.mednet_json,a.mednet_response_json, a.reference_id ,a.check_in_time,a.check_out_time,a.in_consultation_time FROM `video_patient_transaction` a inner join video_patient b on b.id = a.patient_id where a.id = '$booking_id' and a.status = '3' and a.booking_date >= CURDATE()";
      // echo $sql_get;
      
      $query_get = mysqli_query($con, $sql_get);
      if (!$query_get || mysqli_num_rows($query_get) == 0) {
          return [
              "code" => "404",
              "message" => "No data found for this booking ID",
              "result" => null
          ];
      }
      $row_get = mysqli_fetch_array($query_get);

      $payment_response = $row_get['response'];
      $payment_response = json_decode($payment_response, true);
      $payment_id = isset($payment_response['id']) ? $payment_response['id'] : null;

      $processed = stripslashes(trim($row_get['mednet_response_json'], '"'));
      $mednet_json = json_decode($processed, true);
      
      $txn_no = $mednet_json['txnHeaderID'] ?? null;
      // $txn_no = 8660563;
      $payment_date = stripslashes(trim($row_get['response'], '"'));
      $payment_date = json_decode($payment_date, true);
      
      $payment_date = $payment_date['created_at'] ;
      $payment_date = date("Y-m-d",$payment_date);
   
      if($row_get['reference_id'] != null ){
        $date_diff = dateDiffInDays($payment_date, $today_date);
        if($date_diff > 3){
          $cancel_slot = cancel_unwanted_bill($txn_no);
       
          $main_refund_url = "http://mednet.anshuhospitals.in:8080/mednet/ws/patientBillingWS/createPatientRefundByRefundInitiation";
          $main_refund_post = json_encode([
            "txnHeaderID"      => (int)$txn_no,
            "refundAmount"     => (float)$row_get['amount'],
            "paymentMode"      => "Online",
            "txnRefundDate"    => date("d-m-Y"),   
            "refundNarration"  => "narration1",
            "notes"            => "done"
          ]);
          $refund_result = get_refund($main_refund_url, "POST", $main_refund_post);


          $refund_url = "http://mednet.anshuhospitals.in:8080/mednet/api/billing/createCreditNote" ;
          $refund_post = '{ 
            "txnHeaderID": '.(int)$txn_no.',
            "creditNoteAmount": '.$row_get['amount'].',
            "creditNoteType" : "P"
          }' ;

          $credit_note = get_curl($refund_url,"POST",$global_header, $refund_post);

          $razor_pay_refund = razor__pay_refund((float)$row_get['amount'],$payment_id);

    
          if(!empty($refund_result['success']) && $refund_result['success'] == 1){
            $sql_update = "UPDATE `video_patient_transaction` SET status = '5' WHERE id = '$booking_id'";
            $query_update = mysqli_query($con, $sql_update);
            return array(
              "code" => "101",
              "message" => "Booking Cancelled Successfully. Refund will be initiated and credited within next 7-10 working days.",
              "result" => $refund_result
            );
          }else{
                return array(
                  "code" => "102",
                  "message" => "Booking Cancelled Failed.",
                  "result" => $refund_result
              );
          }
          

  
        }else{
         
          $cancel_slot = cancel_unwanted_bill($txn_no);

          $main_refund_url = "http://mednet.anshuhospitals.in:8080/mednet/ws/patientBillingWS/createPatientRefundByRefundInitiation";
          $main_refund_post = json_encode([
            "txnHeaderID"      => (int)$txn_no,
            "refundAmount"     => (float)$row_get['amount'],
            "paymentMode"      => "Online",
            "txnRefundDate"    => date("d-m-Y"),   
            "refundNarration"  => "narration1",
            "notes"            => "done"
          ]);
          $refund_result = get_refund($main_refund_url, "POST", $main_refund_post);

          $razor_pay_refund = razor__pay_refund((float)$row_get['amount'],$payment_id);

          if(!empty($refund_result['success']) && $refund_result['success'] == 1){
            $sql_update = "UPDATE `video_patient_transaction` SET status = '5' WHERE id = '$booking_id'";
            $query_update = mysqli_query($con, $sql_update);
            return array(
              "code" => "101",
              "message" => "Booking Cancelled Successfully. Refund will be initiated and credited within next 7-10 working days.",
              "result" => $refund_result
            );
          }else{
                return array(
                  "code" => "102",
                  "message" => "Booking Cancelled Failed.",
                  "result" => $refund_result
              );
          }
         
         
        }

      }else{
        return array(
          "code" => "102",
          "message" => "Booking Cancelled Failed.",
          "result" => []
      );
      }



        
  
    }


    function razor__pay_refund($amount,$payment_id){

      $curl = curl_init();

      $postData = [
        "amount" => $amount,
        "payment_id" => $payment_id,
        "facilityGUID" => "f6de8499-0004-5896-ab8c-7523695Jop"
      ];

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.sarvodayahospital.com/mapp/paymentgatway/noida_refund.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($postData),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;

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
      $info = curl_getinfo($curl);

 
     
      $err = curl_error($curl);
      // print_r($err);
      curl_close($curl);
  
      if ($err) {
          return array();
      } else {
          $decoded = json_decode($response, true);
          return $decoded["data"] ?? $decoded; // fallback to full response if "data" key doesn't exist
      }
    }



    function get_refund($url, $req_type = "GET", $post_data = null) {
        $headers = array(
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Accept: application/json",
            "Content-Type: application/json",
            "cache-control: no-cache",
            "facilityGUID: 3e77361c-d482-4816-afbb-5b87576da352",
            "source: WebClient",
            "userID: appointment@sarvodaya",
            "userKey: a7a56cfe-d152-480b-aab3-d5923a8b5bb7",
            "mednetOAuthApiToken: 607e2bb49932eedc15e24b0694dd7556732c909d",
            "loggedInUserID: -1"
        );

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($req_type),
            CURLOPT_HTTPHEADER => $headers,
        ]);

        // Attach post data if required
        if (in_array(strtoupper($req_type), ["POST", "PUT", "PATCH"]) && !empty($post_data)) {
            if (is_array($post_data)) {
                $post_data = json_encode($post_data, JSON_UNESCAPED_SLASHES);
            }
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return ["success" => false, "error" => $err];
        }

        $decoded = json_decode($response, true);
        return $decoded ?: ["success" => false, "rawResponse" => $response];
    }
      

    function cancel_unwanted_bill($txn_no) {
        $url = "http://mednet.anshuhospitals.in:8080/mednet/ws/patientBillingWS/cancelUnwantedBill/txnHeaderID/" . $txn_no;

        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
            "mednetOAuthApiToken: 607e2bb49932eedc15e24b0694dd7556732c909d",
            "loggedInUserID: -1"
        );

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return ["success" => false, "error" => $err];
        }

        $decoded = json_decode($response, true);
        return $decoded ?: ["success" => true, "result" => $response];
    }

?>