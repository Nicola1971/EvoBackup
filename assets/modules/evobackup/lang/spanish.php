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
$_lang["bk_manager"] = 'Gestor copias de seguridad';
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
$_lang['extract_zip_backup'] = 'Extraer archivo de copia de seguridad';
$_lang['restore_sql_backup'] = 'Restaurar copia de seguridad de SQL';
//Generate Backup
$_lang['generate_backup'] = 'Generar un nuevo archivo de copia de seguridad';
$_lang['choose_backup'] = 'Elija tipo de copia de seguridad:';
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
$_lang['backupdb_button_text'] = 'Crear copia de seguridad de la base de datos';
$_lang['backupdbonly_button_text'] = 'Sólo crear copia de la base de datos';
$_lang['close'] = 'Cerrar';
$_lang['help'] = 'Ayuda';
$_lang['settings_module'] = 'Ajustes';
//help
$_lang['help_light_backup'] = '<p>Esta copia de seguridad incluye sólo los archivos necesarios, los archivos de usuario y db. <br/> Genera un archivo zip más pequeño y requiere menos memoria y recursos</p>  ';
$_lang['help_medium_backup'] = '<p>Esta copia de seguridad incluye archivos necesarios, archivos de usuario, elementos (snippets, modules, plugins..) y db. <br/> Genera un archivo zip medio</p> ';
$_lang['help_full_backup'] = '<p>Esta copia de seguridad incluye recursos completos y carpeta de admin (incluidas subcarpetas personalizadas), archivos raíz y respaldo db <br/> Genera un archivo zip más grande y requiere más memoria y recursos</p>';
$_lang['archive_backup_help_title'] = 'Descargar o eliminar las copias de seguridad .zip de EvoBackup ';
$_lang['archive_backup_help'] = '<p>Nota: el archivo zip con sufijo <b>_db</b> contiene un archivo .sql con archivos de copia de seguridad de base de datos.</p><p>Archivos sin sufijo <b>_db</b> contiene sólo archivos.</p>
<p>Para crear copias de seguridad automáticas de archivos, descargue e instale <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p> ';
$_lang['sql_backup_help_title'] = 'Descargar o eliminar copias de seguridad .sql';
$_lang['sql_backup_help'] = '<p>Las copias de seguridad de SQL se pueden generar manualmente con el predeterminado <a href="index.php?a=93">MODX Backup Snapshot Manager</a></p> <p>Para crear copias de seguridad .sql automáticas, descargue e instale <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</a></p>';
//Alerts
$_lang['backup_successful'] = '¡Copia creada con éxito!';
$_lang['backupdb_successful'] = '¡Copia Database creada con éxito!';
$_lang['backupzip_successful'] = '¡Copia creada con éxito!';
$_lang['backup_directory'] = 'Directorio de copia de seguridad';
$_lang['does_not_exist'] = 'no existe';
$_lang['is_not_writable'] = '¡NO se puede escribir!';
$_lang['file'] = 'Archivo';
$_lang['deleted'] = 'Eliminado';
$_lang['unable_to_backup_db'] = 'No se puede guardar la base de datos';
$_lang['archive_extracted'] = 'Archivo Extraído';
$_lang['db_extracted'] = 'Base de datos restaurada';
$_lang['error_open_archive'] = 'Error al abrir el archivo';
// Confirm windows alerts
$_lang['delete_confirm'] = '¿Estas seguro que quieres borrarlo?';
$_lang['delete_confirm_info'] = '¡Los archivos eliminados no se pueden restaurar más tarde!';
$_lang['extract_zip_confirm'] = '¿Estás seguro de que quieres Extraer?';
$_lang['extract_to'] = 'a';
$_lang['backup_folder'] = 'Carpeta de copia de seguridad';
$_lang['extract_folder'] = 'Carpeta de Extraer';
$_lang['extract_zip_info'] = 'Restaurar una copia de seguridad del archivo, en la raíz del sitio, sobrescribirá todos los archivos existentes. ¡Esta acción puede ser muy peligrosa!';
$_lang['restore_sql_confirm'] = '¿Seguro que quieres restaurar?';
$_lang['restore_sql_info'] = 'Restaurar la copia de seguridad de .sql sobrescribirá todos los datos de base de datos existentes. ¡Esta acción puede ser muy peligrosa!';
