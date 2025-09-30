<?php
    function get_kyc($data){

      

        $mrn = 'LSHHI341368';
        // $mrn = $data['data_global']['mrn'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sarvodayahospital19.com/pdm/API/kyc_check',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('mrn' => $mrn),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=002850fe6e58989b653c04a4e2a377d4bc0ee989'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }
?>