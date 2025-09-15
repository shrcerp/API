<?php

    function get_coupon_data($data){
        global $con;
        $date = date("Y-m-d");
        // print_r($data);
        // return;
        $coupon_code = $_POST["coupon_code"];
        $location = $data["data_self"]["location"];
       
        // $location = 'sarvodaya-hospital-research-centre-sector-8';
        $sql = "select * from video_patient_coupon where coupon_code = '$coupon_code' and status = 1 and start_date <= '$date' and end_date >= '$date' and location='$location'";
        $result_data = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result_data);
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