<?php
function patient_acknowledgement($data){
    global $con;
    // print_r($data);
    // return;
    
    $mrn = $data['data_global']['mrn'];
    // $ip = $data['data_self']['ip'];
    $ip = 'IP123';

    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d H:i:s');

    $sql = "UPDATE patient_acknowledgement 
            SET consent = 1,
            status=2,
            consent_time = '$current_time'
            WHERE ip = '$ip'";

    $query = mysqli_query($con, $sql);

    if ($query && mysqli_affected_rows($con) > 0) {
        return [
            "code" => 102,
            "message" => "Consent Successfully Updated"
        ];
    } else {
        return [
            "code" => 101,
            "message" => "no records found"
        ];
    }
}
?>
