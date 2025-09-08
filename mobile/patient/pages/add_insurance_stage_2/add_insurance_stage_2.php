<?php


    function add_insurance_stage_2_form($data){

      global $con;
      $search = "";
      $data_global = $data["data_global"];
      if($data_global["id"] == "0"){
          $data_global["id"] = "3";
      }
      $patient_id = $data_global["id"];
      $sql = "select b.document_type from va_patient_insurance a
              inner join m_panel b on b.id = a.m_panel_id
              where a.status = '1' and b.id='1' order by a.id desc limit 1";
      $query = cj_query($sql);
      $doc_data = cj_fetch_array($query);

      if(!count($doc_data)){
        return array(
            "code" => "101"
            ,"result" => array()
            ,"messages" => "No Insurance found"
        );
      }



      $sql_doc = "select a.document_name,a.id,a.document_type from m_document a
                  where a.id in (".$doc_data["document_type"].")";

      $query_doc = cj_query($sql_doc);
      $elements_new = array();
      while($row_doc = cj_fetch_array($query_doc)){
            $elements_new[] = elements_code($row_doc["document_name"],$row_doc["id"],$row_doc["document_type"],"");
      }


      $result = '{
                "code": "101",
                "message": "Success",
                "result": {
                    "submit_form_url": "https://sarvodayahospital19.com/api/mobile/patient/add_insurance_stage_2_submit",
                    "elements": '.json_encode($elements_new).',
                    "submit_button_name": "Submit",
                    "submit_button_background_color": "#FFFFFF",
                    "submit_button_font_color": "#000000",
                    "submit_button_border_color": "#666666",
                    "data_self": "MG12NEp3bDFQUGlNQTE4bFJwQkg1aXZzQU5pdVd0S3h4c2hBUjVYYjlYS21OTytCd1dWK2xUcEZNQXJ5QmhtTXBsTGdrUGVscXJsUmh2MkNXQmVNSkNtSTB0YkxSU2FsQUZkcnhHY0xYMWwxWEJHZEliUzVub1BldWVEWk94SDc=",
                    "next_page": {
                        "page_code": "home",
                        "data_self": "MG12NEp3bDFQUGlNQTE4bFJwQkg1aXZzQU5pdVd0S3h4c2hBUjVYYjlYS21OTytCd1dWK2xUcEZNQXJ5QmhtTXBsTGdrUGVscXJsUmh2MkNXQmVNSkNtSTB0YkxSU2FsQUZkcnhHY0xYMWwxWEJHZEliUzVub1BldWVEWk94SDc=",
                        "data_heading": "Home",
                        "data_url": "https://sarvodayahospital19.com/api/mobile/patient/home"
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
                        "validation": [],
                        "configuration": [],
                        "value": "'.$value.'"
                    }';

          }else if($doc_type == "2"){

                $a = '{
                        "title": "'.$title.'",
                        "key" : "'.$key.'",
                        "layout_code": "204",
                        "layout_dis": "input",
                        "validation": [],
                        "configuration": [],
                        "value": "'.$value.'"
                    }';

          }else if($doc_type == "4"){

                $a = '{
                        "title": "'.$title.'",
                        "key" : "'.$key.'",
                        "layout_code": "202",
                        "layout_dis": "textarea",
                        "validation": [],
                        "configuration": [],
                        "value": "'.$value.'"
                    }';

          }else if($doc_type == "3"){

                $a = '{
                        "title": "'.$title.'",
                        "key" : "'.$key.'",
                        "layout_code": "205",
                        "layout_dis": "option",
                        "validation": [  ],
                        "configuration": [],
                        "value": "'.$value.'"
                    }';

          }

          return json_decode($a);
    }


?>
