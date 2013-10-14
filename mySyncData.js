var SYNCDATA = {
    url: 'http://www.affairesup.com/webSqlApp',// Set your server URL here	______
    database: 'AddressBook',	// webSQL database object (line 237 of indext.html)
    tableToSync: [{
        tableName: 'Unites',
        idName: 'uniteId'
    }, {
        tableName: 'FiltreParam'
    }, {
        tableName: 'UserParam'
    }, {
        tableName: 'Contacts'
    }],
    sync_info: {//Example of user info
        userEmail: 'name@abc.com',//the user mail is not always here
        device_uuid: 'UNIQUE_DEVICE_ID_287CHBE873JB',//if no user mail, rely on the UUID
        lastSyncDate: '0',
		device_version: '5.1',
        device_name: 'test navigator',
		userAgent: navigator.userAgent,
        //app data
        appName: 'webSqlApp',
        webSqlApp_version: '0.7',
        lng: 'fr'
    },
    _nullDataHandler: function(){

    },
    _errorHandler: function(transaction, error){
        console.error('Error : ' + error.message + ' (Code ' + error.code + ') Transaction.name = ' + transaction.name);
    }
};
