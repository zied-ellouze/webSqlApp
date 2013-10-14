<?php
// getURL.php
// http://userId:userPw@www.myWebSite.com/webSqlApp/sqlSyncAdapter.php
// http://userId:userPw@www.affairesup.com/webSqlApp/getURL.php
//$url = "http://www.affairesup.com/webSqlApp/getURL.php?username=exp&password=4success"

//$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	//http://userId:userPw@www.affairesup.com/webSqlApp/getURL.php -> http://www.affairesup.com/webSqlApp/getURL.php
//echo $url;
//echo "<p>HTTP_HOST is ", $_SERVER['HTTP_HOST'], "</p>";
//echo "<p>REQUEST_URI is ", $_SERVER['REQUEST_URI'], "</p>";
//echo "<p>Username is ", $_SERVER['PHP_AUTH_USER'], "</p>";
//echo "<p>Password is ", $_SERVER['PHP_AUTH_PW'], "</p>";
//echo "<p>REQUEST_URI is ", $_SERVER['REQUEST_URI'], "</p>";

// De Tuanan Android: expertup/mobile/checkLogin.php R: Ça fonctionne encore. Good.
$strUname = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['username'] : addslashes($_REQUEST['username']))   , ENT_QUOTES);
$strPword = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['password'] : addslashes($_REQUEST['password']))   , ENT_QUOTES);
echo "<p>username is ", $strUname, "</p>";
echo "<p>password is ", $strPword, "</p>";

/* Le code suivant fonctionne très bien.
	$fieldUsagerNom_loginQuery='';
	if (isset($_GET['username'])) {
	  $fieldUsagerNom_loginQuery = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_GET['username'] : addslashes($_GET['username']))   , ENT_QUOTES);
	}
	$fieldUsagerPassword_loginQuery = '';
	if (isset($_GET['password'])) {
	  $fieldUsagerPassword_loginQuery = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_GET['password'] : addslashes($_GET['password']))   , ENT_QUOTES);
	}

echo "<p>username is ", $fieldUsagerNom_loginQuery, "</p>";
echo "<p>password is ", $fieldUsagerPassword_loginQuery, "</p>";
*/
?>