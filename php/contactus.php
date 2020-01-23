<?php
//Connecting to server 


/* Attempt MySQL server connection. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

$link = mysqli_connect("localhost:3306", "ebizebiz", "Pqd72H0q7h", "ebizebiz_wp292");

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}


//Capturing data from html form

$email  = mysqli_real_escape_string($link, $_REQUEST['email']);
$comment = mysqli_real_escape_string($link, $_REQUEST['comment']);



// Attempt insert query execution

$sql = "INSERT INTO ebizebizlist (id, email) VALUES ( ' ', '$email')";

if(mysqli_query($link, $sql)){

    echo "Records sent successfully.";

} else{

    echo " " ;

}

//Sending Plain Text Email 

$to = 'support@ebizebiz.com';

$subject = 'EbizEbiz Contact Us Message';

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	

function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:");
	  return str_replace($bad,"",$string);
	}
	

//Create email headers

$headers .= "From: ".clean_string($email)." \r\n".

    "Reply-To: ".clean_string($email)."\r\n" .

    'X-Mailer: PHP/' . phpversion();



	$message  = "Message from EbizEbiz Blog: \n\n";
	
	$message  .= "Email from: " .clean_string($email)."\r\n";
	
	$message  .= "Message: " .clean_string($comment)."\r\n";

//sending mail

 @mail($to, $subject, $message, $headers);

 /*****************
            {

    echo  '<big>Your mail has been sent successfully.<big>';

} else{

    echo  'Unable to send email. Please once again.';

}
**************************/

mysqli_close($link);

?>


<html >
<head><title>Thank You</title></head>
<body>

<h1 style ="text-align:center;" >Thank You.</h1>
<p style ="text-align:center;" >We will get back to you soon. </p>
<p style ="text-align:center;" >Back to the <a href ="http://ebizebiz.com">Front Page</a> 
or visit our <a href="http://ebizebiz.com/blog">Blog</a></p>

</body>
</html>