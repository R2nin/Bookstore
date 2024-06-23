<?php require  "includes/header.php"; ?>
<?php require  "config/config.php"; ?> 

<?php



    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location: index.php');
        exit;
    }


    $select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
    $select->execute();
    $allProdcuts = $select->fetchAll(PDO::FETCH_OBJ);


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'german.lang77@gmail.com';                     //SMTP username
        $mail->Password   = 'nftjsrjpaeojbbzx';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //sender
        $mail->setFrom('hsn42476@gmail.com', 'user');

        //Add a recipient
        $mail->addAddress("german.lang77@gmail.com", 'Bookstore');  
    

        foreach($allProdcuts as $products) {
            $path  = 'admin-panel/products-admins/books';
            //$file = $products->pro_file;

            for($i=0; $i < count($allProdcuts); $i++) {
            
                $mail->addAttachment($path . "/" . $products->pro_file);         //Add attachments

            }
        }