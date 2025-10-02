<?php

    function get_doctor_list($data){
        global $dev_url ;
      global $con;

      if(isset($data["data_self"])){
          $location = $data["data_self"]["location"];
      }

      $time = date("Y-m-d H:i:s",strtotime("-15 min"));
       $sql = "select * from sh_doctor_dev where inperson_booking = '1'
        and status = '1' ";

        if($location){
            $sql .= " and location in ('$location') ";
        }

        $sql .="
        order by ISNULL(priority) ASC,priority, home_status desc, FIELD (designation, 'HOD', 'HOD & Sr. Consultant','Director','Associate Director', 'Sr. Consultant', 'Senior Consultant', 'Consultant','Associate Consultant','Junior Consultant','Radiologist'),specialty,department_priority";
      $query = cj_query($sql);

      $data["data_global"]["location"] = $location;

      $result = '[{
                    "title": "Search Doctors..",
                    "layout_code": "57",
                    "layout_des": "search_bar",
                    "sub_text": "",
                    "image": "",
                    "timestamp": "",
                    "web_link": "",
                    "web_view": "0",
                    "click_action": "0",
                    "web_view_heading": "",
                    "page_code": "5020",
                    "next_page": {
                        "page_code": "view_data",
                        "data_self": "",
                        "data_heading": "Search Result",
                        "data_url": "'.$dev_url .'search_doctor"
                    },
                    "elements": []
                }]';
      $result = json_decode($result,1);
      //$result = array();
      while($row = cj_fetch_array($query)){

            $a = ' {
                      "title": "'.$row["name"].'",
                      "layout_code": "87",
                      "layout_des": "search_bar",
                        "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["designation"])))).'",
                      "image": "https://sarvodayahospital19.com/admin/data/app/'.$row["profile"].'",
                      "timestamp": "",
                      "sub_text1":"Available from '.date('d M Y').'",
                      "rating":"4.4",
                      "review":"No Reviews",
                      "web_link": "",
                      "web_view": "0",
                      "click_action": "1",
                      "web_view_heading": "",
                      "page_code": "5020",
                      "next_page": {
                          "page_code": "web_view",
                          "data_self": "",
                          "data_heading": "'.$row["name"].'",
                          "data_url": "https://sarvodayahospital19.com/doctorpage_mobile/'.$row["id"].'/?token='.encrypt_fun($data["data_global"]).'&p='.rand(1,100).'&location='.$location.'"
                      },
                      "elements": []
                  }';

            $a = json_decode($a,1);
            if($a){
                $result[] = $a;
            }

    	}


      return array(
          "code" => "101"
          ,"message" => "Success"
          ,"result" => $result
      );



    }



?>
