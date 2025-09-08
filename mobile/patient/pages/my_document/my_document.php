<?php





    function get_my_docuemnt($data){
      //print_r($data);
      $result = array();
      $patient_id = $data["data_global"]["id"];






      $result = '[
                    {
                        "title": "",
                        "layout_code": "73",
                        "layout_des": "info_card",
                        "sub_text": "",
                        "image": "",
                        "timestamp": "",
                        "web_link": "",
                        "web_view": "0",
                        "click_action": "0",
                        "web_view_heading": "",
                        "page_code": "5020",
                        "next_page": [],
                        "elements": [

                ]
              }
            ]';
      $result = json_decode($result,1);

      $sql = "select a.m_document_id,a.id,a.reject_reason,a.status,a.value,b.document_name,b.document_type,a.is_confirm from m_patient_document a
              inner join m_document b on b.id = a.m_document_id
              where a.video_patient_id = '$patient_id' and document_type = '1' order by a.is_confirm,a.status";
      $query = cj_query($sql);
      while($row = cj_fetch_array($query)){
            if($row["document_type"] == "1"){
                $row["value"] = "https://sarvodayahospital19.com/admin/data/app/".$row["value"];
            }

            $is_confirm = "Pending for Approval";
            if($row["is_confirm"] == "1"){
                $is_confirm = "Approved";
            }

            $ext = pathinfo($row["value"], PATHINFO_EXTENSION);

            if($row["status"] == "3"){
                $is_confirm = "Rejected - ".$row["reject_reason"];
                $data_self_e = array(
                      "m_document_id" => $row["m_document_id"]

                      ,"id" => $row["id"]

                );
                $data_self_e = encrypt_fun($data_self_e);
                $next_page = array(
                  "page_code" => "form_page",
                  "data_self" => $data_self_e,
                  "data_heading" => "Upload  - ".$row["document_name"],
                  "data_url" =>"https://sarvodayahospital19.com/api/mobile/patient/reject_document_form"
                );
                $click_action = "1";
            }else   if($row["status"] == "4"){
                  $is_confirm = "Document Pending";
                  $data_self_e = array(
                        "m_document_id" => $row["m_document_id"]

                        ,"id" => $row["id"]

                  );
                  $data_self_e = encrypt_fun($data_self_e);
                  $next_page = array(
                    "page_code" => "form_page",
                    "data_self" => $data_self_e,
                    "data_heading" => "Upload  - ".$row["document_name"],
                    "data_url" =>"https://sarvodayahospital19.com/api/mobile/patient/reject_document_form"
                  );
                  $click_action = "1";
              }else if($ext == "png" || $ext == "jpeg" || $ext == "jpg"){
                $next_page = array(
                  "page_code" => "web_view",
                  "data_self"=> "",
                  "data_heading"=> $row["document_name"],
                  "data_url"=> "https://sarvodayahospital19.com/api/web_view.php?token=".$row["value"]
                );
                $click_action = "1";
            }else{
                $next_page = array(
                  "page_code" => "pdf_view",
                  "data_self" => "",
                  "data_heading" => $row["document_name"],
                  "data_url" => $row["value"]
                );
                $click_action = "2";

            }

           $r= '{
                "image": "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                "title": "'.$row["document_name"].'",
                "sub_text": "'.$is_confirm.'",
                "sub_text_1": "",
                "click_action": "'.$click_action.'",
                "timestamp": "",
                "next_page": '.json_encode($next_page).'
            }';
            $r = json_decode($r,1);
            $result[0]["elements"][] = $r;
      }





      if(!count($result[0]["elements"])){
        $result = '[
                              {
                                  "title": "No Documents Found",
                                  "layout_code": "1",
                                  "layout_des": "info_card",
                                  "sub_text": "",
                                  "image": "",
                                  "timestamp": "",
                                  "web_link": "",
                                  "web_view": "0",
                                  "click_action": "0",
                                  "web_view_heading": "",
                                  "page_code": "5020",
                                  "next_page": [],
                                  "elements": []
                              }
                          ]';
        $result = json_decode($result,1);
        return array(
            "code" => "101"
            ,"message" => "No Reports Found"
            ,"result" => $result
        );
      }


      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

  }



?>
