<?php

    function get_attendent_pass($data){
        $mrn = $data['data_global']['mrn'];
        $mrn = 'SR1051432';


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.housepital.in/sarvodaya_api/api/patient_admission_qr_code',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "data" : {
            "mrn" : "'.$mrn.'"
        }
        }

        ',
        CURLOPT_HTTPHEADER => array(
            'facilityGUID: p09678-d4-4816-afbb-5b87576da352',
            'userID: neeraj.mishra@copperjam.com',
            'source: Copperjam',
            'userKey: iop90-d152-480b-aab3-d5928b5bb7',
            'Content-Type: application/json',
            'Cookie: UID=0'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        

        return json_decode($response);

    }
?>