<?php

// require __DIR__ . '/vendor/autoload.php';

// // use KS\PromptPay;

// // // Your PromptPay ID
// // $target = '0899999999';

// // // The payment amount (optional)
// // $amount = 10.00;

// // // The path where you want to save the QR code image
// // // Make sure this folder is writable by the web server
// // $savePath = __DIR__ . '.\vendor\kittinan\php-promptpay-qr\images\qrcode.png';

// // $pp = new PromptPay();

// // try {
// //     // Generate the QR code and save it as a PNG file
// //     $pp->generateQrCode($savePath, $target, $amount);

// //     // Display the image using its relative path
// //     $imageSrc = '.\vendor\kittinan\php-promptpay-qr\images\qrcode.png';

// // } catch (Exception $e) {
// //     // Handle the error (e.g., could not write to file)
// //     echo 'An error occurred: ' . $e->getMessage();
// //     exit;
// // }



// $pp = new \KS\PromptPay();

// //Generate PromptPay Payload
// // $target = '0899999999';
// // echo $pp->generatePayload($target).'<br>';
// //00020101021129370016A000000677010111011300668999999995802TH53037646304FE29

// //Generate PromptPay Payload With Amount
// $target = '0992203806';
// $amount = 2000;
// // echo $pp->generatePayload($target, $amount).'<br>';
// //00020101021229370016A000000677010111011300668999999995802TH53037645406420.006304CF9E

// //Generate QR Code PNG file
// // $target = '1-2345-67890-12-3';
// $savePath = './images/qrcode.png';
// // $pp->generateQrCode($savePath, $target);

// //Generate QR Code With Amount
// // $amount = 420;
// $pp->generateQrCode($savePath, $target, $amount);

// //Set QR Code Size Pixel
// // $width = 1000;
// // $pp->generateQrCode($savePath, $target, $amount, $width);

?>

<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>PromptPay QR Code</title>
    <style type="text/css">
        .box{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .box1{
            padding: 0px 0 10px 0;
        }
        .box1 h1{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .box1 img{
            border: 1px solid black;
        }
        .box2{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .box2 input{
            margin: 0 5px 0 0;
            /* border: 1px solid black; */
        }
        .box3{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .box3 input{
            margin: 0 5px 0 5px;
        }
    </style>
</head>
<body>
    <div class="box_qr_main">
        <div class="box_qr_content">
            <div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" class="form_qr">
                    <div class="box3_qr">
                        amount <input type="text" name="amount_n"  placeholder="">
                        <button type="submit" name="1">ยืนยัน</button>
                    </div>
                </form>
                <div class="box1_qr">
                    <?php if(isset($_SESSION['error'])){ ?>
                        <div class="error_sessin-Qr">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php } ?>
                    <h1>Scan to Pay</h1>
                    <?php
                    require __DIR__ . '/vendor/autoload.php'; // Include Composer's autoloader
                    // use \KS\PromptPay;
                    if(isset($_GET['1'])){
                        if(empty($_GET['amount_n']) || $_GET['amount_n'] == 0){
                            //กรุณากรอกจำนวนเงิน
                            if(empty($_GET['amount_n']) || $_GET['amount_n'] == 0){
                                // if($_POST['amount_n'] == 0){
                                //     $x=$_POST['amount_n'] = 0;
                                // }elseif(empty($_POST['amount_n'])){
                                //     $x=$_POST['amount_n'] = "Empty";
                                // }
                                // $_SESSION['error'] = "***กรุณากรอกจำนวนเงิน(".$x.")";
                                $_SESSION['error'] = "***กรุณากรอกจำนวนเงิน";
                                header('location: index');
                            }
                        }else{
                            $stramount = $_GET['amount_n'];
                            // $number = $stramount;
                            // $stringNumber = (string)$number; // Convert to string
                            // $limitamount = substr($stringNumber, 0, 5); // Get first 5 characters
                            // echo $limitamount; // Output: 12345

                            // echo "limit ไม่เกิน 100000 $limitamount";

                            $decimalNumber = $stramount;
                            $roundamount = round($decimalNumber, 2); // Round to 2 decimal places
                            // echo $roundedNumber; // Output: 123.46

                            $pp = new \KS\PromptPay();
                            
                            // Define PromptPay ID (phone number or national ID) and optional amount
                            $target = '0992203806'; // Example phone number
                            $amount = $roundamount; // Optional amount

                            // Generate the PromptPay payload string
                            // $payload = $pp->generatePayload($target, $amount);

                            // Define the path to save the QR code image
                            // $savePath = './images/qrcode.png'; // Or any other suitable path
                            // $saveimag = 'nat03.png';

                            // Generate the QR code image
                            // You can also specify the width of the QR code image (e.g., 500 for 500 pixels)
                            $width = 500;
                            // $pp->generateQrCode($savePath, $target, $amount, $width);
                            $pp->generateQrCode($target, $amount, $width);
                    ?>
                            <p><?php echo "จำนวนเงิน : $amount บาท"; ?></p>
                            <!-- <img src="<?php #echo $savePath; ?>" alt="PromptPay QR Code"> -->
                            <img src="nat03.png" alt="PromptPay QR Code">
                        <?php }
                    }else{} ?>
                </div>

                
                
                <div class="box2_qr">
                    <input type="file" name="qrprompt" id="">
                    <button type="button" name="submit_upload">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>