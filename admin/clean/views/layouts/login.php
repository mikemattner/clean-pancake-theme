<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $template['title']; ?></title>
	<?php echo Asset::css('login.css', array('media' => 'all')); ?>
	<!--[if lt IE 7]><?php echo asset::css('lt7.css'); ?> <![endif]-->
	<?php if (Settings::get('backend_css')): ?><style type="text/css"><?php echo Settings::get('backend_css'); ?></style><?php endif; ?>
	<script type="text/javascript">
      WebFontConfig = {
			google: { 
			    families: ['PT+Sans+Narrow:400,700']
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
</head>
<body>
<div id="wrapper">
	<?php if (!isset($hide_header)) :?>
	<div class="header-area">
		<?php echo logo();?>
	</div><!-- /header-area end -->
	<?php endif;?>
	<div id="main">
		<?php echo $template['partials']['notifications']; ?>
		<?php echo $template['body']; ?>
	</div><!-- /main end -->
</div><!-- /wrapper end -->
<?php if (!PANCAKE_DEMO) :?>
				<div class="forgotten_password">
					<?php echo anchor('admin/users/forgot_password',  lang('login:forgot'), 'id="forgot-password"'); ?>
				</div>
<?php endif;?>
<?php if (PANCAKE_DEMO) :?>
    <?php echo file_get_contents(FCPATH.'DEMO');?>
<?php endif;?>
</body>
</html>