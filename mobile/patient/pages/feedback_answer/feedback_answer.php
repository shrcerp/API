<?php
    function get_feedback_answer($data) {
        $curl = curl_init();

        $payload = array(
            'unit_id' => '2',
            'form_type_id' => '31',
            'feedback_source_id' => '1',
            'type' => 'PATIENT',
            'name' => $data['data_global']['name'],
            'uhid' => $data['data_global']['mrn'],
            'location_name' => '',
            'email' => 'paras@scoreplusits.com',
            'phone' => '+91' . $data['data_global']['mobile'],
            'feedback_datetime' => date('c'), 
            'feedback_response' => array(
                array(
                    'question_id' => 844,
                    'question_option_id' => 4080
                )
            )
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-feedback.sarvodayahospital.com/api/v1/public/feedback/save',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload), 
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer {{accessToken}}'
            ),
            CURLOPT_SSL_VERIFYPEER => false, 
            CURLOPT_SSL_VERIFYHOST => false, 
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo "cURL Error: " . curl_error($curl);
        }

        curl_close($curl);

        return json_decode($response);
    }
?>
