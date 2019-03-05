<?php 
ini_set('memory_limit','-1');
ini_set('max_execution_time', 300);
include ('libs/AES.php');
include ('libs/DES.php');
include ('libs/RSA.php');

if(isset($_POST["btn_submit"])){
    $file = $_FILES['file'];
    if($file['name'] != null){
        $file_name = $file['name'];
        $file_type = $file['type'];
        $file_tmp = $file['tmp_name'];
        $dir = "filesCrypt/";
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if($ext != 'cry'){
            $msg = "Your file invalid!";
            header("Location: decrypt-form.php?msg=$msg");
            die;
        }

        move_uploaded_file($file_tmp, $dir.$file_name);

        $cipherText = file_get_contents($dir.$file_name);

        if($_POST["algorithms"] == 2){
            $cryptAES = new AES();

            if($_POST["key"] != null){
                if(strlen($_POST["key"]) != 32){
                    $msg = "Your key invalid!";
                    header("Location: decrypt-form.php?msg=$msg");
                    die;
                }
                $key = base64_decode($_POST["key"]);

                $plainText = $cryptAES->decrypt($cipherText, $key);
            }
            else{
                $msg = "Please enter your key to decrypt!";
                header("Location: decrypt-form.php?msg=$msg");
                die;
            }
        }
        else if($_POST["algorithms"] == 1){
            $cryptDES = new DES();

            if($_POST["key"] != null){
                if(strlen($_POST["key"]) != 32){
                    $msg = "Your key invalid!";
                    header("Location: decrypt-form.php?msg=$msg");
                    die;
                }
                $key = base64_decode($_POST["key"]);

                $plainText = $cryptDES->decrypt($cipherText, $key);
            }
            else{
                $msg = "Please enter your key to decrypt!";
                header("Location: decrypt-form.php?msg=$msg");
                die;
            }
        }
        else{
            $cryptRSA = new RSA();
            
            $prikey = file_get_contents('keyRSA/private.pem');

            $pubkey = file_get_contents('keyRSA/public.pem');

            $plainText = $cryptRSA->decrypt($cipherText, $prikey, $pubkey);  
        }

        $nameFileEncryptBase64 = str_replace(".".$ext, "", $file_name);

        if($plainText != null){
            $nameFileEncrypt = base64_decode($nameFileEncryptBase64);
        }
        else{
            $nameFileEncrypt = "unavailable.err";
        }
        $fileEnCrypt = fopen('filesEncrypt/'.$nameFileEncrypt, "wr");
        fwrite($fileEnCrypt, $plainText);
        fclose($fileEnCrypt);
    }
    else{
        $msg = "Please choose file to decrypt!";
        header("Location: decrypt-form.php?msg=$msg");
        die;
    }
}
?>
<?php include('inc/header.php'); ?>
<div class="container">
    <div class="content">
        <div class="title row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1><i class="fa fa-key" aria-hidden="true"></i> Free Crypt</h1>
                <a href="index.php"><i style="font-size: 20px;" class="fa fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="type row">
            <div class="col-1"></div>
            <div class="col-10">
                <p>Download file Encrypt</p>
                <span>Name file: </span><a download href="filesEncrypt/<?php echo $nameFileEncrypt ?>" target="_blank"><?php echo $nameFileEncrypt?></a>
            </div>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>