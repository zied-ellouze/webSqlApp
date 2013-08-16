<?php
// Goal   : This function transforms the json comming from webSqlSync.js and create the sync queries for the MySQL database
// Status : In creation. This is the first step of the ClientToServer sync process
// Created: 2013-08-14...
// By (c) : Alain Beauseigle of AffairesUP.com

// To use : http://www.mySite.com/myFolder/jsonToMySqlTest.php

/*
// Proto #1a à 1 niveau avec [: fonctionnel pour aller chercher les items de info
$json2 = '{"info":[
{"userEmail":"alain2@gmail.com", "userAgent":"Mozilla/2.0", "lastSyncDate":"22222222222"}
]}';
//$jsonArray = json_decode($json, true); Ne marche pas
$jsonArray = json_decode($json2);

foreach($jsonArray->info as $row){
    foreach($row as $key => $val){
        echo $key . ': ' . $val;
        echo '<br>';
    }
}
*/
/*
// Proto #1b à 1 niveau: fonctionnel pour aller chercher les items de info
$json3 = '{"info3":
{"userEmail":"alain3@gmail.com", "userAgent":"Mozilla/3.0", "lastSyncDate":"33333333333"}
}';
$jsonArray3 = json_decode($json3);

foreach($jsonArray3->info3 as $item => $val3){
        echo $item . ': ' . $val3;
        echo '<br>';
}

// Proto #2 à 2 niveaux de foreach: fonctionnel pour aller chercher les items de chacune des lignes (row) d'une seule table
$json = '{"data":[
{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
{"UniteID": "11","UniteSymbol":"h", "last_sync_date": "0000-00-11 00:00:00"},
{"UniteID": "22","UniteSymbol":"$", "last_sync_date": "0000-00-22 00:00:00"}
]}';
//$jsonArray = json_decode($json, true); Ne marche pas
$jsonArray = json_decode($json);

foreach($jsonArray->data as $row){
    foreach($row as $key => $val){
        echo $key . ': ' . $val;
        echo '<br>';
    }
}
*/
/* Proto #3 à 4 niveaux de foreach: fonctionnel sans la création de requêtes SQL
$jsonString = '{
	"info": 
		{"userEmail": "alain@gmail.com", "userAgent": "Mozilla/1.0 ", "lastSyncDate": 11111111},
	"data": [{
		"Unites": [
			{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
			{"UniteID": "11","UniteSymbol":"h",  "last_sync_date": "0000-00-11 00:00:00"},
			{"UniteID": "22","UniteSymbol":"$",  "last_sync_date": "0000-00-22 00:00:00"}
		],
		"Categories": [
			{"CatID": 111, "CatSymbol": "Cat11", "last_sync_date": "0000-00-11 00:00:00"},
			{"CatID": 222, "CatSymbol": "Cat22", "last_sync_date": "0000-00-22 00:00:00"}
		]
	}]
}';
$jsonArray4 = json_decode($jsonString);
foreach($jsonArray4->info as $info => $infoVal){
        echo $info . ': ' . $infoVal;
        echo '<br>';
}
foreach($jsonArray4->data as $dataKey => $dataVal){
	echo '<br>';
    foreach($dataVal as $tableKey => $tableVal){
        echo '<br>';
		foreach($tableVal as $tableRowKey => $tableRowVal){
			echo $tableRowKey ;		// Affiche: 0	1	2		0	1
			foreach($tableRowVal as $tableItemKey => $tableItemVal){
				echo $tableItemKey . ': ' . $tableItemVal;	
				echo '<br>';
			}
		}
    }
}
*/
/*
// Proto #4 à 4 niveaux de foreach: semi-fonctionnel pour créer un requête INSERT pour chacune des tables du json
// problème de virgule de trop à la fin et surtout de dédoublement des Key et Val
$jsonString = '{
	"info": 
		{"userEmail": "alain@gmail.com", "userAgent": "Mozilla/1.0 ", "lastSyncDate": 11111111},
	"data": [{
		"Unites": [
			{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
			{"UniteID": "11","UniteSymbol":"h",  "last_sync_date": "0000-00-11 00:00:00"},
			{"UniteID": "22","UniteSymbol":"$",  "last_sync_date": "0000-00-22 00:00:00"}
		],
		"Categories": [
			{"CatID": 111, "CatSymbol": "Cat11", "last_sync_date": "0000-00-11 00:00:00"},
			{"CatID": 222, "CatSymbol": "Cat22", "last_sync_date": "0000-00-22 00:00:00"}
		]
	}]
}';
$jsonArray4 = json_decode($jsonString);
/*foreach($jsonArray4->info as $info => $infoVal){
        echo $info . ': ' . $infoVal;
        echo '<br>';
}
$sqlInsert = '';
$sqlInsertPart1 = '';
$sqlInsertPart2 = '';
foreach($jsonArray4->data as $dataKey => $dataVal){
	//echo $dataKey ;		// Affiche: bug
	//echo '<br>';
    foreach($dataVal as $tableKey => $tableVal){
		//echo $tableKey ;		// Affiche: Unites		Categories
        //echo '<br>';
		$sqlInsertPart1 = 'INSERT INTO '. $tableKey .'('; 
		$sqlInsertPart2 = ') VALUE ('; 
		echo '<br>';
		foreach($tableVal as $tableRowKey => $tableRowVal){
			//echo $tableRowKey ;		// Affiche: 0	1	2		0	1
			foreach($tableRowVal as $tableItemKey => $tableItemVal){
				echo $tableItemKey . ': ' . $tableItemVal;	
				echo '<br>';
				$sqlInsertPart1 .= ',' . $tableItemKey; 
				$sqlInsertPart2 .= ',' . $tableItemVal; 
				// INSERT INTO Unites (UniteID, UniteSymbol, Unite_last_sync_date) VALUES ($UniteID, '$UniteSymbol', '$Unite_last_sync_date') 
			}
			//$sqlInsertPart1 .= ') VALUE()'; 
		}
		$sqlInsert = $sqlInsertPart1 . $sqlInsertPart2 .')'; 
		print_r($sqlInsert);  
    }
}
*/

/* Proto 5 à 4 niveaux de foreach: fonctionnel pour créer un requête INSERT pour chacune des tables du json
// problème résolu: virgule de trop à la fin et surtout de dédoublement des Key et Val
$jsonString = '{
	"info": 
		{"userEmail": "alain@gmail.com", "userAgent": "Mozilla/1.0 ", "lastSyncDate": 11111111},
	"data": [{
		"Unites": [
			{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
			{"UniteID": "11","UniteSymbol":"h",  "last_sync_date": "0000-00-11 00:00:00"},
			{"UniteID": "22","UniteSymbol":"$",  "last_sync_date": "0000-00-22 00:00:00"}
		],
		"Categories": [
			{"CatID": 111, "CatSymbol": "Cat11", "last_sync_date": "0000-00-11 00:00:00"},
			{"CatID": 222, "CatSymbol": "Cat22", "last_sync_date": "0000-00-22 00:00:00"}
		]
	}]
}';
$jsonArray4 = json_decode($jsonString);
foreach($jsonArray4->info as $info => $infoVal){
        echo $info . ': ' . $infoVal;
        echo '<br>';
}

$sqlInsert = '';
$sqlInsertPart1 = '';
$sqlInsertPart2 = '';
foreach($jsonArray4->data as $dataKey => $dataVal){
    foreach($dataVal as $tableKey => $tableVal){
		//echo $tableKey ;		// Affiche: Unites		Categories
		$tableItemKeyFlag=0;	// pour éviter d'avoir une redondance des tableItemKey dans la partie 1 de la requête
		$sqlInsertPart1 = 'INSERT INTO '. $tableKey .'('; 
		$sqlInsertPart2 = ') VALUE ('; 
		foreach($tableVal as $tableRowKey => $tableRowVal){
			//echo $tableRowKey ;		// Affiche: 0	1	2		0	1
			$sqlInsertPart2 .= '),(' ; 
			foreach($tableRowVal as $tableItemKey => $tableItemVal){
				//echo $tableItemKey . ': ' . $tableItemVal;	
				//echo '<br>';
				if($tableItemKeyFlag==0) {$sqlInsertPart1 .= ',' . $tableItemKey;} 
				$sqlInsertPart2 .= ',' . $tableItemVal; 
				// Résultat désiré: INSERT INTO Unites (UniteID, UniteSymbol, Unite_last_sync_date) VALUES ($UniteID[0], '$UniteSymbol[0]', '$Unite_last_sync_date[0]') ,($UniteID[1], '$UniteSymbol[1]', '$Unite_last_sync_date[1]'), ...
			}
			$tableItemKeyFlag=1;	// pour éviter d'avoir une redondance des tableItemKey dans la requête
		}
		$sqlInsertRaw = $sqlInsertPart1 . $sqlInsertPart2 .')'; 
		$sqlInsertRaw2 = str_replace("(,", "(", $sqlInsertRaw);	// pour enlever la virgule de début.
		$sqlInsert = str_replace("(),", "", $sqlInsertRaw2);	// pour enlever le (), au début de la partie 2.
		print_r($sqlInsert);  
		echo '<br>';
    }
}
*/
/* Proto 6 à 4 niveaux de foreach: fonctionnel pour créer un requête INSERT et des requêtes UPDATE pour chacune des tables du json
// problème à résoudre: mettre en guillemet le data des champs text seulement.
// ToDo: faire la "même" chose pour les UPDATE, puis mettre une condition pour savoir si c'est un INSERT ou un UPDATE
$jsonString = '{
	"info": 
		{"userEmail": "alain@gmail.com", "userAgent": "Mozilla/1.0 ", "lastSyncDate": 11111111},
	"data": [{
		"Unites": [
			{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
			{"UniteID": "11","UniteSymbol":"h",  "last_sync_date": "0000-00-11 00:00:00"},
			{"UniteID": "22","UniteSymbol":"$",  "last_sync_date": "0000-00-22 00:00:00"}
		],
		"Categories": [
			{"CatID": 111, "CatSymbol": "Cat11", "last_sync_date": "0000-00-11 00:00:00"},
			{"CatID": 222, "CatSymbol": "Cat22", "last_sync_date": "0000-00-22 00:00:00"}
		]
	}]
}';
$jsonArray4 = json_decode($jsonString);
/foreach($jsonArray4->info as $info => $infoVal){
        echo $info . ': ' . $infoVal;
        echo '<br>';
}/
$sqlInsert = '';
$sqlInsertPart1 = '';
$sqlInsertPart2 = '';
foreach($jsonArray4->data as $dataKey => $dataVal){
    foreach($dataVal as $tableKey => $tableVal){
		//echo $tableKey ;		// Affiche: Unites		Categories
		$tableItemKeyFlag=0;	// pour éviter d'avoir une redondance des tableItemKey dans la partie 1 de la requête
		$sqlInsertPart1 = 'INSERT INTO '. $tableKey .'('; 
		$sqlInsertPart2 = ') VALUE ('; 
		foreach($tableVal as $tableRowKey => $tableRowVal){
			$tableItemUpdateKeyFlag=0;	// pour n'avoir que le champ ID dans le WHERE
			$sqlUpdatePart1 = 'UPDATE '. $tableKey .' SET '; //UPDATE table_name SET column1=value, column2=value2,... WHERE some_column=some_value 
			//$sqlUpdatePart2 = ' WHERE '; 
			//echo $tableRowKey ;		// Affiche: 0	1	2		0	1
			$sqlInsertPart2 .= '),(' ; 
			foreach($tableRowVal as $tableItemKey => $tableItemVal){
				if($tableItemKeyFlag==0) {$sqlInsertPart1 .= ',' . $tableItemKey;} 
				$sqlInsertPart2 .= ',' . $tableItemVal; 

				$sqlUpdatePart1 .= ', ' . $tableItemKey . '=' . $tableItemVal;
				if ($tableItemUpdateKeyFlag==0) {
					$sqlUpdatePart2 = ' WHERE ' . $tableItemKey . '=' . $tableItemVal; 
					$tableItemUpdateKeyFlag = 1;
				} 
			}
			$tableItemKeyFlag=1;	// pour éviter d'avoir une redondance des tableItemKey dans la requête INSERT et pour éviter la redondance dans le WHERE de la requête
		$sqlUpdateRaw1 = $sqlUpdatePart1 . $sqlUpdatePart2; 
		$sqlUpdateRaw2 = str_replace("SET ,", "SET ", $sqlUpdateRaw1);	// pour enlever la virgule de début.
		print_r($sqlUpdateRaw2);  
		echo '<br>';
		}

		$sqlInsertRaw1 = $sqlInsertPart1 . $sqlInsertPart2 .')'; 
		$sqlInsertRaw2 = str_replace("(,", "(", $sqlInsertRaw1);	// pour enlever la virgule de début.
		$sqlInsert = str_replace("(),", "", $sqlInsertRaw2);	// pour enlever le (), au début de la partie 2.
		//print_r($sqlInsert);  
		echo '<br>';
    }
}
*/
// Proto 6 with 4 inbedded foreach: fonctional. It crates an INSERT and an UPDATE queries for each records of each table in the json
// ToDo: add the condition to determine if we need to use an INSERT or an UPDATE
// Problem to solve: remove "__" for number type fields.

$jsonString = '{
	"info": 
		{"userEmail": "alain@gmail.com", "userAgent": "Mozilla/1.0 ", "lastSyncDate": 11111111},
	"data": [{
		"Unites": [
			{"UniteID": "00","UniteSymbol":"km", "last_sync_date": "0000-00-00 00:00:00"},
			{"UniteID": "11","UniteSymbol":"h",  "last_sync_date": "0000-00-11 00:00:00"},
			{"UniteID": "22","UniteSymbol":"$",  "last_sync_date": "0000-00-22 00:00:00"}
		],
		"Categories": [
			{"CatID": 111, "CatSymbol": "Cat11", "last_sync_date": "0000-00-11 00:00:00"},
			{"CatID": 222, "CatSymbol": "Cat22", "last_sync_date": "0000-00-22 00:00:00"}
		]
	}]
}';
$jsonArray4 = json_decode($jsonString);
/*foreach($jsonArray4->info as $info => $infoVal){
        echo $info . ': ' . $infoVal;
        echo '<br>';
}*/
$sqlInsert = '';
$sqlInsertPart1 = '';
$sqlInsertPart2 = '';
foreach($jsonArray4->data as $dataKey => $dataVal){
    foreach($dataVal as $tableKey => $tableVal){
		//echo $tableKey ;		// Affiche: Unites		Categories
		foreach($tableVal as $tableRowKey => $tableRowVal){
			$tableItemKeyFlag=0;	// pour éviter d'avoir une redondance des tableItemKey dans la partie 1 de la requête
			$sqlInsertPart1 = 'INSERT INTO '. $tableKey .'('; 
			$sqlInsertPart2 = ') VALUE ('; 
			$tableItemUpdateKeyFlag=0;	// pour n'avoir que le champ ID dans le WHERE
			$sqlUpdatePart1 = 'UPDATE '. $tableKey .' SET '; //UPDATE table_name SET column1=value, column2=value2,... WHERE some_column=some_value 
			//$sqlUpdatePart2 = ' WHERE '; 
			//echo $tableRowKey ;		// Affiche: 0	1	2		0	1
			$sqlInsertPart2 .= '),(' ; 
			foreach($tableRowVal as $tableItemKey => $tableItemVal){
				if($tableItemKeyFlag==0) {$sqlInsertPart1 .= ',' . $tableItemKey;} 
				$sqlInsertPart2 .= ',' . $tableItemVal; 

				$sqlUpdatePart1 .= ', ' . $tableItemKey . '=' . $tableItemVal;
				if ($tableItemUpdateKeyFlag==0) {
					$sqlUpdatePart2 = ' WHERE ' . $tableItemKey . '=' . $tableItemVal; 
					$tableItemUpdateKeyFlag = 1;
				} 
			}
			$tableItemKeyFlag=1;	// pour éviter d'avoir une redondance des tableItemKey dans la requête INSERT et pour éviter la redondance dans le WHERE de la requête
		$sqlUpdateRaw1 = $sqlUpdatePart1 . $sqlUpdatePart2; 
		$sqlUpdateRaw2 = str_replace("SET ,", "SET ", $sqlUpdateRaw1);	// pour enlever la virgule de début.
		print_r($sqlUpdateRaw2);  
		echo '<br>';

		$sqlInsertRaw1 = $sqlInsertPart1 . $sqlInsertPart2 .')'; 
		$sqlInsertRaw2 = str_replace("(,", "(", $sqlInsertRaw1);	// pour enlever la virgule de début.
		$sqlInsert = str_replace("(),", "", $sqlInsertRaw2);	// pour enlever le (), au début de la partie 2.
		print_r($sqlInsert);  
		echo '<br>';
		}
    }
}

/*
      	$sqlInsertActivite = "INSERT INTO RN_Activite ("
                ."ActiviteID, ActiviteNumero, ActiviteDescription, ActiviteDateHCree, ActiviteDateHRealisee, "
                ."ActiviteQuantiteConsommee, ActiviteDocumentsAssocies, ActiviteDerniereModifUsagerID, ActiviteDerniereModifDateH, ActiviteEtat, "
                ."TypeID, ProjetID, RessourceID, CategorieID, UniteID"
             		.") VALUES ("
                ."NULL, $ActiviteNumero, '$ActiviteDescription', '$ActiviteDateHCree', '$ActiviteDateHRealisee', "
                ."$ActiviteQuantiteConsommee, NULL, NULL, '$currentDateTime', $ActiviteEtat, "
                ."$TypeID, $ProjetMandateID, $RessourceID, $CategorieID, $UniteID "
                .")";

foreach ($jsonArray as $k1=>$v1) {
		if($k1=='info')$vals['info']=$v1;
		if($k1=='data')$vals['data']=$v1;
		if($k1=='data'){
			$i=0;
			foreach($v1 as $k2=>$v2){
			echo $i;
				foreach($v2 as $k3=>$v3){
					if($k3=='Unites')$vals['Unites'][]=$v3;
					if($k3=='entrydate')$vals['entrydate'][]=$v3;
				}
			$insert_vals[]=$vals['epos'][$i].'-'.$vals['entrydate'][$i].'-'.$vals['rec'].'-'.$vals['chid'];
			$i++;
			}
		}
		if($k1=='Unites'){
			$i=0;
			foreach($v1 as $k2=>$v2){
			echo $i;
				foreach($v2 as $k3=>$v3){
					if($k3=='epos')$vals['epos'][]=$v3;
					if($k3=='entrydate')$vals['entrydate'][]=$v3;
				}
			$insert_vals[]=$vals['epos'][$i].'-'.$vals['entrydate'][$i].'-'.$vals['rec'].'-'.$vals['chid'];
			$i++;
			}
		}
	}
	print_r($insert_vals);  
*/
?>