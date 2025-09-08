<?php


      function get_department_data(){

              $sql = "SELECT department_name, image, position
FROM gw_department
WHERE status = 1
ORDER BY
  position IS NULL,
  position ASC";
              $query = cj_query($sql);


              while($row = cj_fetch_array($query)){
                  if($row["image"]){
                        $row["image"] = "https://sarvodayahospital19.com/admin/data/app/".$row["image"];

                  }else{
                    $row["image"] = "https://sarvodayahospital19.com/api/mobile/images/shield-trust.png";
                  }

                    $row["department_name"] = html_entity_decode($row["department_name"]);
                    $result[] = $row;
              }

              return array(
                  "code" => "101"
                  ,"message" => "Success"
                  ,"result" => $result
              );


    }


?>
