<?php
function get_family_member($data){
    global $con;
    global $dev_url;



    $mobile      = $data["data_global"]["mobile"];
    $selected_id = isset($data["data_global"]["id"]) ? $data["data_global"]["id"] : null;

    $sql = "SELECT * FROM `video_patient` WHERE mobile = '$mobile'";
    $result_data = mysqli_query($con, $sql);


          $switch_selection = get_user_data($data["data_global"]["mobile"],$data["data_global"]["id"]);

    $result = [
        "code" => "101",
        "message" => "family member fetched successfully",
        "result" => $switch_selection
    ];

    return $result;
}


 function get_user_data($mobile,$selected_id){
        global $con;
        global $dev_url;
        $sql = "SELECT * FROM `video_patient` where mobile = '$mobile'";
        $query = cj_query($sql);
        $result = '
               {
                    "title": "Hi",
                    "layout_code": "103",
                    "layout_des": "dropdown",
                    "sub_text": "",
                    "image": "https://sarvodayahospital19.com//api/mobile/images/male_icon.png",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "member_id": "0",
                    "next_page": {
                        "page_code": "form_page",
                        "data_self": "'.$mobile.'",
                        "data_heading": "New Registration",
                        "data_url": "'.$dev_url.'patient_registration_form"
                    },
                    "value": "0",
                    "elements": []
                } ';

        $result = json_decode($result,1);

        $i = 0;
        $select_value = 0;
        $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png";
        while($row = cj_fetch_array($query)){
            $data_global_e = array(
                  "mobile" => $row["mobile"]
                  ,"mrn" => $row["mrn_no"]
                  ,"id" => $row["id"]
                  ,"name" => $row["patient_name"]
                  ,"prefix" => $row["prefix"]
            );
            $data_global_e = encrypt_fun($data_global_e);
            if($selected_id == $row["id"]){
                $select_value = $i;
                if($row["gender"] == "M"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/male_icon.png";
                }else if($row["gender"] == "F"){
                    $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/female_icon.png";
                }
            }
            $result["elements"][] = array(
                $i
                ,ucwords(strtolower($row["patient_name"]))
                ,$avatar_icon
                  ,$data_global_e
            );
            $i++;
        }
        // $result['stack_children'][0]["image"] = $avatar_icon;

        $result["elements"][] = array(
            $i
              ,"New"
              ,"new"
            ,"UGwrMUt1VkkxdmtHT0wrQUNJSkxDWWVRRTNJd1dSSWdYajVscVpCK0VjSnFSRFkrZ21GQWZkOFFMMUtQdzkxZGZqNnJ2cC9mWm0vSXBzdTRHRFJwTVF2SC9QRHp4NTI3QUp1R1BScjNNS253N1ludUJQWXBmVUtPTHJ6NGtvL1B6RVk1dFhqV0JHYlZvcmtxNUtzZ2JYbzJzeFZuMXJ3RDUzYzdTTloxc01XS3NCeGdYMkdtdmxZTXVyRHpFaTBJT0JOaG1LNGU1bXBiK0dkK1o4dGY3c1daaEF4ZkZIMnhkeUo0b2hCS0oxUm1qaVpKS1IrRW94aVFSRy9KbS9UTmpoWUc2L05xZlUvRk5zTVY1TG04Q3YwS0hNVUE2UTE2ZXdSVFgxRUF6UjdsSWNmZVB4WnZKYnpzMGRKV25JK01IQTlOb0NnQnhLYVR2cEpFRnF3c2Z1VmFqV2ltMlljb1cxZXZ5SGl2SS8zNU53Qk5TMVY3YVE5QlJWSnRJdmdlL1JSQlNBeWR0eUk3K2NIWDFvVkc3T2MvUEE5Wk45dnJxUFpzaFFGa1RzUmYrOVIycTNJTGNDRDJrZ0t3UzI1a3Y1Q0t3SHRvWERWL0pwSFZ0QkFabGt5SlZpYWw5dlNvdjMwZzk3UWJ0a1VoQVFBUUdZTGpnb0lhMGQ1OE9GZjh0U0dyOU96bWFFR1Q4RXVobEhZSGVnPT0="

        );

        $result["value"] =   (string)$select_value;

        return $result;
        // return json_encode($result);
    }
?>





