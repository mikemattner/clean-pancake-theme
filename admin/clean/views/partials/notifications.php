<?php if ($message = $this->session->flashdata('success')): ?>
	<div id="notification_overlay" class="fadeable">
	<div class="notification success"><?php echo $message; ?></div>
	</div>
<?php endif; ?>
<?php if (isset($messages['success'])): ?>
	<div id="notification_overlay" class="fadeable">
	<div class="notification success"><?php echo $messages['success']; ?></div>
	</div>
<?php endif; ?>

<?php if ( $message = $this->session->flashdata('error')): ?>
	<div class="notification error"><b><?php echo __('global:error');?>:</b> <?php echo $message; ?></div>
<?php endif; ?>
<?php if (isset($messages['error'])): ?>
	<div class="notification error"><b><?php echo __('global:error');?>:</b> <?php echo $messages['error']; ?></div>
<?php endif; ?>
<?php if ($errors = validation_errors('<p>', '</p>')): ?>
	<div class="notification error"><?php echo $errors; ?></div>
<?php endif; ?>