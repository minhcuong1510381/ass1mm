<?php 
    ini_set('memory_limit','-1');
    ini_set('max_execution_time', 300);
    include('libs/AES.php');
    include('libs/DES.php');
    include('libs/RSA.php');

    if(isset($_POST["btn_submit"])){
        $file = $_FILES['file'];
        if($file['name'] != null){
            $dir = 'media/';
            $file_name = $file['name'];
            $file_type = $file['type'];
            $file_tmp = $file['tmp_name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if($ext == 'cry'){
                $msg = "Your file invalid!";
                header("Location: encrypt-form.php?msg=$msg");
                die;
            }

            move_uploaded_file($file_tmp, $dir.$file_name);

            $plaintext = file_get_contents($dir.$file_name);

            if($_POST["algorithms"] == 2){
                $cryptAES = new AES();

                $key = pack("H*",substr(sha1(rand(1,10000)).md5(rand(1,10000)),0,48));

                $keyBase64 = base64_encode($key);

                $ciphertText = $cryptAES->encrypt($plaintext,$key);
            }
            else if($_POST["algorithms"] == 1){
                $cryptDES = new DES();

                $key = pack("H*",substr(sha1(rand(1,10000)).md5(rand(1,10000)),0,48));

                $keyBase64 = base64_encode($key);

                $ciphertText = $cryptDES->encrypt($plaintext,$key);
            }
            else{
                $cryptRSA = new RSA();

                $pubkey = file_get_contents('keyRSA/public.pem');

                $prikey = file_get_contents('keyRSA/private.pem');

                $ciphertText = $cryptRSA->encrypt($plaintext, $pubkey, $prikey);

            }

            $fileCrypt_name = base64_encode($file_name).".cry";

            $fileCrypt = fopen('filesCrypt/'.$fileCrypt_name, "w");

            fwrite($fileCrypt, $ciphertText);
            fclose($fileCrypt);
        }
        else{
            $msg = "Please choose file to encrypt!";
            header("Location: encrypt-form.php?msg=$msg");
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
                    <?php if($_POST["algorithms"] != 3){ ?>
                        <label>Remember Key and Download file crypt</label>
                        <p>Key: <?php echo $keyBase64; ?></p>
                    <?php } ?>
                    <span>Sort name file: </span><a download href="filesCrypt/<?php echo $fileCrypt_name ?>" target="_blank"><?php echo substr($fileCrypt_name, 0, 16).".cry"?></a>
                </div>
            </div>
        </div>
    </div>
<?php include('inc/footer.php'); ?>
