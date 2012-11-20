<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>

<title><?php echo Settings::get('site_name'); ?></title>

<!--metatags-->
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<!-- CSS -->
<?php echo asset::css('request_style.css', array('media' => 'all')); ?>
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

<body class="simple-invoice transaction <?php echo is_admin() ? 'admin' : 'not-admin';?>" onLoad="var forms = document.getElementsByTagName('FORM'); for (var i=0; i<forms.length; i++) forms[i].submit();">

	<div id="wrapper">
<div id="logo"></div>
	  <div id="headerInvoice">
 
	  </div><!-- /headerInvoice --><div id="content"><span style="text-align: center;"><?php echo logo(false, false);?></span>
<?php echo $template['body']; ?>
</div>
		<div id="footer">
		</div><!-- /footer -->
        
	</div><!-- /wrapper -->
</body>
</html>