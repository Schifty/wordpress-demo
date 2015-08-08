<?php
//////////////////////////////////////////////////////////////////////////////////wpdemo_load_scripts/////////////////////////////////////////////////////////////////////////////////
/*this function is going to load theme scripts*/

function wpdemo_load_scripts()
{
	/////////////////////////////////////nivo slider///////////////////////////////////////
	
	//function to load the custom stylesheet which is differnet  from style.css
	wp_enqueue_style( 'default', get_stylesheet_directory_uri().'/css/themes/default/default.css' );
	
	//loads the nivo slider plugin script code which needs jquery librr to run
	wp_enqueue_script( 'nivo-slider', get_stylesheet_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'), '1.0.0', true );
	
	// starts the slider by loading the slider start code which calls a function in the nivo slider code
	wp_enqueue_script( 'slider-load', get_stylesheet_directory_uri() . '/js/slider.load.js', array('nivo-slider'), '1.0.0', true );
	
	// starts the slider by loading the slider start code which calls a function in the nivo slider code
	wp_enqueue_style( 'nivo-css', get_stylesheet_directory_uri() . '/css/nivo-slider.css' );
	
	
	
	/////////////////////////font awesome//////////////////////////////////////
	
	// starts the slider by loading the slider start code which calls a function in the nivo slider code
	wp_enqueue_style( 'fnt-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );

	
	
	
	////////////////////datepicker////////////////////////////////

	// css fle hosted by google
	wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );

	// js fle which is provided b wordpress
	wp_enqueue_script( 'jquery-ui-datepicker' );
	
	
	// my scrpt for using the datepicker
	wp_enqueue_script( 'datepicker', get_stylesheet_directory_uri() . '/js/datepicker.js', array('jquery-ui-datepicker'), '1.0.0', true );
}
//first parameter is the  hook, second in the function
add_action('wp_enqueue_scripts', 'wpdemo_load_scripts');










/////////////////////////////////////////////////////////////////custom star rating//////////////////////////////////////////////////////////////////////////////////////////////////////
/*gets the star rating*/


//function to cntact the admin when submit is pushed
function get_stars()
{
	//this gets the star rating from the custom field
	$stars = get_field("stars");
	
	// this is the switch statement to save the start rating as a string for out put
	switch ($stars) {
    case "0.0":
        $starRating = '<i class="fa fa-star-o"></i>';
        break;
    case "0.5":
        $starRating = '<i class="fa fa-star-half"></i>';
        break;
    case "1.0":
        $starRating = '<i class="fa fa-star"></i>';
        break;
	case "1.5":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star-half"></i>';
        break;
	case "2.0":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
	case "2.5":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i>';
        break;
	case "3.0":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
	case "3.5":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"><i class="fa fa-star-half"></i>';
        break;
	case "4.0":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
	case "4.5":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
	case "5.0":
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i>';
        break;
    default:
        $starRating = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
	}
	
	return $starRating;
}


















////////////////////////////////////////////////////////////////////////////get the slug function///////////////////////////////////////////////////////////////////////////////////////////////////////////
/**/
function get_the_slug( $id=null ){

  if( empty($id) ):
     global $post;

    if( empty($post) )
	return ''; // No global $post var available.
	  $id = $post->ID;
	endif;
	
	$slug = basename( get_permalink($id) );
  return $slug;

}





/////////////////////////////////////////////////////////////////////////current page url function//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*htis function returns the current page url*/


function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}











///////////////////////////////////////////////////////////////////////custom login functions //////////////////////////////////////////////////////////////////////////////////////////
/*these are the redirect functions to maintain the use of the custom login page and not the wp defautl login page*/

//when the user logs out redirect to the new login page
function wpdemo_logout_page(){

$new_login_page=get_home_url()."/login/";
wp_redirect($new_login_page."?login=out");
exit;

}

add_action('wp_logout','wpdemo_logout_page');

//verify if the username and password are empty
function wp_demo_verify_username_password($user,$username,$password){

if($username=="" or $password==""){
$new_login_page=get_home_url()."/login/";
wp_redirect($new_login_page."?login=empty");
exit;   
}
	 
}

add_filter('authenticate','wp_demo_verify_username_password',1,3);


//if wordpress authentication fails in the database 
//both username and password must be entered to authenticate
function wp_demo_login_fail(){

$new_login_page=get_home_url()."/login/";
wp_redirect($new_login_page."?login=fail");
exit;

}

add_action('wp_login_failed', 'wp_demo_login_fail');



function login_redirect(){

//new login page
$new_login_page=get_home_url()."/login/";
//old login page basename which is wp-login
$visiting_page=basename($_SERVER["REQUEST_URI"],".php"); 

//if the user is on the old login page redirect them to the new login page
//test if the user is on the old login page

if($visiting_page == 'wp-login' and $_SERVER['REQUEST_METHOD'] == 'GET'){
wp_redirect($new_login_page);
exit;
}

}

add_action('init','login_redirect');
























//////////////////////////////////////////////////////////////////wpdemo-admin only page /////////////////////////////////////////////////////////////////////////////////////////////////
/*   Function to protect the member salary page of the blog from those who are not administrators*/




function wpdemo_protect_admin_page(){

	//	check if we are on the member salaries page and Check to see if user is logged in as administrator
	if (is_page('member-salaries') and (!current_user_can('administrator'))){
		
			//location redirect variable
			$location = get_home_url();
			
			// and the redirect if not administrator
			wp_safe_redirect( $location ); exit;
			
	}// ends the if is page 'members' statement
	
}// ends the function protect member salery page

add_action('get_header', 'wpdemo_protect_admin_page');





















//////////////////////////////////////////////////////////////////wpdemo-protect page /////////////////////////////////////////////////////////////////////////////////////////////////
/*   Function to protect the member page of the blog from those who are not logged in*/




function wpdemo_protect_member_page(){

//	check if we are on the member page
if (is_page('members'))
		// heck to see if there is a logged in member
		if ( !is_user_logged_in() ) {
		//saves the login page url as a variabe for redirect
		$login = wp_login_url( );
			$status = '302';
	//the redirect for non logged in users trying to see the protected page		
	wp_redirect( $login, $status);	exit;
}// ends the if is page 'members' statement
}// ends the function protect member page

add_action('get_header', 'wpdemo_protect_member_page');















/////////////////////////////////////////////////////////////////wpdemo_hotel_submit hook//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to contact the admin when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_hotel_submit','hotel_contact_admin');

//function to cntact the admin when submit is pushed
function hotel_contact_admin()
{
	//function to contact the admin when submit is pushed
	//echo get_option( 'admin_email', $default); exit;
	$admin_mail = get_option( 'admin_email', $default); 
 
 wp_mail( $admin_mail, 'New Hotel Form', 'The website has been contacted' );
	
}//close the add meta function



















/////////////////////////////////////////////////////////////////wpdemo_add hotel info to database//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to add hotel info when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_hotel_submit','insert_hotel_info');

//function to insert hotel info to database
function insert_hotel_info()
{	
	//php object variable that represents a connection to the database
	global $wpdb;
	
	// first step is to get the variables
    
	$hname = wp_strip_all_tags($_POST['hotel_name']);
	$address = wp_strip_all_tags($_POST['address']);
    $stars = wp_strip_all_tags($_POST['stars']);
    $slide1 = wp_strip_all_tags($_POST['slide1']);
	
	
	// Create post object
	$hotels_post = array(
	  'post_title'    => $hname,
	  'post_status'   => 'publish',
	  'post_type'     => 'hotels',
	);
	
	
	//inserted into demowp_posts using wpdb object and its function
	$wpdb->insert( 	'demowp_posts', $hotels_post );
	
	//postid variable gets the post id of the contact post just entered and saves it for the post met information
	$post_id = $wpdb->insert_id;
	
	// clumns and meta value for entering the hotel name
	$hname_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'hname',
	  'meta_value' => $hname
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $hname_meta );
	
	// clumns and meta value for entering the address
	$address_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'address',
	  'meta_value' => $address
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $address_meta );
	
	// clumns and meta value for entering the stars
	$stars_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'stars',
	  'meta_value' => $stars
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $stars_meta );
	
	
	
	// clumns and meta value for entering the slide
	$slide1_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'slide1',
	  'meta_value' => $slide1
	);
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $slide1_meta );
	


}//close the add meta function










///////////////////////////////////////////////////request form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
this function process the information inthe contact form and sends off an email to the administrator
*/
function show_hotel_form_error()
{
	
	
	
	
		//set the blank variable
		$error="";
   
        $hname = trim($_POST['hname']);
		$address = trim($_POST['address']);
		$stars = trim($_POST['stars']);
		$description = trim($_POST['description']);
		$slide1 = trim($_POST['slide1']);
        
		
   
 
		
       // Check if name has been entered
        if ($hname!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$hname = filter_var($hname, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($hname == "") {
				$error .= 'Please enter a valid hotel name<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter a hotel name,<br/><br/>';
			}
				
		// Check if name has been entered
        if ($address!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$address = filter_var($address, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($address == "") {
				$error .= 'Please enter a valid address<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter an address,<br/><br/>';
			}
      
		// Check if email has been entered
        if ($stars!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$stars = filter_var($stars, FILTER_SANITIZE_EMAIL);
			//closes the validate if
		}else {
				$error .= 'Please enter a number between 1 and 5,<br/><br/>';
			}//ends the email if email is blank sttement
        
		// Check if email has been entered
        if ($description!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$description = filter_var($description, FILTER_SANITIZE_EMAIL);
			//closes the validate if
		}else {
				$error .= 'Please enter a descripton<br/><br/>';
			}//ends the email if email is blank sttement
		
		
		// Check if name has been entered
        if ($slide1!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$slide1 = filter_var($slide1, FILTER_SANTIZE_STRING);
		}
		
}//ends function




















///////////////////////////////////////////////////show request form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
This function brings up the contact form for the client to see, 
*/
function show_hotel_form($error="")
{
	if($error!=""){
		echo '<div class="alert alert-danger centered">'.$error.'</div>';
	}
	
	
	//echo "Submitted"; exit;
?>
<!--html form for bootstrap contact form-->	
<form class="form-horizontal" role="form" method="post" action="<?php echo get_permalink(); ?>" >
    <div class="form-group">
        <label for="hname" class="col-sm-2 control-label">Hotel Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="hname" name="hname" placeholder="The Sandman" value="<?php echo htmlspecialchars($_POST['hname']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="address" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address" placeholder="123  1st street, anywhere USA" value="<?php echo htmlspecialchars($_POST['address']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="stars" class="col-sm-2 control-label">Stars</label>
        <div class="col-sm-10">
            <input type="stars" class="form-control" id="stars" name="stars" placeholder="5" value="<?php echo htmlspecialchars($_POST['stars']); ?>">
           
        </div>
    </div>
	
	<div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <input type="description" class="form-control" id="description" name="descritpion" placeholder="" value="<?php echo htmlspecialchars($_POST['description']); ?>">
           
        </div>
    </div>
	
	 <div class="form-group">
        <label for="slide1" class="col-sm-2 control-label">Slide1</label>
        <div class="col-sm-10">
            <input type="blob" class="form-control" id="slide1" name="slie"  value="<?php echo htmlspecialchars($_POST['slide1']); ?>">
            
        </div>
    </div>
	
	
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="Submit" type="submit" value="Send" class="btn btn-primary">
        </div>
    </div>
 
</form> 
<?php
}





























/////////////////////////////////////////////////////////////////wpdemo_contact_submit hook//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to contact the admin when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_request_submit','request_contact_admin');

//function to cntact the admin when submit is pushed
function request_contact_admin()
{
	//function to contact the admin when submit is pushed
	//echo get_option( 'admin_email', $default); exit;
	$admin_mail = get_option( 'admin_email', $default); 
 
 wp_mail( $admin_mail, 'New Request Form', 'The website has been contacted' );
	
}//close the add meta function




























/////////////////////////////////////////////////////////////////wpdemo_add request info to database//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to add contact info when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_request_submit','insert_request_info');

//function to insert contact info to database
function insert_request_info()
{	
	//php object variable that represents a connection to the database
	global $wpdb;
	
	// first step is to get the variables
    
	$fname = wp_strip_all_tags($_POST['fname']);
	$lname = wp_strip_all_tags($_POST['lname']);
    $email = wp_strip_all_tags($_POST['email']);
    $member = wp_strip_all_tags($_POST['member']);
	$phone = trim($_POST['phone']);
	$industry = wp_strip_all_tags($_POST['industry']);
	$occupation = wp_strip_all_tags($_POST['occupation']);
    $experience = wp_strip_all_tags($_POST['experience']);
    $workperformed = wp_strip_all_tags($_POST['workperformed']);
	$additionalinfo = wp_strip_all_tags($_POST['additionalinfo']);
	$employer1 = wp_strip_all_tags($_POST['employer1']);
    $employer2 = wp_strip_all_tags($_POST['employer2']);
    $employer3 = wp_strip_all_tags($_POST['employer3']);
	
	
	// join the first nd last name
	$fullname=$lname.', '.$fname;
	
	// Create post object
	$request_post = array(
	  'post_title'    => $fullname,
	  'post_status'   => 'publish',
	  'post_type'     => 'request',
	);
	
	
	//inserted into demowp_posts using wpdb object and its function
	$wpdb->insert( 	'demowp_posts', $request_post );
	
	//postid variable gets the post id of the contact post just entered and saves it for the post met information
	$post_id = $wpdb->insert_id;
	
	// clumns and meta value for entering the fname
	$fname_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'fname',
	  'meta_value' => $fname
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $fname_meta );
	
		// clumns and meta value for entering the lname
	$lname_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'lname',
	  'meta_value' => $lname
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $lname_meta );
	
	// clumns and meta value for entering the email
	$email_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'email',
	  'meta_value' => $email
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $email_meta );
	
	
	
	// clumns and meta value for entering the message
	$phone_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'phone',
	  'meta_value' => $phone
	);
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $phone_meta );
	
	// clumns and meta value for entering the message
	$member_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'member',
	  'meta_value' => $member
	);
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $member_meta );
	
	// clumns and meta value for entering the fname
	$industry_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'industry',
	  'meta_value' => $industry
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $industry_meta );
	
	// clumns and meta value for entering the fname
	$occupation_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'occupation',
	  'meta_value' => $occupation
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $occupation_meta );
	
	// clumns and meta value for entering the fname
	$experience_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'experience',
	  'meta_value' => $experience
	);
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $experience_meta );
	
	// clumns and meta value for entering the fname
	$workperformed_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'workperformed',
	  'meta_value' => $workperformed
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $workperformed_meta );
	
	// clumns and meta value for entering the fname
	$additionalinfo_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'additionalinfo',
	  'meta_value' => $additionalinfo
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $additionalinfo_meta );
	
	// clumns and meta value for entering the fname
	$employer1_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'employer1',
	  'meta_value' => $employer1
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $employer1_meta );

	// clumns and meta value for entering the fname
	$employer2_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'employer2',
	  'meta_value' => $employer2
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $employer2_meta );
	
	// clumns and meta value for entering the fname
	$employer3_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'employer3',
	  'meta_value' => $employer3
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	'demowp_postmeta', $employer3_meta );

}//close the add meta function



















///////////////////////////////////////////////////request form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
this function process the information inthe contact form and sends off an email to the administrator
*/
function show_request_form_error()
{
	
	
	
	
		//set the blank variable
		$error="";
   
        $fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
        $member = trim($_POST['member']);
        $regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		$industry = trim($_POST['industry']);
		$occupation = trim($_POST['occupation']);
		$experience  = trim($_POST['experience']);
		$workperformed = trim($_POST['workperformed']);
		$additionalinfo = trim($_POST['aditionalinfo']);
		$employer1 = trim($_POST['employer1']);
		$employer2 = trim($_POST['employer2']);
		$employer3 = trim($_POST['employer3']);
		
   
 
		
       // Check if name has been entered
        if ($fname!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$fname = filter_var($fname, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($fname == "") {
				$error .= 'Please enter a valid first name<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter a first name,<br/><br/>';
			}
				
		// Check if name has been entered
        if ($lname!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$lname = filter_var($lname, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($lname == "") {
				$error .= 'Please enter a valid ast name<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter a last name,<br/><br/>';
			}
      
		// Check if email has been entered
        if ($email!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			//check to see if its a valid email address
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$error .= "$email is <strong>not</strong> a valid email <br/><br/>";
			}//closes the validate if
		}else {
				$error .= 'Please enter a valid email,<br/><br/>';
			}//ends the email if email is blank sttement
        
				  // Check if name has been entered
        if ($phone!= ""){
			//validate the phone number_format
			if(!preg_match($regex, $phone)){
				$error .= 'Please enter a valid phone number,<br/><br/>';
			}
		}else{//if the phone number field was blank
			$error .= 'Please enter a valid phone number,<br/><br/>';
			}
			
			return $error;
		
		// Check if name has been entered
        if ($member!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$member = filter_var($member, FILTER_SANTIZE_STRING);
		
			//after the first name has been sanitized, make sure it is not blank
			if($member == "") {
				$error .= 'Please state yes if your a member<br/><br/>';
			}
			else {
				$error .= 'Please enter yes if your a member<br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($industry!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$industry = filter_var($industry, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($industry == "") {
				$error .= 'Please enter a valid industry<br/><br/>';
			}
			else {
				$error .= 'Please enter an industry,<br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($occupation!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$occupation = filter_var($occupation, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($occupation == "") {
				$error .= 'Please enter a valid occupation<br/><br/>';
			}
			else {
				$error .= 'Please enter an occupation,<br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($workPerformed!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$workperformed = filter_var($workPerformed, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($workPerformed == "") {
				$error .= 'Please enter the work performed<br/><br/>';
			}
			else {
				$error .= 'Please enter the work performed,<br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($additionalInfo!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$additionalinfo = filter_var($additionalInfo, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($additionalInfo == "") {
				$error .= 'Please enter any additional info <br/><br/>';
			}
			else {
				$error .= 'Please enter any additional info<br/><br/>';
			}
		}
		
		
		
		// Check if name has been entered
        if ($employer1!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$employer1 = filter_var($employer1, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($employer1 == "") {
				$error .= 'Please entter an employer<br/><br/>';
			}
			else {
				$error .= 'Please enter an employer <br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($employer2!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$employer2 = filter_var($employer2, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($employer2 == "") {
				$error .= 'Please entter an employer<br/><br/>';
			}
			else {
				$error .= 'Please enter an employer <br/><br/>';
			}
		}
		
		// Check if name has been entered
        if ($employer3!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$employer3 = filter_var($employer3, FILTER_SANTIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($employer3 == "") {
				$error .= 'Please entter an employer<br/><br/>';
			}
			else {
				$error .= 'Please enter an employer <br/><br/>';
			}
		}
        
 
// If there are no errors, send the email

 

	
}//ends function



























///////////////////////////////////////////////////show request form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
This function brings up the contact form for the client to see, 
*/
function show_request_form($error="")
{
	if($error!=""){
		echo '<div class="alert alert-danger centered">'.$error.'</div>';
	}
	
	
	//echo "Submitted"; exit;
?>
<!--html form for bootstrap contact form-->	
<form class="form-horizontal" role="form" method="post" action="<?php echo get_permalink(); ?>" >
    <div class="form-group">
        <label for="fname" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fname" name="fname" placeholder="John" value="<?php echo htmlspecialchars($_POST['fname']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="lname" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Doe" value="<?php echo htmlspecialchars($_POST['lname']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
           
        </div>
    </div>
	
	 <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">Phone Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="123-456-7890" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="member" class="col-sm-2 control-label">Member</label>
        <div class="col-sm-10">
		 <input type="text" class="form-control" id="member" name="member" placeholder="Yes / No" value="<?php echo htmlspecialchars($_POST['member']); ?>">
          
        </div>
    </div>
	
	 <div class="form-group">
        <label for="industry" class="col-sm-2 control-label">Industry</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="industry" name="industry" placeholder="Web & Design" value="<?php echo htmlspecialchars($_POST['industry']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="ocupation" class="col-sm-2 control-label">Occupation</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Web Site Administrator" value="<?php echo htmlspecialchars($_POST['occupation']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="Experience" class="col-sm-2 control-label">Experience</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="experience" name="experience" placeholder="2 years 3 months" value="<?php echo htmlspecialchars($_POST['experience']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="WorkPerformed" class="col-sm-2 control-label">Work Performed</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="workperformed" name="workperformed" placeholder="Data Entry" value="<?php echo htmlspecialchars($_POST['workperformed']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="info" class="col-sm-2 control-label">Additional Info</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="additionlinfo" name="additionalinfo" placeholder="My Portfolio is www.portfolio.exmple" value="<?php echo htmlspecialchars($_POST['additionalinfo']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="employer1" class="col-sm-2 control-label">Employer 1</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="employer1" name="employer1" placeholder="InkBS, Vancouver, Canada" value="<?php echo htmlspecialchars($_POST['employer1']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="employer2" class="col-sm-2 control-label">Employer 2</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="employer2" name="employer2" placeholder="FDP.com, Shenzhen, China" value="<?php echo htmlspecialchars($_POST['employer2']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="employer3" class="col-sm-2 control-label">Employer 3</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="employer3" name="employer3" placeholder="DealExtreme, GuangDong, China" value="<?php echo htmlspecialchars($_POST['employer3']); ?>">
            
        </div>
    </div>

	
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="Submit" type="submit" value="Send" class="btn btn-primary">
        </div>
    </div>
 
</form> 
<?php
}




























///////////////////////////////////////////////////contact form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
this function process the information inthe contact form and sends off an email to the administrator
*/
function show_contact_form_error()
{
	
	
	
	
		//set the blank variable
		$error="";
   
        $fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
		$phone = trim($_POST['phone']);
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
       // $human = intval($_POST['human']);
        $from = 'Demo Contact Form'; 
        $to = 'Schift.pro@gmail.com'; 
        $subject = 'Message from Contact Demo ';
        
        $body = "From: $lname$fname\n E-Mail: $email\n Message:\n $message";
 
		
		
		
		 // Check if name has been entered
        if ($fname!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$fname = filter_var($fname, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($fname == "") {
				$error .= 'Please enter a valid first name<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter a first name,<br/><br/>';
			}
		
		
        // Check if name has been entered
        if ($lname!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$lname = filter_var($lname, FILTER_SANITIZE_STRING);
			//after the first name has been sanitized, make sure it is not blank
			if($lname == "") {
				$error .= 'Please enter a valid ast name<br/><br/>';
			}
		}
			else {
				$error .= 'Please enter a last name,<br/><br/>';
			}
		
		
		// Check if email has been entered
        if ($email!= ""){
			// sanitize to remove illegal cde entered into the form or illegal characters
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			//check to see if its a valid email address
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$error .= "$email is <strong>not</strong> a valid email <br/><br/>";
			}//closes the validate if
		}else {
				$error .= 'Please enter a valid email,<br/><br/>';
			}//ends the email if email is blank sttement
        
        
        //Check if message has been entered
        if (!$_POST['message']) {
            $errMessage = 'Please enter your message';
        }//ends if post message
		
		
		  // Check if name has been entered
        if ($phone!= ""){
			//validate the phone number_format
			if(!preg_match($regex, $phone)){
				$error .= 'Please enter a valid phone number,<br/><br/>';
			}
		}else{//if the phone number field was blank
			$error .= 'Please enter a valid phone number,<br/><br/>';
			}
			
			
			return $error;
		
		
        //Check if simple anti-bot test is correct
        if ($human !== 5) {
           $errHuman = 'Your anti-spam is incorrect';
        }//ends if human 
 
// If there are no errors, send the email

 

	
}//ends function
























///////////////////////////////////////////////////show contact form///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
This function brings up the contact form for the client to see, 
*/
function show_contact_form($error="")
{
	if($error!=""){
		echo '<div class="alert alert-danger centered">'.$error.'</div>';
	}
	
	
	//echo "Submitted"; exit;
?>
<!--html form for bootstrap contact form-->	
<form class="form-horizontal" role="form" method="post" action="<?php echo get_permalink(); ?>" >
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['fname']); ?>">
            
        </div>
    </div>
	
	<div class="form-group">
        <label for="name" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['lname']); ?>">
            
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
        <label for="phone" class="col-sm-2 control-label">Phone Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
            
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
 
</form> 
<?php
}




























/////////////////////////////////////////////////////////////////wp head hook add meta//////////////////////////////////////////////////////////////////////////////////////////////////////
/* his function adds a meta description t the head
hook int the page with your own code
just before the head finishes loading </head>

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
	
	
add_action('wp_head','add_meta_desc');

function add_meta_desc()
{
//get the blog description from the taglne in settings and puts it on every page
	$desc = get_field('description');
	
	
		//check if metea description i added or not
		if(!empty($desc)){
			
			
			echo '<meta name="description" content="' . $desc . '" />';
		}//close the if empty
	 
	
}//close the add meta function





















/////////////////////////////////////////////////////////////////wpdemo_contact_submit hook//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to contact the admin when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_contact_submit','contact_admin');

//function to cntact the admin when submit is pushed
function contact_admin()
{
	//function to contact the admin when submit is pushed
	//echo get_option( 'admin_email', $default); exit;
	$admin_mail = get_option( 'admin_email', $default); 
 
 wp_mail( $admin_mail, 'New Contact Request', 'The website has been contacted' );
	
}//close the add meta function




























/////////////////////////////////////////////////////////////////wpdemo_add contact info to database//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to add contact info when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
//add_action('wpdemo_contact_submit','insert_contact_info');

//function to insert contact info to database
function insert_contact_info()
{
	
	// first step is to get the variables
	$fname = wp_strip_all_tags($_POST['fname']);
	$lname = wp_strip_all_tags($_POST['lname']);
    $email = wp_strip_all_tags($_POST['email']);
    $message = wp_strip_all_tags($_POST['message']);
	$phone = trim($_POST['phone']);

	$fullname=$lname.', '.$fname;
	
	// Create post object
	$contact_post = array(
	  'post_title'    => $fullname,
	  'post_status'   => 'publish',
	  'post_type'     => 'contact',
	
	);

	// Insert the post into the database
	//this function   wp_insert_post  returns the post id so save it as a variable below
	$post_id = wp_insert_post( $contact_post );
	
	add_post_meta($post_id, 'fname', $fname);
	add_post_meta($post_id, 'lname', $lname);
	add_post_meta($post_id, 'email', $email);
	add_post_meta($post_id, 'message', $message);
	add_post_meta($post_id, 'phone', $phone);
	
}//close the add meta function




























/////////////////////////////////////////////////////////////////wpdemo_add contact info2 to database//////////////////////////////////////////////////////////////////////////////////////////////////////
/*//function to add contact info when submit is pushed

first parameter is the nae of the hook
second parameter is the nae of the function that will execute(code to be add jsut before the head clse tag)*/
add_action('wpdemo_contact_submit','insert_contact_info2');

//function to insert contact info to database
function insert_contact_info2()
{	
	//php object variable that represents a connection to the database
	global $wpdb;
	
	// first step is to get the variables
	$fname = wp_strip_all_tags($_POST['fname']);
	$lname = wp_strip_all_tags($_POST['lname']);
    $email = wp_strip_all_tags($_POST['email']);
    $message = wp_strip_all_tags($_POST['message']);
	$phone = trim($_POST['phone']);
	// join the first nd last name
	$fullname=$lname.', '.$fname;
	
	// Create post object
	$contact_post = array(
	  'post_title'    => $fullname,
	  'post_status'   => 'publish',
	  'post_type'     => 'contact',
	);
	
	
	//inserted into demowp_posts using wpdb object and its function
	$wpdb->insert( 	demowp_posts, $contact_post );
	
	//postid variable gets the post id of the contact post just entered and saves it for the post met information
	$post_id = $wpdb->insert_id;
	
	// clumns and meta value for entering the fname
	$fname_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'fname',
	  'meta_value' => $fname
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	demowp_postmeta, $fname_meta );
	
	// clumns and meta value for entering the lname
	$lname_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'lname',
	  'meta_value' => $lname
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	demowp_postmeta, $lname_meta );
	
	// clumns and meta value for entering the email
	$email_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'email',
	  'meta_value' => $email
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	demowp_postmeta, $email_meta );
	
	// clumns and meta value for entering the message
	$message_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'message',
	  'meta_value' => $message
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	demowp_postmeta, $message_meta );
	
	// clumns and meta value for entering the message
	$phone_meta = array(
	  'post_id' => $post_id,
	  'meta_key'   => 'phone',
	  'meta_value' => $phone
	);
	
	
	// this tie the meta info is inserted into the post meta table
	$wpdb->insert( 	demowp_postmeta, $phone_meta );

}//close the add meta function
























/////////////////////////////////////////////////////////////////custom avartar//////////////////////////////////////////////////////////////////////////////////////////////////////
/*gets the custom avatar*/
add_action('wp_head','get_favicon');

//function to cntact the admin when submit is pushed
function get_favicon()
{
	
		echo '<link rel="shortcut icon" href="'.get_stylesheet_directory_uri().'/images/favicon.ico" />';
	
	
	
	
	
}//close the add meta function





