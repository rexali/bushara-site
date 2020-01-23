<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password= "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['confirm_password'])) {
         // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);

    }else {
        # code..
    
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

}
?>
 




<!DOCTYPE html> 
<html lang="en">   
<head>     
<title> Pharmaceutical and Clinical Services Limited, Bushara.</title>

<meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="jquery-3.3.1.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="bootstrap.min.js"></script>

<style>
.navbar{
margin-bottom:;
background-color: #f5eab0;
z-index:;
}

.page-footer ul a{
 color :;
font-size:17px;
color:red;
background-color: blue;
}
.row{
margin-top:;
background-color: #f5eab0;
}
.jumbotron{
margin-top:80px;
}

.modal-login, .signup-modal{
		width: 320px;
       float:right;
	}
</style>

</head> 
  
<body>

<div class ="container-fluid">
<nav class ="navbar navbar-default navbar-fixed-top" style=" ">
<div class ="container-fluid">
<div class ="navbar-header">
<button class ="navbar-toggle" data-toggle="collapse" data-target="#myNavBar" >
<span class ="icon-bar"></span>
<span class ="icon-bar"></span>
<span class ="icon-bar"></span>
<span class ="icon-bar"></span>
</button>

<a class ="navbar-brand " href ="#" style="color:black;"><span><b>BUSHARA PHARMACY </b> </span></a>
</div>

<div class ="collapse navbar-collapse" id="myNavBar">
<ul class ="nav navbar-nav" >
<li class ="" ><a href="#" style="color:black; font-size:20px;" >About Us</a></li>
<li class ="dropdown "><a href ="#" class ="dropdown-toggle" data-toggle="dropdown" style="color:black; font-size:20px;" >Services<span class="caret"></span></a>

<ul class="dropdown-menu">
<li><a href ="#"><b>Products </b> </a></li>
<li><a href ="#"><b>Consultancy </b> </a></li>
<li><a href ="#"><b>Training</a> </b> </li>
<li><a href ="#"><b>Medical Check</a> </b> </li>
</ul></li>
<li class =""><a href="#" style="color:black; font-size:20px; ">Blog </a></li>
<li class =""><a href="#" style="color:black; font-size:20px;" >Forum</a></li>
</ul>

<ul class ="nav navbar-nav navbar-right">
<li class =""><a href="#myContactModal" class="btn btn-info trigger-btn" data-toggle="modal" style="color:black; font-size:20px;" ><span class ="glyphicon glyphicon-user"></span> Contact Us</a></li>
<li class =""><a href="#mySignUpModal" class="btn btn-info trigger-btn" data-toggle="modal" style="color:black; font-size:20px;" ><span class ="glyphicon glyphicon-user"></span> Sign Up</a></li>
<li class =""><a href="#myLoginModal" class="btn btn-info trigger-btn" data-toggle="modal" style="color:black; font-size:20px;" ><span class ="glyphicon glyphicon-log-in" ></span>  Login </a></li>
</ul>

</div>
</div>
</nav>


<div class="jumbotron">
<p class ="text-success text-center">Bushara Pharmaceutical and Clinical Services Ltd  <span class='glyphicon glyphicon-eye-open'></span></p>
<p class=" text-center ">RC. 1319539</p>
</div>

<!--first row-->
<div class="row">
<!--columns-->
<div class="col-sm-6 ">

<div class="img-responsive">
<a href="#"><img src="imageDoc.png" class ="thumbnail" width="186px" height ="186px" alt="Stethoscope Logo"/>

<div class ="caption">
<p>Hi</p>
</div>

</a>

</div>
<h1 class ="text-center">Who We Are</h1>


<p>Bushara Pharmacy starts at far back as 2010. On the other hand we have been there 6 years ago and have gotten enough knowledge and experience to care for you with best, quality and affordable drugs/medecines. We render several medical or health-related services. With this your concerns are addressed professionally. We take into cognizance your priority and your feedback is our concern and we consider it seriously.  </p>
</div>

<div class="col-sm-6">

<div class="thumbnail">
<a href="#"><img src="imageStore.jpg" width="186px" height ="186px" alt="Stethoscope Logo"/>

<div class ="caption">
<p>Hi</p>
</div>

</a>

</div>
<h1 class ="text-center" >How to Reach Us</h1>
<p>Bushara Pharmacy has its main branch at Kano State. You can find us at #230 Naibawa Gabas in Kumbotso Local Government along line Dan Hassan close to U/turn </p>
</div>

</div>


<!--second row-->
<div class ="row">
<!--columns -->
<div class="col-sm-6">

<div class="">
<a href="#"><img src="imagePx.png" class="thumbnail" width="186px" height ="186px" alt="Stethoscope Logo"/>

<div class ="caption">
<p>Hi</p>
</div>

</a>

</div>

<h1 class ="text-center" >Services or Product We Offer</h1>
<p>We provide a range of services in addition to sales of drugs. The services we are rendering include: pharmaceutical business consultancy, pharmacy business plan development, customer handling and management training and several other medical tests</p>
</div>

<div class="col-sm-6">

<div class="thumbnail">
<a href="#"><img src="imageShop.jpg" width="186px" height ="186px" alt="Stethoscope Logo"/>

<div class ="caption">
<p>Hi</p>
</div>

</a>

</div>
<h1 class ="text-center" >Where to Get Our Latest News </h1>
<p>We have blog and forum where we share our important news and tips related to health and discuss any pertinent topics and profer solutions</p>
</div>

</div>



<div class="page-footer">
<ul class="nav nav-tabs nav-justified">
<li><a href="#">Facebook</a></li>
<li><a href="#" > Twitter </a></li>
<li><a href="#" > Google+ </a></li> 
<li><a href="#" > Term of Use </a> </li> 
<li> <a href="#" > Privacy Policy </a></li>
</ul>
</div>

<!-- Modal HTML for Login -->
<div id="myLoginModal" class="modal fade">
	<div class="modal-dialog modal-sm modal-login">
		<div class="modal-content">
            <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">
            
				<div class="modal-header">	
                <h4 class="modal-title">Login</h4>
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">

			    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
                </div>    

                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                </div>	

				<div class="modal-footer">
				<label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label>
				<input type="submit" class="btn btn-primary pull-right" value="Login">
                </div>
                
               <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

			</form>
		</div>
	</div>
</div>   


<!-- Modal HTML for  Sign Up  -->
<div id="mySignUpModal" class="modal fade">
	<div class="modal-dialog signup-modal modal-sm">
		<div class="modal-content">

            <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">

			<div class="modal-header">				
			<h4 class="modal-title">Sign Up Form</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            
			<div class="modal-body">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err;?></span>
            </div>

            </div>    
           
            <div class="modal-footer">
					<label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label>
					<input type="submit" class="btn btn-primary pull-right" value="Login">
                    <input type="reset" class="btn btn-default" value="Reset">
			</div>
        
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
       
             <input type="button" class="btn btn-link" data-dismiss="modal" value="Cancel">
            </form>
        
            
		    </div>
	        </div>
            </div>


<!-- Modal HTML for Contact Us-->
<div id="myContactModal" class="modal fade">
	<div class="modal-dialog contact-modal">
		<div class="modal-content">
        
			<div class="modal-header">				
				<h4 class="modal-title">Contact Us</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			    <div class="modal-body">
                <!--<form action="/examples/actions/confirmation.php" method="post">-->
                <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" rows="4" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Send">
                    <input type="button" class="btn btn-link" data-dismiss="modal" value="Cancel">
                </form>
			</div>
		</div>
	</div>
</div>  


</div>
</body>
</html>






