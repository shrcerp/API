<?php
    function get_doctor_prescribed_lab($data){

        $mrn = $data['data_global']['mrn'];
        $mrn = 'SR674812';

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.sarvodayahospital.com/permission/doctor_lab_test_mobile',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'mrn' => $mrn
        ),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=eki08hh4pqcdvt40k1lq97fp7t41sdbr'
        ),
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return ['error' => $error_msg];
        }
        curl_close($curl);
        
        return array(
            "code" => "101",
            "message" => "data fetched successfully",
            "result" => json_decode($response)
        );
     
    }
?>

<?php





