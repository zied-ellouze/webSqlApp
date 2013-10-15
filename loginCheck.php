<?php
//To test, use: http://www.affairesup.com/webSqlApp/loginCheck.php?username=exp&password=4success
require_once('connections/connDb.php');
$CLnum_rows = 0;
$strUname = "";
$strPword = "";
$strUname = (isset($_POST["username"])) ? $_POST["username"] : NULL;
$strPword = (isset($_POST["password"])) ? $_POST["password"] : NULL;

echo "<p>username is ", $strUname, " password is ", $strPword, "</p>";

// CL is for Check Login
$CLquery = "SELECT * FROM Usager"
				 	 ." WHERE UsagerActif = 1 AND UsagerNom = '".$strUname."'"
					 ." AND UsagerPassword = PASSWORD('".$strPword."') "
					 ." ORDER BY UsagerID DESC";

$CLresult = mysql_query($CLquery) or die(mysql_error());
$CLnum_rows = mysql_num_rows($CLresult);
?>


