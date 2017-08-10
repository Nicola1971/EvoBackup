<?php
/**
* EvoBackup Module
*/
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");
global $modx, $_lang;

$base_path = $modx->config['base_path'];
$MGR_DIR = MGR_DIR;
if(!$modx->hasPermission('bk_manager')) {	
	$e->setError(3);
	$e->dumpError();
    exit;	
}
$modx_backup_dir = $_SERVER['DOCUMENT_ROOT'].$backup_dir;
$modx_db_backup_dir = $modx->config['base_path'] . 'assets/backup/';
// module info
$module_version = '1.3';
$module_id = (!empty($_REQUEST["id"])) ? (int)$_REQUEST["id"] : $yourModuleId;

//lang
$_lang = array();
include($mods_path.'evobackup/lang/english.php');
if (file_exists($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php')) {
    include($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php');
}

$out ='';
// onManagerMainFrameHeaderHTMLBlock
$evtOut = $modx->invokeEvent('OnManagerMainFrameHeaderHTMLBlock');
$onManagerMainFrameHeaderHTMLBlock = is_array($evtOut) ? implode("\n", $evtOut) : '';
$out .= $onManagerMainFrameHeaderHTMLBlock;

// check if backup exists and is writable
if (!file_exists($modx_backup_dir))
{
    $BACKUPERROR = "<div class=\"alert\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> ".$_lang['backup_directory']." <strong>$modx_backup_dir</strong> ".$_lang['does_not_exist']."</div>";
} elseif(!is_writable($modx_backup_dir))
    {
        $BACKUPERROR = "<div class=\"alert\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> ".$_lang['backup_directory']." <strong>$modx_backup_dir</strong> ".$_lang['is_not_writable']."</div>";
    }

if (isset($BACKUPERROR) && $BACKUPERROR!='') {
    $out .= $BACKUPERROR;
    include_once($mods_path.'evobackup/display.php');
    return $out;
}
//custom folder
$customfold1 = isset ($customfold1) ? $customfold1 : '';
$customfold2 = isset ($customfold2) ? $customfold2 : '';
$customfold3 = isset ($customfold3) ? $customfold3 : '';
$customfold4 = isset ($customfold4) ? $customfold4 : '';
$customfold5 = isset ($customfold5) ? $customfold5 : '';
// --------------- Set Directories and files to include in archive
$dumpmanager  = isset($_POST['dumpmanager']) ? $_POST['dumpmanager']:'';
$dumpmanager  = isset($_POST['dumpmanager']) ? $_POST['dumpmanager']:'';
$dumpmactions  = isset($_POST['dumpmactions']) ? $_POST['dumpmactions']:'';
$dumpmframes  = isset($_POST['dumpmframes']) ? $_POST['dumpmframes']:'';
$dumpmincludes  = isset($_POST['dumpmincludes']) ? $_POST['dumpmincludes']:'';
$dumpmmedia  = isset($_POST['dumpmmedia']) ? $_POST['dumpmmedia']:'';
$dumpmprocessors  = isset($_POST['dumpmprocessors']) ? $_POST['dumpmprocessors']:'';


$dumpindex  = isset($_POST['dumpindex']) ? $_POST['dumpindex']:'';
$dumpindexajax  = isset($_POST['dumpindexajax']) ? $_POST['dumpindexajax']:'';
$dumphtaccess  = isset($_POST['dumphtaccess']) ? $_POST['dumphtaccess']:'';
$dumprobots  = isset($_POST['dumprobots']) ? $_POST['dumprobots']:'';
$dumpconfig  = isset($_POST['dumpconfig']) ? $_POST['dumpconfig']:'';
$dumpthemes  = isset($_POST['dumpthemes']) ? $_POST['dumpthemes']:'';
$dumpmanhtaccess  = isset($_POST['dumpmanhtaccess']) ? $_POST['dumpmanhtaccess']:'';

$dumpcustomfold1  = isset($_POST['dumpcustomfold1']) ? $_POST['dumpcustomfold1']:'';
$dumpcustomfold2  = isset($_POST['dumpcustomfold2']) ? $_POST['dumpcustomfold2']:'';
$dumpcustomfold3  = isset($_POST['dumpcustomfold3']) ? $_POST['dumpcustomfold3']:'';
$dumpcustomfold4  = isset($_POST['dumpcustomfold4']) ? $_POST['dumpcustomfold4']:'';
$dumpcustomfold5  = isset($_POST['dumpcustomfold5']) ? $_POST['dumpcustomfold5']:'';

$dumpassets  = isset($_POST['dumpassets']) ? $_POST['dumpassets']:'';
//assets subfolders
$dumpthumbs  = isset($_POST['dumpthumbs']) ? $_POST['dumpthumbs']:'';
$dumpbackup  = isset($_POST['dumpbackup']) ? $_POST['dumpbackup']:'';
$dumpcache  = isset($_POST['dumpcache']) ? $_POST['dumpcache']:'';
$dumpdocs  = isset($_POST['dumpdocs']) ? $_POST['dumpdocs']:'';
$dumpexport  = isset($_POST['dumpexport']) ? $_POST['dumpexport']:'';
$dumpfiles  = isset($_POST['dumpfiles']) ? $_POST['dumpfiles']:'';
$dumpflash  = isset($_POST['dumpflash']) ? $_POST['dumpflash']:'';
$dumpimages  = isset($_POST['dumpimages']) ? $_POST['dumpimages']:'';
$dumpimport  = isset($_POST['dumpimport']) ? $_POST['dumpimport']:'';
$dumpjs  = isset($_POST['dumpjs']) ? $_POST['dumpjs']:'';
$dumplib  = isset($_POST['dumplib']) ? $_POST['dumplib']:'';
$dumpmedia  = isset($_POST['dumpmedia']) ? $_POST['dumpmedia']:'';
$dumpmodules  = isset($_POST['dumpmodules']) ? $_POST['dumpmodules']:'';
$dumpplugins  = isset($_POST['dumpplugins']) ? $_POST['dumpplugins']:'';
$dumpsite  = isset($_POST['dumpsite']) ? $_POST['dumpsite']:'';
$dumpsnippets  = isset($_POST['dumpsnippets']) ? $_POST['dumpsnippets']:'';
$dumptemplates  = isset($_POST['dumptemplates']) ? $_POST['dumptemplates']:'';
$dumptvs  = isset($_POST['dumptvs']) ? $_POST['dumptvs']:'';

//dump assets folder and index.html
//$modx_files_array = array($modx_root_dir.'assets/index.html');
// dump whole assets..
if ($dumpassets!='')
{
    $modx_files_array = array($modx_root_dir.'assets');
}
//else selected folder
else {
$modx_files_array = array($modx_root_dir.'assets/index.html');
    
if ($dumpthumbs!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/.thumbs';
}
if ($dumpbackup!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/backup';
}
if ($dumpcache!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/cache';
}
if ($dumpdocs!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/docs';
}
if ($dumpexport!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/export';
}
if ($dumpfiles!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/files';
}
if ($dumpflash!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/flash';
}
if ($dumpimages!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/images';
}
if ($dumpimport!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/import';
}
if ($dumpjs!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/js';
}
if ($dumplib!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/lib';
}
if ($dumpmedia!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/media';
}
if ($dumpmodules!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/modules';
}
if ($dumpplugins!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/plugins';
}
if ($dumpsite!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/site';
}
if ($dumpsnippets!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/snippets';
}
if ($dumptemplates!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/templates';
}
if ($dumpsite!='')
{
    $modx_files_array[]=$modx_root_dir.'assets/tvs';
}

}
//dump whole manager folder...

if ($dumpmanager!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR;
}
// ..else selcted files or folders
else {
if ($dumpconfig!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/includes/config.inc.php';
}    

if ($dumpthemes!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/media/style';
} 
if ($dumpmanhtaccess!='')
{
if (file_exists($modx_root_dir.$MGR_DIR.'/.htaccess'))
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/.htaccess';
}
} 
if ($dumpmactions!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/actions';
}
if ($dumpmframes!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/frames';
}
if ($dumpmincludes!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/includes';
}
if ($dumpmmedia!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/media';
}
if ($dumpmprocessors!='')
{
    $modx_files_array[]=$modx_root_dir.$MGR_DIR.'/processors';
}
}
//dump root files 
if ($dumpindex!='')
{
    $modx_files_array[]=$modx_root_dir.'index.php';
}
if ($dumpindexajax!='')
{
if (file_exists($modx_root_dir.'index-ajax.php'))
{
    $modx_files_array[]=$modx_root_dir.'index-ajax.php';
}  
}
if ($dumphtaccess!='')
{
if (file_exists($modx_root_dir.'.htaccess'))
{
    $modx_files_array[]=$modx_root_dir.'.htaccess';
}  
}
if ($dumprobots!='')
{
if (file_exists($modx_root_dir.'robots.txt'))
{
    $modx_files_array[]=$modx_root_dir.'robots.txt';
}  
}

//custom files and folders
if ($dumpcustomfold1!='' && file_exists($modx_root_dir.$customfold1))
{
    $modx_files_array[]=$modx_root_dir.$customfold1;
}  
if ($dumpcustomfold2!='' && file_exists($modx_root_dir.$customfold2))
{
    $modx_files_array[]=$modx_root_dir.$customfold2;
} 
if ($dumpcustomfold3!='' && file_exists($modx_root_dir.$customfold3))
{
    $modx_files_array[]=$modx_root_dir.$customfold3;
}
if ($dumpcustomfold4!='' && file_exists($modx_root_dir.$customfold4))
{
    $modx_files_array[]=$modx_root_dir.$customfold4;
}
if ($dumpcustomfold5!='' && file_exists($modx_root_dir.$customfold5))
{
    $modx_files_array[]=$modx_root_dir.$customfold5;
}

if (!defined('PCLZIP_TEMPORARY_DIR')) { define( 'PCLZIP_TEMPORARY_DIR', $modx_backup_dir ); }

$archive_file = $modx_backup_dir.$archive_prefix;

$opcode     = isset($_POST['opcode']) ? $_POST['opcode']:'';
$dumpdbase  = isset($_POST['dumpdbase']) ? $_POST['dumpdbase']:'';
$droptables = isset($_POST['droptables']) ? $_POST['droptables']:'';
$filename   = isset($_REQUEST['filename']) ? $_REQUEST['filename']:'';
$deletebackupsql  = isset($_POST['deletebackupsql']) ? $_POST['deletebackupsql']:'';

$out .= <<<EOD
<script language="JavaScript" type="text/javascript">
function postForm(opcode,filename){
document.module.opcode.value=opcode;
document.module.filename.value=filename;
document.module.submit();
}
</script>
<form name="module" method="post">
<input name="opcode" type="hidden" value="" />
<input name="filename" type="hidden" value="" />
EOD;

switch($opcode)
{
    case 'deletezip': // delete file
        $deletefile = $modx_backup_dir.$filename;
        if (!file_exists($deletefile))
        {
            $out .= "<div class=\"alert\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> ".$_lang['file']." $filename ".$_lang['does_not_exist']."<br /></div>";
        } else
            {
                unlink($deletefile);
                $out .= "<div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                <i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> $filename ".$_lang['deleted']."<br /></div>";
            }
    break;
    case 'deletesql': // delete file
        $modx_backup_default = "../assets/backup/";
        $deletefile = $modx_db_backup_dir.$filename;
        if (!file_exists($deletefile))
        {
            $out .= "<p class=\"alert\"><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> File $filename ".$_lang['does_not_exist']."<br /></p>";
        } else
            {
                unlink($deletefile);
                $out .= "<div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                <i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> $filename ".$_lang['deleted']."<br /></div>";
            }
    break; 
       case 'generate': // generate backup
        /**
        * Zip directories into archive
        */
		// attempt to change mem / time limits
		@set_time_limit($zip_time_limit);
		@ini_set("memory_limit",$zip_memory_limit);
        $archive_file .= $archive_suffix.'.zip';
        include_once($mods_path.'evobackup/pclzip.lib.php');
        $archive = new PclZip($tempfile);
        $v_list = $archive->create($modx_files_array,PCLZIP_OPT_REMOVE_PATH, $modx_root_dir );
        if ($v_list == 0) {
            $out .= "Error : ".$archive->errorInfo(true);
            return $out;
        }
        rename($tempfile,$archive_file);       
        $out .= "<div class=\"success\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><h2><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> ".$_lang['backup_successful']." </h2><strong> <a  class=\"textlink\"  href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($archive_file)."\">$archive_file</a></strong><br /><br />
        <span class=\"actionButtons evobkpbuttons\">
             <a href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($archive_file)."\"><i class=\"fa fa-download\" aria-hidden=\"true\"></i>  ".$_lang['download_backup']."</a>
        </span></div>";    

        // add database, callback for dbdump
       if ($dumpdbase!='') {
            $out .= "<script type=\"text/javascript\" language=\"javascript\">postForm('dumpdbase','".basename($archive_file)."');</script>";
        }
        
    break;
        case 'onlydbase': // add mysql database dump to archive
        // dump sql data to temp file
        include_once($mods_path.'evobackup/dumpsql.php');
        
        /*
         * Code taken from Ralph A. Dahlgren MySQLdumper Snippet - Etomite 0.6 - 2004-09-27
         * Modified by Raymond 3-Jan-2005
         * Perform MySQLdumper data dump
         */
        @set_time_limit($db_time_limit); // set timeout limit to 2 minutes
        global $dbase,$database_user,$database_password,$dbname,$database_server;
        $dbname = str_replace("`","",$dbase);
        $dumper = new Mysqldumper($database_server, $database_user, $database_password, $dbname); # Variables have replaced original hard-coded values
        
		$dumper->setTablePrefix($table_prefix);
        $dumper->setDroptables(true);
        $dumpfinished = $dumper->createDump($dump_log_tables);
        $fh = fopen($modx_db_backup_dir.$database_filename,'w');
        
        if($dumpfinished) 
        {
            fwrite($fh,$dumpfinished);               
            fclose($fh);
          $out .= "<div class=\"success\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><h2><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> ".$_lang['backupdb_successful']."</h2><strong><a class=\"textlink\" href=\"".$modx->config['site_url']."assets/modules/evobackup/downloadsql.php?filename=".basename($database_filename)."\">".$modx_db_backup_dir.$database_filename."</a></strong><br /><br />
    <span class=\"actionButtons evobkpbuttons\">
             <a href=\"".$modx->config['site_url']."assets/modules/evobackup/downloadsql.php?filename=".basename($database_filename)."\"><i class=\"fa fa-download\" aria-hidden=\"true\"></i>  ".$_lang['download_backup']."</a>
        </span>
    </div>";
         }       
        else {
	        $e->setError(1,"".$_lang['unable_to_backup_db']."");
	        $e->dumpError();
        }
  
    break;
        
    case 'dumpdbase': // add mysql database dump to archive
        // dump sql data to temp file
        include_once($mods_path.'evobackup/dumpsql.php');
        
        /*
         * Code taken from Ralph A. Dahlgren MySQLdumper Snippet - Etomite 0.6 - 2004-09-27
         * Modified by Raymond 3-Jan-2005
         * Perform MySQLdumper data dump
         */
        @set_time_limit($db_time_limit); // set timeout limit to 2 minutes
        global $dbase,$database_user,$database_password,$dbname,$database_server;
        $dbname = str_replace("`","",$dbase);
        $dumper = new Mysqldumper($database_server, $database_user, $database_password, $dbname); # Variables have replaced original hard-coded values
        
		$dumper->setTablePrefix($table_prefix);
        $dumper->setDroptables(true);
        $dumpfinished = $dumper->createDump($dump_log_tables);
        $fh = fopen($modx_db_backup_dir.$database_filename,'w');
        
        if($dumpfinished) 
        {
            fwrite($fh,$dumpfinished);               
            fclose($fh);
          $out .= "<script type=\"text/javascript\" language=\"javascript\">postForm('zipdatabase','".basename($filename)."');</script>";
         }       
        else {
	        $e->setError(1,"".$_lang['unable_to_backup_db']."");
	        $e->dumpError();
        }
  
    break;

    case 'zipdatabase':
        // add dump file to archive
        @set_time_limit($zip_time_limit);
        @ini_set("memory_limit",$zip_memory_limit);
        include_once($mods_path.'evobackup/pclzip.lib.php');
        $archive = new PclZip($modx_backup_dir.$filename);
        $v_list = $archive->add($modx_db_backup_dir.$database_filename,PCLZIP_OPT_REMOVE_PATH, $modx_db_backup_dir );
        if ($v_list == 0) {
            $out .= "Error : ".$archive->errorInfo(true);
            return $out;
        }
        
		// 6 mar/ 07 adjusted to cater for names like mysite.com.au    ie extra . in filename
		$fileBits = explode('.',$filename);
		$ext = array_pop($fileBits); 
		$fname = implode('.',$fileBits);
		
		// list($fname,$ext) = explode('.',$filename);
        rename($modx_backup_dir.$filename,$modx_backup_dir.$fname.'_db.'.$ext);
        // delete .sql file in backup dir after adding to zip
          //          if ($deletebackupsql!='') {
      unlink($modx_db_backup_dir.$database_filename);
    //}
    $out .= "<div class=\"success\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><h2><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> ".$_lang['backupzip_successful']." </h2><strong><a class=\"textlink\" href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($fname."_db.".$ext)."\">".$modx_backup_dir.$fname."_db.".$ext."</a></strong><br /><br />
    <span class=\"actionButtons evobkpbuttons\">
             <a href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($fname."_db.".$ext)."\"><i class=\"fa fa-download\" aria-hidden=\"true\"></i>  ".$_lang['download_backup']."</a>
        </span>
    </div>";    
 break;
//extract a ZipArchive 
case 'extractzip': 
$ext = '.zip';
$zipname = $modx_backup_dir.$filename;
$zip = new ZipArchive;
//open the archive
if ($zip->open($modx_backup_dir.$filename) === TRUE) {
    //extract contents to /data/ folder
    $zip->extractTo($modx_extract_dir);
    //close the archive
    $zip->close();
     $out .= "<div class=\"success\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><h2><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> ".$_lang['archive_extracted']."! </h2><p>from <b>$filename</b> <br/>to <b>$modx_extract_dir</b></p></div>";   
} else {
    $out .= '<div class=\"alert\">'.$_lang['error_open_archive'].'!</div>';
}
break;
case 'restoresql':
global $dbase,$database_user,$database_password,$dbname,$database_server;
$dbname = str_replace("`","",$dbase);        
$sql = mysqli_connect($database_server, $database_user, $database_password, $dbname);
$sqlSource = file_get_contents($modx_db_backup_dir.$filename);
mysqli_multi_query($sql,$sqlSource);
$out .= "<div class=\"success\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span><h2><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> ".$_lang['db_extracted']."! </h2></div>";
break;
}


/** tabs**/
$out .= "<div class=\"tab-pane\" id=\"evobackupPanes\">
   <script type=\"text/javascript\">
        tpResources = new WebFXTabPane( document.getElementById( \"evobackupPanes\" ), true);
    </script>
        <div class=\"tab-page\" id=\"tabEvobackup\">
    <h2 class=\"tab\"><a href=\"#tabpanel-evobackup\"><span><i class=\"fa fa-download\" aria-hidden=\"true\"></i> ".$_lang['modulename']."</span></a></h2>";

$backup = $_lang['backup'];
$help = $_lang['help'];
$Config = $_lang["settings_module"];
$check_all= $_lang["check_all"];
$out .= '
</tbody></table></form>




<h2>'.$_lang['generate_backup'].'</h2>
<div id="evobackup-info" style="display:none">
            <div class="evobackup-tab-help">
             <h3>'.$_lang['light_backup'].'</h3>
             '.$_lang['help_light_backup'].'
            <h3>'.$_lang['medium_backup'].'</h3>
             '.$_lang['help_medium_backup'].'
            <h3>'.$_lang['full_backup'].'</h3>
             '.$_lang['help_full_backup'].'
            <h3>'.$_lang['backup_folder'].':</h3>
            <b>'.$modx_backup_dir.'</b>
             </div>
        </div>
<p><span class="info"><b><a href="#" title="'.$_lang['help'].'" class="evobackup-help"><i class="fa fa-question-circle fa-lg " aria-hidden="true"></i></a></b></span> '.$_lang['choose_backup'].' <span class="info">
<input type="checkbox" class="UncheckReq UncheckFull" id="checkMinBackup" checked="checked"><b>'.$_lang['light_backup'].'</b> 
<input type="checkbox" class="UncheckMin UncheckFull" id="checkReqBackup"><b>'.$_lang['medium_backup'].'</b>  <input type="checkbox" class="UncheckReq UncheckMin" id="checkAllBackup" ><b>'.$_lang['full_backup'].'</b></span></p>

<div class="border-top" style="clear:both"></div>
<div id="more-options">
<div class="left border-right">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['assets_backup'].'</h3>
<p class="info"><input type="checkbox" class="UncheckReq UncheckMin" id="checkAllAssets" > '.$_lang['check_all'].' 
 <label><input type="checkbox" name="dumpassets" class="UncheckReq UncheckMin checkAll"/>  <b>/assets</b> ('.$_lang['whole_assets'].')</label></p>

<div class="left border-right">
<h4>'.$_lang['assets_user_folders'].'</h4>
<label><input type="checkbox" name="dumptemplates" class="checkAssets checkReq checkMin" checked="checked"/>  /templates</label><br />
<label><input type="checkbox" name="dumpfiles" class="checkAssets checkReq checkMin" checked="checked"/>  /files </label><br />
<label><input type="checkbox" name="dumpflash" class="checkAssets checkReq checkMin" checked="checked"/>  /flash </label><br />
<label><input type="checkbox" name="dumpimages" class="checkAssets checkReq checkMin" checked="checked"/>  /images </label><br />
<label><input type="checkbox" name="dumpmedia" class="checkAssets checkReq checkMin" checked="checked"/>  /media </label><br />
</div>

<div class="left border-right">
<h4>'.$_lang['assets_elements_folders'].'</h4>
<label><input type="checkbox" name="dumpmodules" class="checkAssets UncheckMin checkReq"/>  /modules</label><br />
<label><input type="checkbox" name="dumpplugins" class="checkAssets UncheckMin checkReq"/>  /plugins</label><br />
<label><input type="checkbox" name="dumpsnippets" class="checkAssets UncheckMin checkReq"/>  /snippets</label><br />
<label><input type="checkbox" name="dumptvs" class="checkAssets UncheckMin checkReq"/>  /tvs</label><br />
<label><input type="checkbox" name="dumplib" class="checkAssets UncheckMin checkReq"/>  /lib </label><br />
<label><input type="checkbox" name="dumpjs" class="checkAssets UncheckMin checkReq"/>  /js </label><br />
</div>

<div class="left">
<h4>'.$_lang['assets_system_folders'].'</h4>
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpthumbs" /> /.thumbs </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpbackup"/> /backup </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpcache" /> /cache </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpdocs" />  /docs </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpexport" />  /export </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpimport" />  /import </label><br />
<label><input type="checkbox" class="checkAssets UncheckMin UncheckReq" name="dumpsite" />  /site</label><br />
</div>


</div>

<div class="left" style="padding-right: 25px;">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['manager_backup'].'</h3>
<p class="info"><label><input type="checkbox" class="UncheckReq UncheckMin checkAll" name="dumpmanager" /> <b>/'.$MGR_DIR.'</b>  ('.$_lang['whole_manager'].')</label></p>
<div class="left">
<h4>'.$_lang['only_those_manager_files'].'</h4>
<label><input type="checkbox" name="dumpconfig" class="checkReq UncheckFull UncheckMin"/> /includes/config.inc.php </label><span class="info">('.$_lang['manager_config_file'].')</span><br />
<label><input type="checkbox" name="dumpmanhtaccess" class="UncheckReq UncheckMin UncheckFull"/> /.htaccess </label><br />
<label><input type="checkbox" name="dumpthemes" class="UncheckReq UncheckMin UncheckFull"/> /media/styles </label><span class="info">('.$_lang['manager_themes'].')</span><br />
<label><input type="checkbox" name="dumpmframes" class="UncheckReq UncheckMin UncheckFull"/> /frames </label><br />
<label><input type="checkbox" name="dumpmincludes" class="UncheckReq UncheckMin UncheckFull"/> /includes </label><br />
<label><input type="checkbox" name="dumpmmedia" class="UncheckReq UncheckMin UncheckFull"/> /media </label><br />
<label><input type="checkbox" name="dumpmprocessors" class="UncheckReq UncheckMin UncheckFull"/> /processors </label><br />
</div>
</div>
<div class="border-top" style="clear:both"></div>

<div class="left border-right" style="padding-right: 25px;">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['root_backup'].'</h3>
<p>'.$_lang['root_backup_descr'].'</p>
<label><input type="checkbox" class="UncheckReq UncheckMin checkAll" name="dumphtaccess" /> .htaccess </label><br />
<label><input type="checkbox" class="UncheckMin checkAll checkReq" name="dumprobots"/> robots.txt </label><br />
<label><input type="checkbox" class="UncheckReq UncheckMin checkAll" name="dumpindex" />  index.php </label><br />
<label><input type="checkbox" class="UncheckReq UncheckMin checkAll" name="dumpindexajax" />  index-ajax.php </label><br /><br />
</div>

<div class="left border-right">
<h3><i class="fa fa-database" aria-hidden="true"></i> '.$_lang['db_backup'].'</h3>
<label><input type="checkbox" name="dumpdbase" class="checkAll checkReq checkMin" checked="checked" /> '.$_lang['include_db_to_zip'].'</label><br /><br />
<br />
</div>
<div class="left">
';

if ($customfold1!=''){
$out .= '
<h3><i class="fa fa-folder-open" aria-hidden="true"></i> '.$_lang['custom_files_backup'].'</h3>
<label><input class="UncheckReq UncheckMin checkAll" type="checkbox" name="dumpcustomfold1" class="checkAll"/>  '.$customfold1.' </label><br />';
}
if ($customfold2!=''){
$out .=  '
<label><input class="UncheckReq UncheckMin checkAll" type="checkbox" name="dumpcustomfold2" class="checkAll"/>  '.$customfold2.' </label><br />';
}
if ($customfold3!=''){
$out .= '
<label><input class="UncheckReq UncheckMin checkAll" type="checkbox" name="dumpcustomfold3" class="checkAll"/>  '.$customfold3.' </label><br />';
}
if ($customfold4!=''){
$out .= '
<label><input class="UncheckReq UncheckMin checkAll" type="checkbox" name="dumpcustomfold4" class="checkAll"/>  '.$customfold4.' </label><br />';
}
if ($customfold5!=''){
$out .= '
<label><input class="UncheckReq UncheckMin checkAll" type="checkbox" name="dumpcustomfold5" class="checkAll"/>  '.$customfold5.' </label><br />';
}

$out .=  '
</div>

<div class="border-top" style="clear:both"></div>
</div>
<span class="actionButtons evobkpbuttons">
             <a class="btn btn-success" href="#" onclick="postForm(\'generate\')" value="Backup Now!">'.$_lang['backup_button_text'].'</a>  
              <a class="btn btn-primary" href="#" onclick="postForm(\'onlydbase\')" value="Backup db">'.$_lang['backupdbonly_button_text'].'</a> 
        </span>



<!---<div style="clear:both"></div>-->
</div>

';
/**
* Display list of backups with download
*/    
global $modx;
$out .= "<div class=\"tab-page\" id=\"tabpanel-evofullbkp\">
	<h2 id=\"tabs-fullbkp\" class=\"tab\"><a href=\"#tabpanel-evofullbkp\"><span><i class=\"fa fa-file-archive-o\" aria-hidden=\"true\"></i> ".$_lang['TabManageBackup']."</span></a></h2>
    <h2> ".$_lang['manage_backup']."</h2>
    <div id=\"archivebackup-info\" style=\"display:none\">
            <div class=\"evobackup-tab-help\">
             <h3>".$_lang['archive_backup_help_title']."</h3>
             ".$_lang['archive_backup_help']."
             <h3>".$_lang['extract_zip_backup']."</h3>
             <p>".$_lang['extract_zip_info']."</p>
            <h3>".$_lang['extract_folder'].":</h3>
             <p><b>".$modx_extract_dir."</b><br/> </p>
             <h3>".$_lang['delete_backup']."</h3>
             <p>".$_lang['delete_confirm_info']."</p>
             </div>
        </div>
    <p><span class=\"info\"><b><a href=\"#\" title=\"".$_lang['help']."\" class=\"archivebackup-help\"><i class=\"fa fa-question-circle fa-lg \" aria-hidden=\"true\"></i></a></b></span> ".$_lang['manage_backup_descr']."</p><div class=\"table-responsive\"><table id=\"zipbackup\" class=\"evobackup tablesorter table data\" width=\"100%\"><thead><tr>
    <th data-sort=\"string\" style=\"width: 300px;\"><b>".$_lang['backup_filename']."</b></th>
    <th data-sort=\"int\"><b>".$_lang['backup_filesize']."</b></th>
    <th style=\"text-align:right;\"><b>".$_lang['backup_file_options']."</b></th>
  </tr></thead><tbody>
  ";
if ($handle = opendir($modx_backup_dir)) {
   /* Loop over backup directory */
   while (false !== ($file = readdir($handle))  ) {
       if ($file!='.' && $file!='..' && (strpos($file,$archive_prefix)!==false ) && $file!=$database_filename)
       {
           $fs = filesize($modx_backup_dir.$file)/1024; 
           $out .= "<tr><td><i class=\"fa fa-file-archive-o yellow\" aria-hidden=\"true\"></i>  <b>$file</b></td><td> ".ceil($fs)." kb</td>"
                  ."<td class=\"actions\" style=\"text-align:right;\"><a title=\"".$_lang['download_backup']."\"  href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=$file\"><i class=\"fa fa-download\"></i></a> 
                  
                  <a title=\"".$_lang['extract_zip_backup']."\" onclick=\"javascript:if(confirm('".$_lang['extract_zip_confirm']." $file ".$_lang['extract_to']." $modx_extract_dir ? ".$_lang['extract_zip_info']."')){postForm('extractzip','$file'); return false;}\"><i class=\"fa fa-file-archive-o\"></i></a>
                  
          
                  <a title=\"".$_lang['delete_backup']."\" onclick=\"javascript:if(confirm('".$_lang['delete_confirm']." $file? ".$_lang['delete_confirm_info']."')){postForm('deletezip','$file'); return false;}\"><i class=\"fa fa-trash\"></i></a>
           
                   
                   </td></tr>";
       }
   }
   closedir($handle);
}
$out .= '</tbody></table></div></div>';
/**
* Display list of modx backups with download
*/
global $modx;
$sqlext = '.sql';
$out .= "<div class=\"tab-page\" id=\"tabpanel-evosqlbkp\">
	<h2 id=\"tabs-evosql\" class=\"tab\"><a href=\"#tabpanel-evosqlbkp\"><span><i class=\"fa fa-database\" aria-hidden=\"true\"></i> ".$_lang['TabMODxBackup']."</span></a></h2>
<h2>".$_lang['manage_modx_backup']."</h2>
    <div id=\"sqlbackup-info\" style=\"display:none\">
            <div class=\"evobackup-tab-help\">
             <h3>".$_lang['sql_backup_help_title']."</h3>
             ".$_lang['sql_backup_help']."
             <h3>".$_lang['restore_sql_backup']."</h3>
             <p>".$_lang['restore_sql_info']."</p>
             <h3>".$_lang['delete_backup']."</h3>
             <p>".$_lang['delete_confirm_info']."</p>
             </div>
        </div>
<p><span class=\"info\"><b><a href=\"#\" title=\"".$_lang['help']."\" class=\"sqlbackup-help\"><i class=\"fa fa-question-circle fa-lg \" aria-hidden=\"true\"></i></a></b></span>  ".$_lang['manage_backup_descr']."</p><div class=\"table-responsive\"><table id=\"sqlbackup\" class=\"evobackup table data\" width=\"100%\"><thead><tr>
    <th data-sort=\"string\" style=\"width: 300px;\"><b>".$_lang['backup_filename']."</b></th>
    <th data-sort=\"int\"><b>".$_lang['backup_filesize']."</b></th>
    <th style=\"text-align:right;\"><b>".$_lang['backup_file_options']."</b></th>
  </tr></thead><tbody>
  ";
$modx_backup_default = "../assets/backup/"; 
if ($handle = opendir($modx_db_backup_dir)) {
   /* Loop over backup directory */
   while (false !== ($file = readdir($handle))  ) {
     if (strpos($file,'.sql')!==false )
       {
           $fs = filesize($modx_backup_default.$file)/1024; 
           $out .= "<tr><td><i class=\"fa fa-database yellow\" aria-hidden=\"true\"></i>  <b>$file</b></td><td> ".ceil($fs)." kb</td>"
                  ."<td class=\"actions\" style=\"text-align:right;\"><a title=\"".$_lang['download_backup']."\" href=\"".$modx->config['site_url']."assets/modules/evobackup/downloadsql.php?filename=$file\"><i class=\"fa fa-download\"></i></a> 
                  
                  <a title=\"".$_lang['restore_sql_backup']."\"><i class=\"fa fa-repeat\" onclick=\"javascript:if(confirm('".$_lang['restore_sql_confirm']." $file? ".$_lang['restore_sql_info']."')){postForm('restoresql','$file'); return false;}\"></i></a>
                  
                  
                   <a title=\"".$_lang['delete_backup']."\" onclick=\"javascript:if(confirm('".$_lang['delete_confirm']." $file? ".$_lang['delete_confirm_info']."')){postForm('deletesql','$file'); return false;}\"><i class=\"fa fa-trash\"></i></a>
                   </td></tr>";
       }
   }
   closedir($handle);
}

global $lang;
$out .= '</tbody></table></div><span class="actionButtons evobkpbuttons">
            <a class="btn btn-success" href="#" onclick="postForm(\'onlydbase\')" value="Backup db">'.$_lang['backupdb_button_text'].'</a>
             <a href="index.php?a=93" class="" style="display:inline-block;">'.$_lang['bk_manager'].'</a>
  
        </span></div>
';

?>