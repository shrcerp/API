<?php
      function patient_registration_form($data){
        global $dev_url;
        $data_self = encrypt_fun($data['data_global']);
        $form = '{
                "code": "101",
                "message": "Success",
                "result": {
                  "submit_form_url": "'.$dev_url .'submit_patient_registration",
                  "elements": [
                    {
                        "title": "",
                        "text": "",
                        "layout_code": "20/5-5",
                        "layout_dis": "option",
                        "configuration": "",
                        "elements": [
                            {
                                "title": "Prefix",
                                "key": "prefix",
                                "text": "",
                                "layout_code": "205",
                                "layout_dis": "option",
                                "configuration": {
                                    "option_value": [
                                        [
                                            "Mr.",
                                            "Mr."
                                        ],
                                        [
                                            "Mrs.",
                                            "Mrs."
                                        ],
                                        [
                                            "Miss.",
                                            "Miss."
                                        ],
                                        [
                                            "Master.",
                                            "Master"
                                        ],
                                        [
                                            "Baby boy of",
                                            "Baby boy of"
                                        ],
                                        [
                                            "Baby girl of",
                                            "Baby girl of"
                                        ],
                                        [
                                            "Mx.",
                                            "Mx."
                                        ],
                                        [
                                            "Dr.",
                                            "Dr."
                                        ],
                                        [
                                            "Prof.",
                                            "Prof."
                                        ]
                                    ]
                                },
                                "value": "",
                                "validation": [
                                    "require"
                                ]
                            },
                            {
                                "title": "Gender",
                                "text": "",
                                "key": "gender",
                                "layout_code": "205",
                                "layout_dis": "option",
                                "configuration": {
                                    "option_value": [
                                        [
                                            "M",
                                            "Male"
                                        ],
                                        [
                                            "F",
                                            "Female"
                                        ],
                                        [
                                            "X",
                                            "Other"
                                        ]
                                    ]
                                },
                                "value": "",
                                "validation": [
                                    "require"
                                ]
                            }
                        ]
                    },
                    
                    {
                        "title": "Patient Name",
                        "key": "patient_name",
                        "text": "",
                        "layout_code": "204",
                        "layout_dis": "input",
                        "configuration": [],
                        "value": "",
                        "validation": [
                            "require"
                        ]
                    },
                    
                    {
                        "title": "Address",
                        "text": "",
                        "key": "address",
                        "layout_code": "202",
                        "layout_dis": "textarea",
                        "configuration": [],
                        "value": "",
                        "validation": [
                            "require"
                        ]
                    },
                    {
                        "title": "Date Of Birth",
                        "text": "",
                        "key": "dob",
                        "layout_code": "201",
                        "layout_dis": "datepicker",
                        "configuration": {
                            "from_date": "1930-01-01",
                            "to_date": "2022-11-10",
                            "start_date": "2022-11-04"
                        },
                        "value": "",
                        "validation": [
                            "require"
                        ]
                    },
                    {
                        "title": "",
                        "text": "",
                        "layout_code": "20/5-5",
                        "layout_dis": "option",
                        "configuration": "",
                        "elements": [
                            {
                                "title": "State",
                                "text": "",
                                "key": "state",
                                "layout_code": "205",
                                "layout_dis": "option",
                                "configuration": {
                                    "option_value": [
                                        [
                                            1,
                                            "ANDAMAN & NICOBAR ISLANDS"
                                        ],
                                        [
                                            2,
                                            "ANDHRA PRADESH"
                                        ],
                                        [
                                            3,
                                            "ARUNACHAL PRADESH"
                                        ],
                                        [
                                            4,
                                            "ASSAM"
                                        ],
                                        [
                                            5,
                                            "BIHAR"
                                        ],
                                        [
                                            6,
                                            "CHANDIGARH"
                                        ],
                                        [
                                            7,
                                            "CHATTISGARH"
                                        ],
                                        [
                                            8,
                                            "DADRA & NAGAR HAVELI"
                                        ],
                                        [
                                            9,
                                            "DAMAN & DIU"
                                        ],
                                        [
                                            10,
                                            "DELHI"
                                        ],
                                        [
                                            11,
                                            "GOA"
                                        ],
                                        [
                                            12,
                                            "GUJARAT"
                                        ],
                                        [
                                            13,
                                            "HARYANA"
                                        ],
                                        [
                                            14,
                                            "HIMACHAL PRADESH"
                                        ],
                                        [
                                            15,
                                            "JAMMU & KASHMIR"
                                        ],
                                        [
                                            16,
                                            "JHARKHAND"
                                        ],
                                        [
                                            17,
                                            "KARNATAKA"
                                        ],
                                        [
                                            18,
                                            "KERALA"
                                        ],
                                        [
                                            19,
                                            "LAKSHADWEEP"
                                        ],
                                        [
                                            20,
                                            "MADHYA PRADESH"
                                        ],
                                        [
                                            21,
                                            "MAHARASHTRA"
                                        ],
                                        [
                                            22,
                                            "MANIPUR"
                                        ],
                                        [
                                            23,
                                            "MEGHALAYA"
                                        ],
                                        [
                                            24,
                                            "MIZORAM"
                                        ],
                                        [
                                            25,
                                            "NAGALAND"
                                        ],
                                        [
                                            26,
                                            "ODISHA"
                                        ],
                                        [
                                            27,
                                            "PONDICHERRY"
                                        ],
                                        [
                                            28,
                                            "PUNJAB"
                                        ],
                                        [
                                            29,
                                            "RAJASTHAN"
                                        ],
                                        [
                                            30,
                                            "SIKKIM"
                                        ],
                                        [
                                            31,
                                            "TAMIL NADU"
                                        ],
                                        [
                                            32,
                                            "TELANGANA"
                                        ],
                                        [
                                            33,
                                            "TRIPURA"
                                        ],
                                        [
                                            34,
                                            "UTTAR PRADESH"
                                        ],
                                        [
                                            35,
                                            "UTTARAKHAND"
                                        ],
                                        [
                                            36,
                                            "WEST BENGAL"
                                        ]
                                    ]
                                },
                                "value": "",
                                "validation": [
                                    "require"
                                ],
                                "change_option_value": "1",
                                "change_url": "'.$dev_url .'/get_city_data"
                            },
                            {
                                "title": "City",
                                "text": "",
                                "key": "city",
                                "layout_code": "205",
                                "layout_dis": "option",
                                "configuration": {
                                    "option_value": []
                                },
                                "value": "",
                                "validation": [
                                    "require"
                                ]
                            }
                        ]
                    },
                    
                    {
                        "title": "Pin Code",
                        "key": "pin_code",
                        "text": "",
                        "layout_code": "204",
                        "layout_dis": "input",
                        "configuration": [],
                        "value": "",
                        "validation": [
                            "require"
                        ]
                    },
                    {
                        "title": "I hereby confirm that the information provided in this registration form is true and correct to the best of my knowledge, and I agree to abide by the terms and conditions.",
                        "key": "Terms",
                        "text": "",
                        "layout_code": "206",
                        "layout_dis": "input",
                        "configuration": [],
                        "value": "",
                        "validation": [
                            "require"
                        ]
                    }
                  ],
                  "submit_button_name": "Register",
                  "submit_button_background_color": "#FFFFFF",
                  "submit_button_font_color": "#000000",
                  "submit_button_border_color": "#666666",
                  "data_self": "'.$data_self.'",
                  "next_page": {
                      "page_code": "home",
                      "save_data_global": "1",
                      "data_self": "'.$data_self.'",
                      "data_heading": "Home",
                      "data_url": "'.$dev_url .'home"
                  }
                }
              }';

            return json_decode($form,1);


      }

      function get_state_list(){

          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listStates/1/?countryID=1',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          ));

          $response = curl_exec($curl);
          curl_close($curl);

          $response = json_decode($response,1);
          $option = array();
          foreach($response["data"] as $i => $val){
                $option[] = array($val["stateID"], $val["stateName"]);
          }
          return json_encode($option);
      }

?>
