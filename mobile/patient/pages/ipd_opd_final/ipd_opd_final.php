<?php
    function ipd_opd_final($data){
        global $con;
    
        // $mrn = $data['data_global']['mrn'];
        $mrn = 'SR1055081';
            
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sarvodayahospital19.com/pdm/API/ip_from_mrn',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('mrn' => $mrn),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=b4391faa3a96315824464fafbb0eab31e998b57c'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $postmanapi = json_decode($response, true);




        // $ip = $data['data_self']['ip'];
        $ip = $postmanapi['IP'];

        $sql = "SELECT * FROM patient_acknowledgement WHERE mrn = '$mrn' AND ip = '$ip' and status=1";
        $query = mysqli_query($con, $sql);

        if ($query && mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
            return [
                            "title"=> "",
                            "layout_code"=> "73-1",
                            "layout_des"=> "info_card",
                            "sub_text"=> "",
                            "image"=> "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                            "timestamp"=> "",
                            "web_link"=> "",
                            "web_view"=> "0",
                            "click_action"=> "0",
                            "web_view_heading"=> "",
                            "page_code"=> "5020",
                            "next_page"=> [],
                            "elements"=> $result
            ];
        }else {
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
                    "elements" => []  
                )
            );
        }

    }

?>