<?php

    function get_my_prescription($data){
      //print_r($data);

      $patient_id = $data["data_global"]["id"];
      $mobile = $data["data_global"]["mobile"];
      
      $patient_mrn = $data["data_global"]["mrn"];
    //   $patient_mrn = "SR820314";

      $result = get_booking_report($patient_mrn);
    //   $result = get_mrn($patient_mrn);
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

  }

  	function get_booking_report($mrn){
  				$r_v = array();

  				$url = "https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/myPrescription";
  				// $url = "https://demo.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/myPrescription";
  				$global_header = array(
  		      "Accept-Encoding: gzip, deflate",
  		      "Cache-Control: no-cache",
  		      "Connection: keep-alive",
  		      "Content-Type: text/plain",
  		      "cache-control: no-cache",
  		      "facilityGUID: 3e77361c-d482-4816-afbb-5b87576da352",
  		      "source: WebClient",
  		      "userID: appointment@sarvodaya",
  		      "userKey: a7a56cfe-d152-480b-aab3-d5923a8b5bb7"
  		    );

  				$post_field = '{
  				    "mrn": "'.$mrn.'",
  				    "facilityGUID":"3e77361c-d482-4816-afbb-5b87576da352",
  				    "pageNumber":"1",
  				    "recordsPerPage":"100"
  				}';
  				// $post_field = '{
                //              "mobileNo":"7276505005"
                //             ,"facilityGUID":"f6de8499-0004-42c6-ab8c-f031b2a10a66",
                //             "pageNumber":"1","recordsPerPage":"100"
                //         }';
                if($mrn == ""){
                    $lab_result = '[
                      {
                          "title": "No Summary Found",
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
                    $lab_result = json_decode($lab_result,1);
                    return $lab_result;
                }else{
  				$result = post_curl($url,$global_header,$post_field);

  				if($result["data"]){
                    $lab_result = '[
                        {
                            "title": "",
                            "layout_code": "73-1",
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

                    $lab_result = json_decode($lab_result,1);
                    foreach($result["data"] as $i => $row){

                    // $a = '{
                    //             "title": "'.$row["primaryDoctorName"].'",
                    //             "layout_code": "80",
                    //             "sub_text": "'.$row["department"].'",
                    //             "sub_text_1": "'.$row["referenceType"].'",
                    //             "sub_text_2": "",
                    //             "layout_des": "button",
                    //             "order_approve": "Approved",
                    //             "order_status": "1",
                    //             "status_history": "done",
                    //             "image": "https://cdn3.iconfinder.com/data/icons/avatars-collection/256/47-512.png",
                    //             "timestamp": "30 Mar 2021",
                    //             "web_link": "",
                    //             "web_view": "0",
                    //             "click_action": "0",
                    //             "web_view_heading": "",
                    //             "next_page": {
                    //                 "page_code": "web_view",
                    //                 "data_self": "",
                    //                 "data_heading": "Prescription",
                    //                 "data_url": "'.$row['pdfFilePath'].'"
                    //             }
                    //         }';
                        $a ='{
                            "image": "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                            "title": "'.$row["primaryDoctorName"].'",
                            "sub_text": "'.date("d M Y",strtotime($row['formattedTxnDate'])).'" ,
                            "sub_text_1": "",
                            "click_action": "2",
                            "timestamp": "",
                            "next_page": {
                                "page_code": "pdf_view",
                                "data_self": "",
                                "data_heading": "My Prescription",
                                "data_url": "'.$row['pdfFilePath'].'"
                            }
                        }';
                        $lab_result[0]["elements"][] = json_decode($a,1);
                    }
                    return $lab_result;
  				}else{
                    $lab_result = '[
                      {
                          "title": "No Summary Found",
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
                    $lab_result = json_decode($lab_result,1);
                    return $lab_result;
                  }
                }
  				// return array();
  	}

    function post_curl($url,$header,$post_field){


  		$curl = curl_init();
  		curl_setopt_array($curl, array(
  		CURLOPT_URL => $url,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => "",
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_TIMEOUT => 30,
  		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => "POST",
  		CURLOPT_POSTFIELDS => $post_field,
  		CURLOPT_HTTPHEADER => $header));

  		$response = curl_exec($curl);

  		$err = curl_error($curl);

  		curl_close($curl);

  			if($err) {
  					return array();
  			}else {
  				$response =  json_decode($response,1);
  				return $response["data"];
  		}
  	}



?>
