<?php




    function patient_data($data_global){

            $sql = "select * from video_patient where id = '".$data_global["id"]."'";
            $query = cj_query($sql);
            while($row = cj_fetch_array($query)){

                  return $row;
            }


    }
    function get_my_reports($data){
      //print_r($data);
      $result = array();
    //  print_r($data["data_global"]);
      //$patient_data = patient_data($data["data_global"]);
      /*
      if($patient_data["mrn_no"] || $patient_data["mrn_nodia"]){

        $result = get_mrn($patient_data["mrn_no"],$patient_data["mrn_nodia"]);

      }
      */
      $result = get_data_from_server($data["data_global"]["mobile"]);

      if(!count($result["result"])){
        $result = '[
                              {
                                  "title": "No Reports Found",
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
      $s_info = array();
      foreach($result["result"] as $i => $val){
        $k = '{
                  "image": "https://sarvodayahospital19.com//api/mobile/images/sarvodaya_mobile_logo.png",
                  "title": "'.$val["report_name"].'",
                  "sub_text": "Name - '.$val["name"].' \nDate - '.date("d M Y",strtotime($val["created_on"])).'",
                  "sub_text_1": "",
                  "click_action": "2",
                  "timestamp": "",
                  "next_page": {
                      "page_code": "pdf_view",
                      "data_self": "",
                      "data_heading": "Sarvodaya Hospital Noida",
                      "data_url": "'.$val["link"].'"
                  }
              }';
          $s_info[] = json_decode($k,1);
      }
      $data_s = '{
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
                    "elements": '.json_encode($s_info).'
            }';
      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => array(json_decode($data_s,1))
      );

  }

  function get_data_from_server($mobile){

    $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.sarvodayahospital.com/App_api/get_report_data',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{

      "mobile_number" : "'.$mobile.'",
      "facilityGUID":"f6de8499-0004-42c6-ab8c-f031b2a10a66"
      }',
      CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Cookie: ci_session=f3eqp61o5r2nfcec1nq2qpo0u4oqiv9e'
      ),
      ));

      $response = curl_exec($curl);
      return json_decode($response,1);

  }


  function get_mrn($mrn,$mrn_nodia){
  				$url = "https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listExistingUser";

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



  			//	$result = post_curl($url,$global_header,$post_field);

          $n = get_report($mrn,$mrn_nodia);

          $result = '[
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
                            "elements": [

                    ]
                  }
                ]';
          $result = json_decode($result,1);
          foreach($n as $i => $row){
            $a_text = "".date("d M Y",strtotime($row["formattedRecordReceivedDate"]));



               $r= '{
                    "image": "https://sarvodayahospital.com//api/mobile/images/sarvodaya_mobile_logo.png",
                    "title": "'.$row["documentName"].'",
                    "sub_text": "'.$a_text.'",
                    "sub_text_1": "",
                    "click_action": "2",
                    "timestamp": "",
                    "next_page": {
                        "page_code" : "pdf_view",
                        "data_self": "",
                        "data_heading": "'.$row["facilityName"].'",
                        "data_url": "'.$row["pdfFilePath"].'"
                    }
                }';
                $r = json_decode($r,1);
                $r["sub_text"] = $a_text;
                $result[0]["elements"][] = $r;
          }

          return $result;

        /*
  				if($result){
  							$a = array();
  							foreach ($result as $key => $value) {
  									$mrn = $value["mrn"];
  									$n = get_report($mrn);
                    if($n){
                        foreach ($n as $key => $value) {
                              $a[$value["formattedRecordReceivedDate"]][] = $value;
                        }
                    }
  							}

                $lab_result = array();
                foreach ($a as $dates => $date_val) {
                    foreach($date_val as $i => $row){
                      $service_order = array();
                      $service_order[] = $row["patientName"];
                      $service_order[] = $row["facilityName"];
                      $service_order[] = "";
                      $lab_result[] = array(
                        "title" => $row["documentName"],
                        "table_info" => $service_order,
                        "row" => $row,
                        "button_name" => "Download Report",
                        "pdf_link" => $row["pdfFilePath"],
                        "text" => "",
                        "layout_code" => "47",
                        "edit_button" =>  "1",
                        "delete_button" =>  "1",
                        "sub_text" => "",
                        "image" => "",
                        "timestamp" => strtotime($row["formattedRecordReceivedDate"]),
                        "web_link" => "",
                        "web_view" => "0",
                        "background_color" => "FFFFFF",
                        "click_action" => "1",
                        "next_page" => "",
                        "web_view_heading" => "",
                        "page_code" => "5020",
                        "elements" => []
                      );
                    }
                }
  							return $lab_result;

  				}
  				return array();
          */
  	}

  	function get_report($mrn,$mrn_nodia){
  				$r_v = array();

  				$url = "https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/myLabReports";
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
          $all_data = array();
          if($mrn){
              $post_field = '{
                  "mrn": "'.$mrn.'",
                  "facilityGUID":"3e77361c-d482-4816-afbb-5b87576da352",
                  "pageNumber":"1",
                  "recordsPerPage":"100"
              }';

              $result = post_curl($url,$global_header,$post_field);
              if($result["data"]){
                  $all_data = $result["data"];
      				}
          }
          if($mrn_nodia){
              $post_field = '{
                  "mrn": "'.$mrn_nodia.'",
                  "facilityGUID":"7c43de44-9724-4b6a-828b-73a3097d3653",
                  "pageNumber":"1",
                  "recordsPerPage":"100"
              }';
              $result = post_curl($url,$global_header,$post_field);
              if($result["data"]){
                  if(count($all_data)){
                        $all_data = array_merge($all_data,$result["data"]);
                  }else{
                        $all_data = $result["data"];
                  }
      				}
          }



              return $all_data ;

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
