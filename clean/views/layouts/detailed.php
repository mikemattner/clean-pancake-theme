<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<title><?php echo __('invoices:invoicenumber', array($invoice['invoice_number']));?> | <?php echo Settings::get('site_name'); ?></title>

<!--favicon-->
<link rel="shortcut icon" href="" />

<!--metatags-->
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<!-- CSS -->
<?php echo asset::css('invoice_style.css', array('media' => 'all'), NULL, $pdf_mode); ?>

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

<body class="invoice <?php echo is_admin() ? 'admin' : 'not-admin';?> <?php if ($pdf_mode): ?>pdf_mode pdf<?php else: ?>not-pdf<?php endif;?>">
<?php if( ! $pdf_mode): ?>
	<div id="buttonBar">

		<div id="buttonHolders">
		    
		<?php if (is_admin()): ?>
			<?php echo anchor('admin/invoices/'.((isset($is_estimate) and $is_estimate) ? 'estimates' : 'all'), 'Go to Admin &rarr;', 'class="button"'); ?>
		<?php endif; ?>
		    <?php echo anchor(Settings::get('kitchen_route').'/'.$client_unique_id, 'Go to Client Area &rarr;', 'class="button"'); ?>
		<div id="pdf">
			<a href="<?php echo site_url('pdf/'.$invoice['unique_id']); ?>" title="Download PDF" id="download_pdf" class="button">Download PDF</a>
		</div><!-- /pdf -->

		<?php if( ! $is_paid and (count(Gateway::get_frontend_gateways($invoice['real_invoice_id'])) > 0)){ ?>
		<div id="paypal">
        	<a href="<?php echo $invoice['partial_payments'][$invoice['next_part_to_pay']]['payment_url']; ?>" class="button"><?php if (count($invoice['partial_payments']) > 1) : ?>Pay part #<?php echo $invoice['next_part_to_pay']; ?> of your invoice now<?php else: ?>Proceed to payment<?php endif;?></a>
		</div><!-- /paypal -->
		<?php }?>
		<?php if ($is_paid) :?>
		    <span class="paidon status_paid"><?php echo __('invoices:thisinvoicewaspaidon', array(format_date($invoice['payment_date'])));?></span>
		<?php elseif (!isset($is_estimate)) :?>
		    <span class="paidon status_unpaid"><?php echo __('invoices:thisinvoiceisunpaid');?></span>
		<?php endif;?>
		</div><!-- /buttonHolders -->

	</div><!-- /buttonBar -->
<?php endif; ?>
	<div id="wrapper">
		<div id="header">
			<div id="envelope" <?php if (!$pdf_mode):?> style="padding: 0" <?php endif; ?>>
				<table cellspacing="0" cellpadding="0" style="padding: 0 0px;">
					<tr>
                      <td class="invoice-details-holder">
                      	   <h2><?php echo __('global:invoice'); ?></h2>
                      </td>
						<td style="text-align:left;vertical-align:middle;" id="company-info-holder">
						    <?php echo logo(false, false, 2);?><br />
							<?php echo nl2br(Settings::get('mailing_address')); ?></p>
                            
              		   </td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" class="details-box">
                    <tr>
                    	<td>
                    		<div id="clientAddress">
							<p><strong><?php echo $invoice['company'];?></strong><br />
                            <?php echo $invoice['first_name'].' '.$invoice['last_name'];?><br />
                            <?php echo nl2br($invoice['address']);?></p>
                            </div><!-- /clientInfo -->	
                        </td>
                        <td class="details"><span>Invoice #</span> <?php echo __($invoice['invoice_number']);?></td>
                      	<td class="details"><span><?php echo __('invoices:invoicedate'); ?></span> <?php echo $invoice['date_entered'] ? format_date($invoice['date_entered']) : '<em>n/a</em>';?></td>
						<td class="details"><span><?php echo __('invoices:due'); ?></span> <?php echo $invoice['due_date'] ? format_date($invoice['due_date']) : '<em>n/a</em>';?></td>
			            <?php if($invoice['is_paid'] == 1): ?>
			               <td class="details is_paid"><span>Paid On</span><?php echo __(format_date($invoice['payment_date']));?></td>
			            <?php endif; ?>
			        </tr> 
				</table>
			</div><!-- /envelope -->


			<div id="clientInfo">
            <div id="billing-info">
              <table cellspacing="0" cellpadding="0" id="billing-table">
				<tr>
                  <td width="<?php echo (!$pdf_mode)? "100%" : "700px" ?>"  style="vertical-align:top;">
						<?php if ( ! empty($invoice['description'])): ?>
						<h3>Project Summary:</h3>
						<?php echo auto_typography($invoice['description']);?>
						<?php endif; ?>
					</td>
                </tr>
              </table>
              <br /> <br />
            </div>
		  </div><!-- /clientInfo -->



		</div><!-- /header -->
<?php echo $template['body']; ?>
		<div id="footer">
Thank you for your business!
		</div><!-- /footer -->
</div><!-- /wrapper -->


<?php

// ====================
// = Remittence slips =
// ====================

/*
	If you wish to remove this option delete everyting between
	
	=== PAYMENT SLIP ====
	
	=== END PAYMENT SLIP ===
	
*/


?>



<?php // 	=== PAYMENT SLIP ====	 ?>

<?php if($pdf_mode and Settings::get('include_remittance_slip')): ?>
<div style="page-break-before: always;"></div>
<div id="wrapper">
 <div id="header">
  <div id="envelope">
   <table border="0" cellspacing="5" cellpadding="5">
    <tr>
     <td width="400px">
      <h2>How to Pay</h2>
      <p>View invoice online at <?php echo anchor($invoice['unique_id']); ?></p>
      <p>You may pay in person, online, or by mail using this payment voucher. Please provide your payment information below.<br/>
<br/><br/>
Enclosed Amount: __________________________________
      </p>
     </td>
     <td width="200px" style="text-align:right">
      <p>
      <strong>Invoice #:</strong> <?php echo $invoice['invoice_number'];?><br/>
      <strong>Total:</strong> <?php echo Currency::format($invoice['total'], $invoice['currency_code']); ?><br/>
      <strong>Due:</strong> <?php echo $invoice['due_date'] ? format_date($invoice['due_date']) : '<em>n/a</em>';?>
      </p>
      
      <h3>Mail To:</h3>      
      <p><?php echo Settings::get('site_name'); ?><br /><?php echo nl2br(Settings::get('mailing_address')); ?></p>
     </td>
     
    </tr>
   </table>
  </div>
 </div>
</div>
<?php endif; ?>
<?php // === END PAYMENT SLIP === ?>

</body>
</html>