<?php
/**
* Main Modbak include code
*/
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODx Content Manager instead of accessing this file directly.");

if(!$modx->hasPermission('bk_manager')) {	
	$e->setError(3);
	$e->dumpError();
    exit;	
}

// module info
$module_version = '1.2 (beta 1)';

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

$modx_files_array = array($modx_root_dir.'assets');    

if ($dumpmanager!='')
{
    $modx_files_array[]=$modx_root_dir.'manager';
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
            $out .= "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> File $filename does not exist<br />";
        } else
            {
                unlink($deletefile);
                $out .= "<i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> $filename Deleted<br />";
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
        $out .= "<i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> <br />Modx Backup Successful <strong>--&gt <a href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=".basename($archive_file)."\">$archive_file</a></strong><br /><br />";    

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
        
    break;
}

/**
* Display list of backups with download
*/
$out .= "<h2>Current Backups:</h2><p> Download or delete previous backup archives</p><table class=\"evobackup grid\" width=\"100%\"><thead><tr>
    <th style=\"width: 300px;\"><b>file</b></th>
    <th><b>size</b></th>
    <th style=\"text-align:right;\"><b>actions</b></th>
  </tr></thead><tbody>
  ";
if ($handle = opendir($modx_backup_dir)) {
   /* Loop over backup directory */
   while (false !== ($file = readdir($handle))  ) {
       if ($file!='.' && $file!='..' && (strpos($file,$archive_prefix)!==false ) && $file!=$database_filename)
       {
           $fs = filesize($modx_backup_dir.$file)/1024; 
           $out .= "<tr><td><b>$file</b></td><td> ".ceil($fs)." kb</td>"
                  ."<td style=\"text-align:right;\"><a class=\"btn btn-default btn-sm\" href=\"".$modx->config['site_url']."assets/modules/evobackup/download.php?filename=$file\"><i class='fa fa-download'></i></a> 
                   <a class=\"btn btn-default btn-sm\" onclick=\"postForm('delete','$file')\" /><i class='fa fa-trash'></i></a></td></tr>";
       }
   }
   closedir($handle);
}


$out .= <<<EOD
</tbody></table><h2>Generate New Backup:</h2>
<p> Select  what to include in the archive</p>

<label><input type="checkbox" name="dumpmanager" checked="checked" /> /manager </label><br />
<label><input type="checkbox" name="dumpdbase" checked="checked" /> database</label><br />

<label><input type="checkbox" name="dumphtaccess" checked="checked" /> .htaccess </label><br />
<label><input type="checkbox" name="dumprobots" /> robots.txt </label><br />
<label><input type="checkbox" name="dumpindex" />  index.php </label><br />
<label><input type="checkbox" name="dumpindexajax" />  index-ajax.php </label><br />

<p></p><input type="submit" name="generate_backup" onclick="postForm('generate')" value="Backup Now!" />
</form>

EOD;
?>