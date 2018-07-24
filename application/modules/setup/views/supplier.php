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
        <h3 class="box-title">Supplier <small></small></h3>
      </div>
      <div class="box-body box-profile">
         <form method="post" id="forms_submit" name="submit_supplier" action="<?php echo base_url().'setup/supplier_info/'.$edit.'/'; ?>" class="form-label-left">
         <div class="col-md-4 div-border">
            <h4>Add Supplier</h4>
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
						$name = $edit_data[0]['SUPPLIER_NAME']; 
						$email = $edit_data[0]['SUPPLIER_EMAIL']; 
						$phone = $edit_data[0]['SUPPLIER_PHONE']; 
						$addres = $edit_data[0]['SUPPLIER_ADDRESS']; 
						$status = $edit_data[0]['SUPPLIER_STATUS']; 
					}else{ 
						$name = '';
						$email = '';
						$phone = '';
						$addres = '';
						$status = '';
					}
						
					?>
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputname">Name:</label>
		              <input type="text" id="name" name="name" value="<?= $name;?>" required="required" class="form-control" placeholder="Name">
		              <span class="glyphicon glyphicon-user form-control-feedback"></span>
		            </div>

					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputemail">Email:</label>
		              <input type="email" id="email" name="email" value="<?= $email;?>" required="required" class="form-control" placeholder="Email">
		              <span class="form-control-feedback"> @</span>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputemail">Phone:</label>
		              <input type="text" id="phone" name="phone" value="<?= $phone;?>" class="form-control" placeholder="Phone">
		              <span class="glyphicon glyphicon-phone form-control-feedback"></span>
		            </div>
					
					<div class="form-group has-feedback clear-both">
		              <label for="exampleInputemail">Address:</label>
		              <textarea  id="address" name="address" value="" class="form-control" placeholder="Address here.."><?= $addres;?></textarea>
		              
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
					  <button name="submit_supplier" type="submit" id="submit_supplier" class="btn btn-success btn-md wdt-bg">Save</button>  
					</div>
					<?php
					if($edit > 0){
					?>
						<div class="form-group has-feedback sub-btn-wdt pull-right" > <a href="<?php echo base_url().'setup/supplier_info/'; ?>"> Add Supllier</a></div>
					<?php	
					}
					?>
				 </div>
			</div>
          </div>
         </form>
		  <div class="col-md-8">
            <center><h4>Supplier List</h4></center>
			<div class="row"><div class="col-md-4 pull-right form-group"><input type="text" id="myInput" class="form-control" onkeyup="mySearch()" placeholder="Search for names.." title="Type in a name"></div></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="myTable">
					<thead>
					  <tr>
						<th>#SL</th>
						<th>Supplier</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					<?php
					$m = $increment+1;
					if(is_array($supplier_list) AND sizeof($supplier_list) > 0){
						foreach($supplier_list AS $value):
					?>
					  <tr ondblclick="location.replace('<?php echo base_url().'setup/supplier_info/'.$value['SUPPLIER_ID'].'/'; ?>');">
						<td><?= $m;?> <input type="hidden" name="editId" id="editId__<?= $m;?>" value="<?= $value['SUPPLIER_ID'];?>"></td>
						<td><?= $value['SUPPLIER_NAME'];?></td>
						<td><?= $value['SUPPLIER_EMAIL'];?></td>
						<td><?= $value['SUPPLIER_PHONE'];?></td>
						<td><?= $value['SUPPLIER_ADDRESS'];?> </td>
						
						<td align="center"><a href="<?php echo base_url().'setup/supplier_info/'.$value['SUPPLIER_ID'].'/'; ?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
						
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
					<li>Ctrl+f = Find Supllier</li>
					<li>Ctrl+s = Save</li>
					<li>Ctrl+Shift+u = Edit Supllier</li>
					<li>Ctrl+Shift+n = New Supplier</li>
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
$('form#forms_submit input, select, textarea, button').keydown(function (e) {
   if (e.keyCode == 13) {
        var inputs = $(this).parents("form#forms_submit").eq(0).find(":input, select, textarea, button");
        if (inputs[inputs.index(this) + 1] != null) {                    
            inputs[inputs.index(this) + 1].focus();
        }else{
			document.getElementById("submit_supplier").click();
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
					location.replace(url+'setup/supplier_info/'+idD);
				}
				event.preventDefault();           
				break;
				
			case 'n':
				document.getElementById('name').focus();
				location.replace(url+'setup/supplier_info/');
				event.preventDefault();           
				break;

			case 't':
				var urlData = prompt("Enter a Page No.", "");
				if(urlData > 0){
					location.replace(url+'setup/supplier_info/?page='+urlData);
				}
				event.preventDefault();           
				break;
			
			
		}
	}
	
	if((event.ctrlKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
			case 's':
				document.getElementById("submit_supplier").click();
				event.preventDefault();           
				break;	
		}
	}
});
</script>