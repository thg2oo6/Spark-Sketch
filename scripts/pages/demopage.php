<? require_once("tpl/top.php");?>
<div class="sketch">
	<div class="toolbox">
		<div class="left main">
		</div>
		<div class="right tools">
			<ul>
				<li><input title="<?=$language['clearPage']?>" type="button" class="no-text button clear" id="clear" value="clear"/></li>
				<li>
					<input title="<?=$language['brushSize']?>" type="button" class="no-text button brush" id="brush" value="brush"/>
					<div class="widthBox"><?=$language['size']?>: <span id="size">2</span> <div id="brushSize" style="width: 100px;padding:0;margin-top:6px;margin-right:7px;float: right;font-size: 8pt;"></div></div>
				</li>
				<li title="<?=$language['brushColor']?>" class="color" style="vertical-align: middle;margin-top: 3px;margin-right: 7px;"><input type="color" data-text="hidden" data-hex="true" style="height: 28px; width: 28px; vertical-align: middle;" value="#dc0000" id="color"></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="drawingpad"></div>
</div>
<? require_once("tpl/footer.php"); ?>
