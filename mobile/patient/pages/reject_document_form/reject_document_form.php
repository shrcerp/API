<?php



          function reject_document_form_fun($data){

            global $con;
            $search = "";
            $data_global = $data["data_global"];
            $data_self = $data["data_self"];

            $patient_id = $data_global["id"];



            $data_self_e = encrypt_fun($data_self);
            $sql_doc = "select a.document_name,a.id,a.document_type from m_document a
                        where a.id in (".$data_self["m_document_id"].")";
            $query_doc = cj_query($sql_doc);
            $elements_new = array();
            while($row_doc = cj_fetch_array($query_doc)){
                  $elements_new[] = elements_code($row_doc["document_name"],$row_doc["id"],$row_doc["document_type"],"");
            }

            $result = '{
                      "code": "101",
                      "message": "Success",
                      "result": {
                          "submit_form_url": "https://sarvodayahospital.com/api/mobile/patient/add_insurance_stage_reject_submit",
                          "elements": '.json_encode($elements_new).',
                          "submit_button_name": "Submit",
                          "submit_button_background_color": "#FFFFFF",
                          "submit_button_font_color": "#000000",
                          "submit_button_border_color": "#666666",
                          "data_self": "'.$data_self_e.'",
                          "next_page": {
                              "page_code": "home",
                              "data_self": "MG12NEp3bDFQUGlNQTE4bFJwQkg1aXZzQU5pdVd0S3h4c2hBUjVYYjlYS21OTytCd1dWK2xUcEZNQXJ5QmhtTXBsTGdrUGVscXJsUmh2MkNXQmVNSkNtSTB0YkxSU2FsQUZkcnhHY0xYMWwxWEJHZEliUzVub1BldWVEWk94SDc=",
                              "data_heading": "Home",
                              "data_url": "https://sarvodayahospital.com/api/mobile/patient/home"
                          }
                      }
                  }';
            $result =  json_decode($result,1);
            return $result;
            return array(
                "code" => "101"
                ,"result" => $result
                ,"messages" => "success"
            );

                  //return $result;


          }


          function elements_code($title,$key,$doc_type,$value){

                if($doc_type == "1"){

                      $a = '{
                              "title": "'.$title.'",
                              "key" : "'.$key.'",
                              "layout_code": "212",
                              "layout_dis": "imageUpload",
                              "validation": [
                                  "require"
                              ],
                              "configuration": [],
                              "value": "'.$value.'"
                          }';

                }else if($doc_type == "2"){

                      $a = '{
                              "title": "'.$title.'",
                              "key" : "'.$key.'",
                              "layout_code": "204",
                              "layout_dis": "input",
                              "validation": [
                                  "require"
                              ],
                              "configuration": [],
                              "value": "'.$value.'"
                          }';

                }else if($doc_type == "4"){

                      $a = '{
                              "title": "'.$title.'",
                              "key" : "'.$key.'",
                              "layout_code": "202",
                              "layout_dis": "textarea",
                              "validation": [
                                  "require"
                              ],
                              "configuration": [],
                              "value": "'.$value.'"
                          }';

                }else if($doc_type == "3"){

                      $a = '{
                              "title": "'.$title.'",
                              "key" : "'.$key.'",
                              "layout_code": "205",
                              "layout_dis": "option",
                              "validation": [
                                  "require"
                              ],
                              "configuration": [],
                              "value": "'.$value.'"
                          }';

                }

                return json_decode($a);
          }



?>
