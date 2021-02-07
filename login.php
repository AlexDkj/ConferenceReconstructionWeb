<!DOCTYPE html>
<html>
 <div class="navbar-header">
		<?php include 'includes/header.php';?>
	</div>
<body>	
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Login</h3>
                </div>
            </div>
                
            <form action="#" id="login-form">
                <div class="row">
                    <div class="col-md-12" id="login-msg" style="display:none;">
                        <div class="alert"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" id="uname" name="uname" required>
                        </div>
					</div>	
					
					<div class="col-sm-6">
                        
						<div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
                        </div>
                    </div>
				</div>		
				<div class="text-center mt20">
                    <button type="submit" class="btn btn-black btn-lg" id="registration-submit-btn">LOGIN </button>
                </div>
			</form>		
		</div>	
</body>		
	
		
</html>