<?php $TARGET_COUNTRY="United_States"; //get me from `nordvpn countries` ?>
<?php 
	$a=$_GET["action"]; 
	function getIP(){
		$ip=file_get_contents("https://ipinfo.io/ip");
		$country=unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$IP"))["geoplugin_countryName"];
		return "[$country] $ip";
	}
?>
<style>body{font-size: 2vw;}</style>
<body scroll="no" style="overflow: hidden">
<h2>VPN control</h2>
<hr />

<?php if ($a=="connect" || $a=="disconnect"): ?>
	<li><a href="?action=index">back</a></li>
<?php else: ?>
	<li><a href="?action=connect"><?= $TARGET_COUNTRY; ?></a></li>
	<li><a href="?action=disconnect">DISCONNECT</a></li>
<?php endif; ?>
<hr />

<?php if ($a=="connect" || $a=="disconnect"): ?>
	IP before: <?php echo getIP(); ?>
	<hr />
<?php endif; ?>

<?php 
	    if ($a=="connect")    $cmd="connect $TARGET_COUNTRY";
	elseif ($a=="disconnect") $cmd="disconnect";
	else                      $cmd="status";

$output=shell_exec("/usr/bin/nordvpn $cmd");
$output=str_replace("\r","",$output);
echo "<pre>$output</pre>";
?>
<hr />

<b>IP: <?php echo getIP(); ?></b>

</body>