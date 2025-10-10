<?php
    function ipd_opd_final($data){
        global $con;
    
        // $mrn = $data['data_global']['mrn'];
        $mrn = 'SR588436';
        // $ip = $data['data_self']['ip'];
        $ip = 'IP123';

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