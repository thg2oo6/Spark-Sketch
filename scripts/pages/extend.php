<?php
if(!isset($_SESSION['sk_user'])){
	masterRedirect("/");
}
$filename = filter_var(end($core->url),FILTER_SANITIZE_STRING);
$q = mysql_query("SELECT * FROM `draws` WHERE `filename`='{$filename}'");
if(!mysql_num_rows($q))
	masterRedirect("/404");
$r = mysql_fetch_assoc($q);

$quota = $core->quota($_SESSION['sk_user']);
if($quota['available']>0){
	$qval = $quota['used']/$quota['available']*100;
	$mcolor = $core->quotaColor($qval);
}else{
	$quota['available'] = "&infin;";
	$qval = 0;
	$mcolor = $core->quotaColor(0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title><?=$language['extendPage_title']?> / Spark Sketch</title>
	<? require_once("tpl/header.php");?>
</head>
<body>
	<?require_once("tpl/menu_logged.php"); ?>
	<div class="sketch">
		<div class="quota">
			<div class="qinfo qtext_m<?=$mcolor?>"><?=$quota['used']?>/<?=$quota['available']?> pictures</div>
			<div class="qbar qcolor_m<?=$mcolor?>" style="width: <?=$qval?>%;">&nbsp;</div>
		</div>
		<div class="toolbox">
			<div class="left main">
				<ul>
					<li><input title="<?=$language['newDraw']?>" type="button" class="no-text button new" id="new" value="new"/></li>
					<li>
						<input title="<?=$language['saveDraw']?>" type="button" class="no-text button save" id="save" value="save"/>
						<div class="saveBox">
							Name: <input type="text" class="saveText" name="saveText" value=""/> <input type="button" id="saveOk" value="Ok" /> <input type="button" id="saveCancel" value="Cancel" />
							<input type="hidden" id="dType" value="new"/>
						</div>
					</li>
					<li><input title="<?=$language['cancelDraw']?>" type="button" class="no-text button cancel" id="cancel" value="cancel"/><input type="hidden" id="extendFN" value="<?=$r['filename']?>"/></li>
				</ul>
			</div>
			<div class="right tools">
				<ul>
					<li><input title="<?=$language['clearPage']?>" type="button" class="no-text button clear" id="clear" value="clear"/></li>
					<li>
						<input title="<?=$language['brushSize']?>" type="button" class="no-text button brush" id="brush" value="brush"/>
						<div class="widthBox"><?=$language['size']?>: <span id="size">2</span> <div id="brushSize" style="width: 100px;padding:0;margin-top:6px;margin-right:7px;float: right;font-size: 8pt;"></div></div>
					</li>
					<li title="<?=$language['brushColor']?>" class="color" style="vertical-align: middle;margin-top: 3px;margin-right: 7px;"><input type="color" data-text="hidden" data-hex="true" style="height: 28px; width: 28px; vertical-align: middle;" value="#dc0000" id="color"></li>
					<li title="<?=$language['bkgColor']?>" class="color" style="vertical-align: middle;margin-top: 3px;"><input type="color" data-text="hidden" data-hex="true" style="height: 28px; width: 28px; vertical-align: middle;" value="#ffffff" id="bgcolor"></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="drawingpad"></div>
	</div>
	<? require_once("tpl/footer.php"); ?>
	<div id="modalMsg"></div>
</body>
</html>