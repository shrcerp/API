<?php

function patient_journey($data) {
    global $con;

    $loc = $data['data_self']['location'];
    $mrn = $data['data_global']['mrn'];
    $mrn = 'SR1044400'; 
    $today_date = date('Y-m-d');

    if (!empty($loc)) {
        $mrn_sql = ($loc == 'sarvodaya-hospital-greater-noida-west') ? "b.mrn_nodia = '$mrn'" : "b.mrn_no = '$mrn'";
    } else {
        $mrn_sql = "(
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
        return call_token_api($mrn, $row['booking_date'], $loc);
    } else {
        return ["code" => "102", "message" => "no appointment found", "result" => []];
    }
}

function call_token_api($mrn, $booking_date, $loc) {
    $curl = curl_init();
    // $mrn = 'SHC003158';
    // $booking_date = '2025-09-25';
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
 

    // Fixed services
    $fixedServices = [ "Nursing", "Consultation","LAB", "Radiology", "Pharmacy"];
    $mappedServices = [];

    // Map API data to fixed services
    if (!empty($apiData)) {
        foreach ($apiData as $service) {
            $serviceName = $service['service'];

            if (
                stripos($serviceName, "EMR_Pharmacy") !== false ||
                stripos($serviceName, "OP_Pharmacy") !== false
            ) {
                $serviceName = "Pharmacy";
            } elseif (
                stripos($serviceName, "Nursing Station (2)") !== false ||
                stripos($serviceName, "Nursing Station (A)") !== false ||
                stripos($serviceName, "Nursing Station (AB)") !== false ||
                stripos($serviceName, "Nursing Station (B)") !== false ||
                stripos($serviceName, "Nursing Station (C)") !== false ||
                stripos($serviceName, "Nursing Station (D)") !== false ||
                stripos($serviceName, "Nursing Station (LG)") !== false ||
                stripos($serviceName, "Nursing_Station_1") !== false ||
                stripos($serviceName, "Nursing_Station_2") !== false ||
                stripos($serviceName, "Nursing_Station_3") !== false ||
                stripos($serviceName, "Nursing_Station_4") !== false ||
                stripos($serviceName, "Nursing_Station_5") !== false ||
                stripos($serviceName, "Nursing_Station_6") !== false ||
                stripos($serviceName, "Nursing_Station_7") !== false ||
                stripos($serviceName, "Nursing_Station_8") !== false ||
                stripos($serviceName, "Nursing_Station_9") !== false ||
                stripos($serviceName, "Nursing_Station_AB") !== false ||
                stripos($serviceName, "Nursing_Station_B") !== false ||
                stripos($serviceName, "Nursing_Station_LG") !== false 
            
            ) {
                $serviceName = "Nursing";
            } elseif ( stripos($serviceName, "CREDIT_COUNTER_A") !== false || stripos($serviceName, "CREDIT_COUNTER_B") !== false || stripos($serviceName, "CREDIT_COUNTER_C") !== false || stripos($serviceName, "CREDIT_COUNTER_D") !== false
            ) {
                $serviceName = "Consultation";
            } elseif ( stripos($serviceName, "CT") !== false ||    stripos($serviceName, "X_RAY") !== false ||stripos($serviceName, "USG_OBS") !== false ||stripos($serviceName, "ECG") !== false ||stripos($serviceName, "ECHO") !== false ||stripos($serviceName, "USG") !== false ||stripos($serviceName, "MRI") !== false ||stripos($serviceName, "TMT") !== false ||stripos($serviceName, "USG_IPD") !== false
                    ) {
                $serviceName = "Radiology";
            }elseif (stripos($serviceName, "LAB") !== false) {
                $serviceName = "LAB";
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
            ["service" => "Appointment",
            "service_done" =>"1"]
        ]
    ];

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

    return $final;
}
?>
