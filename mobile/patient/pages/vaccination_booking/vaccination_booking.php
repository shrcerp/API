<?php

    function vaccination_booking_get($data){
      //print_r($data);

      $patient_id = $data["data_global"]["id"];

      $sql = "select
         a.booking_date
         ,a.booking_time
         ,a.reference_id
         ,a.amount
         ,a.dose_id
         ,a.created_on
         ,a.bill_number
         ,a.id
         ,c.hospital_name
         ,b.name as patient_name
         ,b.phone as mobile
         ,d.vaccine
         from va_order_history a
         inner join va_patient b on b.id = a.patient_id
         inner join va_location c on c.id = a.location_id
         inner join va_vaccine d on d.id = a.vaccine_id
         where a.video_patient_id = '$patient_id' and a.status = '3'";

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

        if($row["booking_time"] == "1"){
            $booking_time =  'Morning (9:00 am - 12:00 pm)';
        }else if($row["booking_time"] == "2"){
            $booking_time =  'Afternoon (12:00 pm - 3:00 pm)';
        }else if($row["booking_time"] == "3"){
            $booking_time =  'Evening (3:00 pm - 5:00 pm)';
        }


        $value_amount = 'Paid Amount : '.$row["amount"].' Rs';


        $data_url = "https://sarvodayahospital.com/admin/N/V?token=".base64_encode($row["id"])."&v=1";

            $a = '{
                  "title": "'.$row["patient_name"].'",
                  "layout_code": "80",
                  "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["vaccine"])))).'",
                  "sub_text_1": "'.$row["hospital_name"].'",
                  "sub_text_2": "Booking Date : '.date("d M Y",strtotime($row["booking_date"])).', Booking Time : '.$booking_time.'",
                  "layout_des": "button",
                  "order_approve": "Booking On : '.date("d M Y",strtotime($row["created_on"])).'",
                  "order_status": "1",
                  "status_history": "'.$value_amount.'",
                  "image": "https://cdn3.iconfinder.com/data/icons/avatars-collection/256/47-512.png",
                  "timestamp": "30 Mar 2021",
                  "web_link": "",
                  "web_view": "0",
                  "click_action": "0",
                  "web_view_heading": "",
                  "click_action": "1",
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
