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
        <h3 class="box-title">Stock <small></small></h3>
      </div>
      <div class="box-body box-profile" id="purchase_div">
         
          <div class="col-md-3 div-border">
            <h4>Add Stock</h4>
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
						$SUPPLIER_ID = $edit_data[0]['ITEM_TYPE']; 
						$item_unit = $edit_data[0]['ITEM_UNIT']; 
						$status = $edit_data[0]['ITEM_STATUS']; 
						$REMARKS = $edit_data[0]['REMARKS']; 
					}else{ 
						$name = '';
						$stock_price = '';
						$sell_price = '';
						$email = '';
						$SUPPLIER_ID = '';
						$item_unit = '';
						$status = '';
						$REMARKS = '';
					}
						//echo $item_id;
					?>
					<form action="" method="post" id="add_purchse">
					<div class="form-group has-feedback">
		             <label for="exampleInputstatus">Item:</label>
		              <!--<input type="text" id="mySelect" class="form-control"> -->
					  <select name="item_id" id="item_id" class="form-control" required="required" onchange="search_model(this);">
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
		              <!--<input type="text" id="name" name="name_item" onkeyup="removeSpcial(this);" value="" required="required" class="form-control" placeholder="Code">
		              <span class="form-control-feedback"> </span> -->
					   <select name="model_code" id="model_code" class="form-control" required="required" onchange="search_model_info(this);">
						
					   </select>
		            </div>

					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Qty.:</label>
		              <input type="text" id="stock_qty" name="stock_qty" onkeyup="removeChar(this);" value="" required="required" class="form-control" placeholder="0">
		              <span class="form-control-feedback"> </span>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		             <label for="exampleInputstatus">Supplier:</label>
		              <select name="supplier_id" id="supplier_id" class="form-control">
		        			<option value="0">Select</option>
							<?php
							if(is_array($supplier_list_all) AND sizeof($supplier_list_all) > 0):
							foreach($supplier_list_all AS $value):
							    $select = '';
								if($SUPPLIER_ID == $value['SUPPLIER_ID']){
									$select = 'selected';
								}
							?>
							<option value="<?= $value['SUPPLIER_ID'];?>" <?= $select;?>> ( <?= $value['SUPPLIER_ID'];?> ) <?= $value['SUPPLIER_NAME'];?></option>
							<?php endforeach; endif; ?>
							
		              </select>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputemail">Note:</label>
		              <textarea  id="remarks" name="remarks" value="" class="form-control" placeholder="Note here.."><?= $REMARKS;?></textarea>
		              
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
					  <button name="add_purchase" type="button" onclick="add_purchase_data();" id="add_purchase" class="btn btn-success btn-md wdt-bg">Add</button>  
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
			</form>
          </div>
         
		  <div class="col-md-9">
            <center><h4>Stock List</h4></center>
			<div class="row"><div class="col-md-4 pull-right form-group"><input type="text" id="myInput" class="form-control" onkeyup="mySearch()" placeholder="Search for names.." title="Type in a name"></div></div>
				<form method="post" name="save_submit" id="save_submit" action="<?php echo base_url().'purchase/add_stock/'.$edit.'/'; ?>" class="form-label-left">
        
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="myTable">
						<thead>
						  <tr>
							<th>#SL</th>
							<th>Model</th>			
							<th>S.</th>			
							<th style="text-algin:center;">Qty.</th>
							<th style="text-algin:right;">S.Price</th>
							<th style="text-algin:right;">Net.Price</th>
							<th>Type</th>
							<th>Unit</th>
							<th>Note</th>
							<th style="text-algin:center;">A.</th>
						  </tr> 
						</thead>
							<tbody id="addPurchaseTbody">
								
							</tbody>
					  </table>
				  </div>
				  <div class="row">
					<div class="col-md-12 form-group">
						<div class="col-md-9" ></div>
						<div class="col-md-3" >
							<b>Sub Total - </b><span id="sub_total"> 0.00 </span>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-9" ></div>
						<div class="col-md-3" style="display:inline-flex;">
							<b>Receive - </b> <input type="text" id="receive_amount" class="receive-amount" onblur="reveivePayment()" placeholder="0.00" title="Receive amount">
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-9" ></div>
						<div class="col-md-3" style="">
							<b>Due - </b> <span id="due_total"> 0.00 </span>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-10" ></div>
						<div class="col-md-2" >
						  <button name="submit_purchase" type="submit" id="submit_purchase" class="btn btn-success btn-md wdt-bg">Save</button>  
						</div>
					</div>
				</div>
			  </form>
			  
          </div>
		 <!-- /.box-body -->
			 <div class="row col-md-12 note-panel">   
				<b>Note:</b> 
				<ul>
					<li>Enter = Next Filed</li>
					<li>Backspace = Back Filed</li>
					<li>Ctrl+"+" = Add Stock</li>
					<li>Delete, Ctrl+"-" = Remove Stock</li>
					<li>Ctrl+c = Copy Receive amount</li>
					<li>Ctrl+s = Save Stock</li>
					<li>Ctrl+f = Find Stock</li>					
					<li>Alt+n = Reload Page / New Stock</li>
					<li>Alt+z = Back page</li>
					<li>Alt+y = Go page</li>
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

$('form#add_purchse input, select, textarea, button').keydown(function (e) {
   if (e.keyCode == 13) {
        var inputs = $(this).parents("form#add_purchse").eq(0).find(":input, select, textarea, button");
        if (inputs[inputs.index(this) + 1] != null) {                    
            inputs[inputs.index(this) + 1].focus();
        }else{
			add_purchase_data();
		}
        e.preventDefault();
        return false;
    }else if(e.keyCode == 8){
		var inputs = $(this).parents("form#add_purchse").eq(0).find(":input, select, textarea, button");
        if (inputs[inputs.index(this) - 1] != null) {                    
            inputs[inputs.index(this) - 1].focus();
        }
	}
});


$(window).keypress(function(event) {
	if (event.keyCode == 46) {
		var url = prompt("Enter a SL", "");
		if(url > 0){
			var id = document.getElementById('button__'+url);
			remove_data('button__'+url);
		}
		event.preventDefault();       
	}
	
	if((!event.ctrlKey && event.altKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 'n':
				document.getElementById('item_id').focus();
				event.preventDefault();           
				break;
		}
	}
	
	if((event.ctrlKey && !event.altKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 's':
				if(!confirm('Are you want to save stock')){
					 event.preventDefault();
					return true;
				}
				document.getElementById("submit_purchase").click();
				event.preventDefault();           
				break;
				
			case 'c':
				var sub = document.getElementById('sub_total').innerText;
				document.getElementById('receive_amount').value = Number(sub).toFixed(2);
				document.getElementById("receive_amount").select();				
				event.preventDefault();           
				break;

			case '=':
				document.getElementById("add_purchase").click();
				event.preventDefault();           
				break;
				
			case '+':
				document.getElementById("add_purchase").click();
				event.preventDefault();           
				break;
			
			case '-':
				var url = prompt("Enter a SL", "");
				if(url > 0){
					var id = document.getElementById('button__'+url);
					remove_data('button__'+url);
				}
				event.preventDefault();           
				break;
			
		}
	}
	
});
</script>
