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
$_lang["bk_manager"] = 'Backup manager';
$_lang['TabManageBackup'] = 'Beheer backup archief';
$_lang['TabMODxBackup'] = 'Beheer database backups';
//Manage Backups
$_lang['manage_backup'] = 'Beheer EvoBackup gearchiveerde Backups';
$_lang['manage_modx_backup'] = 'Beheer MODX Systeem .sql Backups';
$_lang['manage_backup_descr'] = 'Download of verwijder oudere backup archieven';
$_lang['backup_filename'] = 'Bestandsnaam';
$_lang['backup_filesize'] = 'Bestandsgrootte';
$_lang['backup_file_options'] = 'Opties';
$_lang['delete_backup'] = 'Verwijder backup';
$_lang['download_backup'] = 'Download backup';
$_lang['extract_zip_backup'] = 'Extract Archive Backup';
$_lang['restore_sql_backup'] = 'Restore Sql Backup';
//Generate Backup
$_lang['generate_backup'] = 'Genereer een nieuw backup archief';
$_lang['choose_backup'] = 'Selecteer backup type:';
$_lang['light_backup'] = 'Small backup';
$_lang['medium_backup'] = 'Medium backup';
$_lang['full_backup'] = 'Full backup';
//assets Backup
$_lang['assets_backup'] = 'Assets backup';
$_lang['check_all'] = 'Selecteer alle';
$_lang['whole_assets'] = 'volledige assets map';
$_lang['assets_user_folders'] = 'Gebruikers mappen';
$_lang['assets_elements_folders'] = 'Elementen mappen';
$_lang['assets_system_folders'] = 'Systeem mappen';
//manager backup
$_lang['manager_backup'] = 'Manager backup';
$_lang['whole_manager'] = 'volledige manager map';
$_lang['only_those_manager_files'] = 'Alleen deze manager bestanden en mappen:';
$_lang['manager_config_file'] = 'config bestand';
$_lang['manager_themes'] = 'manager themes';
//root backup
$_lang['root_backup'] = 'Root bestanden backup';
$_lang['root_backup_descr'] = 'Selecteer additionele root bestanden om toe te voegen in het archief';
//db backup
$_lang['db_backup'] = 'Database backup';
$_lang['include_db_to_zip'] = '.sql database backup toevoegen als zip ';
// custom backup
$_lang['custom_files_backup'] = 'Custom bestanden en mappen';
//buttons
$_lang['backup_button_text'] = 'Backup maken!';
$_lang['backupdb_button_text'] = 'Backup Database';
$_lang['backupdbonly_button_text'] = 'Backup Database Only';
$_lang['close'] = 'Close';
$_lang['help'] = 'Help';
$_lang['settings_module'] = 'Instellingen';
//help
$_lang['help_light_backup'] = '<p>Deze backup bevat alleen vereiste bestanden, gebruikersbestanden en database.<br/> Genereert een klein zip-archief en vereist minder geheugen en ruimte</p> ';
$_lang['help_medium_backup'] = '<p>Deze backup bevat benodigde bestanden, gebruikersbestanden, elementen (fragmenten, modules, plugins ..) en database.<br/> Genereert een middelgroot zip-archief</p> ';
$_lang['help_full_backup'] = '<p>Deze backup bevat hele activa en manager map (inclusief aangepaste submappen), root bestanden en database backup<br/> Genereert een groter zip-archief en meer geheugen nodig en de middelen</p>';
$_lang['archive_backup_help_title'] = 'Download of EvoBackup zip-archief back-ups te verwijderen';
$_lang['archive_backup_help'] = '<p>Opmerking: zip-archief met <b>_db</b> achtervoegsel bevat een .sql bestand met de Database Backup</p><p>Archieven zonder <b>_db</b> achtervoegsel bevat gewoon bestanden</p>
<p>Om de automatische archieven back-ups te maken, te downloaden en te installeren <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p> ';
$_lang['sql_backup_help_title'] = 'Download of verwijder .sql backups';
$_lang['sql_backup_help'] = '<p>Sql backups kunnen handmatig worden gegenereerd met standaard <a href="index.php?a=93">MODX Backup snapshot manager</a></p> <p>Om automatische .sql back-ups te maken, download en installeer <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p>';
//Alerts
$_lang['backup_successful'] = 'Backup gelukt!';
$_lang['backupdb_successful'] = 'Database Backup gelukt!';
$_lang['backupzip_successful'] = 'Archief Backup gelukt!';
$_lang['backup_directory'] = 'Backup locatie';
$_lang['does_not_exist'] = 'bestaat niet';
$_lang['is_not_writable'] = 'is NIET schrijfbaar!';
$_lang['file'] = 'Bestand';
$_lang['deleted'] = 'Verwijderd';
$_lang['unable_to_backup_db'] = 'Backup database lukt niet';
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

