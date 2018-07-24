
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/moment.min_1.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/daterangepicker.js'); ?>"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.form-validator.min.js');?>"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url('assets/js/jquery.slimscroll.min_1.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/fastclick_1.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/app.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/icheck.min_1.js');?>"></script>
<script src="<?php echo base_url('assets/ckeditor/adapters/jquery_1.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo_1.js');?>"></script>
<script src="<?php echo base_url('assets/js/custom_1.js');?>"></script>
<script src="<?php echo base_url('assets/js/shop/shoping.js');?>"></script>
<script src="<?php echo base_url('assets/js/shop/purchase.js');?>"></script>
<script src="<?php echo base_url('assets/js/select/sol.js');?>"></script>

<script>
	function validate_fileType(fileName,Nameid,arrayValu)
	{
		var string = arrayValu;
		var tempArray = new Array();
		var tempArray = string.split(',');					
		var allowed_extensions =tempArray;
		var file_extension = fileName.split(".").pop(); 
		for(var i = 0; i <= allowed_extensions.length; i++)
		{
			if(allowed_extensions[i]==file_extension)
			{	
				$("#error_"+Nameid).html("");
				return true; // valid file extension
			}
		}
		$("#"+Nameid).val("");
		$("#error_"+Nameid).css("color","red").html("File formate not suport To uploade");
		return false;
	}
</script>
</body>
</html>
<!-- modal -->
<div id="cnfrm_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-md-6">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete </p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-small  yes-btn btn-danger" href="">yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
            </div>
        </div> 
    </div>
</div>