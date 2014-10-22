<?php $this->load->view("partial/header"); ?>
<?php
if (isset($error_message))
{
	echo '<div class="alert-danger alert"><h1 style="text-align: center;">'.$error_message.'</h1></div>';
	exit;
}
?>
<?php if($this->config->item('print_receipt_size')=='receipt_tape'):?>
<input type="button" class="btn btn-small btn-inverse"
onclick="window.open('<?php echo site_url("sales/printreceipt/$sale_number");?>','receipt_window','toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=305, height=700');this.disabled" 
value="<?php echo ($this->Sale->was_copied($sale_number)->copied==1)?'Cannot Re-print, a copy was reprinted on '.$this->Sale->was_copied($sale_number)->copied_date:$this->lang->line('common_print');?>" 
<?php echo ($this->Sale->was_copied($sale_number)->copied==1)?"DISABLED='Disabled'":'';?> />
	 
 <?php else:?>
<input type="button" class="btn btn-small btn-inverse"
onclick="window.open('<?php echo site_url("sales/printreceipt/$sale_number");?>','receipt_window','toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=900 , height=841');" value="<?php echo $this->lang->line('common_print');?>">
	
  <?php endif;?>

<div id="receipt_wrapper">
	<div id="receipt_header">

	<div id="sale_receipt"></div>
	

	<div style="float:left">

		<div style="float:left"><?php echo $transaction_time ?></div>
		<br/>
		<br/>
		<?php if(isset($customer)):?>
			<div style="float:left"><strong><?php echo $this->lang->line('customers_customer');?></strong>: <?php echo $customer->first_name.' '.$customer->last_name; ?></div>
		    <br/>
		    <?php if (strlen($customer->tin)==9):?>
		    <div style="float:left"><strong><?php echo $this->lang->line('common_tin');?></strong>: <?php echo $customer->tin; ?></div>
		    <br/>
		    <?php endif;?>
		    <?php if (strlen($customer->address_1)>4):?>
		    <div style="float:left"><strong><?php echo $this->lang->line('common_address');?></strong>: <?php echo $customer->address_1; ?></div>
		    <?php endif;?>
	
		<?php endif;?>
		  <br/>
		<div style="float:left"><strong><?php echo $this->lang->line('sales_id');?></strong> <?php echo $sale_id; ?></div>
	
		
	</div>

<table class="receipt_right" style="background:#f9f9f9; margin-bottom:20px;" >
    <?php if($this->config->item('show_logo_on_receipt')):?>	
    <tr style="background-color:#ffffff;">
	<td   colspan="2"  style="text-align:center;">
	<?php
$image_properties = array(
		'src' => 'images/company_logo/'.$this->config->item('company_logo'),
		'alt' => 'KPharmacy',
		'class' => 'img-polaroid',
		'width' => '200',
		'height' => '100',
		'title' => 'That was quite a night',
		'rel' => 'lightbox',
);
echo img($image_properties);?>
</td>
</tr>	
<?php endif;?>	
	<tr>
	<td    ><strong><?php echo $this->config->item('company'); ?></strong></td>
	</tr>
	<tr>
	<td   class="receipt_right"><?php echo $this->lang->line('common_tin'); ?>&nbsp; &nbsp;:<?php echo $this->config->item('tin'); ?></td>
	</tr>
	<tr>
	<td   class="receipt_right">&nbsp; &nbsp; &nbsp; &nbsp;<?php echo $this->config->item('phone'); ?></td>
	</tr>
	<tr>
	<td   class="receipt_right">&nbsp; &nbsp; &nbsp; &nbsp;<?php echo $this->config->item('email'); ?></td>
	</tr>
	<tr>
	<td  class="receipt_right">&nbsp; &nbsp; &nbsp; &nbsp;<?php echo $this->config->item('website'); ?></td>
	</tr>
	<tr>
	<td>&nbsp; &nbsp; &nbsp; &nbsp;<?php echo nl2br($this->config->item('address')); ?></td>
	</tr>

</table>

<div>
	
</div>
<br/>


	<table id="receipt_items" style="margin-top:20px;" class="table table-bordered table-striped">
	<tr>
	<th style="width:25%;text-align:center;" ><?php echo $this->lang->line('sales_item_number'); ?></th>
	<th style="width:25%;text-align:center;" ><?php echo $this->lang->line('items_item'); ?></th>
	<th style="width:17%;text-align:center;" ><?php echo $this->lang->line('common_price'); ?></th>
	<th style="width:16%;text-align:center;" ><?php echo $this->lang->line('sales_quantity'); ?></th>
	<th style="width:16%;text-align:center;" ><?php echo $this->lang->line('sales_discount'); ?></th>
	<th style="width:17%;text-align:right;" ><?php echo $this->lang->line('sales_total'); ?></th>
	</tr>
	<?php
	foreach(array_reverse($cart, true) as $line=>$item)
	{
	?>
		<tr>
		<td><?php echo $item['item_number']; ?></td>
		<td><span class='long_name'><?php echo $item['name']; ?></span><span class='short_name'><?php echo character_limiter($item['name'],10); ?></span></td>
		<td><?php echo to_currency($item['price']); ?></td>
		<td style='text-align:center;'><?php echo $item['quantity']; ?></td>
		<td style='text-align:center;'><?php echo $item['discount']; ?></td>
	
	<td style='text-align:right;'><?php echo to_currency(round($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100)); ?></td>
	
	
	    </tr>

	<?php
	}
	?>
	</table>

	<table class="receipt_right">
	<tr  class="border_top border_bottom_small">
	<td  class="receipt_left" ><?php echo $this->lang->line('sales_sub_total'); ?></td>
	<td   ><?php echo to_currency($subtotal); ?></td>
	</tr>

	<?php foreach($taxes as $name=>$value) : ?>
		<tr class="border_bottom_small">
			<td   class="receipt_left"><?php echo $name; ?>:</td>
			<td  ><?php echo to_currency(round($value)); ?></td>
		</tr>
	<?php endforeach; ?>

	<tr  class="border_top">
	<th class="receipt_left"><?php echo $this->lang->line('sales_total'); ?></th>
	<th  ><?php echo to_currency($total); ?></th>
	</tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr class="border_bottom">
    <th colspan="2" style="text-align:center"><?php echo $this->lang->line('sales_payment'); ?></th>
    </tr>

	<?php	foreach($payments as $payment_id=>$payment): ?>
		<tr class="border_bottom_small">
		<td class="receipt_left"><?php $splitpayment=explode(':',$payment['payment_type']); echo str_replace('_', " ", $splitpayment[0]); ?> </td>
	
	    <td   class="border_bottom_small">:&nbsp;<?php echo to_currency( round($payment['payment_amount']) * -1 ); ?>  </td>
	    </tr>
	<?php endforeach;	?>
 
    <tr class="border_bottom"><td class="receipt_left" > ITEMS NUMBER </td><td><?php echo count($cart);?></td></tr>
    
     <tr><td colspan="2">&nbsp;</td></tr>

	<tr class="border_bottom_small">
		<td    class="receipt_left"><strong><?php echo $this->lang->line('sales_change_due'); ?> </strong></td>
		<td  ><strong><?php echo  $amount_change; ?></strong></td>
	</tr>

	</table>
	</div>
	</div>

<div style="width:400px;"> 	
<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>SDC INFORMATION </strong>
<br/>----------------------------------------------
<?php
echo "<br/>Date: ".$sdc_infos['Date']."  &nbsp; &nbsp; &nbsp;  &nbsp; Time: ".$sdc_infos['TIME'];
echo "<br/>SDC ID: &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$sdc_infos['SDC_ID']." ";
echo "<br/>RECEIPT NUMBER:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$sdc_infos['TNumber']."/".$sdc_infos['GNumber']."  ".$sdc_infos['RLabel'];

if (strlen($sdc_infos['Internal_Data'])>=26) :

echo "<br/><br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Internal Data: ";
echo "<br/> ".$sdc_infos['Internal_Data']." ";

endif;

if (strlen($sdc_infos['Receipt_Signature'])>=16) :
echo "<br/>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Receipt Signature: ";
echo "<br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$sdc_infos['Receipt_Signature']." ";
endif;
echo "<br/><br/>---------------------------------------------- ";
echo "<br/>RECEIPT NUMBER: &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $sale_id ";
echo "<br/>DATE: ".substr($sale_info['sale_time'], 0,10)."  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; TIME: ".substr($sale_info['sale_time'], 10,8)." ";
echo "<br/>MRC:&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$this->config->item('software_developer_id').$this->config->item('software_certificate_number').$this->config->item('serial_number');
echo "<br/>---------------------------------------------- ";
?>

</div>
</div>

<div style="width:100%" class="border_bottom"></div>

<br/>
   <div id="sale_return_policy">
	<?php echo nl2br($this->config->item('return_policy')); ?>
	<br/>
	<div id="sale_return_policy" class="border_top_small border_bottom_small" style="width:250px;"><strong>Served by </strong><?php echo $employee; ?></div>
	</div>
	<div id='barcode'>
	<?php echo "<img src='index.php/barcode?barcode=$sale_id&text=$sale_id&width=250&height=50' />"; ?>
	</div>
</div>
<?php $this->load->view("partial/footer"); ?>

<?php if ($this->Appconfig->get('print_after_sale') and $this->uri->segment(2)=='complete')
{
?>
<script type="text/javascript">
$(window).load(function()
{
 <?php if($this->config->item('print_receipt_size')=='receipt_tape'):?>
	 window.open('<?php echo site_url('sales/printreceipt/'.$sale_number);?>',"receipt_window","toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=305, height=700"); 
 <?php else:?>
     window.open('<?php echo site_url('sales/printreceipt/'.$sale_number);?>',"receipt_window","toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no"); 
 <?php endif;?>
});
</script>
<?php
}
?>