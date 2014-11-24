<footer>
	<div id="top">&#9650; Back to Top</div>
	&copy; <?php echo date("Y",time()); ?> Red Bird Reports. All Rights Reserved.
</footer>
<!-- END CANVAS AREA -->
</div>
<!-- Scripts -->
<script src="<?php echo URL; ?>public/js/retina.js"></script>
<?php if (isset($sectionScript)) { ?>
<script src="<?php echo URL; ?>public/js/<?php echo $sectionScript; ?>"></script>
<?php } ?>
</body>
</html>