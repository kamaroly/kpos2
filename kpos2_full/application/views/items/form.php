

<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<ul id="error_message_box"></ul>
<?php
echo form_open('items/save/'.$item_info->item_id,array('id'=>'item_form'));
?>
<fieldset id="item_basic_info">
<legend><?php echo $this->lang->line("items_basic_information"); ?></legend>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_item_number').':', 'name',array('class'=>'wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'item_number',
		'id'=>'item_number',
		'value'=>$item_info->item_number)
	);?>
	</div>
</div>


<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_name').':', 'name',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'name',
		'id'=>'name',
		'value'=>$item_info->name)
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_category').':', 'category',array('class'=>'wide')); ?>
<?php $categories_items=array(0=>'Select categories',);?>
<?php foreach ($items_categories as $catagory):?>
<?php $categories_items[$catagory->id]=$catagory->cname;?>
<?php endforeach;?>
	<div class='form_field'>
	<?php
	 echo form_dropdown('category_id',
                        $categories_items,
                        $item_info->category_id?$item_info->category_id:0
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_supplier').':', 'supplier',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_cost_price').':', 'cost_price',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'cost_price',
		'size'=>'8',
		'id'=>'cost_price',
		'value'=>$item_info->cost_price)
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_unit_price').':', 'unit_price',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'unit_price',
		'size'=>'8',
		'id'=>'unit_price',
		'value'=>$item_info->unit_price)
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_vat_type').':', 'vat_type',array('class'=>'required wide')); ?>
<div class='form_field'>
<?php echo form_dropdown('vat_type',array('A-EX'=>'A-EX(Tax Exempted)',
		                                  'B'=>'B (VAT=18%)',
		                                  'C'=>'C (TAX =0 %)',
		                                  'D'=>'D (TAX =0 %)',),
		                    $item_info->vat_type);
?>
</div>		                                  
</div>


<div class="field_row clearfix">
	<?php echo form_label('Expiration'.$this->lang->line('sales_date').':','sales_date',array('class'=>'wide')); ?>
		<div class='form_field'>
			<?php echo form_input(array('name'=>'expiration_date',
					                    'value'=>$item_info->expiration_date, 
					                     'id'=>'date'));?>
		</div>
	</div>
	

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_quantity').':', 'quantity',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'quantity',
		'id'=>'quantity',
		'value'=>$item_info->quantity)
	);?>
	</div>
</div>

<input type="hidden" name="back_stock" value="0">

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_reorder_level').':', 'reorder_level',array('class'=>'required wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'reorder_level',
		'id'=>'reorder_level',
		'value'=>$item_info->reorder_level)
	);?>
	</div>
</div>

<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('items_location').':', 'location',array('class'=>'wide')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'location',
		'id'=>'location',
		'value'=>$item_info->location)
	);?>
	</div>
</div>
<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_description').':', 'description',array('class'=>'wide')); ?>
	<div class='form_field'>
	<?php echo form_textarea(array(
		'name'=>'description',
		'id'=>'description',
		'value'=>$item_info->description,
		'rows'=>'5',
		'cols'=>'17')
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_allow_alt_desciption').':', 'allow_alt_description',array('class'=>'wide')); ?>
	<div class='form_field'>
	<?php echo form_checkbox(array(
		'name'=>'allow_alt_description',
		'id'=>'allow_alt_description',
		'value'=>1,
		'checked'=>($item_info->allow_alt_description)? 1  :0)
	);?>
	</div>
</div>

<div class="field_row clearfix">
<?php echo form_label($this->lang->line('items_is_serialized').':', 'is_serialized',array('class'=>'wide')); ?>
	<div class='form_field'>
	<?php echo form_checkbox(array(
		'name'=>'is_serialized',
		'id'=>'is_serialized',
		'value'=>1,
		'checked'=>($item_info->is_serialized)? 1 : 0)
	);?>
	</div>
</div>


<?php
echo form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'btn btn-small btn-primary')
);
?>
</fieldset>
<?php
echo form_close();
?>
<script type='text/javascript'>

//validation and submit handling
$(document).ready(function()
{
	
	$('#date').datePicker({ dateFormat: 'dd-mm-yy' });

	$('#total_stock').val(Number($('#back_stock').val())+Number($('#quantity').val()));
	
	$("#category").autocomplete("<?php echo site_url('items/suggest_category');?>",{max:100,minChars:0,delay:10});
    $("#category").result(function(event, data, formatted){});
	$("#category").search();


	$('#item_form').validate({
		submitHandler:function(form)
		{
			/*
			make sure the hidden field #item_number gets set
			to the visible scan_item_number value
			*/
			$('#item_number').val($('#scan_item_number').val());
			$(form).ajaxSubmit({
			success:function(response)
			{
				tb_remove();
				post_item_form_submit(response);
			},
			dataType:'json'
		});

		},
		errorLabelContainer: "#error_message_box",
 		wrapper: "li",
		rules:
		{
			name:"required",
			category_id:"required",
			cost_price:
			{
				required:true,
				number:true
			},

			unit_price:
			{
				required:true,
				number:true
			},
			tax_percent:
			{
				required:true,
				number:true
			},
			quantity:
			{
				required:true,
				number:true
			},
			reorder_level:
			{
				required:true,
				number:true
			}
   		},
		messages:
		{
			name:"<?php echo $this->lang->line('items_name_required'); ?>",
			category:"<?php echo $this->lang->line('items_category_required'); ?>",
			cost_price:
			{
				required:"<?php echo $this->lang->line('items_cost_price_required'); ?>",
				number:"<?php echo $this->lang->line('items_cost_price_number'); ?>"
			},
			unit_price:
			{
				required:"<?php echo $this->lang->line('items_unit_price_required'); ?>",
				number:"<?php echo $this->lang->line('items_unit_price_number'); ?>"
			},
			tax_percent:
			{
				required:"<?php echo $this->lang->line('items_tax_percent_required'); ?>",
				number:"<?php echo $this->lang->line('items_tax_percent_number'); ?>"
			},
			quantity:
			{
				required:"<?php echo $this->lang->line('items_quantity_required'); ?>",
				number:"<?php echo $this->lang->line('items_quantity_number'); ?>"
			},
			reorder_level:
			{
				required:"<?php echo $this->lang->line('items_reorder_level_required'); ?>",
				number:"<?php echo $this->lang->line('items_reorder_level_number'); ?>"
			}

		}
	});
});
</script>