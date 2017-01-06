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
$_lang['TabManageBackup'] = 'Gestionar archivos de copias de seguridad';
$_lang['TabMODxBackup'] = 'Gestionar copias de seguridad de bases de datos';
//Manage Backups
$_lang['manage_backup'] = 'Gestionar copias de seguridad de los archivos de EvoBackup';
$_lang['manage_modx_backup'] = 'Gestionar las copias de seguridad de .sql del sistema MODx';
$_lang['manage_backup_descr'] = 'Descargar o eliminar archivos de copia de seguridad anteriores';
$_lang['backup_filename'] = 'Nombre del archivo';
$_lang['backup_filesize'] = 'Tamaño del archivo';
$_lang['backup_file_options'] = 'Opciones';
$_lang['delete_backup'] = 'Eliminar copia de seguridad';
$_lang['download_backup'] = 'Descargar copia de seguridad';
$_lang['extract_zip_backup'] = 'Extract Archive Backup';
$_lang['restore_sql_backup'] = 'Restore Sql Backup';
//Generate Backup
$_lang['generate_backup'] = 'Generar un nuevo archivo de copia de seguridad';
$_lang['choose_backup'] = 'Elija Tipo de copia de seguridad:';
$_lang['light_backup'] = 'Copia mínima';
$_lang['medium_backup'] = 'Copia media';
$_lang['full_backup'] = 'Copia del sitio completo';
//assets Backup
$_lang['assets_backup'] = 'Copia de seguridad de Assets';
$_lang['check_all'] = 'Seleccionar todo';
$_lang['whole_assets'] = 'Carpeta de Assets completos';
$_lang['assets_user_folders'] = 'Carpetas de usuarios';
$_lang['assets_elements_folders'] = 'Carpetas de elementos';
$_lang['assets_system_folders'] = 'Carpetas del sistema';
//manager backup
$_lang['manager_backup'] = 'Copias de seguridad de admin';
$_lang['whole_manager'] = 'Carpeta de admin completo';
$_lang['only_those_manager_files'] = 'Sólo los archivos y carpetas de admin:';
$_lang['manager_config_file'] = 'Archivo de configuración';
$_lang['manager_themes'] = 'Temas del admin';
//root backup
$_lang['root_backup'] = 'Copia de seguridad de archivos raíz';
$_lang['root_backup_descr'] = 'Seleccionar archivos raíz adicionales para incluirlos en el archivo';
//db backup
$_lang['db_backup'] = 'Copia de seguridad de la base de datos';
$_lang['include_db_to_zip'] = 'Incluir la copia de seguridad de .sql de la base de datos a zip ';
// custom backup
$_lang['custom_files_backup'] = 'Archivos y carpetas personalizadas';
//buttons
$_lang['backup_button_text'] = '¡Crear copia ahora!';
$_lang['help'] = 'Help';
$_lang['settings_module'] = 'Ajustes';
//help
$_lang['help_light_backup'] = '<p>Esta copia de seguridad incluye sólo los archivos necesarios, los archivos de usuario y db. <br/> Genera un archivo zip más pequeño y requiere menos memoria y recursos</p>  ';
$_lang['help_medium_backup'] = '<p>Esta copia de seguridad incluye archivos necesarios, archivos de usuario, elementos (snippets, modules, plugins..) y db. <br/> Genera un archivo zip medio</p> ';
$_lang['help_full_backup'] = '<p>Esta copia de seguridad incluye recursos completos y carpeta de admin (incluidas subcarpetas personalizadas), archivos raíz y respaldo db <br/> Genera un archivo zip más grande y requiere más memoria y recursos</p>';
$_lang['archive_backup_help_title'] = 'Download or delete EvoBackup .zip archive backups';
$_lang['archive_backup_help'] = '<p>Note: zip archive with <b>_db</b> suffix contains a .sql file with Database Backup</p><p>Archives without <b>_db</b> suffix contains just files</p>
<p>To create automatic archives backups, download and install <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p> ';
$_lang['sql_backup_help_title'] = 'Download or delete .sql backups';
$_lang['sql_backup_help'] = '<p>Sql backups can be manually generated with default <a href="index.php?a=93">MODX Backup Snapshot Manager</a></p> <p>To create automatic .sql backups, download and install <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p>';
//Alerts
$_lang['backup_successful'] = 'Backup Successful!';
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


