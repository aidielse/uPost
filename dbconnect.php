<?php 
	require_once("config.php");

    // These variables define the connection information for your MySQL database 
    $username = $database["username"]; 
    $password = $database["password"]; 
    $host = $database["host"]; 
    $dbname = $database["dbname"]; 
    
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    
    $success=true;
    try 
    { 
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
    } 
    catch(PDOException $ex) 
    { 
        echo "Failed to connect to the database! Check host, dbname, username, and password in the config.php file. Error: ".$ex->getMessage();
        $success=false;
    } 

    if($success)
    {
    	
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	     
	    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
	     
	    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
	    { 
	        function undo_magic_quotes_gpc(&$array) 
	        { 
	            foreach($array as &$value) 
	            { 
	                if(is_array($value)) 
	                { 
	                    undo_magic_quotes_gpc($value); 
	                } 
	                else 
	                { 
	                    $value = stripslashes($value); 
	                } 
	            } 
	        } 
	     
	        undo_magic_quotes_gpc($_POST); 
	        undo_magic_quotes_gpc($_GET); 
	        undo_magic_quotes_gpc($_COOKIE); 
	    } 
	    
	     
    }
?>
    