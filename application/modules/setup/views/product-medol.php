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
        <h3 class="box-title">Items Model <small></small></h3>
      </div>
      <div class="box-body box-profile">
         <form method="post" name="form_submit" id="form_submit" action="<?php echo base_url().'setup/items_model/'.$edit.'/'; ?>" class="form-label-left">
        
          <div class="col-md-4 div-border">
            <h4>Add Model</h4>
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
						$item_id = $edit_data[0]['ITEM_ID']; 
						$name = $edit_data[0]['MODEL_CODE']; 
						$stock_price = $edit_data[0]['MODEL_BUY_PRICE']; 
						$sell_price = $edit_data[0]['MODEL_SELL_PRICE']; 
						$item_type = $edit_data[0]['ITEM_TYPE']; 
						$item_unit = $edit_data[0]['ITEM_UNIT']; 
						$status = $edit_data[0]['ITEM_STATUS']; 
						$REMARKS = $edit_data[0]['REMARKS']; 
					}else{ 
						$name = '';
						$stock_price = '';
						$sell_price = '';
						$email = '';
						$item_type = '';
						$item_unit = '';
						$status = '';
						$REMARKS = '';
					}
						//echo $item_id;
					?>
					
					<div class="form-group has-feedback clear-both">
		             <label for="exampleInputstatus">Item:</label>
		              <select name="item_id" id="item_id" class="form-control" required="required" >
		        			<option value="0">Select</option>
							<?php
							if(is_array($items_list_all) AND sizeof($items_list_all) > 0):
							foreach($items_list_all AS $value):
							    $select = '';
								if($item_id == $value['ITEM_ID']){
									$select = 'selected';
								}
							?>
							<option value="<?= $value['ITEM_ID'];?>" <?= $select;?>><?= $value['ITEM_NAME'];?></option>
							<?php endforeach; endif; ?>
							
		              </select>
		            </div>
					
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Model Code:</label>
		              <input type="text" id="name" name="name_item" onkeyup="removeSpcial(this);" value="<?= $name;?>" required="required" class="form-control" placeholder="Code">
		              <span class="form-control-feedback"> </span>
		            </div>

					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Stock Price:</label>
		              <input type="text" id="stock_price" name="stock_price" onkeyup="removeChar(this);" value="<?= $stock_price;?>" required="required" class="form-control" placeholder="0.00">
		              <span class="form-control-feedback"> </span>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Sell Price:</label>
		              <input type="text" id="sell_price" name="sell_price" onkeyup="removeChar(this);" value="<?= $sell_price;?>" required="required" class="form-control" placeholder="0.00">
		              <span class="form-control-feedback"> </span>
		            </div>
					
					<?php
					if($edit > 0){
					?>
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
							<option value="<?= $value['ITEM_TYPE_ID'];?>" <?= $select;?>><?= $value['ITEM_TYPE_NAME'];?></option>
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
							<option value="<?= $valueU['ITEM_UNIT_ID'];?>" <?= $selectc;?>><?= $valueU['ITEM_UNIT_NAME'];?></option>
							<?php endforeach; endif; ?>
							
		              </select>
		            </div>
					<?php
					}
					?>
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
					  <button name="submit_model" type="submit" id="submit_model" class="btn btn-success btn-md wdt-bg">Save</button>  
					</div>
					<?php
					if($edit > 0){
					?>
						<div class="form-group has-feedback sub-btn-wdt pull-right" > <a href="<?php echo base_url().'setup/items_model/'; ?>"> Add Model</a></div>
					<?php	
					}
					?>
				 </div>
			</div>
          </div>
         </form>
		  <div class="col-md-8">
            <center><h4>Model List</h4></center>
			<div class="row"><div class="col-md-4 pull-right form-group"><input type="text" id="myInput" class="form-control" onkeyup="mySearch()" placeholder="Search for names.." title="Type in a name"></div></div>
			
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="myTable">
					<thead>
					  <tr>
						<th>#SL</th>
						<th>Model</th>
						<th>Item</th>
						<th style="text-algin:right;">Stock Price</th>
						<th style="text-algin:right;">Sell Price</th>
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
						$items = $this->setup->items_data($value['ITEM_ID']);
						$itemName = '';
						if(is_array($items) AND sizeof($items) > 0){
							$itemName = $items[0]['ITEM_NAME'];
						}
					?>
					  <tr ondblclick="location.replace('<?php echo base_url().'setup/items_model/'.$value['MODEL_ID'].'/'; ?>');">
						<td><?= $m;?> <input type="hidden" name="editId" id="editId__<?= $m;?>" value="<?= $value['MODEL_ID'];?>"></td>
						<td><?= $value['MODEL_CODE'];?></td>
						<td><?= $itemName;?></td>
						<td align="right"><?= number_format($value['MODEL_BUY_PRICE'], 2);?></td>
						<td align="right"><?= number_format($value['MODEL_SELL_PRICE'], 2);?></td>
						<td><?= $value['ITEM_TYPE_NAME'];?></td>
						<td><?= $value['ITEM_UNIT_NAME'];?></td>
						<td><?= $value['REMARKS'];?> <input type="hidden" name="editId" value="<?= $value['MODEL_ID'];?>"></td>
						<td align="center"><a href="<?php echo base_url().'setup/items_model/'.$value['MODEL_ID'].'/'; ?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
						
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
					<li>Ctrl+f = Find Model</li>
					<li>Ctrl+s = Save</li>
					<li>Ctrl+Shift+u = Edit Model</li>
					<li>Ctrl+Shift+n = New Model</li>
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
document.getElementById('item_id').focus();
$('form#form_submit input, select, textarea, button').keydown(function (e) {
   if (e.keyCode == 13) {
        var inputs = $(this).parents("form#form_submit").eq(0).find(":input, select, textarea, button");
        if (inputs[inputs.index(this) + 1] != null) {                    
            inputs[inputs.index(this) + 1].focus();
        }else{
			document.getElementById("submit_model").click();
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
					location.replace(url+'setup/items_model/'+idD);
				}
				event.preventDefault();           
				break;
			case 'n':
				document.getElementById('item_id').focus();
				location.replace(url+'setup/items_model/');
				event.preventDefault();           
				break;
				
			case 't':
				var urlData = prompt("Enter a Page No.", "");
				if(urlData > 0){
					location.replace(url+'setup/items_model/?page='+urlData);
				}
				event.preventDefault();           
				break;
		}
	}
	
	if((event.ctrlKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 's':
				document.getElementById("submit_model").click();
				event.preventDefault();           
				break;	
		}
	}
});
</script>
