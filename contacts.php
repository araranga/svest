<?php

include("connect.php");

include("function.php");

$main = getrow("tbl_logo");

?>

<!DOCTYPE html>

<html lang="en">

<head>

<title><?php echo $main['title'];?></title>

<?php include("includes/head.php"); ?>

</head>

<body>

<?php include("includes/menu.php"); ?>

<div id="content">

  <div class="inner pad1">

    <div class="container_12">

      <div class="wrapper h-pad">

        <div class="grid_7">

          <h2>Contact Info</h2>

          <div class="wrapper">

            <div class="grid_4 alpha">

              <iframe width="300" height="340" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d3865.8668863370417!2d121.1103094!3d14.319163800000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d14.3193769!2d121.1103201!4m5!1s0x3397d9bc67a4cecd%3A0x6110a8ba0b5e02b8!2sMarco+Polo+Place+Phase+1%2C+Santa+Rosa%2C+Laguna!3m2!1d14.3191638!2d121.11030939999999!5e0!3m2!1sen!2sph!4v1440775167513"></iframe>

            </div>

            <div class="grid_3 omega">

  <?php

  $qr = mysql_fetch_array(mysql_query("SELECT * FROM tbl_cmsmanager WHERE id='35'"));

  echo $qr['cmsmanager_content'];

  ?>

            </div>

          </div>

        </div>

        <div class="grid_4 prefix_1">

          <h2>Get In Touch</h2>
<?php

if($_POST['Name']!='')
{

$msg = '';
foreach($_POST as $key=>$val)
{
  $msg .= "$key:$val<br/>";
}

$to = 'sureinvest2015@gmail.com';
$x = "noreply@sureinvest-oms.com";
$subject = 'Inquiries';

$headers = "From: " . strip_tags($x) . "\r\n";
$headers .= "Reply-To: ". strip_tags($x) . "\r\n";
$headers .= "CC: ardeenathanraranga@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $msg, $headers);
#echo $msg;
echo "<p style='color:green;'>Thanks for the inquiry. Please wait while your message sent to the admin</p>";
}
?>
          <form id="contact-form" action="" method="POST">

            <fieldset>

              <label>

                <input type="text" name="Name" value="Name" onFocus="if(this.value=='Name'){this.value=''}" onBlur="if(this.value==''){this.value='Name'}">

              </label>

              <label>

                <input type="text" name="Email" value="Email" onFocus="if(this.value=='Email'){this.value=''}" onBlur="if(this.value==''){this.value='Email'}">

              </label>

              <label>

                <input type="text" name="Phone" value="Phone" onFocus="if(this.value=='Phone'){this.value=''}" onBlur="if(this.value==''){this.value='Phone'}">

              </label>

              <textarea name="Message" onFocus="if(this.value=='Message'){this.value=''}" onBlur="if(this.value==''){this.value='Message'}">Message</textarea>

              <a href="#" class="button1" onClick="document.getElementById('contact-form').reset()">clear</a> <a href="#" class="button1" onClick="document.getElementById('contact-form').submit()">send</a>

            </fieldset>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include("includes/footer.php"); ?>

</body>

</html>