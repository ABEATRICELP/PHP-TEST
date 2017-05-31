<?php

if(!function_exists('xlLoadWebSmartObject')) 
{
	function xlLoadWebSmartObject($file, $class) 
	{	
		if($file !== $_SERVER["SCRIPT_FILENAME"]) 
		{	
			return;	
		} 

		$instance = new $class; $instance->runMain(); 
	}
}

require_once('/esdi/websmart/v11.0/include/WebSmartObject.php');
require_once('/esdi/websmart/v11.0/include/xl_functions.php');

class test2 extends WebSmartObject
{
	
	public function runMain()
	{
		// Connect to the database
		try 
		{
			$this->db_connection = new PDO(
			'ibm:' . $this->defaults['pf_db2SystemName'], 
			$this->defaults['pf_db2UserId'], 
			$this->defaults['pf_db2Password']
			);
			$this->displayPage();
		}
		catch (PDOException $ex)
		{
			die('Could not connect to database: ' . $ex->getMessage());
		}


	}

	public function displayPage()
	{
		//prepare sql statement
		$string = 'SELECT  * FROM ZZANDREWB.TESTTBL';
		$stmt = $this->db_connection->prepare($string);
		$stmt->execute();
		
		$row = $stmt->fetchAll();
			//comment
			
		require 'text.view.php';
	}
}



// Auto-load this WebSmart object (by calling xlLoadWebSmartObject) 
//if this script is called directly (not via an include/require).
// Comment this line out if you do not wish this object to be invoked directly.
xlLoadWebSmartObject(__FILE__, 'test2');?>