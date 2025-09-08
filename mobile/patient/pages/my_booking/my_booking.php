<?php

    function get_my_booking($data){
      //print_r($data);

      $patient_id = $data["data_global"]["id"];
      $mobile = $data["data_global"]["mobile"];
      $location = "";
      if(isset($data["data_self"])){
          $location = $data["data_self"]["location"];
      }

      $sql = "select
            a.booking_from
            ,a.booking_to
            ,a.booking_type
            ,a.is_video_start
            ,a.booking_date
            ,a.amount
            ,a.interest
            ,a.id
            ,a.status
            ,a.created_on
            ,a.reference_id
            ,b.prefix
            ,b.patient_name
            ,b.mrn_no
            ,b.gender
            ,b.dob
            ,b.address
            ,c.complaint
            ,c.experiencing_since
            ,c.past_history
            ,c.sugar
            ,c.bp
            ,c.body_temperature
            ,c.spo
            ,d.DoctorName as doc_name
            ,d.CurrentDesignation as designation
            from video_patient_transaction a
            inner join video_patient b on b.id = a.patient_id
            left join video_calling_booking_extra c on c.booking_id = a.id
            inner join gw_doctor_info d on d.gw_id = a.doctor_id
            where b.mobile = '$mobile' and (a.status = '3' or a.status = '9') ";

      if($location){
          $sql .= " and location in ('$location') ";
      }
      $sql .= " ORDER BY a.id  DESC";

      $result = '[
                {
                    "title": "",
                    "layout_code": "81",
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
        $query = cj_query($sql);
      while($row = cj_fetch_array($query)){
        $value_amount = 'Paid Amount : '.$row["amount"].' Rs';
        $data_url = "https://sarvodayahospital19.com/admin/N/R?token=".base64_encode($row["id"]);
        $click_action = "1";
        if($row["booking_type"] == "1" && $row["is_video_start"] == "2"){
            if($row["is_video_start"] == "2"){
                $data_url = "https://sarvodayahospital19.com/p/".$row["id"];
            }else{
                $click_action = "0";
            }


        }
        if($row["status"] == "9"){
            $value_amount = 'Amount to be paid: '.$row["amount"].' Rs';

            $data_url = "https://sarvodayahospital19.com/video_calling_payment/".$row["id"];
        }
          $a = '{
                  "title": "'.$row["doc_name"].'",
                  "layout_code": "80",
                  "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["designation"])))).'",
                  "sub_text_1": "'.$row["interest"].'",
                  "sub_text_2": "Booking Date : '.date("d M Y",strtotime($row["booking_date"])).', Booking Time : '.date("h:i a",strtotime($row["booking_from"])).'",
                  "layout_des": "button",
                  "order_approve": "'.$row["prefix"]." ".ucfirst(strtolower($row["patient_name"])).'",
                  "order_status": "1",
                  "status_history": "'.$value_amount.'",
                  "image": "https://cdn3.iconfinder.com/data/icons/avatars-collection/256/47-512.png",
                  "timestamp": "30 Mar 2021",
                  "web_link": "",
                  "web_view": "0",
                  "web_view_heading": "",
                  "click_action": "'.$click_action.'",
                  "web_view_heading": "",
                  "page_code": "5020",
                  "next_page": {
                      "page_code": "web_view",
                      "data_self": "",
                      "data_heading": "'.$row["patient_name"].'",
                      "data_url": "'.$data_url.'"
                  }
              }';

            $result[0]["elements"][] = json_decode($a,1);

      }


      if(!count($result[0]["elements"])){
        $result = '[
                              {
                                  "title": "No Booking Found",
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
            ,"message" => "No Result Found"
            ,"result" => $result
        );

      }
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );

  }


  function get_my_booking_old($data){
    //print_r($data);
    $result = get_mrn($data["data_global"]["mobile"]);
    return array(
        "code" => "101"
        ,"message" => "Success"
        ,"result" => $result
    );

}

  function get_mrn($mobile){
  				$url = "http://mx.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listExistingUser";
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
  					    "mobileNo": "'.$mobile.'",
  					    "facilityGUID":["3e77361c-d482-4816-afbb-5b87576da352"],
  					}';

  				$result = post_curl($url,$global_header,$post_field);

  			//	print_r($result);

  				if($result){
  							$a = array();
                $mrn = "";
                $n = get_booking_report($mrn);
                /*
  							foreach ($result as $key => $value) {
  									$mrn = $value["mrn"];
  									$n = get_booking_report($mrn);
                    if($n){
                        foreach ($n as $key => $value) {
                              $a[$value["formattedRecordReceivedDate"]][] = $value;
                        }

                    }
                }
                */
                $lab_result = '[
                                      {
                                          "title": "",
                                          "layout_code": "81",
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
              //  $lab_result = array();
                    foreach($n as $i => $row){

                      $a = '{
                                "title": "'.$row["doctorName"].'",
                                "layout_code": "80",
                                "sub_text": "'.$row["qualification"].'",
                                "sub_text_1": "'.$row["facilityName"].'",
                                "sub_text_2": "Booking Date : '.$row["appointmentDate"].', Booking Time : '.$row["appointmentTime"].'",
                                "layout_des": "button",
                                "order_approve": "'.$row["appointmentStatus"].'",
                                "order_status": "1",
                                "status_history": "'.$row["facilityAddress"].'",
                                "image": "https://cdn3.iconfinder.com/data/icons/avatars-collection/256/47-512.png",
                                "timestamp": "30 Mar 2021",
                                "web_link": "",
                                "web_view": "0",
                                "click_action": "0",
                                "web_view_heading": "",
                                "next_page": []
                            }';
                      $lab_result[0]["elements"][] = json_decode($a,1);
                        }

  							return $lab_result;

  				}
  				return array();
  	}

  	function get_booking_report($mrn){
  				$r_v = array();

  				$url = "http://mx.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/myBookings";
  				$url = "https://demo.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/myBookings";
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
  				$post_field = '{
                             "mobileNo":"7276505005"
                            ,"facilityGUID":"f6de8499-0004-42c6-ab8c-f031b2a10a66",
                            "pageNumber":"1","recordsPerPage":"100"
                        }';

  				$result = post_curl($url,$global_header,$post_field);

  				if($result["data"]){
              return $result["data"];
  				}
  				return array();
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
