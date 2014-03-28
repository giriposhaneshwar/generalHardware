<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	//echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}


$email_from = $_POST['email'];//<== update the email address
$email_subject = "mail by $name - From www.ghisfastners.com";
$email_body = "
<html>
<head>
<title>".$name."</title>
</head>
<body>
<p>Email From -->".$email_from."</p>
<table cellpadding='8' cellspacing='0' border='0' width='100%'>
<tr bgcolor='#CCCCCC'>
<th>Name:</th>
<td>".$name."</td>
</tr>
<tr bgcolor='#CCCCCC'>
<th>Phone:</th>
<td>".$phone."</td>
</tr>
<tr bgcolor='#f2f2f2'>
<td colspan='2'>".$message."</td>
</tr>
</table>
</body>
</html>
";
    
$to = "info@icsitpark.com";//<== update the email address

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

$headers .= "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
 //done. redirect to thank-you page.
header("Location: contactus.html");
  
?> 