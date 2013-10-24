WebSqlApp 
=====================
**WebSQLApp** is an HTML5 WebSql Application with CRUD (Create, Reach, Update, Delete). It uses the local SQLite database included in the browser (Safari, Chrome and many mobile browsers). It uses jQuery Mobile for a better user interface because CSS3 seems not enough for selectbox. The form contains different fields such as text, number, date (with a calendar), selectbox, checkbox and radio button. It uses webSqlSync.js to automatically synchronize the local WebSql database (SQLite of the browser) with a php-MySQL server. The php code for the sync still in development (see sqlSyncHandlerTast.php called by the syncDownloadUnits() function in index.html). Thanks to Samuel for WebSqlSync.js (https://github.com/orbitaloop/WebSqlSync).

Installing
==========

- copy the files in the webSqlApp folder on your server.  
- change the connexion data to your server (dbhost, dbname, dbuname, dbpass) in sqlSyncHandlerTest.php.
- change mywebsite.com to your server name.
- index.html is the main file of the application. Start with it in your learning.
- In the first time, I get (download) the data from the server MySQL database using webSqlSync.js. 
- I modified the webSqlSync.js to treat the data from the server with a double id (one for the server and on for the app). When the contact id is null, it means that the record was created in MySQL first.
- The contacts table is two way synced.
- The units table is one way sync (server to client). It's just to feed the options of the select box.
 
How it works
==========
I use 2 indexes (one for the client DB and one for the server DB). 
I modifyed webSqlSync.js to handle inserted records directly into MySQL that have a null client id value.
I added the _buildInsertSQLWithIdNull function to webSqlSync.js to determine if we INSERT or UPDATE the webSQL DB from the ServerJson
When I insert a record in webSQL (with the client), I use -1 in the "server" ID to inform the server adapter that's a record newly created with the app. 
"-1" means to do an INSERT INTO MySQL.
 
I hope it will help you to create your own webSql app. You are welcome to improve the code of the 2 ways sync.

## Limitations:

 - DELETE are not handled for now in the sync process.
 - The one way sync for Units must be improved to avoid being updated every time even though there is no change in MySQL. 
 - There is no error handling for the server side. You're welcome to help me for it.
 - Still to do: Activate and debug the authenetication mechanism. (do not put a username and password, anyway, it's desactivated). The authenetication (username and password) should be passed in the json from client. 
 - There is one dependency to JQuery and jQueryMobile (mainly used to improve the UI. jQuery is not used for the sync. I welcome any pull request to remove this dependency (if you can do a good UI for the select box and its options with CSS3).
 
Have fun!
 
