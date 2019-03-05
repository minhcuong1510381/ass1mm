<?php 
class RSA{

	public function encrypt($plaintext, $pubkey, $prikey)
    {
    	ini_set('memory_limit','-1');
		ini_set('max_execution_time', 300);

    	if(strlen($plaintext) <= 245){
    		openssl_public_encrypt($plaintext, $encrypted, $pubkey);

    		openssl_sign($encrypted, $signature, $prikey);
    		
    		$ciphertext = base64_encode($encrypted);

    		$signCipher = $signature . $ciphertext;
    	}
        else{
        	$temp = chunk_split($plaintext, 245, ",.,\n");

        	$blocksToEncrypt = explode(",.,\n", $temp);

        	$ciphertext = null;

        	if($blocksToEncrypt[count($blocksToEncrypt) - 1] == ""){
        		unset($blocksToEncrypt[count($blocksToEncrypt) - 1]);
        	}

            foreach ($blocksToEncrypt as $block) {
            	openssl_public_encrypt($block, $encrypted, $pubkey);

            	$ciphertext .= $encrypted;
            }

            openssl_sign($ciphertext, $signature, $prikey);

            $ciphertext = base64_encode($ciphertext);

            $signCipher = $signature . $ciphertext;
        }

        return $signCipher;
    }

    public function decrypt($sigciphertext, $prikey, $pubkey)
    {
    	ini_set('memory_limit','-1');
		ini_set('max_execution_time', 300);

		$signature = substr($sigciphertext, 0, 256);

		$ciphertext = substr($sigciphertext, 256);

    	$ciphertext = base64_decode($ciphertext);

    	if(strlen($ciphertext) <= 256){
    		session_start();

	    	if(openssl_verify($ciphertext, $signature, $pubkey)){
	    		if (openssl_private_decrypt($ciphertext, $decrypted, $prikey))
		            $plaintext = $decrypted;
		        else
		            $plaintext = '';
	    	}
	    	else{
	    		return null;
	    	}
    	}
    	else{
    		session_start();

			$temp = chunk_split($ciphertext, 256, ",.,\n");

        	$blocksToDecrypt = explode(",.,\n", $temp);

        	$plaintext = null;

        	if($blocksToDecrypt[count($blocksToDecrypt) - 1] == ""){
        		unset($blocksToDecrypt[count($blocksToDecrypt) - 1]);
        	}

        	if(openssl_verify($ciphertext, $signature, $pubkey)){
        		foreach ($blocksToDecrypt as $block) {
	            	openssl_private_decrypt($block, $decrypted, $prikey);

	            	$plaintext .= $decrypted;
	            }
        	}
        	else{
        		return null;
        	}
    	}

        return $plaintext;
    }
}
 ?>
