<?php

    function get_notifications($data){
        $mrn = $data['data_global']['mrn'];
        global $con;

        $sql = "SELECT b.title,b.body,b.icon,b.status,b.id FROM video_patient a JOIN mobile_notification b ON a.id = b.user_id WHERE (a.mrn_no = '$mrn' OR a.mrn_nodia = '$mrn') ";
       
        $query = mysqli_query($con, $sql);
        if (!$query || mysqli_num_rows($query) == 0) {
            return [
                "code" => "102",
                "message" => "No Notifications Found",
                "result" => []
            ];
        }
        
        $result = [
            "title" => "Notifications",
            "layout_code"=> "311",
            "elements" => []

        ];
        while($row = mysqli_fetch_assoc($query)){   
            $result['elements'][] = $row;
        }

        return $result;  
    }



?>