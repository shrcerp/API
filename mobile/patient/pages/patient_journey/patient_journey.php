<?php
    
function patient_journey($data) {
    global $con;
  
    // $loc = $data['data_self']['location'];
    $id = $data['data_global']['id'];
    $today_date = date('Y-m-d'); 

    $sql = "SELECT a.loc,a.booking_date,a.payment_date,a.doctor_id,case when a.loc = 'sarvodaya-hospital-greater-noida-west' then b.mrn_nodia else b.mrn_no end as mrn  FROM video_patient_transaction a join video_patient b on a.patient_id=b.id where b.id=$id and a.booking_date >= '$today_date'";

    // $mrn = 'SR1044400';
    // $mrn_sql = "";
    

    // if (!empty($data['data_self']['location'])) {
    //     if ($loc == 'sarvodaya-hospital-greater-noida-west') {
    //         $mrn_sql = " b.mrn_nodia = '$mrn'";
    //     } else {
    //         $mrn_sql = " b.mrn_no = '$mrn'";
    //     }
    // } else {
    //     $mrn_sql = " (
    //         (b.mrn_no IS NOT NULL AND b.mrn_no != '' AND TRIM(b.mrn_no) = '$mrn')
    //         OR
    //         ((b.mrn_no IS NULL OR b.mrn_no = '') AND TRIM(b.mrn_nodia) = '$mrn')
    //     )";
    // }

    // $sql = "SELECT booking_date,payment_date,doctor_id 
    //         FROM video_patient_transaction a 
    //         JOIN video_patient b ON b.id=a.patient_id 
    //         WHERE $mrn_sql AND booking_date >= '$today_date'";

          

    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    if (!empty($row)) {
        // return call_token_api($mrn, $row['booking_date'], $row, $loc);
        return call_token_api($row['mrn'], $row['booking_date'], $row['loc']);
    } else {
        return ["code" => "102","message"=>"no appointment found","result"=>[]];
    }
}


function call_token_api($mrn, $booking_date, $loc) {
    $curl = curl_init();
//    $mrn = 'SHC003158';
//     $booking_date = '2025-09-25';
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

    $fixedServices = ["Nursing Vitals", "Consultation", "Prescription"];
    $mappedServices = [];

    if (!empty($apiData)) {
        foreach ($apiData as $service) {
            $serviceName = $service['service'];

            if (
                stripos($serviceName, "EMR_Pharmacy") !== false ||
                stripos($serviceName, "OP_Pharmacy") !== false
            ) {
                $serviceName = "Prescription";
            } elseif (
                stripos($serviceName, "Nursing Station") !== false ||
                stripos($serviceName, "Nursing_Station") !== false
            ) {
                $serviceName = "Nursing Vitals";
            } elseif (
                stripos($serviceName, "CREDIT_COUNTER") !== false
            ) {
                $serviceName = "Consultation";
            } elseif (
                stripos($serviceName, "CT") !== false ||    
                stripos($serviceName, "X_RAY") !== false ||
                stripos($serviceName, "USG") !== false ||
                stripos($serviceName, "ECG") !== false ||
                stripos($serviceName, "ECHO") !== false ||
                stripos($serviceName, "MRI") !== false ||
                stripos($serviceName, "TMT") !== false
            ) {
                $serviceName = "Radiology";
            } elseif (stripos($serviceName, "LAB") !== false) {
                $serviceName = "Lab";
            }

            $mappedServices[$serviceName] = [
                "service"      => $serviceName,
                "ticket_no_1"  => $service['ticket_no_1'],
                "service_done" => $service['service_done'],
                "ticket_date"  => $service['ticket_date'],
            ];
        }
    }

    $final = [
        "code" => "101",
        "service"=> "Appointment",
        "message" => "booking and services",
        "result" => [
            ["service" => "Appointment", "service_done" => "1"]
        ]
    ];

    // Add always-visible services
    foreach ($fixedServices as $srv) {
        if (isset($mappedServices[$srv])) {
            $final["result"][] = $mappedServices[$srv];
        } else {
            $final["result"][] = [
                "service"      => $srv,
                "ticket_no_1"  => "",
                "service_done" => "0",
                "ticket_date"  => ""
            ];
        }
    }

    // Add LAB and Radiology ONLY if present
    foreach (["Lab", "Radiology"] as $optionalSrv) {
        if (isset($mappedServices[$optionalSrv])) {
            $final["result"][] = $mappedServices[$optionalSrv];
        }
    }

    return $final;
}

?>
