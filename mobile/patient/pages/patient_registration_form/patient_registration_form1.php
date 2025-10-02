<?php
      function patient_registration_form($data){
        $data_self = encrypt_fun($data['data_global']);
        $form = '{
                "code": "101",
                "message": "Success",
                "result": {
                  "submit_form_url": "https://sarvodayahospital.com/api/mobile/patient/submit_patient_registration",
                  "elements": [
                      {
                          "title": "Prefix",
                          "text": "",
                          "key" : "prefix",
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
                          "title": "Patient Name",
                          "key" : "patient_name",
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
                          "title": "Gender",
                          "text": "",
                          "key" : "gender",
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
                      },
                      {
                          "title": "Address",
                          "text": "",
                          "key" : "address",
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
                          "key" : "dob",
                          "layout_code": "201",
                          "layout_dis": "datepicker",
                          "configuration": {
                              "from_date": "1930-01-01",
                              "to_date": "'.date('Y-m-d').'",
                              "start_date": ""
                          },
                          "value": ""
                      },
                      {
                          "title": "State",
                          "text": "",
                          "key" : "state",
                          "layout_code": "205",
                          "layout_dis": "option",
                          "configuration": {
                              "option_value": '.get_state_list().'
                          },
                          "value": "",
                          "validation": [
                              "require"
                          ]
                      },
                      {
                          "title": "Pin Code",
                          "key" : "pin_code",
                          "text": "",
                          "layout_code": "204",
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
                      "data_url": "https://sarvodayahospital.com/api/mobile/patient/home"
                  }
                }
              }';

            return json_decode($form,1);


      }

      function get_state_list(){

          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://mx.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listStates/1/?countryID=1',
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
