<head>
	<title>Shop Management</title>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
	  	<div class="login-logo">
	    	<a href="<?php echo base_url(); ?>"><b>Shop Management</b></a>
	  	</div>
	  	<!-- /.login-logo -->
	  	<div class="login-box-body">
	    	<p class="login-box-msg">Sign in </p>
			<?php if($this->session->flashdata("messagePr")){?>
	  		<div class="alert alert-warning">      
		        <?php echo $this->session->flashdata("messagePr")?>
		    </div>
		    <?php } ?>
		    <form action="<?php echo base_url().'login/'; ?>" method="post">
		    	<div class="form-group has-feedback">
		    		<input type="text" name="email" class="form-control" id="" placeholder="User id">
		        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
		      	</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" id="pwd" placeholder="Password" >
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
			    <div class="row">
			  		<div class="col-xs-12">
		          		<button type="submit" class="btn btn-primary btn-block btn-flat btn-color" name="login_data">Sign In</button>
		        	</div>
				</div>
		    </form>
		    <a href="forgetpassword" class="forgot ">I Forgot my password?</a>
			  	
		</div>
		<!-- /.login-box-body -->
	</div>
</body>
