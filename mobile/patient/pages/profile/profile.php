<?php

    function get_profile_data($data){
      global $dev_url;
      $name = array_key_exists('name',$data["data_global"]) ? $data["data_global"]["name"] : $data["data_global"]["patient_name"] ;
      $mrn = array_key_exists('mrn',$data["data_global"]) ? $data["data_global"]["mrn"] : $data["data_global"]["mrn_no"] ;
      

      $result = '[
                    {
                        "title": "'.$name.'",
                        "layout_code": "312",
                        "title_heading": "icon_person",
                        "sub_text_heading": "icon_service",
                        "sub_text": "User",
                        "sub_text_2_heading": "icon_person",
                        "sub_text_2": "'.$data["data_global"]["mobile"].'",
                        "sub_text_3_heading": "icon_money",
                        "sub_text_3_text": "'.$mrn.'",
                        "star_rating": "5",
                        "star_rating_text": "Cumulative",
                        "layout_des": "user_profile",
                        "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                        "timestamp": "22 Feb 2021",
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "0",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "edit_icon": "0",
                        "edit_icon_heading": "icon_edit",
                        "next_page": {
                            "page_code": "form_page",
                            "data_self": "MDFjVEp2aFh4Qll5QXFoME81emNOQT09",
                            "data_heading": "Personal Information",
                            "data_url": "http://app.housepital.in/admin_new/Mobile_staff/form_personalinfo"
                        },
                        "elements": []
                    },
                    {
                          "type":"",
                          "layout_code":"102",
                          "header_title": "",
                          "sub_heading": "",
                          "image": "http://app.housepital.in/admin_new/data/mobile/1605676475049.png",
                          "ok_button":"0",
                          "next_page1": [],
                          "elements":[
                              {
                "title" : "Family Profile",
                "image" : "assets/UI_icons/Profile_1.png",
                "color" : "#FF5733",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "family_member",
                    "data_self" : "",
                    "data_heading" : "Family Profile",
                    "data_url" : "'.$dev_url .'family_member"
                  }
                  },
            {
                "title" : "My Reports",
                "image" : "assets/UI_icons/Reports.png",
                "color" : "#FF5733",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "view_data",
                    "data_self" :  "" ,
                    "data_heading" : "My Reports",
                    "data_url" : "'.$dev_url .'my_reports"
                  }
                  },
            {
                "title" : "Prescriptions",
                "image" : "assets/UI_icons/Prescription.png",
                "color" : "#FF5733",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "view_data",
                    "data_self" :  "" ,
                    "data_heading" : "My Prescriptions",
                    "data_url" : "'.$dev_url .'patient_medicine"
                  }
                  },
            {
                "title" : "Bills",
                "image" : "assets/UI_icons/bills_1.png",
                "color" : "#FF5733",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "coming_soon",
                    "data_self" :  "" ,
                    "data_heading" : "Bills",
                    "data_url" : "'.$dev_url .'Bills"
                  }
                  },
            {
                "title" : "Medical Reports",
                "image" : "assets/UI_icons/MRD.png",
                "color" : "#FF5733",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "coming_soon",
                    "data_self" :  "" ,
                    "data_heading" : "Medical Reports",
                    "data_url" : "'.$dev_url .'medical_reports"
                  }
                  },
                  {
                "title" : "Lab Test",
                "image" : "assets/UI_icons/LabTest.png",
                "color" : "#6495ED",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "page_view",
                    "data_self" :  "" ,
                    "type": "lab",
                    "data_heading" : "Lab Test",
                    "data_url" : "'.$dev_url .'doctor_lab"
                  }
                  },
                  {
                "title" : "Booking History",
                "image" : "assets/UI_icons/booking.png",
                "color" : "#6495ED",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "view_data",
                    "data_self" :  "" ,
                    "data_heading" : "Lab Test",
                    "data_url" : "'.$dev_url .'my_booking"
                  }
                  },
            {
                "title" : "Pharmacy",
                "image" : "assets/UI_icons/pharmacy.png",
                "color" : "#6495ED",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "page_view",
                    "data_self" :  "" ,
                    "type": "pharmacy",
                    "data_heading" : "Pharmacy",
                    "data_url" : "'.$dev_url .'patient_medicine"
                  }
                  },
            {
                "title" : "Attendent Pass",
                "image" : "assets/UI_icons/AttendantPass.png",
                "color" : "#40E0D0",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "page_view",
                    "data_self" :  "" ,
                    "type": "attendant_pass",
                    "data_heading" : "Attendent Pass",
                    "data_url" : "'.$dev_url .'attendent_pass"
                  }
                  },
            {
                "title" : "E-KYC",
                "image" : "assets/UI_icons/EKYC_1.png",
                "color" : "#FFBF00",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "coming_soon",
                    "data_self" :  "" ,
                    "data_heading" : "E-KYC",
                    "data_url" : "'.$dev_url .'e_kyc"
                  }
                  },
            {
                "title" : "Our Accreditations",
                "image" : "assets/UI_icons/Accreditation.png",
                "color" : "#FFBF00",
                "click_action": "1",
                "next_page" : {
                    "page_code" : "accreditation",
                    "data_self" :  "" ,
                    "data_heading" : "Our Accreditations",
                    "data_url" : "'.$dev_url .'OurAccreditations"
                  }
                  }
                  
                          ]
                      },
                      {
                      "title" : "OTHER INFORMATION",
                      "layout_code" : "313",
                      "elements" : [
                          {
                              "title" : "Terms & Conditions",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "html_page",
                                  "type":"tnc",
                                  "data_heading" : "Terms & Conditions",
                                  "data_url" : "'.$dev_url .'Terms_Conditions"
                              }
                            },
                            {
                              "title" : "Privacy Policy",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "html_page",
                                  "type":"privacy",
                                  "data_heading" : "Privacy Policy",
                                  "data_url" : "'.$dev_url .'privacy_policy"
                              }
                            },
                            {
                              "title" : "Refund Policy",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "html_page",
                                  "type":"refund",
                                  "data_heading" : "Refund Policy",
                                  "data_url" : "'.$dev_url .'Refund_Policy"
                                }
                            },
                            {
                              "title" : "Delete Account",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "delete",
                                  "data_heading" : "Delete Account",
                                  "data_url" : "'.$dev_url .'account_delete"
                                }
                            },
                            {
                              "title" : "Share",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "share",
                                  "data_heading" : "Share",
                                  "data_url" : "'.$dev_url .'Share"
                                }
                            },
                            {
                              "title" : "Logout",
                              "color" : "#FF5733",
                              "click_action": "1",
                              "next_page" : {
                                  "page_code" : "logout",
                                  "data_heading" : "Share",
                                  "data_url" : "'.$dev_url .'Share"
                                }
                            }

                          ]
                        }
        ]';
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => json_decode($result,1)
      );

    }

    // ,
    // {
    //     "title" : "Feedback",
    //     "color" : "#FF5733",
    //     "click_action": "1",
    //     "next_page" : {
    //         "page_code" : "view_data",
    //         "data_heading" : "Feedback",
    //         "data_url" : "'.$dev_url .'Feedback"
    //       }
    //   }

?>
