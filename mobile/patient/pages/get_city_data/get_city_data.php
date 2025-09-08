<?php
      function get_city_data_fun($data){

            $state_id = $data["select_value"];
            $city_data = get_city_list($state_id);

            $form = ' {"message": "success",
    "code": "101",
    "result": {
                          "option_value": '.$city_data.'
                      }

                    }';

        return json_decode($form,1);
      }

      function get_city_list($state_id){

          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://live.mednetlabs.com/mxServer/ws/onlineDoctorsAppointment/listCity/'.$state_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          ));

          $response = curl_exec($curl);
          curl_close($curl);

          $response = json_decode($response,1);
          $option = array();
          foreach($response["data"] as $i => $val){
                $option[] = array($val["cityName"], $val["cityName"]);
          }
          return json_encode($option);
      }

?>
