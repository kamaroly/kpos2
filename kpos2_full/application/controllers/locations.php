<?php
require_once ("secure_area.php");

class Locations extends Secure_area 
{
  function index($offset=0)
	{
		$locations= model\Locations_model::all();
		
		$config['base_url'] = site_url('/locations/index');
		$config['total_rows'] =  count($locations);
		$config['per_page'] = '10';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		
		$data['locations']= model\Locations_model::limit($config['per_page'],$offset)->all();
		
		
		
		
		
		$this->load->view('locations/locations_table',$data);
		
		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	* locations EDIT
	* Inserts new locations to the database.
	 * This page is accessed via the 'locations' page via a link titled 'Insert New locations'.
	 */
	 function edit($id=0)
	 {

     //check if the id were provided
	 		if($id==0)
	 		{
	 			show_404();
	 			return;
	 		}
	 	
	 		if($_POST)
	 		{
                
	 			if($this->input->post('cancel'))
	 			{
	 				$this->locations_delete($id);
	 			}
	 			$data['locations']= model\locations_model::find($id);
	 			
                 $data['locations']->name                =$this->input->post('name');
                 $data['locations']->address             =$this->input->post('address');
                 $data['locations']->phone               =$this->input->post('phone');
                 $data['locations']->fax                 =$this->input->post('fax');
                 $data['locations']->email               =$this->input->post('email');

                 if($this->input->post('receive_stock_alert')):
                 $data['locations']->receive_stock_alert =$this->input->post('receive_stock_alert')==''?0:$this->input->post('return_policy');
                 endif;

                 if($this->input->post('stock_alert_email')):
                 $data['locations']->stock_alert_email   =$this->input->post('stock_alert_email')==''?0:$this->input->post('stock_alert_email');
                 endif;
                  if($this->input->post('return_policy')):
                 $data['locations']->return_policy       =$this->input->post('return_policy');
                  endif;
                 $data['locations']->timezone            =$this->input->post('timezone');
                 $data['locations']->default_tax_1_rate  =$this->input->post('default_tax_1_rate');
                 $data['locations']->default_tax_1_name  =$this->input->post('default_tax_1_name');
                 $data['locations']->default_tax_2_rate  =$this->input->post('default_tax_2_rate');
                 $data['locations']->default_tax_2_name  =$this->input->post('default_tax_2_name');
                 $data['locations']->default_tax_3_rate  =$this->input->post('default_tax_3_rate');
                 $data['locations']->default_tax_3_name  =$this->input->post('default_tax_3_name');
                 $data['locations']->default_tax_4_rate  =$this->input->post('default_tax_4_rate');
                 $data['locations']->default_tax_4_name  =$this->input->post('default_tax_4_name');
                 $data['locations']->default_tax_5_rate  =$this->input->post('default_tax_5_rate');
                 $data['locations']->default_tax_5_name  =$this->input->post('default_tax_5_name');
	 		
	 			if(!$data['locations']->save(TRUE))
	 			{
	 				 
	 				$this->session->set_flashdata('type','danger');
	 				$this->session->set_flashdata('message','Error occured during operation'.$data['locations']->errors);
	 				$this->index();
	 				
	 			}
	 			else
	 			{
	 				$this->session->set_flashdata('type','success');
	 				$this->session->set_flashdata('message',$this->lang->line('config_saved_successfully'));
	 			    $this->index();
	 			}
	 		}
	 		else 
	 		{
	 			
	 			$data['locations']= model\locations_model::find($id);
	 			
	 			$this->load->view('locations/location_edit',$data);
	 		}
	 		
	 		
	 	}
	 	
     /**
      * @author Kamaro Lambert
      * @name   locations_new
      * Function create new locations
      */
	 function locations_new()
	 {
	 	$locations= new Model\locations_model();
	 	$locations->Name='New locations';
	 	$locations->Exchange_Rate='600';
	 	
	 	//Save the new records
	 	$locations->save();
	 	
        $curr_id= Model\locations_model::last_created()->curr_id;
       $this->locations_edit($curr_id);
      	 	
	 }
	 /**
	  * @author Kamaro Lambert
	  * @name   locations_delete
	  * @param  numeric $id
	  * Method to delete the locations
	  */
	 function locations_delete($id=0)
	 {

	 	Model\locations_model::delete($id);
	 
	 	$this->session->set_flashdata('type','success');
	 	$this->session->set_flashdata('message',$this->lang->line('config_saved_successfully'));
	  	redirect('config/locations');
	 }
}