<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<title><?php echo __('kitchen:kitchen_name') ?> | <?php echo Settings::get('site_name'); ?></title>

<!--favicon-->
<link rel="shortcut icon" href="" />

<!--metatags-->
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<!-- CSS -->
<?php echo asset::css('kitchen_style.css', array('media' => 'all')); ?>

<script type="text/javascript">
      WebFontConfig = {
			google: { 
			    families: ['PT+Sans+Narrow:400,700','Droid+Serif:400,700,700italic,400italic']
			}
      };
      (function() {
    	var wf = document.createElement('script');
    	wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    	wf.type = 'text/javascript';
    	wf.async = 'true';
    	var s = document.getElementsByTagName('script')[0];
    	s.parentNode.insertBefore(wf, s);
      })();
</script>

<?php if (Settings::get('frontend_css')): ?>
	<style type="text/css"><?php echo Settings::get('frontend_css'); ?></style>
<?php endif; ?>

</head>


<body class="kitchen <?php echo is_admin() ? 'admin' : 'not-admin';?>">
	
	

	<div id="buttonBar">

		<div id="buttonHolders">
			

				
		<?php if (is_admin()): ?>
			<?php echo anchor('admin/', __('global:backtoadmin'), 'class="button"'); ?>
		<?php endif; ?>
		<?php if ($this->session->userdata('client_passphrase') != ''): ?>
		<?php if ($this->uri->segment(3) == ''): ?>
			<?php echo anchor(Settings::get('kitchen_route').'/'.$this->uri->segment(2), 'Dashboard', 'class="button active"'); ?>
		<?php endif; ?>
		<?php endif; ?>
		

		<?php if ($this->session->userdata('client_passphrase') != ''): ?>
			<?php echo anchor(Settings::get('kitchen_route').'/logout/'.$this->uri->segment(2), __('global:logout'), 'class="button"'); ?>
		<?php endif; ?>
		<?php if ($this->uri->segment(4) != ''): ?>
			<?php echo anchor(Settings::get('kitchen_route').'/'.$this->uri->segment(2), __('kitchen:backtodashboard'), 'class="button"'); ?>
		<?php endif; ?>
		
		<span class="button-bar-text "><?php echo Settings::get('site_name'); ?> - <?php echo __('kitchen:kitchen_name') ?></span>
		</div><!-- /buttonHolders -->
		
		

	</div><!-- /buttonBar -->
	
	<div id="wrapper">
		<?php if (!isset($hide_header)) :?>
		<div class="header-area">
			
		</div><!-- /header-area end -->
		<?php endif;?>


<?php echo $template['body']; ?>



		
        <div id="footer">

		</div><!-- /footer -->
	</div><!-- /wrapper -->
</body>
</html>