<?php 
class DES{
	public $method;
	
	public function __construct(){
		$this->method = "DES-CBC";
	}

	public function encrypt($plaintext, $key){
		ini_set('memory_limit','-1');
		ini_set('max_execution_time', 300);
	    $iv = openssl_random_pseudo_bytes(8);
	    $ciphertext = openssl_encrypt($plaintext, $this->method, $key, OPENSSL_RAW_DATA, $iv);
	    $hash = hash_hmac('md5', $ciphertext, $key, true);
	    $ivHashCiphertext = base64_encode($iv . $hash . $ciphertext);

	    return $ivHashCiphertext;
	}

	public function decrypt($ivHashCiphertext, $key){
		ini_set('memory_limit','-1');
		ini_set('max_execution_time', 300);
		$ivHashCiphertext = base64_decode($ivHashCiphertext);
	    $iv = substr($ivHashCiphertext, 0, 8);
	    $hash = substr($ivHashCiphertext, 8, 16);
	    $ciphertext = substr($ivHashCiphertext, 24);

	    if (hash_hmac('md5', $ciphertext, $key, true) !== $hash) return null;

	    return openssl_decrypt($ciphertext, $this->method, $key, OPENSSL_RAW_DATA, $iv);
	}
}
?>