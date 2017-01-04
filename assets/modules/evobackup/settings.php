<?php
/**
* EvoBackup Settings
* v1.2
*/

$modx_backup_dir = $_SERVER['DOCUMENT_ROOT'].'/_evobackup_archives/';
$modx_db_backup_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/backup/'; 
// Generate Archive(s) within subdir of backup directory - ie /backup_dir/site1/site1_date1_db.zip
// /site1/site1_date2_db.zip                              
// /site2/site2_date1_db.zip

// ---- RETURN IF NO SITENAME------  USED FOR DOWNLOAD
if (!isset($site_name) || $site_name=='') {
  return; 
}

// Archive file name prefix - 5mar07 - change to default site name
$archive_prefix = (isset($archive_prefix))? $archive_prefix: @$site_name;

// Suffix to add to archive name  (ie modxbackup12-11-2005-1735)   .zip will be added to output file
$archive_suffix = (isset($archive_suffix))? $archive_suffix: '_'.date('Y-m-d-Hi');

// sql database filename
// 5mar07 - change from database_backup.sql to sitename.sql - robstemp
$database_filename = (isset($database_filename))? $database_filename:@$site_name.'.sql';

// Table Prefix
$table_prefix = (isset($table_prefix))? $table_prefix: @$GLOBALS['table_prefix'];

// include Log table data in database backup, these tables can be quite large, so default is to exclude them
$dump_log_tables = false;

// temporary file for archive, this is created and then renamed if zip is successfull
$tempfile = $modx_backup_dir.'tmpbackup.zip';

// memory / time settings
$zip_time_limit = 250;
$zip_memory_limit = '12M';
$db_time_limit = 250;
$db_memory_limit = '12M';

?>