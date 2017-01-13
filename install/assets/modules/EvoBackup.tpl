/**
 * EvoBackup
 *
 * Backup modx files and compress into .zip for easy download
 * @category	module
 * @version     1.2
 * @author      Author: Nicola Lambathakis http://www.tattoocms.it/
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal	@modx_category Manager
 * @internal    @properties &backup_dir=Backup Directory:;string;/_evobackup_archives/;; Need to edit /assets/modules/evobackup/settings.php too and set $modx_backup_dir. Make sure read/write permission is set. &extract_dir=Extract zip archive Directory:;string;_extract/;; Warning: setting to site root (empty) will overwrite existing files! &zip_t_limit=ZIP time limit:;string;250 &zip_m_limit=ZIP memory limit:;string;80M &db_t_limit=DB time limit:;string;250 &db_m_limit=DB memory limit:;string;80M &dump_logs=Dump logs tables:;menu;false,true;false;;Include Log table data in database backup. These tables can be quite large, so default is to exclude them. &customfold1=Custom file or folder 1:;string;;; example assets/galleries &customfold2=Custom file or folder 2:;string;;; example assets/videos &customfold3=Custom file or folder 3:;string;;; example forum &customfold4=Custom file or folder 4:;string;;; example shop &customfold5=Custom file or folder 5:;string;;; example google123456abcdefg789.html
 * 
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
$modx_db_backup_dir = $modx->config['base_path'] . 'assets/backup/';
$modx_extract_dir = $modx->config['base_path'].$extract_dir;
/*
*  $modx_root_dir 
*        MODx Base path
*  $mods_path
*        Modules Path
*/
$modx_root_dir =$modx->config['base_path'];
$mods_path = $modx->config['base_path'] . "assets/modules/";
$site_name = preg_replace('/[^a-zA-Z0-9]+/', '_', $modx->config['site_name']);
//lang
$_lang = array();
include($mods_path.'evobackup/lang/english.php');
if (file_exists($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php')) {
    include($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php');
}
// Archive file name prefix - 5mar07 - change to default site name
$archive_prefix = (isset($archive_prefix))? $archive_prefix: $site_name;

// Suffix to add to archive name  (ie modxbackup12-11-2005-1735)   .zip will be added to output file
$archive_suffix = '_'.date('Y-m-d-Hi');

// sql database filename
// 5mar07 - change from database_backup.sql to sitename.sql - robstemp
$database_filename = $site_name.'_'.$archive_suffix.'.sql';

// Table Prefix
$table_prefix = (isset($table_prefix))? $table_prefix: $GLOBALS['table_prefix'];

// include Log table data in database backup, these tables can be quite large, so default is to exclude them
$dump_log_tables = $dump_logs;

$out = '';

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