<?php

    function get_feedback_question() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-feedback.sarvodayahospital.com/api/v1/public/feedback/questions?search[status]=1&search[form_type_id]=31',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false, 
            CURLOPT_SSL_VERIFYHOST => false, 
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            echo json_encode(["error" => curl_error($curl)]);
            return;
        }
        curl_close($curl);
        return json_decode($response);
    }

?>
