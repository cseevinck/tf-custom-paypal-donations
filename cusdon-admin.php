<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
add_action( 'admin_menu', 'cusdon_add_admin_menu' );
add_action( 'admin_init', 'cusdon_settings_init' );

function cusdon_add_admin_menu(  ) { 
	add_menu_page( 'TF Custom Paypal Donations', 'TF Custom Paypal Donations', 'manage_options', 'cusdon_paypal_donations', 'cusdon_options_page' );
}

function cusdon_settings_init(  ) { 
	register_setting( 'cusdon_pluginPage', 'cusdon_settings' );

	add_settings_section(
	'cusdon_pluginPage_section', 
	__( '', 'wordpress' ), 
	'cusdon_settings_section_callback', 
	'cusdon_pluginPage'
	);

	add_settings_field( 
		'cusdon_organization_name', 
		__( 'Organization Name', 'wordpress' ), 
		'cusdon_organization_name_render', 
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section' 
	);

	add_settings_field( 
		'cusdon_give_to', 
		__( 'Possible Donations List', 'wordpress' ), 
		'cusdon_give_to_render', 
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section' 
	);

	add_settings_field( 
		'cusdon_paypal_email', 
		__( 'Paypal Email Account', 'wordpress' ), 
		'cusdon_paypal_email_render', 
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section' 
	);

	add_settings_field( 
		'cusdon_notification_to_email', 
		__( 'Notification To Email', 'wordpress' ), 
		'cusdon_notification_to_email_render', 
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section' 
	 );

	// Disable the from and reply to email fields
	// because i cant figure out how to use them with wp_mail
	// so use the defaults that wp_mail provides
	//
	// add_settings_field( 
	//	'cusdon_notification_from_email', 
	//	__( 'Notification From Email', 'wordpress' ), 
	//	'cusdon_notification_from_email_render', 
	//	'cusdon_pluginPage', 
	//	'cusdon_pluginPage_section' 
	// );

//		add_settings_field( 
//		'cusdon_notification_reply_to_email', 
//		__( 'Notification Reply To Email', 'wordpress' ), 
//		'cusdon_notification_reply_to_email_render', 
//		'cusdon_pluginPage', 
//		'cusdon_pluginPage_section' 
//	);

	add_settings_field( 
		'cusdon_disable_css_handle', 
		__( 'Disable Plugin CSS', 'wordpress' ), 
		'cusdon_disable_css_render', 
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section' 
	);

	add_settings_field( 
		'cusdon_donate_image', 
		__( 'Donate image URL', 'wordpress' ), 
		'cusdon_donate_image_render',
		'cusdon_pluginPage', 
		'cusdon_pluginPage_section'  
	);
}

function cusdon_give_to_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<textarea name='cusdon_settings[cusdon_give_to]' rows="10" cols="70" maxlength="1000" class='wide' required><?php if(isset($options['cusdon_give_to']))
	{echo $options['cusdon_give_to'];} ?></textarea>
	<?php
}

function cusdon_paypal_email_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='email' name='cusdon_settings[cusdon_paypal_email]' value='<?php if(isset($options['cusdon_paypal_email']))
	{echo $options['cusdon_paypal_email'];} ?>' class='wide' required>
	<?php
}

function cusdon_notification_to_email_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
		<input type='email' name='cusdon_settings[cusdon_notification_to_email]' value='<?php if(isset($options['cusdon_notification_to_email']))
		{echo $options['cusdon_notification_to_email'];} ?>' class='wide' required>
	<?php
}

function cusdon_notification_from_email_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='email' name='cusdon_settings[cusdon_notification_from_email]' value='<?php if(isset($options['cusdon_notification_from_email']))
	{echo $options['cusdon_notification_from_email'];} ?>' class='wide' required>
	<?php
}

function cusdon_notification_reply_to_email_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='email' name='cusdon_settings[cusdon_notification_reply_to_email]' value='<?php if(isset($options['cusdon_notification_reply_to_email']))
	{echo $options['cusdon_notification_reply_to_email'];} ?>' class='wide' required>
	<?php
}

function cusdon_organization_name_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='text' name='cusdon_settings[cusdon_organization_name]' value='<?php if(isset($options['cusdon_organization_name']))
	{echo $options['cusdon_organization_name'];} ?>' class='wide' required style=''>
	<?php
}

function cusdon_donate_image_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='text' name='cusdon_settings[cusdon_donate_image]' 
	value='<?php if(isset($options['cusdon_donate_image']))
	{echo $options['cusdon_donate_image'];} else{ echo("https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif");} ?>' class='wide'>
	<?php
}

function cusdon_disable_css_render(  ) { 

	$options = get_option( 'cusdon_settings' );
	?>
	<input type='checkbox' id='cusdon_disable_css' name='cusdon_settings[cusdon_disable_css]' 
	<?php checked( isset($options['cusdon_disable_css']), 1 ); ?> value='1'>
	<?php
}

function cusdon_settings_section_callback(  ) { 
	echo __( '', 'wordpress' );
}

function cusdon_options_page(  ) { 
	?>
	<form action='options.php' method='post'>
		<input type="hidden" name="destination" value="<?php echo admin_url('admin.php?page=cusdon_donations')?>"/>

		<div id='cusdon-admin'>
			<h2>TF Custom Paypal Donations<br>Setup Page</h2>
			<?php
			settings_fields( 'cusdon_pluginPage' );
			do_settings_sections( 'cusdon_pluginPage' );
			?> 
			</div>
			<div class='cusdon_form_section'> 
			<?php
			submit_button();
			?>
		</div>
	</form>
	<?php
}
?>