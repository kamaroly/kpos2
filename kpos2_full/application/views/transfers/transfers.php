<table id="suspended_transfers_table">
	<tr>
		<th><?php echo "transfer ID";//$this->lang->line('transfers_sale_id'); ?></th>
		<th><?php echo "TRANSFER DATE";$this->lang->line('transfers_date'); ?></th>
		<th><?php echo "AMOUNT";$this->lang->line('transfers_date'); ?></th>
		<th><?php echo "FROM LOCATION";$this->lang->line('transfers_customer'); ?></th>
		<th><?php echo "TO LOCATION";$this->lang->line('transfers_comments'); ?></th>
		<th><?php echo "RECEIVE";$this->lang->line('transfers_unsuspend_and_delete'); ?></th>
	</tr>

	<?php
	foreach ($receiving_transfers as $receiving_transfer)
	{
	?>
		<tr>
			<td><?php echo $receiving_transfer['sale_id'];?></td>
			<td><?php echo date('m/d/Y',strtotime($receiving_transfer['sale_time']));?></td>
			<td><?php echo $receiving_transfer['payment_type'];?></td>
			<td><?php echo model\locations_model::find($receiving_transfer['from_location_id'])->name;	?></td>
			<td><?php echo model\locations_model::find($receiving_transfer['to_location_id'])->name;?></td>
			<td><a href="<?php echo site_url('receivings/add/'.$receiving_transfer['sale_id']);?>">Receive</a>
				</td>
		</tr>
	<?php
	}
	
	?>
	
</table>