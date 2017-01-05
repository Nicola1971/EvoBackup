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
$_lang['TabManageBackup'] = 'Gestisci Archivi di Backup';
$_lang['TabMODxBackup'] = 'Gestisci Backup Sql';
//Manage Backups
$_lang['manage_backup'] = 'Gestisci archivi di Backup generati da EvoBackup';
$_lang['manage_modx_backup'] = 'Gestisci i backup .sql del sistema';
$_lang['manage_backup_descr'] = 'Scarica o cancella i precedenti backup';
$_lang['backup_filename'] = 'Nome file';
$_lang['backup_filesize'] = 'Dimensione';
$_lang['backup_file_options'] = 'Opzioni';
$_lang['delete_backup'] = 'Cancella Backup';
$_lang['download_backup'] = 'Scarica Backup';
//Generate Backup
$_lang['generate_backup'] = 'Genera un nuovo archivio di Backup';
$_lang['choose_backup'] = 'Scegli un tipo di Backup:';
$_lang['light_backup'] = 'Backup Leggero';
$_lang['medium_backup'] = 'Backup Medio';
$_lang['full_backup'] = 'Backup Completo';
//assets Backup
$_lang['assets_backup'] = 'Assets Backup';
$_lang['check_all'] = 'Seleziona tutto';
$_lang['whole_assets'] = 'e tutte le sotto directory';
$_lang['assets_user_folders'] = 'Utente';
$_lang['assets_elements_folders'] = 'Elementi';
$_lang['assets_system_folders'] = 'Sistema';
//manager backup
$_lang['manager_backup'] = 'Manager Backup';
$_lang['whole_manager'] = 'e tutte le sotto directory';
$_lang['only_those_manager_files'] = 'Solo questi file e directory:';
$_lang['manager_config_file'] = 'configurazione';
$_lang['manager_themes'] = 'temi del manager';
//root backup
$_lang['root_backup'] = 'Backup file in root';
$_lang['root_backup_descr'] = 'Seleziona i file da aggiungere all\'archivio';
//db backup
$_lang['db_backup'] = 'Backup del Database';
$_lang['include_db_to_zip'] = 'includi un backup .sql del database';
// custom backup
$_lang['custom_files_backup'] = 'Altri File e Cartelle';
//buttons
$_lang['backup_button_text'] = 'Backup!';
$_lang['help'] = 'Aiuto';
$_lang['settings_module'] = 'Configurazione';
//help
$_lang['help_light_backup'] = '<p>Questo backup include solo i file necessari, i file utente e il backup del db. <br/> Genera un archivio zip più piccolo e richiede meno memoria e risorse</p>';
$_lang['help_medium_backup'] = '<p>Questo backup include file necessari, i file utente, elementi (frammenti, moduli, plugin ..) e il backup del db. <br/> Genera un archivio zip di medie dimensioni</p> ';
$_lang['help_full_backup'] = '<p>Questo backup include le directory assets e manager (incluse sottocartelle personalizzate), i file di root e il backup del db <br/> Genera un archivio zip più grande e richiede più memoria e risorse</p>';
$_lang['archive_backup_help_title'] = 'Scarica o cancella gli archivi di backup in formato .zip';
$_lang['archive_backup_help'] = '<p>Note: gli archivi .zip con suffisso <b>_db</b> contengono un file .sql con il Backup del Database</p><p>Gli archivi privi del suffisso <b>_db</b> contengono solo il backup dei files</p>
<p>Per creare automaticamente archivi di backup, scarica e installa <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</p> ';
$_lang['sql_backup_help_title'] = 'Scarica o cancella file .sql con il Backup del Database';
$_lang['sql_backup_help'] = '<p>I backup .sql possono essere generati manualmente, utilizzando lo strumento di sistema di <a href="index.php?a=93"> Backup e Snapshot</a></p> <p>Per creare automaticamente file .sql con il Backup del Database, scarica e installa <a href="https://github.com/Nicola1971/AutoEvoBackup" target="_blank">AutoEvoBackup</p>';
//Alerts
$_lang['backup_successful'] = 'Backup Eseguito con successo!';
$_lang['backup_directory'] = 'La Directory di Backup ';
$_lang['does_not_exist'] = 'non esiste';
$_lang['is_not_writable'] = 'NON è scrivibile!';
$_lang['file'] = 'File';
$_lang['deleted'] = 'Cancellato';
$_lang['unable_to_backup_db'] = 'Impossibile eseguire il Backup del Database';

