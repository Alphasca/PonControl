<?php
include 'vars.php';
$extra = 'index.php';



$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
$psql = "select * from olts order by ip";
$pretval = mysql_query( $psql, $conn );
if(! $pretval )
{
  die('Could not enter data: ' . mysql_error());
}

  while ($row=mysql_fetch_array($pretval)) {



$sql_ip = $row['ip'];
$ro = $row['ro'];
$ip = long2ip($sql_ip);
include 'ping.php';

if ($ping == 0) {
} else {

$sql_req = "UPDATE olts SET last_act=\"$date\" WHERE ip='$sql_ip'";
$retval_ping = mysql_query( $sql_req, $conn );
if(! $retval_ping )
{
  die('Could not enter data: ' . mysql_error());
}


$table = str_replace (".", "_", $ip);
include 'get_snmp.php';



}



}
mysql_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");

?>
