<?php
      function form_a_form($data){
        $data_self = encrypt_fun($data['data_global']);
        $form = '{
                      "code": "101",
                      "message": "Success",
                      "result": {
                          "submit_form_url": "",
                          "elements": [
                              {
                                  "title": "SIGN IN (In Operating Theater Before Induction of Anesthesia) :",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "199",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Part A",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "199",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Patient Identification (Full Name, MR. No.)",
                                  "key": "patient_name1",
                                  "text": "",
                                  "layout_code": "205",
                                  "layout_dis": "radio",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Surgical Procedure to be performed",
                                  "key": "patient_name2",
                                  "text": "",
                                  "layout_code": "205",
                                  "layout_dis": "radio",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Site/Surgical Procedure with marking",
                                  "key": "patient_name3",
                                  "text": "",
                                  "layout_code": "205",
                                  "layout_dis": "radio",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Documentation completed",
                                  "key": "patient_name4",
                                  "text": "",
                                  "layout_code": "205",
                                  "layout_dis": "radio",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Consent Forms/Surgery",
                                              "Consent Forms/Surgery"
                                          ],
                                          [
                                              "Anesthesia completed/signed",
                                              "Anesthesia completed/signed"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Known Allergies",
                                  "key": "patient_name5",
                                  "text": "",
                                  "layout_code": "205",
                                  "layout_dis": "radio",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "OT Technician: Transfer the patient to the operating room only after Part A is completed and signed by Anesthetist.",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "199",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "-------------------------------------------------------",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "199",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Part B",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "199",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Part B",
                                  "key": "patient_name0",
                                  "text": "",
                                  "layout_code": "01",
                                  "layout_dis": "input",
                                  "configuration": [],
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Is Patient Identification reconfirmed?",
                                  "text": "",
                                  "key": "prefix1",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Known Allergy",
                                  "text": "",
                                  "key": "prefix2",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Anesthesia Safety Check completed",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Risk of blood loss >500ml (or >7ml/kg in children):",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "IV Access and fluids planned",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Blood products available",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Lab Results available",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Labeled Radiological Results available & displayed",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Implants required are available:",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Special equipment required are available",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Airway aspiration risk",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              },
                              {
                                  "title": "Anesthesia equipment/assistance available for airway",
                                  "text": "",
                                  "key": "prefix3",
                                  "layout_code": "205",
                                  "layout_dis": "option",
                                  "configuration": {
                                      "option_value": [
                                          [
                                              "Yes",
                                              "Yes"
                                          ],
                                          [
                                              "No",
                                              "No"
                                          ]
                                      ]
                                  },
                                  "value": "",
                                  "validation": [
                                      "require"
                                  ]
                              }
                          ],
                          "submit_button_name": "Sign In",
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
