<?php
/**
* Main Modbak include code
*/
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");
global $modx, $_lang;
$MGR_DIR = MGR_DIR;
if(!$modx->hasPermission('bk_manager')) {	
	$e->setError(3);
	$e->dumpError();
    exit;	
}

// module info
$module_version = '1.2 (beta 4.2)';
$module_id = (!empty($_REQUEST["id"])) ? (int)$_REQUEST["id"] : $yourModuleId;
//lang
$_lang = array();
include($mods_path.'evobackup/lang/english.php');
if (file_exists($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php')) {
    include($mods_path.'evobackup/lang/' . $modx->config['manager_language'] . '.php');
}
$out ='';
// check if backup exists and is writable
if (!file_exists($modx_backup_dir))
{
    $BACKUPERROR = "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> Backup directory <strong>$modx_backup_dir</strong> does not exist";
} elseif(!is_writable($modx_backup_dir))
    {
        $BACKUPERROR = "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> Backup directory <strong>$modx_backup_dir</strong> is NOT writable!";
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
    case 'delete': // delete file
        $deletefile = $modx_backup_dir.$filename;
        if (!file_exists($deletefile))
        {
            $out .= "<p class=\"alert\"><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> File $filename does not exist<br /></p>";
        } else
            {
                unlink($deletefile);
                $out .= "<div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                <i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> $filename Deleted<br /></div>";
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
        $out .= "<p class=\"success\"><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> <br />Modx Backup Successful <strong>--&gt <a href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($archive_file)."\">$archive_file</a></strong><br /><br /></p>";    

        // add database, callback for dbdump
        if ($dumpdbase!='') {
            $out .= "<i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> Adding Database..<script type=\"text/javascript\" language=\"javascript\">postForm('dumpdbase','".basename($archive_file)."');</script>";
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
        $fh = fopen($modx_backup_dir.$database_filename,'w');
        
        if($dumpfinished) 
        {
            fwrite($fh,$dumpfinished);               
            fclose($fh);
            $out .= "<script type=\"text/javascript\" language=\"javascript\">postForm('adddumpfile','".basename($filename)."');</script>";
        }       
        else {
	        $e->setError(1,"Unable to Backup Database");
	        $e->dumpError();
        }    
    break;
    
    case 'adddumpfile':
        // add dump file to archive
        @set_time_limit($zip_time_limit);
        @ini_set("memory_limit",$zip_memory_limit);
        include_once($mods_path.'evobackup/pclzip.lib.php');
        $archive = new PclZip($modx_backup_dir.$filename);
        $v_list = $archive->add($modx_backup_dir.$database_filename,PCLZIP_OPT_REMOVE_PATH, $modx_backup_dir );
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
        unlink($modx_backup_dir.$database_filename);
    break;
}

/**
* Display list of backups with download
*/
global $modx;
$out .= "<h2><i class=\"fa fa-download\" aria-hidden=\"true\"></i> ".$_lang['manage_backup']."</h2><p> ".$_lang['manage_backup_descr']."</p><table class=\"evobackup grid\" width=\"100%\"><thead><tr>
    <th style=\"width: 300px;\">".$_lang['backup_filename']."</th>
    <th>".$_lang['backup_filesize']."</b></th>
    <th style=\"text-align:right;\">".$_lang['backup_file_options']."</th>
  </tr></thead><tbody>
  ";
if ($handle = opendir($modx_backup_dir)) {
   /* Loop over backup directory */
   while (false !== ($file = readdir($handle))  ) {
       if ($file!='.' && $file!='..' && (strpos($file,$archive_prefix)!==false ) && $file!=$database_filename)
       {
           $fs = filesize($modx_backup_dir.$file)/1024; 
           $out .= "<tr><td><i class=\"fa fa-file-archive-o yellow\" aria-hidden=\"true\"></i>  <b>$file</b></td><td> ".ceil($fs)." kb</td>"
                  ."<td style=\"text-align:right;\"><a title='".$_lang['download_backup']."' class=\"btn btn-default btn-sm\" href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=$file\"><i class='fa fa-download'></i></a> 
                   <a title='".$_lang['delete_backup']."' class=\"btn btn-default btn-sm\" onclick=\"postForm('delete','$file')\" /><i class='fa fa-trash'></i></a></td></tr>";
       }
   }
   closedir($handle);
}

$backup = $_lang['backup'];
$help = $_lang['help'];
$Config = $_lang["settings_module"];
$check_all= $_lang["check_all"];
$out .= '
</tbody></table>
<div id="evobackup-info" style="display:none">
            <p class="element-edit-message">
             <h3>'.$_lang['light_backup'].'</h3>
             '.$_lang['help_light_backup'].'
            <h3>'.$_lang['medium_backup'].'</h3>
             '.$_lang['help_medium_backup'].'
            <h3>'.$_lang['full_backup'].'</h3>
             '.$_lang['help_full_backup'].'
        </div>

 <script>
$(document).ready(function(){
    $(".evobackup-help").click(function(){
        $("#evobackup-info").toggle(800);
    });
});
</script>
<h2><i class="fa fa-file-archive-o" aria-hidden="true"></i> '.$_lang['generate_backup'].'</h2>
<p><span class="info"><b><a href="#" title="'.$_lang['help'].'" class="evobackup-help"><i class="fa fa-question-circle fa-lg " aria-hidden="true"></i></a></b></span> '.$_lang['choose_backup'].' <span class="info">
<input type="checkbox" id="checkMinBackup"><b>'.$_lang['light_backup'].'</b> 
<input type="checkbox" id="checkReqBackup" checked="checked"><b>'.$_lang['medium_backup'].'</b>  <input type="checkbox" id="checkAllBackup" ><b>'.$_lang['full_backup'].'</b></span></p>

<div class="border-top" style="clear:both"></div>
<div id="more-options">
<div class="left border-right">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['assets_backup'].'</h3>
<p class="info"><input type="checkbox" id="checkAllAssets" > '.$_lang['check_all'].' 
 <label><input type="checkbox" name="dumpassets" class="checkAll"/>  <b>/assets</b> ('.$_lang['whole_assets'].')</label></p>

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
<label><input type="checkbox" name="dumpmodules" class="checkAssets checkReq" checked="checked"/>  /modules</label><br />
<label><input type="checkbox" name="dumpplugins" class="checkAssets checkReq" checked="checked"/>  /plugins</label><br />
<label><input type="checkbox" name="dumpsnippets" class="checkAssets checkReq" checked="checked"/>  /snippets</label><br />
<label><input type="checkbox" name="dumptvs" class="checkAssets checkReq" checked="checked"/>  /tvs</label><br />
<label><input type="checkbox" name="dumplib" class="checkAssets checkReq" checked="checked"/>  /lib </label><br />
<label><input type="checkbox" name="dumpjs" class="checkAssets checkReq" checked="checked"/>  /js </label><br />
</div>

<div class="left">
<h4>'.$_lang['assets_system_folders'].'</h4>
<label><input type="checkbox" class="checkAssets" name="dumpthumbs" /> /.thumbs </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpbackup"/> /backup </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpcache" /> /cache </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpdocs" />  /docs </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpexport" />  /export </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpimport" />  /import </label><br />
<label><input type="checkbox" class="checkAssets" name="dumpsite" />  /site</label><br />
</div>


</div>

<div class="left" style="padding-right: 25px;">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['manager_backup'].'</h3>
<p class="info"><label><input type="checkbox" class="checkAll" name="dumpmanager" /> <b>/'.$MGR_DIR.'</b>  ('.$_lang['whole_manager'].')</label></p>
<div class="left">
<h4>'.$_lang['only_those_manager_files'].'</h4>
<label><input type="checkbox" name="dumpconfig" class="checkReq checkMin" checked="checked"/> /includes/config.inc.php </label><span class="info">('.$_lang['manager_config_file'].')</span><br />
<label><input type="checkbox" name="dumpmanhtaccess" /> /.htaccess </label><br />
<label><input type="checkbox" name="dumpthemes" /> /media/styles </label><span class="info">('.$_lang['manager_themes'].')</span><br />
<label><input type="checkbox" name="dumpmframes" /> /frames </label><br />
<label><input type="checkbox" name="dumpmincludes" /> /includes </label><br />
<label><input type="checkbox" name="dumpmmedia" /> /media </label><br />
<label><input type="checkbox" name="dumpmprocessors" /> /processors </label><br />
</div>
</div>
<div class="border-top" style="clear:both"></div>

<div class="left border-right" style="padding-right: 25px;">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> '.$_lang['root_backup'].'</h3>
<p>'.$_lang['root_backup_descr'].'</p>
<label><input type="checkbox" class="checkAll" name="dumphtaccess" /> .htaccess </label><br />
<label><input type="checkbox" class="checkAll checkReq" name="dumprobots" checked="checked"/> robots.txt </label><br />
<label><input type="checkbox" class="checkAll" name="dumpindex" />  index.php </label><br />
<label><input type="checkbox" class="checkAll" name="dumpindexajax" />  index-ajax.php </label><br /><br />
</div>

<div class="left border-right">
<h3><i class="fa fa-database" aria-hidden="true"></i> '.$_lang['db_backup'].'</h3>
<label><input type="checkbox" name="dumpdbase" class="checkAll checkReq checkMin" checked="checked" /> '.$_lang['include_db_to_zip'].' </label><br /><br />
</div>
<div class="left">
';

if ($customfold1!=''){
$out .= '
<h3><i class="fa fa-folder-open" aria-hidden="true"></i> '.$_lang['custom_files_backup'].'</h3>
<label><input type="checkbox" name="dumpcustomfold1" class="checkAll"/>  '.$customfold1.' </label><br />';
}
if ($customfold2!=''){
$out .=  '
<label><input type="checkbox" name="dumpcustomfold2" class="checkAll"/>  '.$customfold2.' </label><br />';
}
if ($customfold3!=''){
$out .= '
<label><input type="checkbox" name="dumpcustomfold3" class="checkAll"/>  '.$customfold3.' </label><br />';
}
if ($customfold4!=''){
$out .= '
<label><input type="checkbox" name="dumpcustomfold4" class="checkAll"/>  '.$customfold4.' </label><br />';
}
if ($customfold5!=''){
$out .= '
<label><input type="checkbox" name="dumpcustomfold5" class="checkAll"/>  '.$customfold5.' </label><br />';
}

$out .=  '
</div>

<div class="border-top" style="clear:both"></div>
</div>
<span class="actionButtons evobkpbuttons">
             
             <!--- <a href="#" id="more-options-button">More Options</a>-->
             <a class="primary" href="#" onclick="postForm(\'generate\')" value="Backup Now!" />'.$_lang['backup_button_text'].'</a>
        </span>

</form>

<div style="clear:both"></div>

';
?>