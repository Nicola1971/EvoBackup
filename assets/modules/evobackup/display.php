<?php
    global $_lang, $manager_language, $manager_theme,$theme_refresher,$modx_manager_charset, $syncid, $syncsite,$messagesallowed;

$o = <<<EOD
<html>
<head>
	<title>MODx Backup Utility</title>
	<meta http-equiv="Content-Type" content="text/html; charset=$modx_manager_charset" />
	<link rel="stylesheet" type="text/css" href="media/style/$manager_theme/style.css" />
    <link rel="stylesheet" href="media/style/common/font-awesome/css/font-awesome.min.css" />
<script src="media/script/jquery/jquery.min.js"></script>
</head>
<script>
jQuery( document ).ready(function( $ ) {
$('#checkAllAssets').click(function () {    
    $(':checkbox.checkAssets').prop('checked', this.checked);    
 });
$('#checkAllBackup').click(function () {    
    $(':checkbox.checkAll').prop('checked', this.checked);    
 });
 });
 </script>
<style>
h2 {border-bottom: 1px dotted #dedede;}
table.evobackup {margin-bottom:24px;}
table.evobackup th, table.evobackup td {font-size:13px;}
.info {color: #3e87fd; margin-bottom: 15px;}
.alert {padding: 20px;background-color: #f44336; /* Red */color: white;margin-bottom: 5px;}
.success {color: #07b922;}
.yellow {font-size:14px; color:#444; background-color: yellow; border-radius:50%; border: 1px solid #f7bf04; padding:5px 7px; margin-right:5px;}
.left {float: left; padding:10px; margin-right:20px;}
.border-right {border-right: 1px dotted #dedede;}
.border-top {padding-top: 10px; border-top: 1px dotted #dedede;}
</style>
<h1 class="pagetitle">
  <span class="pagetitle-icon">
    <i class="fa fa-download"></i>
  </span>
  <span class="pagetitle-text">
    Evo Backup v$module_version
  </span>
</h1>
<div id="actions">
    <ul class="actionButtons">
    <!--@IF:[[#hasPermission?key=new_module]] OR [[#hasPermission?key=edit_module]]-->
    <li id="Button6"><a href="index.php?a=108&id=$module_id"><i class='fa fa-cog'></i></a> </li>
    <!--@ENDIF-->
        <li id="Button5"><a href="index.php?a=2">
            Close
        </a></li>
    </ul>
</div>
<div class="sectionBody">
<div class="dynamic-tab-pane-control tab-pane" id="evobackupPanes">
<div class='tab-row'>
        
        </div>
        <div class="tab-page panel-container">
EOD;

$out = $o.$out.'</div></div></div>';
return $out;
?>