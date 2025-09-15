<?php


    function get_family_member($data){
        global $con;
        global $dev_url;
        $mobile = $data["data_global"]["mobile"];
        $selected_id = isset($data["selected_id"]) ? $data["selected_id"] : null;

        $sql = "SELECT * FROM `video_patient` WHERE mobile = '$mobile'";
        $result_data = mysqli_query($con, $sql);

        $result = [
            "code" => "101",
            "message" => "family member fetched successfully",
            "result" => [
                [
                    "title" => "Family members",
                    "layout_code" => "103",
                    "layout_des" => "dropdown",
                    "sub_text" => "",
                    "image" => "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                    "timestamp" => "",
                    "web_link" => "",
                    "web_view" => "0",
                    "click_action" => "0",
                    "web_view_heading" => "",
                    "page_code" => "5020",
                    "next_page" => [
                        "page_code" => "form_page",
                        "data_self" => $mobile,
                        "data_heading" => "New Registration",
                        "data_url" => "'.$dev_url.'patient_registration_form"
                    ],
                    "elements" => [],
                    "value" => "0"
                ]
            ]
        ];

        $i = 0;
        while($row = mysqli_fetch_assoc($result_data)) {
            $data_global_e = [
                "mobile" => $row["mobile"],
                "mrn"    => $row["mrn_no"],
                "id"     => $row["id"],
                "name"   => $row["patient_name"],
                "prefix" => $row["prefix"]
            ];

            // $data_global_e = encrypt_fun($data_global_e);

            if($row["gender"] == "M"){
                $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/male_icon.png";
            } else if($row["gender"] == "F"){
                $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/female_icon.png";
            } else {
                $avatar_icon = "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png";
            }

            $result["stack_children"][0]["elements"][] = [
                $i,
                ucwords(strtolower($row["patient_name"])),
                $avatar_icon,
                $data_global_e
            ];
            $i++;
        }

       
        // $result["stack_children"][0]["elements"][] = [
        //     $i,
        //     "New",
        //     "new",
        //     encrypt_fun(["mobile" => $mobile, "id" => "new"])
        // ];

       
        echo json_encode($result);
        exit;
    }



?>