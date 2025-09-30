<?php


    function get_patient_medicine($data) {
        $location = $data['data_self']['location'];
        if(empty($location)){
            return array(
                "code"=>"101",
                "message"=>"please select location",
                "result"=> array(
                    "title"=> "No Location Found",
                    "layout_code"=> "1",
                    "layout_des"=> "info_card",
                    "sub_text"=> "",
                    "image"=> "",
                    "timestamp"=> "",
                    "web_link"=> "",
                    "web_view"=> "0",
                    "click_action"=> "0",
                    "web_view_heading"=> "",
                    "page_code"=> "5020",
                    "next_page"=> [],
                    "elements"=> []
                )
            );
        }
        $mrn = $data['data_global']['mrn'];
        $mrn = 'SHC076966';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sarvodayahospital19.com/pdm/patientmedicine/patient_medicine_api_mobile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'location' => $location  ,
                'mrn' => $mrn 
            ),
            CURLOPT_HTTPHEADER => array(
                'Cookie: ci_session=b113582899cbc5ab3cc6b118b5e7b8922ccfd3bf'
            ),
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return ['error' => $error_msg];
        }
        curl_close($curl);
        $data = json_decode($response, true);
        
        return array(
            "code" => "101",
            "message" => "data fetched successfully",
            "result" => $data
        );
    }

?>
