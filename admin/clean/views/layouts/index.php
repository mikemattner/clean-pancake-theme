<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $template['title']; ?></title>
	<link rel="shortcut icon" href="<?php echo Asset::get_src('favicon.ico', 'img');?>" />
	<?php asset::css('uniform.default.css', array('media' => 'screen'), 'main-css'); ?>
	<?php asset::css('facebox.css', array('media' => 'screen'), 'main-css'); ?>
	<?php asset::css('stacks.css', array('media' => 'all'), 'main-css'); ?>
    <?php asset::css('jquery.minicolors.css', array(), 'main-css'); ?>
	<?php asset::css('pancake-ui/jquery-ui-1.8.15.custom.css', array('media' => 'screen'), 'main-css'); ?>
	<?php echo asset::render('main-css'); ?>

	<!--[if lt IE 7]><?php echo asset::css('lt7.css'); ?> <![endif]-->
	<!--[if !IE 7]><style type="text/css">#wrapper {display:table;height:100%}</style><![endif]-->
	<?php if (Settings::get('backend_css')): ?><style type="text/css"><?php echo Settings::get('backend_css'); ?></style><?php endif; ?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
	<script>
	    window.jQuery || document.write('<script src="<?php echo asset::get_src('jquery.js', 'js');?>">\x3C/script>');
	    refreshTrackedHoursUrl = '<?php echo site_url('ajax/refresh_tracked_hours/');?>';
	    faceboxURL = '<?php echo str_replace('facebox.js', '', asset::get_src('facebox/facebox.js', 'js'));?>';
	    faceboxLoadingImageURL = '<?php echo asset::get_src('facebox/loading.gif', 'js');?>';
	    faceboxCloseLabelURL = '<?php echo asset::get_src('facebox/closelabel.png', 'js');?>';
	    baseURL = '<?php echo substr((substr(site_url('ajax'), -1) == '/') ? site_url('ajax') : site_url('ajax').'/', 0, -5);?>';
	    siteURL = '<?php echo rtrim(site_url(), '/');?>/';
	    php_date_format = "<?php echo Settings::get('date_format');?>";
	    datePickerFormat = "<?php echo get_date_picker_format();?>";
	    storeTimeUrl = '<?php echo site_url('ajax/store_time');?>';
	    lang_paymentdetails = '<?php echo __('partial:paymentdetails'); ?>';
	    lang_markaspaid     = '<?php echo __('partial:markaspaid'); ?>';
	    submit_import_url = '<?php echo site_url('admin/settings/submit_import/')?>';
	    lang_loading_please_wait = '<?php echo addslashes(__('update:loadingpleasewait'));?>';
        submit_hours_url = '<?php echo site_url('admin/projects/times/add_hours')?>';
	</script>
	<?php asset::js('main.js', array(), 'main-js'); ?>
	<?php asset::js('jquery-ui-1.8.15.custom.min.js', array(), 'main-js'); ?>
	<?php asset::js('plugins.js', array(), 'main-js'); ?>
    <?php asset::js('jquery.minicolors.js', array(), 'main-js'); ?>
	
	<?php echo asset::render('main-js'); ?>
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
    <body class="<?php echo (isset($iframe)) ? ($iframe ? 'iframe' : '') : '';?>">
<div id="wrapper">
	<div class="w1">
		<div class="w2">
			<div id="header">
				<div class="header-cell">
				    <div class="surround">
					<?php echo logo();?>
					<ul class="user-nav">
					    <?php if (defined('TEMPORARY_NO_INTERNET_ACCESS')) :?>
						<li><?php echo __('update:internetissues');?></li>
					    <?php else: ?>
						<?php if (Settings::get('latest_version') != Settings::get('version')) :?>
						    <li><?php echo anchor('admin/settings#update', __('settings:newversionavailable', array(Settings::get('latest_version')))); ?></li>
						<?php endif;?>
					    <?php endif;?>
						    <?php if (is_admin()) :?>
						<li<?php echo ((substr($this->uri->uri_string(), 6, 9) == 'settings') or ($module == 'settings')) ? ' class="active"' : ''; ?>><?php echo anchor('admin/settings', __('global:settings')); ?></li>
						    <?php endif;?>
					    <?php if (!PANCAKE_DEMO) :?>
						<li><?php echo anchor('admin/users/change_password', __('global:changepassword')); ?></li>
					    <?php endif; ?>
						<li><?php echo anchor('admin/users/logout', __('global:logout')); ?></li>
					</ul>
					<!-- /user-nav end -->
					</div>
				</div><!-- /header-cell end -->
				<div class="header-box">
				    <div class="surround clearfix">
					<ul id="nav">
						<li class="dashboard<?php echo ($module == 'dashboard') ? ' active' : ''; ?>"><?php echo anchor('admin', __('global:dashboard')); ?></li>
						<?php if (is_admin() or isset($this->permissions['invoices'])): ?>
						<li class="<?php echo ($module == 'invoices' and substr($this->uri->uri_string(), 6, 9) != 'estimates') ? 'active ' : ''; ?>subnav">
							<?php echo anchor('admin/invoices/all', __('global:invoices')); ?>
							<ul class="submenu">
								
								<?php if (group_has_role('invoices', 'create')): ?>
							    <li><?php echo anchor('admin/invoices/create', __('global:createinvoice')); ?></li>
								<?php endif ?>
								
								<?php if (group_has_role('invoices', 'view')): ?>
							    <li><?php echo anchor('admin/invoices/paid', __('global:paid')); ?> <span class="count"><?php echo get_count('paid'); ?></span></li>
							    <li><?php echo anchor('admin/invoices/overdue', __('global:overdue')); ?> <span class="count"><?php echo get_count('overdue'); ?></span></li>
							    <li><?php echo anchor('admin/invoices/unpaid', __('global:sentbutunpaid')); ?> <span class="count"><?php echo get_count('sent_but_unpaid'); ?></span></li>
							    <li><?php echo anchor('admin/invoices/unsent', __('global:unsent')); ?> <span class="count"><?php echo get_count('unsent'); ?></span></li>
							    <li><?php echo anchor('admin/invoices/recurring', __('global:recurring')); ?> <span class="count"><?php echo get_count('recurring'); ?></span></li>
								<?php endif ?>
							    <li><?php echo anchor('admin/items', __('global:reusableinvoiceitems')); ?></li>
							  </ul>
						</li>
						
						<?php if (group_has_role('invoices', 'create')): ?>
						<li<?php echo (($module == 'invoices' and substr($this->uri->uri_string(), 6, 9) == 'estimates') or ($module == 'estimates')) ? ' class="active"' : ''; ?>><?php echo anchor('admin/invoices/estimates', __('global:estimates')); ?></li>
						<?php endif ?>
						<?php endif ?>
							
						<?php if (is_admin() or isset($this->permissions['projects'])): ?>
						<li<?php echo ($module == 'projects') ? ' class="active"' : ''; ?>><?php echo anchor('admin/projects', __('global:projects')); ?></li>
						<?php endif ?>
						<?php if (is_admin() or isset($this->permissions['proposals'])): ?>
                        <li<?php echo ($module == 'proposals') ? ' class="active"' : ''; ?>><?php echo anchor('admin/proposals', __('global:proposals')); ?></li>
						<?php endif ?>
						<?php if (is_admin() or isset($this->permissions['reports'])): ?>
						<li<?php echo ($module == 'reports') ? ' class="active"' : ''; ?>><?php echo anchor('admin/reports', __('global:reports')); ?></li>
						<?php endif ?>
						<?php if (is_admin() or isset($this->permissions['clients'])): ?>
						<li<?php echo ($module == 'clients') ? ' class="active"' : ''; ?>><?php echo anchor('admin/clients', __('global:clients')); ?></li>
						<?php endif ?>
						<?php if (is_admin() or isset($this->permissions['users'])): ?>
						<li<?php echo ($module == 'users') ? ' class="active"' : ''; ?>><?php echo anchor('admin/users', __('global:users')); ?></li>
						<?php endif; ?>
					</ul><!-- /nav end -->
					</div>
				</div><!-- /header-box end -->

			</div><!-- /header end -->
			<?php echo $template['partials']['notifications']; ?>
			<div id="main_wrapper">
			<div id="main">
			
<?php if ($module !== 'dashboard'): ?>				
				<div class="subbar">

<div class="invoice-block ">
	
	<div class="head-box module-title">
		<h3 class="ttl ttl2"><?php echo $module_details['name'] ? anchor('admin/'.$module_details['slug'], $module_details['name']) : '' ?>
			<?php if ( $this->uri->segment(2) ) { echo '&nbsp;  &nbsp;'; } ?>
		</h3>
		<span>
			<?php echo $module_details['description'] ? $module_details['description'] : ''; ?>
		</span>
	</div><!-- /head-box -->

</div><!-- /invoice-block  -->




						<div id="shortcuts">
							<ul class="btns-list">
								<?php if ( ! empty($module_details['sections'][$active_section]['shortcuts'])): ?>
									<?php foreach ($module_details['sections'][$active_section]['shortcuts'] as $shortcut):
										$name 	= $shortcut['name'];
										$uri	= $shortcut['uri'];
										unset($shortcut['name']);
										unset($shortcut['uri']); ?>
									<li><a <?php foreach($shortcut AS $attr => $value) echo $attr.'="'.$value.'"'; echo 'href="' . site_url($uri) . '"><span>' . lang($name) . '</span></a>'; ?></li>
									<?php endforeach; ?>
								<?php endif; ?>

								<?php if ( ! empty($module_details['shortcuts'])): ?>
									<?php foreach ($module_details['shortcuts'] as $shortcut):
										$name 	= $shortcut['name'];
										$uri	= $shortcut['uri'];
										unset($shortcut['name']);
										unset($shortcut['uri']); ?>
									<li><a <?php foreach($shortcut AS $attr => $value) echo $attr.'="'.$value.'"'; echo 'href="' . site_url($uri) . '"><span>' . lang($name) . '</span></a>'; ?></li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div><!-- /shortcuts -->

				</div><!-- /subbar -->
<?php endif ?>
				<?php if ( ! empty($module_details['sections'])): ?>
					
					<div class="sections_bar">
							
							<ul>
								<?php foreach ($module_details['sections'] as $name => $section): ?>
								<?php if(isset($section['name']) && isset($section['uri'])): ?>
								<li class="<?php if ($name === $active_section) echo 'current' ?>">
									<?php echo anchor($section['uri'], lang($section['name'])); ?>

								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>

					</div><!-- /sections_bar -->
					
				<?php endif ?>
				

				<?php echo $template['body']; ?>
			</div><!-- /main end -->
			</div><!-- /main_wrapper end -->
		</div>
	</div>
</div><!-- /wrapper end -->
<div id="footer">
			<div class="footer-cell">
				<strong class="f-logo"><a href="http://pancakeapp.com/">Pancake</a></strong>
				<div class="holder">
					<div class="row">
						<p><?php echo __('global:pancakeby7am', array(Settings::get('version'), '<a href="http://7am.ca/">7am</a>'))?>.<br />
						<?php echo __('global:allrelatedmediacopyright', array(COPYRIGHT_YEAR, '<a href="http://7am.ca/">7am</a>')); ?>.<br />
						Clean Theme 2.5 by <a href="http://www.mikemattner.com">Mike Mattner</a> &copy; <?php echo date('Y'); ?>.</p>
					</div>
				</div>
			</div><!-- /footer-cell end -->
</div><!-- /footer end -->
<?php print_update_notification();?>
<?php if (PANCAKE_DEMO) :?>
    <?php echo file_get_contents(FCPATH.'DEMO');?>
<?php endif;?>
</body>
</html>