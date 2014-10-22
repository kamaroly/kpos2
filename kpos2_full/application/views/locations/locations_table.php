<?php $this->load->view("partial/header"); ?>
<div id="title_bar"> <span title="" class="label label-info tip-left" data-original-title="1 total locations">List of Locations</span></div>
<style>
<!--

.success {
color: #ffffff;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
background-color: #5bb75b;
background-image: -moz-linear-gradient(top, #62c462, #51a351);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
background-image: -webkit-linear-gradient(top, #62c462, #51a351);
background-image: -o-linear-gradient(top, #62c462, #51a351);
background-image: linear-gradient(to bottom, #62c462, #51a351);
background-repeat: repeat-x;
border-color: #51a351 #51a351 #387038;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}
.primary {
color: #ffffff;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
background-color: #006dcc;
background-image: -moz-linear-gradient(top, #0088cc, #0044cc);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
background-image: -webkit-linear-gradient(top, #0088cc, #0044cc);
background-image: -o-linear-gradient(top, #0088cc, #0044cc);
background-image: linear-gradient(to bottom, #0088cc, #0044cc);
background-repeat: repeat-x;
border-color: #0044cc #0044cc #002a80;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0);
filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}



-->
</style>
<div class="widget-box">
          <div class="widget-title">
            <?php echo $this->pagination->create_links();?>
            <br/>
           
          </div>
       
           <table border="1" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th class="leftmost primary"><input type="checkbox" id="select_all"></th>
                <th class="primary">Location ID</th>
                <th class="primary">Name</th>
                <th class="primary">Address</th>
                <th class="primary">Phone</th>
                <th class="primary">Email</th>
                <th class="rightmost primary">&nbsp;</th></tr></thead>
                <tbody>
                <?php foreach ($locations as $location):?>
                <tr style="cursor: pointer;">
                     <td width="3%"><input type="checkbox" id="location_1" value="<?php echo $location->location_id; ?>"></td>
                     <td width="10%"><?php echo $location->location_id;?></td>
                     <td width="15%"><?php echo $location->name;?></td>
                     <td width="15%"><?php echo $location->address;?></td>
                     <td width="11%"><?php echo $location->phone;?></td>
                     <td width="11%"><?php echo $location->email;?></td>
                     <td width="5%" class="rightmost">
                       <?php echo anchor('locations/edit/'.$location->location_id.'/width:450','<img border="0" src="'.base_url().'/images/b_edit.png" title="Edit" alt="Edit"> ','class="thickbox" title="Update"');?>
                      |
                      <?php echo anchor('locations/delete/'.$location->location_id.'/width:450','<img border="0" src="'.base_url().'/images/b_drop.png" Onclick="ConfirmDelete()" title="Delete" alt="Delete"> ');?>
                   
                     </td>
               </tr>
               <?php endforeach; ?>
              </tbody>
           </table>      
</div>

<?php $this->load->view("partial/footer"); ?>