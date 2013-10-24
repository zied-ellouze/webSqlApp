<?php
//To test, use: http://www.affairesup.com/webSqlApp/loginCheck.php?username=exp&password=4success
require_once('connections/connDbUP.php');
$CLnum_rows = 0;
$strUname = "";
$strPword = "";
//$strUname = "exp";
//$strPword = "4success";
$strUname = (isset($_POST["username"])) ? $_POST["username"] : NULL;
$strPword = (isset($_POST["password"])) ? $_POST["password"] : NULL;

//$strUname = $_POST['username'];
//$strPword = $_POST['password'];
//$strUname = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_POST['userID'] : addslashes($_POST['userID']))   , ENT_QUOTES);
//$strPword = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_POST['userPW'] : addslashes($_POST['userPW']))   , ENT_QUOTES);

//$strUname = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['username'] : addslashes($_REQUEST['username']))   , ENT_QUOTES);
//$strPword = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['password'] : addslashes($_REQUEST['password']))   , ENT_QUOTES);
echo "<p>username is ", $strUname, " password is ", $strPword, "</p>";

//To test: use the folloing hard coded ID and PW 
//$strUname = stripslashes('eXp');
//$strPword = stripslashes('4success'); 
 
// CL is for Check Login
/*
$CLquery = "SELECT Count(UsagerID) FROM RN_Usager"
				 	 ." WHERE UsagerActif = 1 AND UsagerNom = '".$strUname."'"
					 ." AND UsagerPassword = PASSWORD('".$strPword."') "
					 ." ORDER BY UsagerID DESC";
// CLnum_rows donne toujours 1 même avec un mauvais mot de passe.
*/
$CLquery = "SELECT * FROM RN_Usager"
				 	 ." WHERE UsagerActif = 1 AND UsagerNom = '".$strUname."'"
					 ." AND UsagerPassword = PASSWORD('".$strPword."') "
					 ." ORDER BY UsagerID DESC";

//echo "<p> CLquery2 is ", $CLquery2, "</p>"; //R: GOOD
$CLresult = mysql_query($CLquery) or die(mysql_error());
$CLnum_rows = mysql_num_rows($CLresult);
//echo "<p> CLresult is ", $CLresult['ClientID'], "</p>";	//R: Bug: Ca donne toujours 1 même avec un mauvais mot de passe. 
//echo "<p> CLnum_rows is ", $CLnum_rows, "</p>"; 
//session_start();	//pas présent dans le code de Android ??? peut-être à cause qu'il ne faut pas de variable de session ?  // possiblement à mettre plus haut 
//$_SESSION['ClientID']=$CLresult['ClientID'];
//echo "<p> ClientID is ", $CLresult, "</p>";	//R: Bug:  
?>


