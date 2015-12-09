<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php base_url_asset(); ?>global/plugins/respond.min.js"></script>
<script src="<?php base_url_asset(); ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php base_url_asset(); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php base_url_asset(); ?>global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?php base_url_asset(); ?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php base_url_asset(); ?>admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->
</body>
</html>