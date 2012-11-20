<div id="login-box">
	<?php echo logo(false, false, 2);?>
	<p class="client-welcome"><?php echo __('kitchen:client_welcome') ?> <?php echo $client->first_name . " ". $client->last_name  . " - ". $client->company?></p>
	<h3><?php echo __('kitchen:pleaselogin') ?></h3>
	


	
	<?php echo form_open(Settings::get('kitchen_route')."/login/".$client->unique_id, 'id="login-form"');?>
				<div class="row">
				<label for="email"><?php echo lang('clients:passphrase') ?>:</label>
				<?php echo form_input(array(
					'name'	=> 'passphrase',
					'id'	=> 'passphrase',
					'type'	=> 'password',
					'class'	=> 'txt',
					'value' => set_value('passphrase'),
				));?>
				</div>
				
				<?php if ($this->session->flashdata('error')): ?>
					<p class="error"><?php echo $this->session->flashdata('error'); ?></p>
				<?php endif ?>
				
				<div>
						<input type="submit" class="hidden-submit button" value="<?php echo lang('login:login') ?>" />
						<!-- <input type="submit" class="hidden-submit" />
						<a href="#" class="yellow-btn" onclick="document.getElementById('login-form').submit();" style="float: right; margin-right: 30px"><span>&nbsp;&nbsp;<?php echo lang('login:login') ?>&nbsp;&nbsp;</span></a> -->
				</div>
	<?php echo form_close();?>
</div>