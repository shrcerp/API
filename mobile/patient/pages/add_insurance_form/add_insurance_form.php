<?php


    function add_insurance_form_fun($data){
        global $dev_url;
      global $con;
      $search = "";
      $data_global = $data["data_global"];
      $sql = "select * from m_panel where status = '1'";

      $query = cj_query($sql);
      $panel_name = array();
      while($row = cj_fetch_array($query)){
            $panel_name[] = array(
                  $row["id"], $row["panel_name"]
            );

      }

      $result = '{
    "code": "101",
    "message": "Success",
    "result": {
        "submit_form_url": "'.$dev_url .'add_insurance_form_submit",
        "elements": [
            {
                "title": "Insurance Company",
                "key": "insurance_company",
                "text": "",
                "layout_code": "205",
                "layout_dis": "option",
                "configuration": {
                    "option_value":  '.json_encode($panel_name).'
                },
                "value": "",
                "validation": [
                    "require"
                ]
            },
            {
                "title": "Policy Number",
                "key": "reference_name",
                "text": "",
                "layout_code": "204",
                "layout_dis": "input",
                "configuration": [],
                "value": "",
                "validation": [
                    "require"
                ]
            },
            {
                "title": "Policy Expire Date",
                "key": "expire_date",
                "layout_code": "201",
                "layout_dis": "datepicker",
                "configuration": {
                    "from_date": "'.date("Y-m-d").'",
                    "to_date": "'.date("Y-m-d",strtotime("+2 Year")).'",
                    "start_date": ""
                },
                "value": ""
            }
        ],
        "submit_button_name": "Submit",
        "submit_button_background_color": "#FFFFFF",
        "submit_button_font_color": "#000000",
        "submit_button_border_color": "#666666",
        "data_self": "",
        "next_page": {
            "page_code": "form_page",
            "data_self": "",
            "data_heading": "Submit your Documents",
            "data_url": "'.$dev_url .'add_insurance_stage_2"
        }
    }
}';
      $result =  json_decode($result,1);
      return $result;

            //return $result;


    }


?>
