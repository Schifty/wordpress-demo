<?php
///////////////////////////////////////////////////contact form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
this function process the information inthe contact form and sends off an email to the administrator
*/
function contact_form()
{
	
	//echo "Submitted"; exit;

   
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
        $human = intval($_POST['human']);
        $from = 'Demo Contact Form'; 
        $to = 'Schift.pro@gmail.com'; 
        $subject = 'Message from Contact Demo ';
        
        $body = "From: $name\n E-Mail: $email\n Message:\n $message";
 
        // Check if name has been entered
        if (!$_POST['name']) {
            $errName = 'Please enter your name';
        }//ends if post name
        
        // Check if email has been entered and is valid
        if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'Please enter a valid email address';
        }//ends if post email
        
        //Check if message has been entered
        if (!$_POST['message']) {
            $errMessage = 'Please enter your message';
        }//ends if post message
		
        //Check if simple anti-bot test is correct
        if ($human !== 5) {
            $errHuman = 'Your anti-spam is incorrect';
        }//ends if human 
 
// If there are no errors, send the email
//if ((!$errName && !$errEmail && !$errMessage && !$errHuman)) {
    //if (mail ($to, $subject, $body, $from)){
       // $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
   // }//cloeses the no errors if statement else 
	//{
       // $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
   // }//ends no errors else
//}//ends no errros if statment
 

	
}//ends function













///////////////////////////////////////////////////////check contact form error////////////////////////////////////////////////////////////////////
/*this function takes an error string and outputs a the 
for with the error string, Has 1 parameter called error,
the default value of error is blank which means if the programer
 does not enter the value then the error wil be "" and
 the  form will still pop up still
*/

function check_contact_form_error()
{
	
	$error="";
		
		
			
	return $error;
}//ends error check
///////////////////////////////////////////////////show contact form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
This function brings up the contact form for the client to see, 
*/
function show_contact_form($error="")
{
	//echo "Submitted"; exit;
?>
<!--html form for bootstrap contact form-->	
<form class="form-horizontal" role="form" method="post" action="<?php echo get_permalink(); ?>" >
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
            
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
           
        </div>
    </div>
    <div class="form-group">
        <label for="message" class="col-sm-2 control-label">Message</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
          
        </div>
    </div>
    <div class="form-group">
        <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
         
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="Submit" type="submit" value="Send" class="btn btn-primary">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <?php echo $result; ?>    
        </div>
    </div>
</form> 
<?php
}