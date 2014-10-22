<?php
class Sale_quotations extends CI_Model
{
	function get_all($limit=null,$offset=null)
	{
		$this->create_quotations_items_temp_table();
		
		$this->db->from('sales_quotations');
		$this->db->join('quotations_items_temp','sales_quotations.sale_id=quotations_items_temp.sale_id','LEFT');
		//check if the limitation is needed.
		if ($limit!=null and $offset!=null):
		$this->db->limit($limit,$offset);
		
		endif;
		
		$this->db->order_by('sale_id');
		return $this->db->get();
	}
	
	public function get_info_for_guest($invoice_url_key)
	{
	
		$this->db->where('invoice_url_key',$invoice_url_key);
		return $this->db->get('sales_quotations');
	}
	
	function get_max_sale_id()
	{
		$this->db->select_max('sale_id');
		return $this->db->get('sales_quotations')->row()->sale_id+1;
	}
	/**
	 * @Author Kamaro Lambert
	 * @param  numeric $sale_id
	 */
	public function get_info($sale_id)
	{
		$this->db->from('sales_quotations');
		$this->db->where('sale_id',$sale_id);
		return $this->db->get();
	}

	function exists($sale_id)
	{
		$this->db->from('sales_quotations');
		$this->db->where('sale_id',$sale_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}
	
	function update($sale_data, $sale_id)
	{
		$this->db->where('sale_id', $sale_id);
		$success = $this->db->update('sales_quotations',$sale_data);
		
		return $success;
	}
	
   function save ($items,$customer_id,$employee_id,$comment,$payments,$sale_id=false,$total,$invoice_number=null,$date_issued=null,$po_number=null)
	{
		if(count($items)==0)
			return -1;

		//Alain Multiple payments
		//Build payment types string
		$payment_types='';
		foreach($payments as $payment_id=>$payment)
		{
			$payment_types=$payment_types.$payment['payment_type'].': '.to_currency($payment['payment_amount']).'<br />';
		}

		$sales_data = array(
			'sale_time'           => ($date_issued!=null)?$date_issued:date('Y-m-d H:i:s'),
			'customer_id'         => $this->Customer->exists($customer_id) ? $customer_id : null,
			'employee_id'         => $employee_id,
			'payment_type'        => $payment_types,
			'comment'             => $comment,
			'invoice_date_created'=> ($date_issued!=null)?$date_issued:date('Y-m-d H:i:s'),
			'invoice_date_due'    => (isset($date_due)!=null)?$date_due:date('Y-m-d',strtotime(date('Ymd').' + 31 day')),
			'invoice_number'      => ($invoice_number!=null)?$invoice_number:'',
			'po_number'           => ($po_number!=null)?$po_number:'',
			'invoice_url_key'     => $this->Sale->get_url_key()
		);
       

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->db->insert('sales_quotations',$sales_data);
		$sale_id = $this->db->insert_id();

		foreach($payments as $payment_id=>$payment)
		{
			$sales_payments_data = array
			(
				'sale_id'=>$sale_id,
				'payment_type'=>$payment['payment_type'],
				'payment_amount'=>$payment['payment_amount']
			);
			$this->db->insert('sales_quotations_payments',$sales_payments_data);
		}

		foreach($items as $line=>$item)
		{
			$cur_item_info = $this->Item->get_info($item['item_id']);

			$sales_items_data = array
			(
				'sale_id'=>$sale_id,
				'item_id'=>$item['item_id'],
				'line'=>$item['line'],
				'description'=>$item['description'],
				'serialnumber'=>$item['serialnumber'],
				'quantity_purchased'=>$item['quantity'],
				'discount_percent'=>$item['discount'],
				'item_cost_price' => $cur_item_info->cost_price,
				'item_unit_price'=>$item['price']
			);

			$this->db->insert('sales_quotations_items',$sales_items_data);

			$customer = $this->Customer->get_info($customer_id);
 			if ($customer_id == -1 or $customer->taxable)
 			{
				foreach($this->Item_taxes->get_info($item['item_id']) as $row)
				{
					$this->db->insert('sales_quotations_items_taxes', array(
						'sale_id' 	=>$sale_id,
						'item_id' 	=>$item['item_id'],
						'line'      =>$item['line'],
						'name'		=>$row['name'],
						'percent' 	=>$row['percent']
					));
				}
			}
		}
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
			return -1;
		}
		
		return $sale_id;
	}
	
	function delete($sale_id)
	{
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		$this->db->delete('sales_quotations_payments', array('sale_id' => $sale_id)); 
		$this->db->delete('sales_quotations_items_taxes', array('sale_id' => $sale_id)); 
		$this->db->delete('sales_quotations_items', array('sale_id' => $sale_id)); 
		$this->db->delete('sales_quotations', array('sale_id' => $sale_id)); 
		
		$this->db->trans_complete();
				
		return $this->db->trans_status();
		
	}

	function get_sale_items($sale_id)
	{
		$this->db->from('sales_quotations_items');
		$this->db->where('sale_id',$sale_id);
		return $this->db->get();
	}

	function get_sale_payments($sale_id)
	{
		$this->db->from('sales_quotations_payments');
		$this->db->where('sale_id',$sale_id);
		return $this->db->get();
	}

	function get_customer($sale_id)
	{
		
		$this->db->where('sale_id',$sale_id);
		
		return $this->Customer->get_info($this->db->get('sales_quotations')->row()->customer_id);
	}
	
	function get_comment($sale_id)
	{
		
		$this->db->where('sale_id',$sale_id);
		$this->db->get('sales_quotations');
		return $this->db->get('sales_quotations')->row()->comment;
	}
	
	/**
	 * @author Kamaro Lambert
	 * @name   create_sales_items_temp_table()
	 * @method We create a temp table that allows us to do easy report/sales queries
	 */
	
	public function create_quotations_items_temp_table($StartDAte=null,$EndDate=null,$sale_id=null)
	{
		//Added date filter for optimization
		if($StartDAte!=null and $EndDate!=NULL)
		{
			$period_condition=" AND date(sale_time) BETWEEN '".$StartDAte."' AND '".$EndDate."'";
		}
		elseif ($this->uri->segment(3)!='' AND $this->uri->segment(4)!='')
		{
			$period_condition=" AND date(sale_time) BETWEEN '".$this->uri->segment(3)."' AND '".$this->uri->segment(4)."'";
				
		}
		else
		{
			$period_condition='';
		}
		if($sale_id)
		{
			$sale_id_condition=" AND sale_id=$sale_id";
		}
		else
		{
			$sale_id_condition='';
		}
			
		$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('quotations_items_temp'));
		$this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('quotations_items_temp')."
		(SELECT date(sale_time) as sale_date, ".$this->db->dbprefix('sales_quotations_items').".sale_id, comment,payment_type, customer_id,
				CONCAT(last_name,' ',first_name) as Customer_names,employee_id, invoice_url_key,invoice_number,
		".$this->db->dbprefix('items').".item_id, supplier_id, quantity_purchased, item_cost_price, item_unit_price, SUM(percent) as item_tax_percent,
		discount_percent, (item_unit_price*quantity_purchased-item_unit_price*quantity_purchased*discount_percent/100) as subtotal,
		".$this->db->dbprefix('sales_quotations_items').".line as line, serialnumber, 
		ROUND((item_unit_price*quantity_purchased-item_unit_price*quantity_purchased*discount_percent/100)*(1+(SUM(percent)/100)),2) as total,
		ROUND((item_unit_price*quantity_purchased-item_unit_price*quantity_purchased*discount_percent/100)*(SUM(percent)/100),2) as tax,
		(item_unit_price*quantity_purchased-item_unit_price*quantity_purchased*discount_percent/100) - (item_cost_price*quantity_purchased) as profit
		FROM ".$this->db->dbprefix('sales_quotations_items')."
		INNER JOIN ".$this->db->dbprefix('sales_quotations')."
	    ON  ".$this->db->dbprefix('sales_quotations_items').'.sale_id='.$this->db->dbprefix('sales_quotations').'.sale_id'."
		$period_condition 	$sale_id_condition
		INNER JOIN ".$this->db->dbprefix('items')." ON  ".$this->db->dbprefix('sales_quotations_items').'.item_id='.$this->db->dbprefix('items').'.item_id'."
		LEFT OUTER JOIN ".$this->db->dbprefix('suppliers')." ON  ".$this->db->dbprefix('items').'.supplier_id='.$this->db->dbprefix('suppliers').'.person_id'."
		LEFT JOIN ".$this->db->dbprefix('people')." ON ".$this->db->dbprefix('people').".person_id=".$this->db->dbprefix('sales_quotations').".customer_id
		LEFT OUTER JOIN ".$this->db->dbprefix('sales_quotations_items_taxes')." ON  "
				.$this->db->dbprefix('sales_quotations_items').'.sale_id='.$this->db->dbprefix('sales_quotations_items_taxes').'.sale_id'." and "
				.$this->db->dbprefix('sales_quotations_items').'.item_id='.$this->db->dbprefix('sales_quotations_items_taxes').'.item_id'." and "
				.$this->db->dbprefix('sales_quotations_items').'.line='.$this->db->dbprefix('sales_quotations_items_taxes').'.line'."
		GROUP BY sale_id, item_id, line)");
	
		//Update null item_tax_percents to be 0 instead of null
		$this->db->where('item_tax_percent IS NULL');
		$this->db->update('sales_items_temp', array('item_tax_percent' => 0));
	
		//Update null tax to be 0 instead of null
		$this->db->where('tax IS NULL');
		$this->db->update('quotations_items_temp', array('tax' => 0));
	
		//Update null subtotals to be equal to the total as these don't have tax
		$this->db->query('UPDATE '.$this->db->dbprefix('quotations_items_temp'). ' SET total=subtotal WHERE total IS NULL');
	}
}
?>
