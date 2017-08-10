<?php
    global $_lang, $manager_language, $manager_theme,$theme_refresher,$modx_manager_charset, $syncid, $syncsite,$messagesallowed;
$help = $_lang['help'];
$Config = $_lang["settings_module"];
$o = '
<html>
<head>
	<title>EvoBackup Backup Manager Module</title>
	<meta http-equiv="Content-Type" content="text/html; charset='.$modx_manager_charset.'" />
	<link rel="stylesheet" type="text/css" href="media/style/'.$manager_theme.'/style.css" />
    <link rel="stylesheet" type="text/css" href="../assets/modules/evobackup/css/style1.3.css" />
    <link rel="stylesheet" href="media/style/common/font-awesome/css/font-awesome.min.css" />
<script src="../assets/modules/evobackup/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/modules/evobackup/js/tabpane.js"></script>
<script type="text/javascript" src="../assets/modules/evobackup/js/stupidtable.min.js"></script>

<script>

jQuery( document ).ready(function( $ ) {
$(\'#zipbackup\').stupidtable(); 
$(\'#sqlbackup\').stupidtable(); 
$(\'#checkAllAssets\').click(function () {    
    $(\':checkbox.checkAssets\').prop(\'checked\', this.checked);    
 });
$(\'#checkAllBackup\').click(function () {    
    $(\':checkbox.checkAll\').prop(\'checked\', this.checked); 
    $(\':checkbox.UncheckFull\').prop(\'checked\', false);
    $(\':checkbox.checkAssets\').prop(\'checked\', false);
 });
$(\'#checkReqBackup\').click(function () {    
    $(\':checkbox.checkReq\').prop(\'checked\', this.checked);
    $(\':checkbox.UncheckReq\').prop(\'checked\', false)
    
 });
$(\'#checkMinBackup\').click(function () {    
    $(\':checkbox.checkMin\').prop(\'checked\', this.checked); 
    $(\':checkbox.UncheckMin\').prop(\'checked\', false);
 });

$(".evobackup-help").click(function(){
        $("#evobackup-info").toggle(800);
    });
$(".archivebackup-help").click(function(){
        $("#archivebackup-info").toggle(800);
    });
$(".sqlbackup-help").click(function(){
        $("#sqlbackup-info").toggle(800);
    });
$(".all-help").click(function(){
        $("#sqlbackup-info").toggle(800);
        $("#evobackup-info").toggle(800);
        $("#archivebackup-info").toggle(800);
    });
});
</script>
 </head>
 <style>
 /* Sortable indicator icon */
th[data-sort]:after {
    font-family: FontAwesome;
    content: \'\f07d\';
    padding-left: 5px;
    color: #dedede;
}
th.sorting-desc:after {
    font-family: FontAwesome;
    content: \'\f175\';
    padding-left: 5px;
    color: red;
}
th.sorting-asc:after {
    font-family: FontAwesome;
    content: \'\f176\';
    padding-left: 5px;
    color: red;
}
 </style>
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
     <li id="Button9"><a href="#" class="all-help"><i class="fa fa-question-circle"></i> '.$help.'</a></li>
        <li id="Button5"><a href="index.php?a=2">
            '.$_lang['close'].'
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