<?php
$ini_array = parse_ini_file("../conf.ini");
?>

<!DOCTYPE html>
<html>
<head>
<title>Captive Portal</title>
<meta charset="utf-8">
  <link href="./bootstrap.min.css" rel="stylesheet" media="screen">
   
<?php
// capture their IP address
$ip = $_SERVER['REMOTE_ADDR'];

// this is the path to the arp command used to get user MAC address 
// from it's IP address in linux environment.
$arp = "/usr/sbin/arp";

// execute the arp command to get their mac address
$mac = shell_exec("$arp -an " . $ip);
preg_match('/..:..:..:..:..:../',$mac , $matches);
$mac = @$matches[0];

// if MAC Address couldn't be identified.
if( $mac === NULL) { 
  echo "Access Denied.";
  exit;
}

if(isset($_POST['username']) && isset($_POST['passwd'])) 
  {
    $users = array(
		   'username' => 'passwd',
		   );
    $user = $_POST['username'];
    $passwd = $_POST['passwd'];
    if(isset($users[$user]) && $users[$user] == $passwd) 
      {
	exec('/home/portal/grantaccess.sh '.strtoupper($mac).' '.$user);
	if(isset($_GET['add']))
	  {
	      ?>
	      <meta http-equiv="refresh" content="0; http://<?php echo $_GET['add'];?> ">
	        <?php
	      }
      }
  }

$add = 'google.fr';
if(isset($_GET['add']))
  $add = $_GET['add'];
?>
</head>
<div class="container" style="margin-top: 3em;">
<div class="row">
<form class="col-md-6 col-md-offset-3" style="background-color:#eeeeee; border-radius:10px;" method="post" action=".?add=<?php echo $add; ?>">
  <h1>Captive Portal</h1>
  <p class="lead">Si vous n'avez pas d'identifiant, passez votre chemin.</p>
  <div class="form-group">
  <label for="username">Username</label>
  <input type="text" class="form-control" id="username" name="username"  />
  <label for="password">Password</label>
  <input class="form-control" id="password" type="password" name="passwd" value="" />
  </div>
  <input class="btn btn-primary" type="submit" value="OK" />
  <p class="text-muted">La session sera re©initialiee toutes les 4 heures.</p>
</form>
</div>
</div>
</html>
