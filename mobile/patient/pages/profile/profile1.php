<?php

function get_profile_data($data) {
    global $con;
    global $dev_url;


  

    // $mrn = $data['data_global']['mrn'];
    // $sql = "SELECT patient_name, mobile FROM video_patient WHERE (mrn_no = '$mrn' OR mrn_nodia = '$mrn')";
    // $query = mysqli_query($con, $sql);

    $other_info = [
        "title" => "other_info",
        "layout_code" => "313",
        "elements" => [
             [
                "title" => "Terms & Conditions",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_heading" => "Terms & Conditions",
                    "data_url" => $dev_url . "Terms & Conditions"
                ]
            ],
            [
                "title" => "Refund Policy",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_heading" => "Refund Policy",
                    "data_url" => $dev_url . "Refund Policy"
                ]
            ],
            [
                "title" => "Delete Account",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_heading" => "Delete Account",
                    "data_url" => $dev_url . "Delete Account"
                ]
            ],
            [
                "title" => "Share",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_heading" => "Share",
                    "data_url" => $dev_url . "Share"
                ]
            ],
            [
                "title" => "Feedback",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_heading" => "Feedback",
                    "data_url" => $dev_url . "Feedback"
                ]
            ],

        ]

    ];

  

        $elements = [
            [
                "title" => "Family Profile",
                "image" => "familyprofile.png",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" => "",
                    "data_heading" => "Family Profile",
                    "data_url" => $dev_url . "family_member"
                ]
            ],
            [
                "title" => "My Reports",
                "image" => "Reports.png",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "My Reports",
                    "data_url" => $dev_url . "my_reports"
                ]
            ],
            [
                "title" => "Prescriptions",
                "image" => "lib/assets/icons/prescriptions_icon.png",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "My Prescriptions",
                    "data_url" => $dev_url . "patient_medicine"
                ]
            ],
            [
                "title" => "Bills",
                "image" => "lib/assets/icons/Bills.png",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "Bills",
                    "data_url" => $dev_url . "Bills"
                ]
            ],
            [
                "title" => "Medical Reports",
                "image" => "lib/assets/icons/Medical Reports.png",
                "color" => "#FF5733",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "Medical Reports",
                    "data_url" => $dev_url . "medical_reports"
                ]
            ],
            [
                "title" => "Lab Test",
                "image" => "lib/assets/icons/lab_history_icon.png",
                "color" => "#6495ED",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "Lab Test",
                    "data_url" => $dev_url . "doctor_prescribed_lab"
                ]
            ],
            [
                "title" => "Attendent Pass",
                "image" => "lib/assets/icons/attendent_icon.png",
                "color" => "#40E0D0",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "Attendent Pass",
                    "data_url" => $dev_url . "attendent_pass"
                ]
            ],
            [
                "title" => "E-KYC",
                "image" => "lib/assets/icons/kyc_icon.png",
                "color" => "#FFBF00",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "E-KYC",
                    "data_url" => $dev_url . "kyc"
                ]
            ],
            [
                "title" => "Our Accreditations",
                "image" => "lib/assets/icons/Our Accreditations.png",
                "color" => "#FFBF00",
                "click_action"=> "1",
                "next_page" => [
                    "page_code" => "view_data",
                    "data_self" =>  "" ,
                    "data_heading" => "Our Accreditations",
                    "data_url" => $dev_url . "Our Accreditations"
                ]
            ]
        ];

        $result_card = [
            "title" => "profile",
            "layout_code" => "312",
            "layout_des" => "info_card",
            "patient_image" => "image.png",
            "sub_text" => "",
            "patient_name" => $data['data_global']['name'],
            "mobile" => $data['data_global']['mobile'],
            "layout_des" => "top_header",
            "timestamp" => "",
            "web_link" => "",
            "web_view" => "0",
            "click_action" => "0",
            "web_view_heading" => "",
            "page_code" => "5020",
            "next_page" => [],
            "elements" => $elements
        ];

        return [
            "code" => "101",
            "message" => "successful",
            "result" => [$result_card],
            "other_info" => $other_info
        ];
        
}
?>
