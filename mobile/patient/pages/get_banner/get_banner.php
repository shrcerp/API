<?php

    function get_banner($data){
        global $con;
        $date = date("Y-m-d");
        // $location = $data_self['location'];
        $sql = "select * from video_patient_coupon where status = 1 and start_date <= '$date' and end_date >= '$date' ";
        $result_data = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result_data);
         $coupons = [];
        if ($result_data && mysqli_num_rows($result_data) > 0) {
            while ($rows = mysqli_fetch_assoc($result_data)) {
                $coupons[] = $rows;
            }
        }

        // return as JSON for API
        echo json_encode([
            "code" => 101,
            "message" => "Coupons fetched successfully",
            "data" => $coupons
        ]);
        return;

        
        if(!is_array($row)){
            $a = array(
                "code" => "102"
                ,"message" => "Coupon Not Found"
                ,"result" =>  array()
            );
            echo json_encode($a);
            exit();
        }
        $data = [
            "discount_image" => $row['coupon_image'],
            "discount_per" => $row['discount_per']
        ];
        return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" =>  $data

      );
    }

?>