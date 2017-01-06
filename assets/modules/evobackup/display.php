<?php
    global $_lang, $manager_language, $manager_theme,$theme_refresher,$modx_manager_charset, $syncid, $syncsite,$messagesallowed;
$help = $_lang['help'];
$Config = $_lang["settings_module"];
$o = '
<html>
<head>
	<title>MODx Backup Utility</title>
	<meta http-equiv="Content-Type" content="text/html; charset='.$modx_manager_charset.'" />
	<link rel="stylesheet" type="text/css" href="media/style/'.$manager_theme.'/style.css" />
    <link rel="stylesheet" href="media/style/common/font-awesome/css/font-awesome.min.css" />
<script src="../assets/modules/evobackup/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/modules/evobackup/js/tabpane.js"></script>

<script>
jQuery( document ).ready(function( $ ) {
$(\'#checkAllAssets\').click(function () {    
    $(\':checkbox.checkAssets\').prop(\'checked\', this.checked);    
 });
$(\'#checkAllBackup\').click(function () {    
    $(\':checkbox.checkAll\').prop(\'checked\', this.checked);    
 });
$(\'#checkReqBackup\').click(function () {    
    $(\':checkbox.checkReq\').prop(\'checked\', this.checked);    
 });
$(\'#checkMinBackup\').click(function () {    
    $(\':checkbox.checkMin\').prop(\'checked\', this.checked);    
 });
 });
 </script>

<style>
h2 {border-bottom: 1px dotted #dedede;}
h3 {color: #3697CD;}
h2.tab a:hover {text-decoration:none;}
p {margin-bottom: 10px;}
table.evobackup {margin-bottom:24px;}
table.evobackup th, table.evobackup td {font-size:13px;}
table.evobackup a {
  cursor: pointer;
}
table.evobackup .btn {
  width: 15px;
}
.info {color: #777;}
.info b{color: #3697CD;}
.alert {padding: 20px;background-color: #f44336; color: white;margin-bottom: 5px;}
.success {padding: 20px;background-color: #07b922; color: white;margin-bottom: 5px;}
.success a.textlink:link {color: white!important;}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}
.closebtn:hover {
    color: black;
}

.yellow {font-size:14px; color:#444; background-color: yellow; border-radius:50%; border: 1px solid #f7bf04; padding:5px 7px; margin-right:5px;}
.left {float: left; padding:10px; margin-right:20px;}
.border-right {border-right: 1px dotted #dedede;}
.border-top {padding-top: 10px; border-top: 1px dotted #dedede;}
.capitalize {text-transform: capitalize;}
.element-edit-message {
  padding-bottom: 10px;
  border-bottom: 1px solid #ededed;
  border-top:0!important;
  margin-bottom: 15px;
  color: #777;
}

</style>
 </head>
 <body>
<h1 class="pagetitle">
  <span class="pagetitle-icon">
    <i class="fa fa-download"></i>
  </span>
  <span class="pagetitle-text">
    '.$_lang['modulename'].' v'.$module_version.'
  </span>
</h1>
<div id="actions">
    <ul class="actionButtons">
    <!--@IF:[[#hasPermission?key=new_module]] OR [[#hasPermission?key=edit_module]]-->
    <li id="Button6"><a href="index.php?a=108&id='.$module_id.'"><i class="fa fa-cog"></i> '.$Config.'</a> </li>
    <!--@ENDIF-->
     <li id="Button9"><a href="#" class="evobackup-help"><i class="fa fa-question-circle"></i> '.$help.'</a></li>
        <li id="Button5"><a href="index.php?a=2">
            Close
        </a></li>
    </ul>
</div>
<div class="sectionBody">  
';

$out = $o.$out.' </div> </div>

</body>
</html>';
return $out;
?>