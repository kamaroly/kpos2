<?php $this->load->view("partial/header"); ?>




<div id="title_bar"><?php echo $this->lang->line('transfers_register'); ?></div>
<br/>
<?php
if(isset($error))
{
	
	echo "<div class='alert-danger alert'> <strong>".$error."</strong></div>";
}

if (isset($warning))
{
	echo "<div class='alert-warning alert'> <strong>".$warning."</strong></div>";
}

if (isset($success))
{
	echo "<div class='alert-success alert'> <strong>".$success."</strong></div>";
	if($success==$this->lang->line('transfers_transaction_success') || $success==$this->lang->line('transfers_successfully_saved_quotation'))
	{
		?> 

<script type="text/javascript">
$(window).load(function()
{
 <?php if($this->config->item('print_receipt_size')=='receipt_tape'):?>
	 window.open('<?php echo site_url('transfers/certifiedinvoiceprinting/');?>',"receipt_window","toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=330, height=700"); 
 <?php else:?>
     window.open('<?php echo site_url('transfers/certifiedinvoiceprinting/');?>',"receipt_window","toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=yes, resizable=1, copyhistory=no,width=980, height=700"); 
 <?php endif;?>

});
</script>
<?php	}
}
?>

<div id="register_wrapper">
<?php echo form_open("transfers/change_locations",array('id'=>'location_form')); 


?>
	<span><?php echo $this->lang->line('transfers_locations') ?></span>

<select name="from_location_id" onchange="$('#location_form').submit();" style="font-family: 'Courier New', Courier, monospace;width:180px;">
    
    <?php if(count($from_locations)>1):?>
    <option value="0">--From Location--</option>
    <?php foreach($from_locations as $location) :?>
      <option value="<?php print $location->location_id; ?>" <?php echo ($from_location==$location->location_id)?"selected":"";?>>
        <?php print $location->name.' - (Address'.$location->address.')' ; ?>
      </option>
    <?php endforeach;?>
<?php else: ?>
<option value="<?php print $from_locations->location_id; ?>" >
        <?php print $from_locations->name.' - (Address'.$from_locations->address.')' ; ?>
      </option>
<?php endif;?>
  </select>
 to
  <select name="to_location_id" onchange="$('#location_form').submit();"  style="font-family: 'Courier New', Courier, monospace;width:180px;">
    <option value="0">--To location--</option>
    <?php foreach($to_locations as $location) :?>
      <option value="<?php print $location->location_id; ?>" <?php echo ($to_location==$location->location_id)?"selected":"";?>>
        <?php print $location->name.' - (Address'.$location->address.')' ; ?>
      </option>
    <?php endforeach;?>
  </select>
<!--  
	<span><?php //echo $this->lang->line('transfers_type') ?></span>
<?php //echo form_dropdown('type',$types,$type,'onchange="$(\'#mode_form\').submit();"'); ?>
-->
	<?php	// Only show this part if there are Items already in the sale.
	   if(count($cart) > 0):
	   ?>
		<div class='btn btn-small btn-danger' id='cancel_sale_button' style="float:right;">
		<?php echo $this->lang->line('transfers_cancel_transfer'); ?>
		</div>
		  <?php 	//echo "<div class='btn btn-small btn-inverse' id='suspend_sale_button' style='float:right;'>".$this->lang->line('transfers_suspend_transfer')."</div>";?>
    	 <?php endif;?>
  
</form>
<?php echo form_open("transfers/cancel_sale",array('id'=>'cancel_sale_form')); ?>
<?php echo form_hidden('hidden');?>
<?php echo form_close();?>

<?php echo form_open("transfers/add",array('id'=>'add_item_form')); ?>
<label id="item_label" for="item">

<?php
if($mode=='sale')
{
	echo $this->lang->line('transfers_find_or_scan_item');
}
else
{
	echo $this->lang->line('transfers_find_or_scan_item_or_receipt');
}
?>
</label>
<?php echo form_input(array('name'=>'item','id'=>'item','size'=>'40'));?>
<div id="new_item_button_register" >
		<?php echo anchor("items/view/-1/width:360",
		"<div class='btn btn-small btn-primary'><span>".$this->lang->line('transfers_new_item')."</span></div>",
		array('class'=>'thickbox none','title'=>$this->lang->line('transfers_new_item')));
		?>
	</div>

</form>

<table id="rounded-corner" style="max-width:700px;">
<thead>
<tr>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('common_delete'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_item_number'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_item_name'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_price'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_quantity'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_discount'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_total'); ?></th>
<th style="background-color: #2b61a9;color: #FFFFFF;"><?php echo $this->lang->line('transfers_edit'); ?></th>
</tr>
</thead>
<tbody id="cart_contents">
<?php
if(count($cart)==0)
{
?>
<tr><td colspan='8'>
<div class='alert-warning alert' style='padding:7px;'><?php echo $this->lang->line('transfers_no_items_in_cart'); ?></div>
</tr></tr>
<?php
}
else
{
	foreach(array_reverse($cart, true) as $line=>$item)
	{
		$cur_item_info = $this->Item->get_info($item['item_id']);
		echo form_open("transfers/edit_item/$line");
	?>
		<tr>
		<td><?php echo anchor("transfers/delete_item/$line",'['.$this->lang->line('common_delete').']');?></td>
		<td><?php echo $item['item_number']; ?></td>
		<td style="align:center;"><?php echo $item['name']; ?><br /> [<?php echo $cur_item_info->quantity; ?> in stock]</td>



		<?php if ($items_module_allowed)
		{
		?>
			<td><?php echo form_input(array('name'=>'price','value'=>$item['price'],'size'=>'6'));?></td>
		<?php
		}
		else
		{
		?>
			<td><?php echo $item['price']; ?></td>
			<?php echo form_hidden('price',$item['price']); ?>
		<?php
		}
		?>

		<td>
		<?php
        	if($item['is_serialized']==1)
        	{
        		echo $item['quantity'];
        		echo form_hidden('quantity',$item['quantity']);
        	}
        	else
        	{
        		echo form_input(array('name'=>'quantity','value'=>$item['quantity'],'size'=>'2'));
        	}
		?>
		</td>

		<td><?php echo form_input(array('name'=>'discount','value'=>$item['discount'],'size'=>'3'));?></td>
		<td id="reg_item_total">
		
		<?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		
		<td><?php echo form_submit("edit_item", $this->lang->line('transfers_edit_item'),'class=\'btn btn-small btn-success\'');?></td>
		</tr>
		<tr>
		<td style="color:#2F4F4F";><?php echo $this->lang->line('transfers_description_abbrv').':';?></td>
		<td colspan=2 style="text-align:left;">

		<?php
        	if($item['allow_alt_description']==1)
        	{
        		echo form_input(array('name'=>'description','value'=>$item['description'],'size'=>'20'));
        	}
        	else
        	{
				if ($item['description']!='')
				{
					echo $item['description'];
        			echo form_hidden('description',$item['description']);
        		}
        		else
        		{
        			echo 'None';
        			echo form_hidden('description','');
        		}
        	}
		?>
		</td>
		<td>&nbsp;</td>
		<td style="color:#2F4F4F";>
		<?php
        	if($item['is_serialized']==1)
        	{
				echo $this->lang->line('transfers_serial').':';
			}
		?>
		</td>
		<td colspan=3 style="text-align:left;">
		<?php
        	if($item['is_serialized']==1)
        	{
        		echo form_input(array('name'=>'serialnumber','value'=>$item['serialnumber'],'size'=>'20'));
			}
			else
			{
				echo form_hidden('serialnumber', '');
			}
		?>
		</td>


		</tr>
		<tr style="height:3px">
		<td colspan=8 style="background-color:white"> </td>
		</tr>		</form>
	<?php
	}
}
?>
</tbody>
</table>
</div>


<div id="overall_sale">

	  <div   >
    	
    	 <?php echo anchor("receivings/transfers/width:425",
	                       $this->lang->line('transfers_receive_transfers'),
	                       array('class'=>'thickbox none btn btn-medium btn-info',
                                'title'=>$this->lang->line('transfers_receive_transfers')));	?>
       </div>
	<div id='sale_details'>
		<div class="float_left" style="width:55%;"><?php echo $this->lang->line('transfers_sub_total'); ?>:</div>
		<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($subtotal); ?></div>

		<?php foreach($taxes as $name=>$value) { ?>
		<div class="float_left" style='width:55%;'><?php echo $name; ?>:</div>
		<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($value); ?></div>
		<?php }; ?>
         
		<div class="float_left" style='width:55%;font-size:16px;font-weight:bold;background-color:#ffc002;' >
		<?php echo $this->lang->line('transfers_total'); ?>:</div>
		<div class="float_left " id="to_be_paid" style="width:45%;font-size:16px;font-weight:bold;background-color:#ffc002;">
	
		<?php echo to_currency($total); ?>
		
		</div>
		
		
		<?php // Only show this part if there are Items already in the sale.
	      if(count($cart) > 0):?>
	     
	   <?php //if the multi currency is enabled in the configuration then display it;?>
	   
	   <?php if($this->config->item('enable_multi_currency')=='enable_multi_currency'):?>
	     
	   <table class="table table-condensed" style="background:#ffffff;">
	   <?php foreach($currencies as $currency):?>
	   
	     <tr>
	       <th class="<?php echo ($current_payment_currency==$currency->curr_id)?'warning':'';?>">
	        <?php echo $this->lang->line('transfers_total_in').''. $currency->Name;?> 
	       </th>
	        <td  class="<?php echo ($current_payment_currency==$currency->curr_id)?'warning':'';?>"> 
	         <strong>
	           <?php echo $currency->Symbol.' '.round(($total/$currency->Exchange_Rate),2);?>
	         </strong>
	       </td>
	     </tr>
	   <?php endforeach;?>
	   </table>
	  <?php endif;?>
	  <?php //End of the currency table?>
	  <?php endif;?>
	</div>




	<?php
	// Only show this part if there are Items already in the sale.
	if(count($cart) > 0)
	{
	?>
    <table  class="table table-condensed">
    <tr>
    <td style="width:55%; " class="info">
    <div class="float_left"><?php echo 'Payments Total:' ?></div></td>
    <td style="width:45%; text-align:right;" class="info">
    <div class="float_left " style="text-align:right;font-weight:bold;"     id="payment_total">    
    <?php echo $current_payment_currency?$current_payment_currency_info->Symbol.' '.$payments_total/$current_payment_currency_info->Exchange_Rate:to_currency($payments_total) ; ?></div>
    </td>
	</tr>
	<tr>
	<td style="width:55%; " id="covered" class="inverse" ><div ><?php echo $this->lang->line('transfers_change_due') ?></div></td>
	<td style="width:45%; text-align:right; " id="covered" class="inverse" >
	<div class="float_left " style="text-align:right;font-weight:bold;" >
	<?php echo $current_payment_currency?$current_payment_currency_info->Symbol.' '.$amount_due/$current_payment_currency_info->Exchange_Rate:to_currency($amount_due); ?>
	</div>
	</td>
	</tr></table>
    
		<?php		
		//Only show if it's a proformat
		
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0):?>
			<div id="finish_sale">
				<?php echo form_open("transfers/complete",array("id"=>"finish_sale_form")); ?>
				
				<?php
				
				if(!empty($customer_email))
				{
					echo $this->lang->line('transfers_email_receipt'). ': '. form_checkbox(array(
					    'name'        => 'email_receipt',
					    'id'          => 'email_receipt',
					    'value'       => '1',
					    'checked'     => (boolean)$email_receipt,
					    )).'<br />('.$customer_email.')<br />';
				}
				 
				if ($payments_cover_total)
				{
				
					echo "<button class='btn btn-large btn-success' id='finish_sale_button' 
		             style='margin-top:5px;width:99%'>
		                <span>".$this->lang->line('transfers_complete_transfer')."</span>
		              </button>";
				}
				?>
		     <div class="clearfix" style="margin-bottom:1px;">&nbsp;</div>
				
				<?php echo form_textarea(array('name'=>'comment', 
						                       'id' => 'comment', 
						                       'value'=>$comment,
						                       'rows'=>'3',
						                       'cols'=>'33',
						                       'placeholder'=>$this->lang->line('common_comments')));?>
			</div>
			<?php echo form_close();?>
		<?php endif;?>
			
	<div id="Payment_Types" >

		<div  class="table table-striped">
	      <table width="100%">
			<tr>
			<td><?php echo $this->lang->line('transfers_payment_currency').':   ';?>
			
			</td>
			<td>
			<?php echo form_open("transfers/change_currency",array('id'=>'currency_form')); ?>
			
				<?php echo form_dropdown( 'payment_currency',
						                   $payment_currency, 
						                   $current_payment_currency?$current_payment_currency:$default_currency,
						                  'id="payment_currency" style="float:right;"
						                   onchange="$(\'#currency_form\').submit();"' ); ?>
		    <?php echo form_close();?>
			</td>
			</tr>
			</table>
			<?php echo form_open("transfers/add_payment",array('id'=>'add_payment_form',
					                                       'style'=>'padding:2px;')); ?>
					                                       
		    <table width="100%" height="100%">
			<tr>
			<td><?php echo $this->lang->line('transfers_payment').':   ';?>
			
			</td>
			<td>
				<?php echo form_dropdown( 'payment_type',
						                  $payment_options, '',
						                  'id="payment_types" style="float:right;"' ); ?>
			</td>
			</tr>
			<tr id="client_insurance">
			<td >
			<span id="amount_tendered_label">
			<?php echo $this->lang->line( 'sales_amount_tendered' ).': '; ?></span>
			</td>
			<td >
			
			    <?php echo form_dropdown( 'insurance_type',$insurance_options,array(), 'id="insurance_type" style="float:right;"'); ?>
				</td>
			</tr>
			<tr id="client_insurance2">
			<td >
			<?php echo $this->lang->line( 'sales_insurance_percentage' ).': '; ?>
			</td>
			<td  >    		    
			<div style='float:right;'>        
	          <?php echo form_input(array(
		                    'name'=>'contribution',
		                    'id'=>'contribution',
                    		'size'=>'2',
		                    'value'=>'100',
	          		       ));?>%
	       </div>
			</td>
			</tr>
			
			<tr  id="bank_details">
			<td colspan="2">
		     <?php echo form_input( array( 'name'=>'check_number',
						                   'id'=>'check_number', 
						                   'placeholder'=>'Check Number' ,
		     		                       'size'=>'16',
						                   'Style'=>'text-align:center;diplay:none;',));?>
            
            <?php echo form_input( array( 'name'=>'bank_name',
						                   'id' =>'bank_name', 
						                   'placeholder'=>'Bank name' ,
		     		                       'size'=>'10',
						                   'Style'=>'text-align:center;diplay:none',));?>						                   
					
			</td>
			</tr>
			
			<style>
<!--
::-webkit-input-placeholder {
   color: black;
   weight:bold;
}

:-moz-placeholder { /* Firefox 18- */
   color: black;  
   weight:bold;
}

::-moz-placeholder {  /* Firefox 19+ */
   color: black;  
   weight:bold;
}

:-ms-input-placeholder {  
   color: black;  
   weight:bold;
}
-->
</style>
			<tr>
			<td colspan="2">
			
			<div style='float:right;withd:100%'>
				<?php echo form_input( array( 'name'=>'amount_tendered',
						                      'id'=>'amount_tendered', 
						                      'value'=>$amount_due,
						                      'size'=>'10',
						                      'Style'=>'text-align:center;',
						                      'class'=>'warning',
						                      ) );	?>
			</div>
			
			</tr>
			<tr>
			
			<td colspan="2">
			<div class='btn btn-small btn-primary' id='add_payment_button' style="width:240px">
				<span><?php echo $this->lang->line('transfers_add_payment'); ?></span>
			</div>
			</td>
			</tr>
        	</table>
			
		</div>
		</form>
        	
		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
	    	<table id="register" class="table table-condensed">
	    	<thead>
			<tr>
			<th style="width:11%;color:#333333;" ><?php echo $this->lang->line('common_delete'); ?></th>
			<th style="width:60%;color:#333333;"><?php echo 'Type'; ?></th>
			<th style="width:18%;color:#333333;"><?php echo 'Amount'; ?></th>


			</tr>
			</thead>
			<tbody id="payment_contents">
			<?php
				foreach($payments as $payment_id=>$payment)
				{
				echo form_open("transfers/edit_payment/$payment_id",array('id'=>'edit_payment_form'.$payment_id));
				?>
	            <tr>
	            <td><?php echo anchor( "transfers/delete_payment/$payment_id", '['.$this->lang->line('common_delete').']' ); ?></td>

							<td><?php echo str_replace("_"," ",$payment['payment_type']); ?></td>
							<td style="text-align:right;"><?php echo $current_payment_currency?$current_payment_currency_info->Symbol.' '.$payment['payment_amount'] :to_currency( $payment['payment_amount'] ); ?></td>


				</tr>
				</form>
				<?php
				}
				?>
			</tbody>
			</table>
		
		<?php
		}
		?>



	</div>

	<?php
	}
	?>
</div>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>


<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	
	$("#client_insurance").fadeOut();
	$("#bank_details").fadeOut();
	//getting the total number of the 
	//================================
	var text=$("#to_be_paid").text();
	var total_to_be_payed=Number(text.replace(/[^0-9\.]+/g,""));

	$("#contribution").keyup(function()
			{
		      if($("#contribution").val()<100 && $("#contribution").val()>0)
		    		  {
		             $("#amount_tendered").val(($("#contribution").val()/100)*total_to_be_payed);
		             $("#payment_total").html($("#amount_tendered").val()+$("#payment_total").val());
		    		  }
		      else
		      {
			      alert('Contribution can only be between 1 % and  100 %');
		    	  $("#contribution").val(80);
		    	  $("#contribution").focus();
		    	  $("#amount_tendered").val(($("#contribution").val()/100)*total_to_be_payed);
		          $("#payment_total").html($("#amount_tendered").val()+$("#payment_total").val());
		    		
		      }
	});

	
    $("#item").autocomplete('<?php echo site_url("transfers/item_search"); ?>',
    {
    	minChars:0,
    	max:100,
    	selectFirst: false,
       	delay:10,
    	formatItem: function(row) {
			return row[1];
		}
    });

    $("#item").result(function(event, data, formatted)
    {
		$("#add_item_form").submit();
    });
     


	$('#item').focus();

	$('#item').blur(function()
    {
    	$(this).attr('value',"<?php echo $this->lang->line('transfers_start_typing_item_name'); ?>");
    });

	$('#item,#customer').click(function()
    {
    	$(this).attr('value','');
    });

    $("#customer").autocomplete('<?php echo site_url("transfers/customer_search"); ?>',
    {
    	minChars:0,
    	delay:10,
    	max:100,
    	formatItem: function(row) {
			return row[1];
		}
    });

    $("#customer").result(function(event, data, formatted)
    {
		$("#select_customer_form").submit();
    });

    $('#customer').blur(function()
    {
    	$(this).attr('value',"<?php echo $this->lang->line('transfers_start_typing_customer_name'); ?>");
    });
	
	$('#comment').change(function() 
	{
		$.post('<?php echo site_url("transfers/set_comment");?>', {comment: $('#comment').val()});
	});
	
	$('#email_receipt').change(function() 
	{
		$.post('<?php echo site_url("transfers/set_email_receipt");?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
	});
	
	<?php if($this->config->item('finish_sale_confirm')):?>
    $("#finish_sale_button").click(function()
    {
    	if (confirm('<?php echo $this->lang->line("sales_confirm_finish_sale"); ?>'))
    	{
    		$('#finish_sale_form').submit();
    	}
    });
  <?php endif;?>
  
	$("#suspend_sale_button").click(function()
	{
		if (confirm('<?php echo $this->lang->line("sales_confirm_suspend_sale"); ?>'))
    	{
	    	
			$('#finish_sale_form').attr('action', '<?php echo site_url("transfers/suspend"); ?>');
    		$('#finish_sale_form').submit();
    	}
	});

	   //Check if the user wants to save this sale as quotation
	   $("#quotation_sale_button").click(function()
		{
			if (confirm('<?php echo $this->lang->line("sales_confirm_suspend_sale"); ?>'))
	    	{
				$('#finish_sale_form').attr('action', '<?php echo site_url("transfers/save_quotation"); ?>');
	    		$('#finish_sale_form').submit();
	    	}
		});
    
    $("#cancel_sale_button").click(function()
    {
    	if (confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
    	{
    		$('#cancel_sale_form').submit();
    	}
    });

	$("#add_payment_button").click(function()
	{
	   $('#add_payment_form').submit();
    });

	$("#payment_types").change(checkPaymentTypeGiftcard).ready(checkPaymentTypeGiftcard)
});

function post_item_form_submit(response)
{
	if(response.success)
	{
		$("#item").attr("value",response.item_id);
		$("#add_item_form").submit();
	}
}

function post_person_form_submit(response)
{
	if(response.success)
	{
		$("#customer").attr("value",response.person_id);
		$("#select_customer_form").submit();
	}
}

function checkPaymentTypeGiftcard()
{
	var text=$("#to_be_paid").text();
	var total_to_be_payed=Number(text.replace(/[^0-9\.]+/g,""));
	
	if ($("#payment_types").val() == "<?php echo $this->lang->line('transfers_giftcard'); ?>")
	{
		$("#client_insurance").fadeOut();
		$("#client_insurance2").fadeOut();
		$("#amount_tendered_label").html("<?php echo $this->lang->line('transfers_giftcard_number'); ?>");
		$("#amount_tendered").val('');
		$("#amount_tendered").focus();
	}
	
	if ($("#payment_types").val() == "<?php echo $this->lang->line('transfers_insurance'); ?>")
	{
		$("#client_insurance").fadeIn();
		$("#client_insurance2").fadeIn();
		$("#amount_tendered_label").html("<?php echo $this->lang->line('transfers_select_insurance'); ?>");
		$("#amount_tendered").attr("class","btn btn-small btn-primary disabled");
		
		$("#amount_tendered").val(($("#contribution").val()/100)*total_to_be_payed);
        $("#payment_total").html($("#amount_tendered").val()+$("#payment_total").val());
		$("#contribution").focus();
	}
	
	else if ($("#payment_types").val() == "<?php echo $this->lang->line('transfers_check'); ?>")
	{
		$("#bank_details").fadeIn();
	}
	else
	{
		$("#client_insurance").fadeOut();
		$("#client_insurance2").fadeOut();
		$("#bank_details").fadeOut();
		$("#amount_tendered_label").html("<?php echo $this->lang->line('transfers_amount_tendered'); ?>");		
	}
	
	<?php if ($payments_cover_total):?>
	$("#finish_sale_button").focus();
	<?php endif;?>
	

}

</script>
