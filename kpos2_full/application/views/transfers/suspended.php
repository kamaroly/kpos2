<table id="suspended_transfers_table">
	<tr>
		<th><?php echo $this->lang->line('transfers_sale_id'); ?></th>
		<th><?php echo $this->lang->line('transfers_date'); ?></th>
		<th><?php echo $this->lang->line('transfers_customer'); ?></th>
		<th><?php echo $this->lang->line('transfers_comments'); ?></th>
		<th><?php echo $this->lang->line('transfers_unsuspend_and_delete'); ?></th>
	</tr>
	
	<?php
	foreach ($receiving_transfers as $receiving_transfer)
	{
	?>
		<tr>
			<td><?php echo $receiving_transfer['sale_id'];?></td>
			<td><?php echo date('m/d/Y',strtotime($receiving_transfer['sale_time']));?></td>
			<td>
				<?php
				if (isset($receiving_transfer['customer_id']))
				{
					$customer = $this->Customer->get_info($receiving_transfer['customer_id']);
					echo $customer->first_name. ' '. $customer->last_name;
				}
				else
				{
				?>
					&nbsp;
				<?php
				}
				?>
			</td>
			<td><?php echo $receiving_transfer['comment'];?></td>
			<td>
				<?php 
				echo form_open('transfers/unsuspend');
				echo form_hidden('suspended_sale_id', $receiving_transfer['sale_id']);
				?>
				<input type="submit" name="submit" value="<?php echo $this->lang->line('transfers_unsuspend'); ?>" id="submit" class="submit_button float_right"></td>
				</form>
		</tr>
	<?php
	}
	
	?>
	
</table>