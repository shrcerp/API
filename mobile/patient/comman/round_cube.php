<?php

function create_round_cube_session(){
     $time = time();
     $data = array(
         "application_id" => "5505"
         ,"auth_key" => "8AASqpdD9Mc38th"
         ,"nonce" => $time
         ,"timestamp" => $time
     );
     $data["signature"] =   create_signature($data);

     $curl = curl_init();
     curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://api.connectycube.com/session',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS => $data,
     CURLOPT_HTTPHEADER => array(
     'CB-Account-Key: 8AASqpdD9Mc38th'
     ),
     ));
     $response = curl_exec($curl);
     curl_close($curl);
     $response = json_decode($response,1);
     return $response["session"]["token"];
}


function create_signature($data){

     $string = '';
     foreach($data as $key => $value){
         if($string){
             $string .= '&';
         }
         $string .= $key."=".$value;
     }

     return  hash_hmac('SHA1', $string, 'tnv4ptGLYsHE8tL');

}



 function register_user_roundcube($uid,$name){

     $token =  create_round_cube_session();

     $curl = curl_init();
     curl_setopt_array($curl, array(
       CURLOPT_URL => 'https://api.connectycube.com/users',
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => '',
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => 'POST',
       CURLOPT_POSTFIELDS => array('user[login]' => $uid,'user[password]' => 'A90123456','user[email]' => $uid.'@sarvodayahospital.com','user[full_name]' => $name),
       CURLOPT_HTTPHEADER => array(
         'CB-Token: '.$token
       ),
     ));

     $response = curl_exec($curl);
     curl_close($curl);
     $response = json_decode($response,1);
     return $response["user"];

}

   function create_roundcube_token($uid,$user_type){

				global $con;
				if($user_type == 1){
						$sql = "SELECT patient_name as name,id,roundcube_json FROM `video_patient` where id = '$uid'";
				}else if($user_type == 2){
						$sql = "select id,roundcube_json,name from sh_doctor_dev where id = '$uid'";
				}


				$user_data = array();
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query)) {
					if($row["roundcube_json"]){
								return json_decode($row["roundcube_json"]);
					}
					$user_data = array(
							"uid" => $uid
							,"user_type" => $user_type
							,"user_name" => $row["name"]
					);
				}

				$get_round_cube_data =  register_user_roundcube($user_type."_".$uid,$user_data["user_name"]);
				if(!$get_round_cube_data){
						return array();
				}
				if($user_type == 1){
						$sql = "update video_patient set roundcube_json = '".json_encode($get_round_cube_data)."' where id = '$uid'";
				}else if($user_type == 2){
						$sql = "update sh_doctor_dev set roundcube_json = '".json_encode($get_round_cube_data)."'  where id = '$uid'";
				}
				$query = mysqli_query($con, $sql);
				return $get_round_cube_data;
	}
