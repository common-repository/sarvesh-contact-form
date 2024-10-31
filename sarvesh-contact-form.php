<?php
/*
Plugin Name: Sarvesh Contact form
Description: This plugin is use for to send mail to your client.
Version: 1.0
Author: Sarvesh Patel
*/

function sdp_contact_form () {
    ob_start();
	global $post;
	$current_url = get_permalink($post->ID);
	$nonce = wp_create_nonce( 'my-action_'.$post->ID );
	$to = get_option( 'admin_email' );	
	if(isset($_POST['_wpnonce'])){
		
		$email = sanitize_email( $_POST['email'] );
		$cname = sanitize_text_field( $_POST['cname'] );
		$message = sanitize_text_field( $_POST['message'] );
		$msg = $message.' from '.$cname.' ('.$email.')';
		mail($to,$subject,$msg);
	}
	
?>
<form method="post" action="<?php echo $current_url; ?>"  >
<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo $nonce;?>" />
	Name:<br/>
	<input type="text" name="cname" /><br/>
	Email:<br/>
	<input type="text" name="email" /><br/>
	Subject:<br/>
	<input type="text" name="subject" /><br/>
	Message:<br/>
	<textarea type="text" name="message" ></textarea><br/><br/>
	<input type="submit" name="submit" value="Send" /><br/>
</form>
<?php	
    return ob_get_clean();
}

add_shortcode( 'sdp_form', 'sdp_contact_form' );