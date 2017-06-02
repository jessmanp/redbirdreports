<?php
$rowcnt = 1;
if ($agency_advanced) {
	foreach ($agency_advanced as $file) {
		if ($rowcnt & 1) {
			$rowclass = 'table-row';
		} else {
			$rowclass = 'table-row-alt';
		}
		if ($file->policy == 1) {
			$import = " <a href=\"javascript:doFileImport(".$file->id.",'".$file->title."');\">import</a>";
		} else {
			$import = '';
		}
?>
								<div class="<?php echo $rowclass; ?>" style="text-align:left;line-height:35px;">&nbsp;&nbsp;&nbsp;<?php echo $file->title; ?><?php echo $import; ?><div style="float:right;"><a href="javascript:doFileDelete(<?php echo $file->id.",'" .$file->title."'"; ?>)">delete</a>&nbsp;&nbsp;&nbsp;</div></div>
<?php
	$rowcnt++;
	}
}
?>