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
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form_qr">
                    <div class="box3_qr">
                        <input type="text" name="amount_n" placeholder="จำนวนเงิน">
                        <button type="submit" name="submit_amount">ยืนยัน</button>
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
                    if(isset($_POST['submit_amount'])){
                        if(empty($_POST['amount_n']) || $_POST['amount_n'] == 0){
                            if(empty($_POST['amount_n']) || $_POST['amount_n'] == 0){
                                $_SESSION['error'] = "***กรุณากรอกจำนวนเงิน";
                                header('location: index');
                            }
                        }else{
                            $stramount = $_POST['amount_n'];
                            $pp = new \KS\PromptPay();
                            // Define PromptPay ID (phone number or national ID) and optional amount
                            $target = '0992203806'; // phone number
                            $amount = $stramount; // Optional amount
                            $savePath = './images/qrcode.png'; // Or any other suitable path
                            $width = 500;
                            $pp->generateQrCode($savePath, $target, $amount, $width);
                            $amount_total = number_format(floor($amount * 100) / 100, 2, '.', ',');
                    ?>
                            <p><?php echo "จำนวนเงิน : $amount_total บาท"; ?></p>
                            <img src="<?php echo $savePath; ?>" alt="PromptPay QR Code">
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