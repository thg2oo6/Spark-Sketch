<?php
$filename = filter_var(end($core->url),FILTER_SANITIZE_STRING);
$q = mysql_query("SELECT * FROM `draws` WHERE `filename`='{$filename}'");
if(!mysql_num_rows($q))
	masterRedirect("/404");
$r = mysql_fetch_assoc($q);
?>
<? require_once("tpl/top.php");?>
<div class="sketch">
	<div class="toolbox">
		<div class="left drawTitle">
			<?=$r['title']?> <span class="by">- by <?=$core->fieldByID("user","user",$r['userid']);?></span>
		</div>
		<div class="right drawShare">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_favorites"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=thg2oo6"></script>
			<!-- AddThis Button END -->
		</div>
		<div class="clear"></div>
	</div>
	<div class="imagepad">
		<div class="userbox">
			<ul>
			<?
			if(isset($_SESSION['sk_user'])){
				if($r['userid']==$_SESSION['sk_user']||$core->fieldByID('user','rank',$_SESSION['sk_user'])=='admin'){
			?>
				<li><input title="<?=$language['deleteDraw']?>" type="button" class="no-text button delete" id="delete" value="delete" onClick="confirmDelete('<?=sprintf($language['confirmDelete_title'],$r['title'])?>','<?=sprintf($language['confirmDelete_text'],$r['title'])?>','<?=$r['filename']?>');"/></li>
			<?}
			$quota = $core->quota($_SESSION['sk_user']);
			if($quota['value']<100){?>
				<li><input title="<?=$language['extendDraw']?>" type="button" class="no-text button extend" id="extend" value="extend"/><input type="hidden" id="extendFN" value="<?=$r['filename']?>"/></li>
				<?}?>
			<?}?>
				<li><a href="<?=$core->createURL("/files/{$r['filename']}?dl=1");?>" title="<?=$language['saveFile']?>" type="button" class="no-text button download"></a></li>
			</ul>
		</div>
		<img src="<?=$core->createURL("/files/{$r['filename']}");?>" alt="image" />
	</div>
</div>
<div id="modalMsg"></div>
<? require_once("tpl/footer.php"); ?>