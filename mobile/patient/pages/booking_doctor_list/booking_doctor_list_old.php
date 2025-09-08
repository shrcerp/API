<?php

    function get_doctor_list($data){
      global $con;
      $time = date("Y-m-d H:i:s",strtotime("-15 min"));
       $sql = "select * from sh_doctor_dev where
        mednet_id is not NULL
        and mednet_id != '0'
        and mednet_id != ''
        and department_id is not NULL
        and department_id != '0'
        and department_id != ''
        and unit_id is not NULL
        and unit_id is not NULL
        and unit_id != '0'
        and unit_id != ''
        and is_profile_shown = 1
        and status = '1'
        order by ISNULL(priority) ASC,priority, home_status desc, FIELD (designation, 'HOD', 'HOD & Sr. Consultant','Director','Associate Director', 'Sr. Consultant', 'Senior Consultant', 'Consultant','Associate Consultant','Junior Consultant','Radiologist'),specialty,department_priority";
      $query = cj_query($sql);


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
                        "data_url": "http://app.housepital.in/admin_new/Mobile/home_search"
                    },
                    "elements": []
                }]';
      $result = json_decode($result,1);
      //$result = array();
      while($row = cj_fetch_array($query)){
            if($row["mednet_id"] && $row["department_id"]  && $row["unit_id"]){

            }else{
                continue;
            }

            $a = ' {
                      "title": "'.$row["name"].'",
                      "layout_code": "87",
                      "layout_des": "search_bar",
                      "sub_text": "'.html_entity_decode($row["designation"]).'",
                      "image": "https://sarvodayahospital.com/admin/data/app/'.$row["profile"].'",
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
                          "data_url": "https://sarvodayahospital.com/doctorpage_mobile/'.$row["id"].'/?token='.encrypt_fun($data["data_global"]).'"
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
