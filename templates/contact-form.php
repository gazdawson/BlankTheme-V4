<?php
// Define Vars
global $krank;
$result = $form_data = $sent = $info = $subject = '';
// check for contact email in options framework
if (isset($krank['contact_email'])) {
	$contact_email = $krank['contact_email'];
}
else {
	$contact_email = get_bloginfo('admin_email');
}
$email = $contact_email;
$label_name = "Full Name *";
$label_email = "Email *";
$label_number = "Contact Number *";
$label_subject = "Subject";
$label_message = "Your Message *";
$label_submit = "Submit";
$success = "Thanks for your e-mail! We'll get back to you as soon as we can.";

// function to get the IP address of the user
function contact_form_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

// if the <form> element is POSTed, run the following code
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $error = false;

    // this part fetches everything that has been POSTed, sanitizes them and lets us use them as $form_data['subject']
    foreach ( $_POST as $field => $value ) {
        if ( get_magic_quotes_gpc() ) {
            $value = stripslashes( $value );
        }
        $form_data[$field] = strip_tags( $value );
    }
		
    // but if $error is still FALSE, put together the POSTed variables and send the e-mail!
    if ( $error == false ) {
        // get the website's name and puts it in front of the subject
        $email_subject = "[" . get_bloginfo( 'name' ) . "] " . $form_data['subject'];
        // get the message from the form and add the IP address of the user below it
        $email_message = "Tel: ".$form_data['number']."\n Email: ".$form_data['email']."\n\n". $form_data['message'] . "\n\nIP: " . contact_form_get_the_ip();
        // set the e-mail headers with the user's name, e-mail address and character encoding
        $headers  = "From: " . $form_data['your_name'] . " <" . $form_data['email'] . ">\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        // send the e-mail with the shortcode attribute named 'email' and the POSTed data
        wp_mail( $email, $email_subject, $email_message, $headers );
        // and set the result text to the shortcode attribute named 'success'
        $result = $success;
        // ...and switch the $sent variable to TRUE
        $sent = true;
    }
}
		
// if there's no $result text (meaning there's no error or success, meaning the user just opened the page and did nothing) there's no need to show the $info variable
if ( $result != "" ) {
    $info = 
			'<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 '. $result .'
			</div>';
}

if ( $sent == true ) {
    echo $info;
}

?>
	
<form id="contact-form" method="post" action="<?php echo get_permalink(); ?>">
    <div class="form-group">
        <input type="text" name="your_name" placeholder="<?php echo $label_name; ?>" id="cf_name" class="form-control" size="50" maxlength="50" value="<?php echo isset($form_data['your_name']); ?>" />
    </div>
    <div class="form-group">
        <input type="text" name="email" placeholder="<?php echo $label_email; ?>" id="cf_email" class="form-control" size="50" maxlength="50" value="<?php echo isset($form_data['email']); ?>" />
    </div>
		<div class="form-group">
			<input type="text" name="number" placeholder="<?php echo $label_number; ?>" id="cf_number" class="form-control" size="50" maxlength="50" value="<?php echo isset($form_data['number']); ?>" />
		</div>
    <div class="form-group">
        <input type="text" name="subject" placeholder="<?php echo $label_subject; ?>" id="cf_subject" class="form-control" size="50" maxlength="50" value="<?php echo $subject . isset($form_data['subject']); ?>" />
    </div>
    <div class="form-group">
        <textarea name="message" id="cf_message" placeholder="<?php echo $label_message; ?>" class="form-control" cols="50" rows="15"><?php echo isset($form_data['message']); ?></textarea>
    </div>
    <div>
        <input type="submit" value="<?php echo $label_submit; ?>" name="send" id="cf_send" class="btn btn-primary" />
    </div>
</form>