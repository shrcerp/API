<?php

    function get_search_doctor_list($data){
      global $con;

      $data_global = $data["data_global"];
      $location = $data["data_self"];
      $time = date("Y-m-d H:i:s",strtotime("-15 min"));
      //print_r($location);
       if($location && isset($location["location"])){
          $location = $location["location"];

       }

      $sql = "select * from gw_doctor_info  where OnlineAppointment = 1 ";

           $sql .= " and FIND_IN_SET('$location',hospitals) ";



       $sql .= " and status = 1 order by DoctorName";


                $result = array();



          //  if($location == 'sarvodaya-hospital-greater-noida-west'){
                $query = cj_query($sql);

                while($row = cj_fetch_array($query)){
                //  $location = $row["location"];

                    $a = ' {
                              "doctor": "'.ucwords(strtolower($row["DoctorName"])).'",
                              "Department":"'.html_entity_decode($row["mednet_DepartmentName"]).'"
                          }';


                    $a = json_decode($a,1);

                        $result[] = $a;


                }
                return array(
                    "code" => "101"
                    ,"message" => "Success"
                    ,"result" => $result
                );
    }



?>
