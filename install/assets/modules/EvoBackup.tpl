/**
 * EvoBackup
 *
 * 1.2 Beta 1 - Backup modx files and compress into .zip for easy download
 * @author Nicola Lambathakis
 * @category	module
 * @internal	@modx_category uncategorized
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 */
/**
*  Description: 
*  Backup modx files and compress into .zip for easy download
*  @author Nicola Lambathakis
*  based on modbak by Robin Stemp <robinstemp@gmail.com>
* 
*  Setup:
*     1. change $modx_backup_dir to directory for zip archives and make sure read/write permission is set for directory
*     2. change $modx_backup_dir in /assets/modules/evobackup/download.php file, note download.php requires full path name
*         ie /home/username/public_html/_backup/
* 
*  ----------------------------------------
*  Uses PCLZIP Library for zip compression
*  Courtesy of http://www.phpconcept.net 
*  ----------------------------------------
*/
/*
&backup_dir=Backup Directory:;string;assets/backup/;;directory for zip archives. make sure read/write permission is set &zip_t_limit=zip time limit:;string;250 &zip_m_limit=zip memory limit:;string;50M &db_t_limit=db time limit:;string;250 &db_m_limit=db memory limit:;string;50M &dump_logs=Dump logs tables:;menu;false,true;false;;include Log table data in database backup, these tables can be quite large, so default is to exclude them

&modx_backup_dir=Backup Directory:;menu;show,hide;hide;;Show deprecated Dashboard header with logo and site name


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
$modx_backup_dir = $_SERVER['DOCUMENT_ROOT'].$backup_dir;

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
$database_filename = $site_name.'_'.$archive_suffix.'.sql';

// Table Prefix
$table_prefix = (isset($table_prefix))? $table_prefix: $GLOBALS['table_prefix'];

// include Log table data in database backup, these tables can be quite large, so default is to exclude them
$dump_log_tables = $dump_logs;

$out =  '';

// temporary file for archive, this is created and then renamed if zip is successfull
$tempfile = $modx_backup_dir.'tmpbackup.zip';

// memory / time settings
$zip_time_limit = $zip_t_limit;
$zip_memory_limit = ''.$zip_m_limit.'';
$db_time_limit = $db_t_limit;
$db_memory_limit = ''.$db_m_limit.'';

 
// ------------------------------------------------------ MAIN CODE ----------------
include_once $mods_path.'evobackup/evobackup.php';
include_once $mods_path.'evobackup/display.php';
return $out;