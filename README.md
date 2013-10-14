WebSqlApp 
=====================
**WebSQLApp** is an HTML5 WebSql Application with CRUD (Create, Reach, Update, Delete). It uses the local SQLite database included in the browser (Safari, Chrome and many mobile browsers). It uses jQuery Mobile for a better user interface because CSS3 seems not enough for selectbox. The form contains different fields such as text, number, date (with a calendar), selectbox, checkbox and radio button. It uses webSqlSync.js to automatically synchronize the local WebSql database (SQLite of the browser) with a php-MySQL server. The php code for the sync still in development (see sqlSyncHandlerTast.php called by the syncDownloadUnits() function in index.html). Thanks to Samuel for WebSqlSync.js (https://github.com/orbitaloop/WebSqlSync).

Installing
==========

- copy the files in the webSqlApp folder on your server.  
- change the connexion data to your server (dbhost, dbname, dbuname, dbpass) in sqlSyncHandlerTest.php.
- change mywebsite.com to your server name.
- index.html is the main file of the application. Start with it in your learning.
 
I hope it will help you to create your own webSql app. You are welcome to improve the code to complete the 2 ways sync.

## Limitations:

 - DELETE are not handled for now in the sync process.
 - The server to client sync works but the client to server sync is in debug phase. In the first time, I get (download) the data from the server MySQL database using webSqlSync.js. I modified the webSqlSync.js to do the download sync with a double id (one for the server and on for the app). When the contact id is null, it means that the record was created in MySQL first.
 - The client to server sync still not working (in debug phase). I'm trying to do a 2 way sync. The server code seems working with a json string (see setContact.php) but is not working when integrated in the app. You're welcome to help debug it.
 - Still to do: Activate and debug the authenetication mechanism. (do not put a username and password, anyway, it's desactivated). The authenetication (username and password) should be passed in the json from client. 
 - There is one dependency to JQuery and jQueryMobile (mainly used to improve the UI. jQuery is not used for the sync. I welcome any pull request to remove this dependency (if you can do a good UI for the select box and its options with CSS3).
 
Have fun!
 
