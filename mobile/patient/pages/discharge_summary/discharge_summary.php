<?php

function get_discharge_summary($data) {

    $location = $data['data_self']['location'] ?? '';
    $location = 'sector_8';

    if (empty($location)) {
        return array(
            "code" => "101",
            "message" => "please select location",
            "result" => [
                "title" => "location not found",
                "layout_code" => "1",
                "layout_des" => "info_card",
                "sub_text" => "",
                "image" => "",
                "timestamp" => "",
                "web_link" => "",
                "web_view" => "0",
                "click_action" => "0",
                "web_view_heading" => "",
                "page_code" => "5020",
                "next_page" => [],
                "elements" => []
            ]
        );
    }

    $mrn = $data['data_global']['mrn'] ?? '';
    $mrn = 'SR1046630';
    $url = "https://app.sarvodayahospital.com/permission/discharge_summary?mrn={$mrn}&location={$location}";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=f4la46icub5rfq5m0veuql48n8n88q2h'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $no_summary_response = array(
        "code" => "101",
        "message" => "No Summary Found",
        "result" => [
            "title" => "No Summary Found",
            "layout_code" => "1",
            "layout_des" => "info_card",
            "sub_text" => "",
            "image" => "",
            "timestamp" => "",
            "web_link" => "",
            "web_view" => "0",
            "click_action" => "0",
            "web_view_heading" => "",
            "page_code" => "5020",
            "next_page" => [],
            "elements" => []
        ]
    );

  

    $decoded = json_decode($response, true);

    if (empty($decoded) || !is_array($decoded)) {
        return $no_summary_response;
    }

    return array(
        "code" => "102",
        "message" => "Summary Found",
        "result" => [
            "title" => "Summary Found",
            "layout_code" => "",
            "layout_des" => "info_card",
            "sub_text" => "",
            "image" => "",
            "timestamp" => "",
            "web_link" => "",
            "web_view" => "0",
            "click_action" => "0",
            "web_view_heading" => "",
            "page_code" => "5020",
            "next_page" => [],
            "elements" => $decoded
        ]
    );
}

?>
