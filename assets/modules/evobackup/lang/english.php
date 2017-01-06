<?php
// ---------------------------------------------------------------
// :: EvoBackup
// ----------------------------------------------------------------
//
// 	Short Description:
//         Backup Evo files and compress into .zip for easy download.
//
//   Version:
//         1.2
//
//   Created by:
// 	    Nicola Lambathakis http://www.tattoocms.it/
//
//
// ----------------------------------------------------------------
// :: Copyright & Licencing
// ----------------------------------------------------------------
//
//   GNU General Public License (GPL - http://www.gnu.org/copyleft/gpl.html)
//

$_lang['modulename'] = 'EvoBackup';
$_lang['backup'] = 'backup';
$_lang["bk_manager"] = 'Backup Manager';
$_lang['TabManageBackup'] = 'Manage Backup Archives';
$_lang['TabMODxBackup'] = 'Manage Database Backups';
//Manage Backups
$_lang['manage_backup'] = 'Manage EvoBackup Archives Backups';
$_lang['manage_modx_backup'] = 'Manage MODX System .sql Backups';
$_lang['manage_backup_descr'] = 'Download or delete previous backup archives';
$_lang['backup_filename'] = 'Filename';
$_lang['backup_filesize'] = 'File size';
$_lang['backup_file_options'] = 'Options';
$_lang['delete_backup'] = 'Delete Backup';
$_lang['download_backup'] = 'Download Backup';
$_lang['extract_zip_backup'] = 'Extract Archive Backup';
$_lang['restore_sql_backup'] = 'Restore Sql Backup';
//Generate Backup
$_lang['generate_backup'] = 'Generate a new Backup Archive';
$_lang['choose_backup'] = 'Choose Backup type:';
$_lang['light_backup'] = 'Light Backup';
$_lang['medium_backup'] = 'Medium Backup';
$_lang['full_backup'] = 'Full Site Backup';
//assets Backup
$_lang['assets_backup'] = 'Assets Backup';
$_lang['check_all'] = 'Select All';
$_lang['whole_assets'] = 'whole assets folder';
$_lang['assets_user_folders'] = 'User Folders';
$_lang['assets_elements_folders'] = 'Elements Folders';
$_lang['assets_system_folders'] = 'System Folders';
//manager backup
$_lang['manager_backup'] = 'Manager Backup';
$_lang['whole_manager'] = 'whole manager folder';
$_lang['only_those_manager_files'] = 'Only those manager files and folders:';
$_lang['manager_config_file'] = 'config file';
$_lang['manager_themes'] = 'manager themes';
//root backup
$_lang['root_backup'] = 'Root files Backup';
$_lang['root_backup_descr'] = 'Select additional root files to include in archive';
//db backup
$_lang['db_backup'] = 'Database Backup';
$_lang['include_db_to_zip'] = 'include .sql database backup to zip ';
// custom backup
$_lang['custom_files_backup'] = 'Custom Files and Folders';
//buttons
$_lang['backup_button_text'] = 'Backup Now!';
$_lang['backupdb_button_text'] = 'Backup Database';
$_lang['backupdbonly_button_text'] = 'Backup Database Only';
$_lang['close'] = 'Close';
$_lang['help'] = 'Help';
$_lang['settings_module'] = 'Settings';
//help
$_lang['help_light_backup'] = '<p>This backup includes only required files, user files and db.<br/> Generates a smaller zip archive and requires less memory and resources</p>  ';
$_lang['help_medium_backup'] = '<p>This backup includes required files, user files, elements (snippets, modules, plugins..) and db.<br/> Generates a medium zip archive</p> ';
$_lang['help_full_backup'] = '<p>This backup includes whole assets and manager folder (included custom sub folders), root files and db backup<br/> Generates a bigger zip archive and requires more memory and resources</p>';
$_lang['archive_backup_help_title'] = 'Download or delete EvoBackup .zip archive backups';
$_lang['archive_backup_help'] = '<p>Note: zip archive with <b>_db</b> suffix contains a .sql file with Database Backup</p><p>Archives without <b>_db</b> suffix contains just files</p>
<p>To create automatic archives backups, download and install <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p> ';
$_lang['sql_backup_help_title'] = 'Download or delete .sql backups';
$_lang['sql_backup_help'] = '<p>Sql backups can be manually generated with default <a href="index.php?a=93">MODX Backup Snapshot Manager</a></p> <p>To create automatic .sql backups, download and install <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p>';
//Alerts
$_lang['backup_successful'] = 'Backup Successful!';
$_lang['backupdb_successful'] = 'Database Backup Successful!';
$_lang['backupzip_successful'] = 'Archive Backup Successful!';
$_lang['backup_directory'] = 'Backup directory';
$_lang['does_not_exist'] = 'does not exist';
$_lang['is_not_writable'] = 'is NOT writable!';
$_lang['file'] = 'File';
$_lang['deleted'] = 'Deleted';
$_lang['unable_to_backup_db'] = 'Unable to Backup Database';
$_lang['archive_extracted'] = 'Archive Extracted';
$_lang['db_extracted'] = 'Database Restored';
$_lang['error_open_archive'] = 'Failed to open the archive';
// Confirm windows alerts
$_lang['delete_confirm'] = 'Are you sure you want to Delete';
$_lang['delete_confirm_info'] = 'Deleted files cannot be restored at a later time!';
$_lang['extract_zip_confirm'] = 'Are you sure you want to Extract';
$_lang['extract_to'] = 'to';
$_lang['backup_folder'] = 'Backup Folder';
$_lang['extract_folder'] = 'Extract Folder';
$_lang['extract_zip_info'] = 'Restoring an archive backup, in your site root, will overwrite all existing files. This action can be very dangerous!';
$_lang['restore_sql_confirm'] = 'Are you sure you want to Restore';
$_lang['restore_sql_info'] = 'Restoring .sql backup will overwrite all existing database data. This action can be very dangerous!';
