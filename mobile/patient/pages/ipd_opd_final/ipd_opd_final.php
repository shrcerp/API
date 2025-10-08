<?php
    function ipd_opd_final($data){
        $location = $data['data_self']['location'];
        if(empty($location)){
            return array(
                "code"=>"101",
                "message"=>"please select location",
                "result" => [
                     "title"=> "location not found",
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
                ]
            );
        }
        $mrn = $data['data_global']['mrn'];
        $mrn = 'SR1054138';

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.sarvodayahospital.com/Permission/ipd_opd_bill_final',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('mrn' => $mrn,'location' => $location),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=fpcb8j4do83adao3tk1mo010t873vjst'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        if (!empty($response)) {
            $decoded = json_decode($response, true);
        
            if (is_array($decoded) && count($decoded) > 0) {
                return array(
                    "code" => "101",
                    "message" => "success",
                    "result" => array(
                        "title" => "Document Found",
                        "layout_code" => "1",
                        "layout_des" => "info_card",
                        "sub_text" => "",
                        "image" => "",
                        "timestamp" => "",
                        "web_link" => "",
                        "web_view" => "0",
                        "click_action" => "0",
                        "web_view_heading" => "",
                        "page_code" => "5020",
                        "next_page" => [],
                        "elements" => $decoded   // <--- response data added here
                    )
                );
            }
        }

        return array(
            "code" => "101",
            "message" => "No Data Found for this MRN",
            "result" => array(
                "title" => "No Data Found for this MRN",
                "layout_code" => "1",
                "layout_des" => "info_card",
                "sub_text" => "",
                "image" => "",
                "timestamp" => "",
                "web_link" => "",
                "web_view" => "0",
                "click_action" => "0",
                "web_view_heading" => "",
                "page_code" => "5020",
                "next_page" => [],
                "elements" => []  // empty when no response
            )
        );

    }

?>