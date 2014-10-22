<form action="<?php echo site_url('locations/edit/'.$locations->location_id);?>" accept-charset="utf-8" method="POST">

<h5>Location Information</h5>
         <div class="field_row clearfix">  
          <label for="name" >Name:</label>   
              <div class="form_field">         
                <input type="text" name="name" value="<?php echo $locations->name ;?>"  id="name">              
             </div>
        </div>

  <div class="field_row clearfix">  
     <label for="address" >Address:</label>  
     <div class="form_field">          
       <textarea name="address" cols="30" rows="4" id="address" class="form-textarea"><?php echo $locations->address;?></textarea>                
  </div>
</div> 

  <div class="field_row clearfix">    
      <label for="phone" >Phone:</label> <div class="form_field">     
       <input type="text" name="phone" value="<?php echo $locations->phone ;?>"  id="phone">             
  </div></div>  
  <div class="field_row clearfix">  
            
              <label for="fax" >Fax:</label> <div class="form_field">      
                <input type="text" name="fax" value="<?php echo $locations->fax;?>"  id="fax">             
</div></div>    
 <div class="field_row clearfix">
            
              <label for="email" >Email:</label> <div class="form_field">      
                <input type="text" name="email" value="<?php echo $locations->email ;?>"  id="email">              
</div></div>    
 <div class="field_row clearfix">
 
            <label for="receive_stock_alert" >Receive stock alerts:</label> <div class="form_field">     
              <input type="checkbox" name="receive_stock_alert" value="<?php echo $locations->receive_stock_alert ;?>"
               id="receive_stock_alert">             
</div> 
</div>     
 <div class="field_row clearfix">
           
            <label for="stock_alert_email" >Stock Alert Email:</label> <div class="form_field">      
              <input type="checkbox" name="stock_alert_email" value="<?php echo $locations->stock_alert_email ;?>"  id="stock_alert_email">             
</div> 
</div>           
<div class="field_row clearfix">     
              <label for="default_tax_1_rate" >Tax 1 Rate:</label> <div class="form_field">       
                <input type="text" name="default_tax_1_name" value="<?php echo $locations->default_tax_1_name ;?>"  placeholder="Tax Name" id="default_tax_1_name" size="10">             
              
                <input type="text" name="default_tax_1_rate" value="<?php echo $locations->default_tax_1_rate ;?>"  placeholder="Percent" id="default_tax_1_rate" size="4"> %
</div>
</div>      

<div class="field_row clearfix"> 
              <label for="default_tax_1_rate" >Tax 2 Rate:</label>
               <div class="form_field">       
                <input type="text" name="default_tax_2_name" value="<?php echo $locations->default_tax_2_name ;?>"  placeholder="Tax Name" id="default_tax_2_name" size="10">             

                <input type="text" name="default_tax_2_rate" value="<?php echo $locations->default_tax_2_rate ;?>"  placeholder="Percent" id="default_tax_2_rate" size="4"> %              
 </div></div>      
  <div class="field_row clearfix">    
          
            <div id="show_more_taxes">
              <a href="javascript: void(0);" id="showmore" onclick="toggle_visibility('more_taxes_container');" >Show More »</a>
            </div>
   </div></div> 
   <div class="field_row clearfix"> 
            <div id="more_taxes_container" style="display:none">
              
      <div class="field_row clearfix"> 
                <label for="default_tax_3_rate" >Tax 3 Rate:</label> <div class="form_field">         
                  <input type="text" name="default_tax_3_name" value="<?php echo $locations->default_tax_3_name ;?>"  placeholder="Tax Name" id="default_tax_3_name" size="10">                

                
                  <input type="text" name="default_tax_3_rate" value="<?php echo $locations->default_tax_3_rate ;?>"  placeholder="Percent" id="default_tax_3_rate" size="4">%
                
</div></div>      
 <div class="field_row clearfix">
             
                <label for="default_tax_4_rate" >Tax 4 Rate:</label> <div class="form_field">         
                  <input type="text" name="default_tax_4_name" value="<?php echo $locations->default_tax_4_name ;?>"  placeholder="Tax Name" id="default_tax_4_name" size="10">                
                 <input type="text" name="default_tax_4_rate" value="<?php echo $locations->default_tax_4_rate ;?>"  placeholder="Percent" id="default_tax_4_rate" size="4">%
                
 </div></div>     
 <div class="field_row clearfix">
             
                <label for="default_tax_5_rate" >Tax 5 Rate:</label> <div class="form_field">         
                  <input type="text" name="default_tax_5_name" value="<?php echo $locations->default_tax_5_name ;?>"  placeholder="Tax Name" id="default_tax_5_name" size="10">                

                  <input type="text" name="default_tax_5_rate" value="<?php echo $locations->default_tax_5_rate ;?>"  placeholder="Percent" id="default_tax_5_rate" size="4">%
               </div>   
             </div>    
          </div>    
            <!--End more Taxes Container-->         
            <div class="field_row clearfix">

            <label for="timezone" >Timezone:</label> <div class="form_field">  
<select name="timezone" style="font-family: 'Courier New', Courier, monospace; width: 450px;">
    <option value="0">Please, select timezone</option>

    <?php $timezones=$this->tz_list(); ?>

    <?php foreach($timezones as $t) :?>
      <option value="<?php print $t['zone'] ?>" <?php echo $t['zone']==$locations->timezone?"Selected":"";?>>
        <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
      </option>
    <?php endforeach;?>
  </select>
                    
  </div>
</div>

   <div class="field_row clearfix">  
              <label for="return_policy" >Return Policy:</label>        
                     <div class="form_field">
                <textarea name="return_policy" cols="30" rows="4" id="return_policy" class="form-textarea">
                  <?php echo $locations->return_policy ?></textarea>    
     </div>
   </div>

 <div class="field_row clearfix">
<input type="submit" name="submitf" value="Submit" id="submitf" class="submit_button btn btn-primary">          
                    
</div> 

