<?php
/**
* Main Modbak include code
*/
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");
global $modx, $_lang;
if(!$modx->hasPermission('bk_manager')) {	
	$e->setError(3);
	$e->dumpError();
    exit;	
}

// module info
$module_version = '1.2 (beta 3)';
$module_id = (!empty($_REQUEST["id"])) ? (int)$_REQUEST["id"] : $yourModuleId;

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

// --------------- Set Directories and files to include in archive
$dumpmanager  = isset($_POST['dumpmanager']) ? $_POST['dumpmanager']:'';
$dumpindex  = isset($_POST['dumpindex']) ? $_POST['dumpindex']:'';
$dumpindexajax  = isset($_POST['dumpindexajax']) ? $_POST['dumpindexajax']:'';
$dumphtaccess  = isset($_POST['dumphtaccess']) ? $_POST['dumphtaccess']:'';
$dumprobots  = isset($_POST['dumprobots']) ? $_POST['dumprobots']:'';
$dumpconfig  = isset($_POST['dumpconfig']) ? $_POST['dumpconfig']:'';
$dumpthemes  = isset($_POST['dumpthemes']) ? $_POST['dumpthemes']:'';
$dumpmanhtaccess  = isset($_POST['dumpmanhtaccess']) ? $_POST['dumpmanhtaccess']:'';

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


//other folders

if ($dumpconfig!='')
{
    $modx_files_array[]=$modx_root_dir.'manager/includes/config.inc.php';
}    
if ($dumpmanager!='')
{
    $modx_files_array[]=$modx_root_dir.'manager';
}
if ($dumpthemes!='')
{
    $modx_files_array[]=$modx_root_dir.'manager/media/style';
} 
if ($dumpmanhtaccess!='')
{
if (file_exists($modx_root_dir.'manager/.htaccess'))
{
    $modx_files_array[]=$modx_root_dir.'manager/.htaccess';
}
} 
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
                $out .= "<p class=\"alert\"><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> $filename Deleted<br /></p>";
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
global $modx, $_lang;
$out .= "<h2><i class=\"fa fa-download\" aria-hidden=\"true\"></i> Manage Backups:</h2><p> Download or delete previous backup archives</p><table class=\"evobackup grid\" width=\"100%\"><thead><tr>
    <th style=\"width: 300px;\"><b>".$_lang['files_filename']."</b></th>
    <th><b>".$_lang['files_filesize']."</b></th>
    <th style=\"text-align:right;\"><b>".$_lang['files_fileoptions']."</b></th>
  </tr></thead><tbody>
  ";
if ($handle = opendir($modx_backup_dir)) {
   /* Loop over backup directory */
   while (false !== ($file = readdir($handle))  ) {
       if ($file!='.' && $file!='..' && (strpos($file,$archive_prefix)!==false ) && $file!=$database_filename)
       {
           $fs = filesize($modx_backup_dir.$file)/1024; 
           $out .= "<tr><td><i class=\"fa fa-file-archive-o yellow\" aria-hidden=\"true\"></i>  <b>$file</b></td><td> ".ceil($fs)." kb</td>"
                  ."<td style=\"text-align:right;\"><a title='".$_lang['file_download_file']."' class=\"btn btn-default btn-sm\" href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=$file\"><i class='fa fa-download'></i></a> 
                   <a title='".$_lang['file_delete_file']."' class=\"btn btn-default btn-sm\" onclick=\"postForm('delete','$file')\" /><i class='fa fa-trash'></i></a></td></tr>";
       }
   }
   closedir($handle);
}

$backup = $_lang['backup'];
$out .= <<<EOD
</tbody></table><h2><i class="fa fa-file-archive-o" aria-hidden="true"></i> Generate a new Backup Archive:</h2>
<div class="left border-right">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> Assets Backup</h3>
<p class="info"><i class="fa fa-lg fa-info-circle"></i> <b>Note</b>: /assets folder is always included in zip archive</p>
<div class="left border-right">
<h4>User Folders</h4>
<label><input type="checkbox" name="dumptemplates" checked="checked"/>  /templates</label><br />
<label><input type="checkbox" name="dumpfiles" checked="checked"/>  /files </label><br />
<label><input type="checkbox" name="dumpflash" checked="checked"/>  /flash </label><br />
<label><input type="checkbox" name="dumpimages" checked="checked"/>  /images </label><br />
<label><input type="checkbox" name="dumpdocs" checked="checked"/>  /docs </label><br />
<label><input type="checkbox" name="dumpmedia" checked="checked"/>  /media </label><br />
</div>
<div class="left border-right">
<h4>Elements Folders</h4>
<label><input type="checkbox" name="dumpmodules" checked="checked"/>  /modules</label><br />
<label><input type="checkbox" name="dumpplugins" checked="checked"/>  /plugins</label><br />
<label><input type="checkbox" name="dumpsnippets" checked="checked"/>  /snippets</label><br />
<label><input type="checkbox" name="dumptvs" checked="checked"/>  /tvs</label><br />
<label><input type="checkbox" name="dumplib" checked="checked"/>  /lib </label><br />
<label><input type="checkbox" name="dumpjs" checked="checked"/>  /js </label><br />
</div>
<div class="left">
<h4>System Folders</h4>
<label><input type="checkbox" name="dumpthumbs" /> /.thumbs </label><br />
<label><input type="checkbox" name="dumpbackup" checked="checked"/> /backup </label><br />
<label><input type="checkbox" name="dumpcache" /> /cache </label><br />
<label><input type="checkbox" name="dumpexport" />  /export </label><br />
<label><input type="checkbox" name="dumpimport" />  /import </label><br />
<label><input type="checkbox" name="dumpsite" />  /site</label><br />
</div>
</div>
<div class="left">
<h3><i class="fa fa-database" aria-hidden="true"></i> Database Backup</h3>
<label><input type="checkbox" name="dumpdbase" checked="checked" /> include  .sql database backup to zip </label><br /><br />
</div>


<div class="border-top"style='clear:both'></div>
<div class="left border-right">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> Manager Backup</h3>
<label><input type="checkbox" name="dumpmanager" /> /manager </label><br />
<br />
<label><input type="checkbox" name="dumpconfig" checked="checked"/> /manager/includes/config.inc.php </label><br />
<label><input type="checkbox" name="dumpmanhtaccess" /> /manager/.htaccess </label><br />
<label><input type="checkbox" name="dumpthemes" /> /manager/media/styles </label><br />
</div>
<div class="left">
<h3><i class="fa fa-folder-open-o" aria-hidden="true"></i> Root files Backup</h3>
<p class="info">Select additional folders and files to include in zip archive</p>
<label><input type="checkbox" name="dumphtaccess" /> .htaccess </label><br />
<label><input type="checkbox" name="dumprobots" /> robots.txt </label><br />
<label><input type="checkbox" name="dumpindex" />  index.php </label><br />
<label><input type="checkbox" name="dumpindexajax" />  index-ajax.php </label><br /><br />
</div>



<div class="border-top"style='clear:both'></div>
<p class="actionButtons"><a class="primary" href="#" onclick="postForm('generate')" value="Backup Now!" />$backup</a></p>
</form>
<div style='clear:both'></div>
EOD;
?>