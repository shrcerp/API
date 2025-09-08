<?php


      $secret_key = 'DAS#LlkoLP2ey0Pkh423P0JMfpMS';
      $secret_iv = 'Jpl20P766$%KK4la';
      $encrypt_method = 'AES-256-CBC';

      function encrypt_fun($value){
          global $secret_key;
          global $secret_iv ;
          global $encrypt_method;
      		$value = json_encode($value);
      		$value = openssl_encrypt($value,$encrypt_method, $secret_key, 0, $secret_iv);
      		$value = base64_encode($value);
      		return $value;
    	}

    	function decrypt_fun($value){
        global $secret_key;
        global $secret_iv ;
        global $encrypt_method;
    		$value = base64_decode($value);
    		if(isJson($value)){
    			return json_decode($value,1);
    		}
    		$value = openssl_decrypt($value, $encrypt_method,$secret_key, 0, $secret_iv);
    		$value = json_decode($value,1);
    		return $value;
    	}

      function isJson($string) {
    		return ((is_string($string) &&
                (is_object(json_decode($string)) ||
                is_array(json_decode($string))))) ? true : false;
    	}



?>
