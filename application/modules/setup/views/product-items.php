<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
  <div class="col-md-12 form f-label">
  <?php if($this->session->flashdata("messagePr")){?>
    <div class="alert alert-info">      
      <?php echo $this->session->flashdata("messagePr")?>
    </div>
  <?php } ?>
    <!-- Profile Image -->
    <div class="box box-success pad-profile">
     	<div class="box-header with-border">
        <h3 class="box-title">Product Items <small></small></h3>
      </div>
      <div class="box-body box-profile">
         <form method="post" id="form_submit" action="<?php echo base_url().'setup/product_items/'.$edit.'/'; ?>" class="form-label-left">
        
          <div class="col-md-4 div-border">
            <h4>Add Items</h4>
					<?php
					if(strlen($MSG) > 0){
						?>
							<div class="alert alert-<?= $mass;?>">
							  <strong><?= ucfirst($mass);?> ! </strong> <?= $MSG;?>.
							</div>
						<?php
					}
					?>
					<?php 
					if(is_array($edit_data) AND sizeof($edit_data) > 0) { 
						$name = $edit_data[0]['ITEM_NAME']; 
						$item_type = $edit_data[0]['ITEM_TYPE']; 
						$item_unit = $edit_data[0]['ITEM_UNIT']; 
						$status = $edit_data[0]['ITEM_STATUS']; 
						$REMARKS = $edit_data[0]['REMARKS']; 
					}else{ 
						$name = '';
						$email = '';
						$item_type = '0';
						$item_unit = '0';
						$status = '';
						$REMARKS = '';
					}
						
					?>
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Item Name:</label>
		              <input type="text" id="name" name="name_item" value="<?= $name;?>" required="required" class="form-control" placeholder="Name">
		              <span class="form-control-feedback"> </span>
		            </div>

					<div class="form-group has-feedback clear-both">
		             <label for="exampleInputstatus">Type:</label>
		              <select name="type" id="type" class="form-control">
		        			<?php
							if(is_array($items_type) AND sizeof($items_type) > 0):
							foreach($items_type AS $value):
							    $select = '';
								if($item_type == $value['ITEM_TYPE_ID']){
									$select = 'selected';
								}
							?>
							<option value="<?= $value['ITEM_TYPE_ID'];?>" <?= $select;?> ><?= $value['ITEM_TYPE_NAME'];?></option>
							<?php endforeach; endif; ?>
							
		              </select>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		             <label for="exampleInputstatus">Unit:</label>
		              <select name="unit" id="unit" class="form-control">
		        			<?php
							if(is_array($items_unit) AND sizeof($items_unit) > 0):
							foreach($items_unit AS $valueU):
							    $selectc = '';
								if($item_unit == $valueU['ITEM_UNIT_ID']){
									$selectc = 'selected';
								}
							?>
							<option value="<?= $valueU['ITEM_UNIT_ID'];?>" <?= $selectc;?> ><?= $valueU['ITEM_UNIT_NAME'];?></option>
							<?php endforeach; endif; ?>
							
		              </select>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputemail">Remarks:</label>
		              <textarea  id="remarks" name="remarks" value="" class="form-control" placeholder="Remarks here.."><?= $REMARKS;?></textarea>
		              
		            </div>

					<?php
					if($edit > 0){
					?>
					<div class="form-group has-feedback">
		              <label for="exampleInputstatus">Status:</label>
		              <select name="status" id="status" class="form-control">
		        			<option value="Active" <?php if($status == 'Active'){ echo 'selected';}?> >Active</option>
		        			<option value="DeActive" <?php if($status == 'DeActive'){ echo 'selected';}?> >DeActive</option>
		              </select>
		            </div>
					<?php
					}
					?>
              
            <br>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group has-feedback sub-btn-wdt  pull-left" >
					  <button name="submit_items" type="submit" id="submit_items" class="btn btn-success btn-md wdt-bg">Save</button>  
					</div>
					<?php
					if($edit > 0){
					?>
						<div class="form-group has-feedback sub-btn-wdt pull-right" > <a href="<?php echo base_url().'setup/product_items/'; ?>"> Add Items</a></div>
					<?php	
					}
					?>
				 </div>
			</div>
          </div>
         </form> 
		  <div class="col-md-8">
            <center><h4>Items List</h4></center>
			<div class="row"><div class="col-md-4 pull-right form-group"><input type="text" id="myInput" class="form-control" onkeyup="mySearch()" placeholder="Search for names.." title="Type in a name"></div></div>
			
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="myTable">
					<thead>
					  <tr>
						<th>#SL</th>
						<th>Name</th>
						<th>Type</th>
						<th>Unit</th>
						<th>Remarks</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody id="findValue">
					<?php
					$m = $increment+1;
					if(is_array($items_list) AND sizeof($items_list) > 0){
						foreach($items_list AS $value):
					?>
					  <tr ondblclick="location.replace('<?php echo base_url().'setup/product_items/'.$value['ITEM_ID'].'/'; ?>');">
						<td><?= $m;?> <input type="hidden" name="editId" id="editId__<?= $m;?>" value="<?= $value['ITEM_ID'];?>"></td>
						<td><?= $value['ITEM_NAME'];?></td>
						<td><?= $value['ITEM_TYPE_NAME'];?></td>
						<td><?= $value['ITEM_UNIT_NAME'];?></td>
						<td><?= $value['REMARKS'];?> <input type="hidden" name="editId" value="<?= $value['ITEM_ID'];?>"></td>
						<td align="center"><a href="<?php echo base_url().'setup/product_items/'.$value['ITEM_ID'].'/'; ?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
						
					  </tr>
					 
					 <?php
							$m++;
							endforeach;
						}
					 ?>
					</tbody>
				  </table>
			  </div>
			  <nav aria-label="Page navigation example">
				<?= $this->pagi->create_link();?>
			  </nav>
          </div>
		 <!-- /.box-body -->
		 <div class="row col-md-12 note-panel">   
				<b>Note:</b> 
				<ul>
					<li>Enter = Submit Form</li>
					<li>Ctrl+f = Find Item</li>
					<li>Ctrl+s = Save</li>
					<li>Ctrl+Shift+u = Edit Item</li>
					<li>Ctrl+Shift+n = New Item</li>
					<li>Ctrl+Shift+t = Pagination(Page No)</li>
					<li>Ctrl+Shift+z = Back page</li>
					<li>Ctrl+Shift+y = Go page</li>
				</ul>
		
			</div>	
        </div>
                          
      <!-- /.box -->
    </div>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<script>
document.getElementById('name').focus();
$('form#form_submit input, select, textarea, button').keydown(function (e) {
   if (e.keyCode == 13) {
        var inputs = $(this).parents("form#form_submit").eq(0).find(":input, select, textarea, button");
        if (inputs[inputs.index(this) + 1] != null) {                    
            inputs[inputs.index(this) + 1].focus();
        }else{
			document.getElementById("submit_items").click();
		}
        e.preventDefault();
        return false;
    }
});



$(window).keypress(function(event) {
	if((event.ctrlKey && event.shiftKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 'u':
				var urlData = prompt("Enter a SL", "");
				if(urlData > 0){
					var idD = document.getElementById('editId__'+urlData).value;
					location.replace(url+'setup/product_items/'+idD);
				}
				event.preventDefault();           
				break;
				
			case 'n':
				document.getElementById('name').focus();
				location.replace(url+'setup/product_items/');
				event.preventDefault();           
				break;
				
			case 't':
				var urlData = prompt("Enter a Page No.", "");
				if(urlData > 0){
					location.replace(url+'setup/product_items/?page='+urlData);
				}
				event.preventDefault();           
				break;
		}
	}
	
	if((event.ctrlKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 's':
				document.getElementById("submit_items").click();
				event.preventDefault();           
				break;	
		}
	}
	
});
</script>