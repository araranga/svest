<?php
session_start();
include("../connect.php");
include("../function.php");
$main = getrow("tbl_logo");
if(countfield('accounts_id',$_GET['refer'])==0)
{
exit("No account exists");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $main['title'];?> - Login</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="shortcut icon" type="image/x-icon" href="/1440760626.ico">
</head>
<body>
<style>
select#gender {
  width: 88%;
}
</style>
<?php
/*
$field[] = array("type"=>"text","value"=>"username");
$field[] = array("type"=>"password","value"=>"password");
$field[] = array("type"=>"password","value"=>"password2","label"=>"Re-enter Password");
$field[] = array("type"=>"email","value"=>"email");
$field[] = array("type"=>"text","value"=>"firstname"); 
$field[] = array("type"=>"text","value"=>"lastname");
$field[] = array("type"=>"date","value"=>"birthdate");
$field[] = array("type"=>"select","value"=>"gender","option"=>array("Male","Female"));
$field[] = array("type"=>"text","value"=>"code_value","label"=>"Code Value");
$field[] = array("type"=>"text","value"=>"code_pin","label"=>"Code Pin");
*/
if($_POST['submit']!='')
{
	if($_POST['username']=='')
	{
		$error .= "Username is required!.<br/>";
	}
	if($_POST['password']=='')
	{
		$error .= "Password is required!.<br/>";
	}
	if($_POST['password2']=='')
	{
		$error .= "Password is required!.<br/>";
	}	
	if($_POST['email']=='')
	{
		$error .= "Email is required!.<br/>";
	}	
	if($_POST['firstname']=='')
	{
		#$error .= "firstname is required!.<br/>";
	}
	if($_POST['lastname']=='')
	{
		#$error .= "lastname is required!.<br/>";
	}	
	if($_POST['birthdate']=='')
	{
		#$error .= "birthdate is required!.<br/>";
	}	
	if($_POST['gender']=='')
	{
		#$error .= "gender is required!.<br/>";
	}		
	
if(countfield("username",$_POST['username'])!=0)
{
	$error .= "Username is already exist try another!.<br/>";
}
if(countfield("email",$_POST['email'])!=0)
{
#	$error .= "Email is already exist try another!.<br/>";
}
if($_POST['password']!=$_POST['password2'])
{
  $error .= "Password do not match.<br/>";
}

if(countfield("code_id",$_POST['code_value'])!=0)
{
	$error .= "Code entered is already use by another user.<br/>";
}

if(countresult("SELECT * FROM tbl_code WHERE code_value='".$_POST['code_value']."' AND code_pin='".$_POST['code_pin']."'")==0)
{
	$error .= "Code Value and PIN does not match or not exist.<br/>";
}
else
{
	if($_POST['refer']!='')
	{
		$codeq = mysql_query("SELECT * FROM tbl_code WHERE code_value='".$_POST['code_value']."' AND code_pin='".$_POST['code_pin']."'");
		$rowcode = mysql_fetch_assoc($codeq);
		
		$referq = mysql_query("SELECT b.code_package FROM tbl_accounts as a JOIN tbl_code as b WHERE b.code_value=a.code_id AND a.accounts_id='".$_POST['refer']."'");
		$rowrefer = mysql_fetch_assoc($referq);
		//exit("SELECT b.code_package FROM tbl_accounts as a JOIN tbl_code as b WHERE b.code_value=a.code_id AND a.accounts_id='".$_POST['refer']."'");
		//echo $rowcode['code_package']."==".$rowrefer['code_package'];
		if($rowcode['code_package']!=$rowrefer['code_package'])
		{
			$error .= "Your referrer is not same package as yours.<br/>";
		}
		
		$parentq = mysql_query("SELECT * FROM tbl_refer WHERE parent='".$_POST['refer']."'");
		$countparent = mysql_num_rows($parentq);
		if($countparent>=2)
		{
			$error .= "Your referrer has already maxed out the limit of referring accounts (2 accounts only).<br/>";
		}
	}
	

}


if($error=='')
{
$x_code_value = $_POST['code_value'];
$x_code_pin = $_POST['code_pin'];
$x_refer = $_POST['refer'];
$_POST['code_id'] = $x_code_value;
$code_referrer = $_POST['code_referrer'];
unset($_POST['submit']);
unset($_POST['code_value']);
unset($_POST['code_pin']);
unset($_POST['refer']);
unset($_POST['password2']);
unset($_POST['code_referrer']);

mysql_query("UPDATE tbl_code SET code_referrer='$code_referrer' WHERE code_value='$x_code_value' AND code_pin='$x_code_pin'");
mysql_query("INSERT INTO tbl_accounts SET ".setinsert($_POST));

$refer_add = mysql_query("SELECT * FROM tbl_accounts WHERE username='".$_POST['username']."'");
$refer_add_row = mysql_fetch_assoc($refer_add);
if($x_refer!='' && $refer_add_row['accounts_id']!='')
{
mysql_query("INSERT INTO tbl_refer SET parent='".$x_refer."',child='".$refer_add_row['accounts_id']."'");
}

if($_SESSION['accounts_id']!='')
{
exit("Done on registering account. Close this window now");
}
			if($refer_add_row['accounts_id']!='')
			{
			?>
			<script>
			//window.location = '/account/index.php';
			</script>
			<?php
			}
}



}


 
$field[] = array("type"=>"text","value"=>"username");
$field[] = array("type"=>"password","value"=>"password");
$field[] = array("type"=>"password","value"=>"password2","label"=>"Re-enter Password");
$field[] = array("type"=>"email","value"=>"email");
#$field[] = array("type"=>"text","value"=>"firstname"); 
#$field[] = array("type"=>"text","value"=>"lastname");
#$field[] = array("type"=>"date","value"=>"birthdate");
#$field[] = array("type"=>"select","value"=>"gender","option"=>array("Male","Female"));
#$field[] = array("type"=>"text","value"=>"mobile","label"=>"Contact Number");
$field[] = array("type"=>"text","value"=>"code_value","label"=>"Code Value");
$field[] = array("type"=>"text","value"=>"code_pin","label"=>"Code Pin");

?>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                 <br />
            </div>
        </div>
         <div class="row">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
			
                        <div class="panel panel-default">
                        <div class="panel-heading" style=' background-color: #131212'>
                        <strong><img src="/adminpage/media/<?php echo $main['image'];?>" alt="Genesis" style='width:100%;'></strong>  
                        </div>
               <?php
			   if($error!='')
			   {
			   echo "<p style='color: red;margin-left: 33px;font-size:12px;'>$error</p>";
			   }
			   ?>								
                            <div class="panel-body">
<form method='POST' action=''>
<table width="100%">
<tr>
<td>Referred by:</td>
<td style='color:red;font-weight:700'>
<?php
$rfid = $_GET['refer'];
$rfid_query = mysql_query("SELECT * FROM tbl_accounts WHERE accounts_id='$rfid'");
$rfid_row = mysql_fetch_assoc($rfid_query);
echo $rfid_row['username'];
?>
</td>
</tr>
            <?php
            $is_editable_field = 1;
            foreach($field as $inputs)
            {
                        if($inputs['label']!='')
                        {
                        $label = $inputs['label'];
                        }
                        else
                        {
                        $label = ucwords($inputs['value']);
                        }
            ?>
                  
                    <tr>
                      <td class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
                      <?php if ( $is_editable_field ) { ?>
                      <td>
                      <?php
                      if ($inputs['type']=='select')
                      {
          
                          
                        
                      
                        ?>
                        <select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>>
                        <?php
                        foreach($inputs['option'] as $val)
                        {
                          ?>
                          <option <?php if($$inputs['value']==$val){echo"selected='selected'";} ?> value='<?php echo $val;?>'><?php echo $val;?></option>
                          <?php
                        }
                        ?>
                        </select>
                        <span class="validation-status"></span>
                        <?php
                        
                      }
                      else
                      {
                        ?>
                        <input required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" maxlength="255" value="<?php echo $_POST[$inputs['value']]; ?>" />
                        <span class="validation-status"></span>                       
                        <?php
                      }
                      ?>

                      </td>
                      <?php } else { ?>
                      <td><?php echo $$inputs['value']; ?></td>
                      <?php } ?>                                                                                                    
                    </tr>
            <?php
            }
            ?>
</table>
<br/><br/>
<input type='hidden' name='refer' value='<?php echo $_GET['refer'];?>'/>
<input type='hidden' name='code_referrer' value='<?php echo $_SESSION['accounts_id']; ?>'>
<input type='hidden' name='date_created' value='<?php echo date("Y-m-d h:i:s"); ?>'> 
<center><input type='submit' name='submit' value='Register'></center>
</form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
