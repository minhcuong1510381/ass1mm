<?php 

	$folderCrypt = 'filesCrypt';
	$folderEncrypt = 'filesEncrypt';

    $fileCrypts = glob($folderCrypt . '/*');
    $fileEncrypts = glob($folderEncrypt . '/*');

    if($fileCrypts){
    	foreach ($fileCrypts as $file) {
	        if(is_file($file)){
	            unlink($file);
	        }
	    }
    }
    
    if($fileEncrypts){
    	foreach ($fileEncrypts as $file) {
	        if(is_file($file)){
	            unlink($file);
	        }
	    }
    }

    header("Location: index.php");
 ?>