/**
*  Description: 
*  Backup modx files and compress into .zip for easy download
*  @author Robin Stemp <robinstemp@gmail.com>
*  @version 0.9.4 Fixed issues with . in site name
*  @version 0.9  4 Mar-07 Added table_prefix - restructured some code
*  @version 0.8 13-Feb-06  Added log tables, excluding log data. 
*                          Added check for .htaccess file, backup directory.
*                          Added MODx Manager theme header (header.inc.php)
*                          More testing done.  
*  @version 0.5 11-Feb-2006, not heavily tested though
* 
*  Setup:
*     1. change $modx_backup_dir to directory for zip archives and make sure read/write permission is set for directory
*     2. change $modx_backup_dir in /assets/modules/modbak/download.php file, note download.php requires full path name
*         ie /home/username/public_html/_backup/
* 
*  ----------------------------------------
*  Uses PCLZIP Library for zip compression
*  Courtesy of http://www.phpconcept.net 
*  ----------------------------------------
*/

/**
*   Variables to set:
*       modx_backup_dir [string]
*                Path to create archives and sql file in, must be writable
* 
*       archive_prefix  [string]
*                Prefix for archive filename
* 
*       archive_suffix  [string]
*                Suffix for archive filename
* 
*       database_filename [string]
*                Filename for SQL dump file
*
*       table_prefix [string]
*               Table prefix to dump tables, default is current modx $GLOBALS['table_prefix']
* 
*/

// directory to contain zipped archives, default is servers document root, not secure
$modx_backup_dir = $_SERVER['DOCUMENT_ROOT'].'/_backup/';


/*
*  $modx_root_dir 
*        MODx Base path
*  $mods_path
*        Modules Path
*/
$modx_root_dir =$modx->config['base_path'];
$mods_path = $modx->config['base_path'] . "assets/modules/";
$site_name = str_replace(' ','_', $modx->config['site_name']);

// Archive file name prefix - 5mar07 - change to default site name
$archive_prefix = (isset($archive_prefix))? $archive_prefix: $site_name;

// Suffix to add to archive name  (ie modxbackup12-11-2005-1735)   .zip will be added to output file
$archive_suffix = date('d-m-Y-Hi');

// sql database filename
// 5mar07 - change from database_backup.sql to sitename.sql - robstemp
$database_filename = $site_name.'.sql';

// Table Prefix
$table_prefix = (isset($table_prefix))? $table_prefix: $GLOBALS['table_prefix'];

// include Log table data in database backup, these tables can be quite large, so default is to exclude them
$dump_log_tables = false;

$out =  '';

// temporary file for archive, this is created and then renamed if zip is successfull
$tempfile = $modx_backup_dir.'tmpbackup.zip';

// memory / time settings
$zip_time_limit = 250;
$zip_memory_limit = '12M';
$db_time_limit = 250;
$db_memory_limit = '12M';

 
// ------------------------------------------------------ MAIN CODE ----------------
include_once $mods_path.'modbak/modbak.php';
include_once $mods_path.'modbak/display.php';
return $out;