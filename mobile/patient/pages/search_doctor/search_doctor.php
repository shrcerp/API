<?php

    function get_search_doctor_list($data){
      global $con;
      $search = $data["search"];
      $data_global = $data["data_global"];
      $location = $data["data_self"];
      $time = date("Y-m-d H:i:s",strtotime("-15 min"));
      //print_r($location);
       if($location && isset($location["location"])){
          $location = $location["location"];

       }
    //    print_r($location);
       $search = htmlentities($search, ENT_QUOTES);
       $search = preg_replace('/^Dr[.\s]+/i', '', $search);
       print_r($search);
      $sql = "select * from gw_doctor_info  where OnlineAppointment = 1 ";
       if($location ){
           $sql .= " and FIND_IN_SET('$location',hospitals) ";
       }
       if($search){
         $sql .= " and  (DoctorName like '%$search%' or mednet_DepartmentName like '$search%' or all_department like '$search,%' or all_department like '%,$search'  or all_department like '%,$search,%' ) ";


       }


       if(isset($_POST["dev"])){
          echo $sql;

       }

       $sql .= " and status = 1 ORDER BY
  CASE
    WHEN CurrentDesignation LIKE 'Chairman%' THEN 1
    WHEN CurrentDesignation LIKE 'Group Director%' THEN 2
    WHEN CurrentDesignation LIKE 'Director & Head%' THEN 3
    WHEN CurrentDesignation LIKE 'Director &amp; Head%' THEN 3
    WHEN CurrentDesignation LIKE ' Director & Head%' THEN 3
    WHEN CurrentDesignation LIKE ' Director &amp; Head%' THEN 3
    WHEN CurrentDesignation LIKE 'HOD & Director%' THEN 4
    WHEN CurrentDesignation LIKE 'HOD &amp; Director%' THEN 4
    WHEN CurrentDesignation LIKE ' HOD & Director%' THEN 4
    WHEN CurrentDesignation LIKE ' HOD &amp; Director%' THEN 4
    WHEN CurrentDesignation LIKE 'Director &amp; HOD%' THEN 4
    WHEN CurrentDesignation LIKE ' Director & HOD%' THEN 4
    WHEN CurrentDesignation LIKE 'Director%' THEN 5
    WHEN CurrentDesignation LIKE ' Director%' THEN 5

    WHEN CurrentDesignation LIKE 'Associate Director%' THEN 6
    WHEN CurrentDesignation LIKE 'Senior Consultant & Head%' THEN 7
    WHEN CurrentDesignation LIKE 'Senior Consultant &amp; Head%' THEN 7
    WHEN CurrentDesignation LIKE 'Senior Consultant%' THEN 8
    WHEN CurrentDesignation LIKE 'Consultant%' THEN 9
    WHEN CurrentDesignation LIKE ' Consultant%' THEN 9

    WHEN CurrentDesignation LIKE 'Associate Consultant%' THEN 10
    WHEN CurrentDesignation LIKE 'Attending Consultant%' THEN 11



    ELSE 99
  END,
  CurrentDesignation";
  if($search){
      $search = html_entity_decode($search);
  }

      $result = '[{
                    "title": "'.$search.'",
                    "layout_code": "1",
                    "layout_des": "search_bar",
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
                },{
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
                        "data_self": "'.encrypt_fun($data["data_self"]).'",
                        "data_heading": "Search Result",
                        "data_url": "https://sarvodayahospital19.com/api/mobile/patient/search_doctor"
                    },
                    "elements": []
                }]';
      $result = json_decode($result,1);
      $a = '';


          //  if($location == 'sarvodaya-hospital-greater-noida-west'){
                $query = cj_query($sql);

                while($row = cj_fetch_array($query)){
                //  $location = $row["location"];
                    $is_in_person = "1";
                    $is_video  = 0;
                    if(!$row["all_department"]){
                        $row["all_department"] = "";
                    }
                    $department = json_encode(explode(",",html_entity_decode($row["all_department"])));
                    $a = ' {
                              "title": "'.html_entity_decode(ucwords(strtolower($row["DoctorName"]))).'",
                              "layout_code": "106",
                              "layout_des": "search_bar",
                                "sub_text": "'.preg_replace('/\s+/', ' ', trim(str_replace("<br>",", ",html_entity_decode($row["CurrentDesignation"])))).'",
                              "image": "'.$row["doctor_photo"].'",
                              "timestamp": "",
                              "sub_text1":"'.html_entity_decode($row["mednet_DepartmentName"]).'",
                              "all_department":'.$department.',
                              "is_online":"'.$is_video.'",
                              "is_physical":"'.$is_in_person.'",
                              "doc_id":"'.$row["gw_id"].'",
                              "rating":"",
                              "review":"",
                              "web_link": "",
                              "web_view": "0",
                              "click_action": "1",
                              "web_view_heading": "",
                              "page_code": "5020",
                              "next_page": {
                                  "page_code": "web_view",
                                  "data_self": "",
                                  "doc_id": "'.$row["gw_id"].'",
                                  "data_heading": "'.$row["DoctorName"].'",
                                  "data_url": "https://sarvodayahospital19.com/api/mobile/test/doctor_profile"
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
