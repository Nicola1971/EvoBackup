<?php 
  
// Backup Manager by Raymond:
// modified for complete modx backup - 11feb06 
function callBack(&$dumpstring){
	if(!headers_sent()) {
		header('Content-type: application/download');
		header('Content-Disposition: attachment; filename=database_backup.sql');
	}
	echo $dumpstring;
	return true;
}

	function nicesize($size) {
		$a = array("B", "KB", "MB", "GB", "TB", "PB");

		$pos = 0;
		while ($size >= 1024) {
			   $size /= 1024;
			   $pos++;
		}
		if($size==0) {
			return "-";
		} else {
			return round($size,2)." ".$a[$pos];
		}
	}

/*
* @package  MySQLdumper
* @version  1.0
* @author   Dennis Mozes <opensource@mosix.nl>
* @url		http://www.mosix.nl/mysqldumper
* @since    PHP 4.0
* @copyright Dennis Mozes
* @license GNU/LGPL License: http://www.gnu.org/copyleft/lgpl.html
*
* Modified by Raymond for use with this module
*
**/
class Mysqldumper {
	var $_host;
	var $_dbuser;
	var $_dbpassword;
	var $_dbname;
	var $_dbtables;
	var $_isDroptables;
	
	function __construct($host = "localhost", $dbuser = "", $dbpassword = "", $dbname = "") {
		$this->setHost($host);
		$this->setDBuser($dbuser);
		$this->setDBpassword($dbpassword);
		$this->setDBname($dbname);
		// Don't drop tables by default.
		$this->setDroptables(false);
	}
	
	function setHost($host) {
		$this->_host = $host;
	}
	
	function getHost() {
		return $this->_host;
	}
	
	function setDBname($dbname) {
		$this->_dbname = $dbname;
	}
	
	function getDBname() {
		return $this->_dbname;
	}
	
	function getDBuser() {
		return $this->_dbuser;
	}
	
	function setDBpassword($dbpassword) {
		$this->_dbpassword = $dbpassword;
	}
	
	function getDBpassword() {
		return $this->_dbpassword;
	}
	
	function setDBuser($dbuser) {
		$this->_dbuser = $dbuser;
	}

	function setDBtables($dbtables) {
		$this->_dbtables = $dbtables;
	}
	
	// If set to true, it will generate 'DROP TABLE IF EXISTS'-statements for each table.
	function setDroptables($state) {
		$this->_isDroptables = $state;
	}
	
	// @since 5/mar/07 Set the table prefix for tables to dump
	// will only dump tables with the table_prefix if set
	// if called without parameter uses the global table_prefix set by modx
	function setTablePrefix($table_prefix='') {
		$this->_tablePrefix = $table_prefix;
	}
	
	
	function isDroptables() {
		return $this->_isDroptables;
	}
	
	function createDump($dumpLogs=false,$callBack=null) {
		
		global $site_name,$version,$full_appname;
		
		// Set line feed
		$lf = "\n";
		
		$resource = mysqli_connect($this->getHost(), $this->getDBuser(), $this->getDBpassword(), $this->getDbname());
		//mysql_select_db($this->getDbname(), $resource);		
		$result = mysqli_query($resource,"SHOW TABLES");
		$tables = $this->result2Array(0, $result);
		// 7/mar/07 if table_prefix exists and not empty, remove tables without prefix
		if (!empty($this->_tablePrefix)) {
			/* echo 'prefix:'.$this->_tablePrefix."<br />\n";
			// print_r($tables);
			// echo "<br /><br />";      */
			// remove tables without prefix
			for($i=0;$i<count($tables);$i++) {
				if (strpos($tables[$i], $this->_tablePrefix)!==false) {
					$tmpTable[] = $tables[$i];
				}
			}
			
			
			$tables = $tmpTable;
			/* print_r($tables);
			exit;   */
		}
		
		
		foreach ($tables as $tblval) {
			$result = mysqli_query($resource,"SHOW CREATE TABLE `$tblval`");
			$createtable[$tblval] = $this->result2Array(1, $result);
		}
		// Set header
		$output = "#". $lf;
		$output .= "# ".addslashes($site_name)." Database Dump" . $lf;
		$output .= "# " . $full_appname . $lf;
		$output .= "# ". $lf;
		$output .= "# Host: " . $this->getHost() . $lf;
		$output .= "# Generation Time: " . date("M j, Y at H:i") . $lf;
		$output .= "# Server version: ". mysqli_get_server_info($resource) . $lf;
		$output .= "# PHP Version: " . phpversion() . $lf;
		$output .= "# Database : `" . $this->getDBname() . "`" . $lf;
        $output .= "# Description: EvoBackup {$lf}";
		$output .= "#";


		// Generate dumptext for the tables.
		if (isset($this->_dbtables) && count($this->_dbtables)) {
			$this->_dbtables = implode(",",$this->_dbtables);			
		}
		else {
			unset($this->_dbtables);
		}
		foreach ($tables as $tblval) {
			// check for selected table
			if(isset($this->_dbtables)) {
				if (strstr(",".$this->_dbtables.",",",$tblval,")===false) {
					continue;
				}
			}
			$output .= $lf . $lf . "# --------------------------------------------------------" . $lf . $lf;
			$output .= "#". $lf . "# Table structure for table `$tblval`" . $lf;
			$output .= "#" . $lf . $lf;
			// Generate DROP TABLE statement when client wants it to.
			if($this->isDroptables()) {
				$output .= "DROP TABLE IF EXISTS `$tblval`;" . $lf;
			}
			$output .= $createtable[$tblval][0].";" . $lf;
			$output .= $lf;
			/*
		            *  Insert Data for all tables except log tables(event log, access etc)
		            *  In order to keep sql size down
		            *  @since 13 Feb 06 Robin Stemp <robinstemp@gmail.com>
		            */
            if ((strpos($tblval, 'log')===false) || $dumpLogs==true)
            {
                $output .= "#". $lf . "# Dumping data for table `$tblval`". $lf . "#" . $lf;
			    $result = mysqli_query($resource,"SELECT * FROM `$tblval`");
			    $rows = $this->loadObjectList("", $result);
			    foreach($rows as $row) {
				    $insertdump = $lf;
				    $insertdump .= "INSERT INTO `$tblval` VALUES (";
				    $arr = $this->object2Array($row);
				    foreach($arr as $key => $value) {
					    $value = addslashes($value);
					    $value = str_replace("\n", '\\r\\n', $value);
					    $value = str_replace("\r", '', $value);
					    $insertdump .= "'$value',";
				    }
				    $output .= rtrim($insertdump,',') . ");";
			    }
            }
			// invoke callback -- raymond
			if ($callBack) {
				if (!$callBack($output)) break;
				$output = "";
			}
		}
		mysqli_close($resource);
		return ($callBack) ? true: $output;
	}

	// Private function object2Array.
	function object2Array($obj) {
		$array = null;
		if(is_object($obj)) {
			$array = array();
			foreach (get_object_vars($obj) as $key => $value) {
				if(is_object($value))
					$array[$key] = $this->object2Array($value);
				else
					$array[$key] = $value;
			}
		}
		return $array;
	}

	// Private function loadObjectList.
	function loadObjectList($key='', $resource) {
		$array = array();
		while ($row = mysqli_fetch_object($resource)) {
			if ($key)
				$array[$row->$key] = $row;
			else
				$array[] = $row;
		}
		mysqli_free_result($resource);
		return $array;
	}

	// Private function result2Array.
	function result2Array($numinarray = 0, $resource) {
		$array = array();
		while ($row = mysqli_fetch_row($resource)) {
			$array[] = $row[$numinarray];
		}
		mysqli_free_result($resource);
		return $array;
	}
}

?>