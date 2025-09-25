<?php
    
function patient_journey($data) {
    global $con;
  
    $loc = $data['data_self']['location'];
    $mrn = $data['data_global']['mrn'];
    // $mrn = 'SR1044400';
    $mrn_sql = "";
    $today_date = date('Y-m-d'); 

    if (!empty($data['data_self']['location'])) {
        if ($loc == 'sarvodaya-hospital-greater-noida-west') {
            $mrn_sql = " b.mrn_nodia = '$mrn'";
        } else {
            $mrn_sql = " b.mrn_no = '$mrn'";
        }
    } else {
        $mrn_sql = " (
            (b.mrn_no IS NOT NULL AND b.mrn_no != '' AND TRIM(b.mrn_no) = '$mrn')
            OR
            ((b.mrn_no IS NULL OR b.mrn_no = '') AND TRIM(b.mrn_nodia) = '$mrn')
        )";
    }

    $sql = "SELECT booking_date,payment_date,doctor_id 
            FROM video_patient_transaction a 
            JOIN video_patient b ON b.id=a.patient_id 
            WHERE $mrn_sql AND booking_date >= '$today_date'";

          

    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (!empty($row)) {
        return call_token_api($mrn, $row['booking_date'], $row, $loc);
    } else {
        return ["code" => "102","message"=>"no appointment found","result"=>[]];
    }
}


function call_token_api($mrn, $booking_date, $row , $loc) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.sarvodayahospital.com/permission/token_test',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'mrn' => $mrn,
            'date' => $booking_date,
            'loc' => $loc
        ),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=4nft2itvkpdhl1kfsedcnsmtanvlhdaa'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $apiData = json_decode($response, true);
    $final = [];

    if (empty($apiData)) {
        $final = array(
            "code"=>"101",
            "message"=>"booking found but services not started yet",
            "result" => [
                [
                    "service" => "Appointment",
                    "service_done" =>"1",
                ]
            ]
        );
        return $final;
    }

    $final = array(
        "code" => "101",
        "service"=> "Appointment",
        "message" => "booking and services",
        "result" => [
            ["service" => "Appointment",
            "service_done" =>"1"]
        ]   
    );

    foreach ($apiData as $service) {
        $final["result"][] = [
            "service"      => $service['service'],
            "ticket_no_1"  => $service['ticket_no_1'],
            "service_done" => $service['service_done'],
            "ticket_date"  => $service['ticket_date'],
           
        ];
    }


    return $final;
}

?>
