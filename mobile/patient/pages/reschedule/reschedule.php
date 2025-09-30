<?php
    function reschedule($data){
        global $con;

        $mrn=$data['data_global']['mrn'];
        $slot_data = json_decode($data["slot_data"],1);
        $active_date = $data["active_date"];
        $booking_id_old = $data['data_self']["booking_id"];
        $booking_type = $data['data_self']["booking_type"];
        if($booking_type == 2){
            $interest = "In-Person Booking";
        }
        $amount = $data['data_self']["amount"];
        $loc = $data['data_self']["loc"];
        $patient_mobile = $data['data_self']["mobile"];
        
        $sql = "select a.*,b.mednet_DepartmentName,b.RegNumber,c.prefix,c.patient_name,c.gender,c.dob,c.aadharID,c.state_name,c.city_name,c.pin_code,c.address from video_patient_transaction a join gw_doctor_info b on a.doctor_id=b.gw_id join video_patient c on a.patient_id=c.id where a.id=$booking_id_old";
        $query = cj_query($sql);
        $row = cj_fetch_array($query);
        $discount_coupon_id = $row['discount_coupon_id'];
        $discount_coupon_amount = $row['discount_coupon_amount'];
        $discount_coupon_pre = $row['discount_coupon_pre'];
        $original_price = $row['original_price'];
        $doctor_id = $row['doctor_id'];
        $discount_amount = $row['discount_coupon_amount'];
        $discount_per = $row['discount_coupon_pre'];
        $bill_number = $row['bill_number'];
        $patient_id = $row['patient_id'];
        $payment_date = $row['payment_date'];
        $reference_id = $row['reference_id'];
        $status = $row['status'];
        $message = $row['message'];
        $reschedlue_id = $row['reschedlue_id'];
       




        $response = $row['response'] ?? '';
        $response = mysqli_real_escape_string($con, $response);
        $mednet_response_json = $row['mednet_response_json'] ?? ''; 
        $mednet_response_json = mysqli_real_escape_string($con, $mednet_response_json);
       
       
        $prefix = $row['prefix'];
        $patient_name = $row["patient_name"];
        $gender = $row["gender"];
        $dob = $row["dob"];
        $aadharID = $row["aadharID"] ?? '';
        $state_name = $row["state_name"] ?? '';
        $city_name = $row["city_name"] ?? '';
        $pin_code = $row["pin_code"] ?? '';
        $address = $row["address"] ?? '';

        $mednet_DepartmentName = $row["mednet_DepartmentName"];
        $doctorRegistrationNumber = $row["RegNumber"];

        $created_on = date("Y-m-d H:i:s");
        $sql_insert = "INSERT INTO video_patient_transaction 
        (
            loc,booking_type,patient_id,amount,discount_coupon_id,discount_coupon_amount,discount_coupon_pre,original_price,interest,booking_from,booking_to,booking_date,mednet_booking_id,doctor_id,status,created_on,appointmentTokenNumber,bill_number,reference_id,reschedlue_id,response,message,mednet_response_json
        ) VALUES (
            '$loc',                                  
            '$booking_type',                         
            '$patient_id',                            
            $amount,                                 
            $discount_coupon_id,                     
            $discount_coupon_amount,                 
            $discount_coupon_pre,                 
            $original_price,                        
            '$interest',                               
            '".$slot_data['booking_start_time']."',     
            '".$slot_data['booking_end_time']."',       
            '$active_date',                           
            '".$slot_data['id']."',                      
            $doctor_id,                              
            $status,                                 
            '$created_on',                            
            '".$slot_data['appointmentTokenNumber']."', 
            '$bill_number',                           
            '$reference_id',  
            $booking_id_old  , 
            '$response' ,
            '".$message."',
            '$mednet_response_json'             
        )";
        $query_1 = mysqli_query($con, $sql_insert);
        $booking_id = mysqli_insert_id($con);
        if($booking_id){
            $sql_update = "update video_patient_transaction set status = 5 where id=$booking_id_old ";
            $query_update = mysqli_query($con, $sql_update);

            $confirm_reschedule = salil_sir_fucntion_to_insert_booking_data($order_id,$reference_id);
            return array(
                "code" => 101,
                "message" => "Reschedule Confirmed",
                "result" => $confirm_reschedule 
            );
        }else{
            return array(
                "code" => 102,
                "message" => "Failed",
                "result" => []
            );
        }

    }


    


    function salil_sir_fucntion_to_insert_booking_data($order_id,$reference_id){
                
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.sarvodayahospital19.com/paymentgatway_physical/mobile_video_payment.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "order_id" : "'.$order_id.'",
        "order_status" : "Success",
        "reference_id" : "'.$reference_id.'",
        "result" : "{}",
        "facilityGUID":"f6de8499-0004-5896-ab8c-jduik8JODHJ"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response  = json_decode($response,1);
        return $response;
       
    }
  


   


?>