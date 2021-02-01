<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Plugin Name: TF Custom Paypal Donations
* Description: A plugin to accept Paypal donations with giving details emailed to
* admin email account - shortcode: [tf-custom-paypal-donations]
* Version: 1.2.6 - Feb 1, 2021
*/

add_shortcode('tf-custom-paypal-donations', 'cusdon_donations');

function cusdon_donations() {
    $options = get_option( 'cusdon_settings' );

    if ( !isset($_POST['cusdon-submit'])) {
        ob_start();
        include('templates/donation-form.php');
        return ob_get_clean();
    }
    else {
        process_form_data();
        return;
    }
};

function cusdon_register_styles() {
    wp_enqueue_style('tf-custom-paypal-donations-styles', plugin_dir_url( __FILE__ ) . 'css/cusdonstyle.css' );
};

$options = get_option( 'cusdon_settings' );

if(!isset($options['cusdon_disable_css'])) {
	add_action('wp_enqueue_scripts','cusdon_register_styles');
};

include('cusdon-admin.php');
include('cusdon-admin-styles.php');

/**
 *  process_form_data
 *
 *  This function gets control with the $_POST variable that is
 *  sent when the user completes the Donation form.
 *
 *  This function will extract the relevant variables from the
 *  $_POST and then it will senf an email to the admin address
 *  with a summary of the transaction.
 *
 *  Then it will build a hidden form with the variables required
 *  by the paypal interface and then auto submit the form to Paypal.
 *
 *
*/
function process_form_data() {
    $options = get_option( 'cusdon_settings' ); // settings page variables
    global $cusdon_paypal_email;
    global $cusdon_org;

    ?>
    <style type="text/css">
      .cusdon-hide {
        visibility: hidden;
      }
      .gif-load {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        width: 100px;
       }
    </style>
    <?php

    // Send notification email with Name, Email Address and Giving Instructions
    $output[] = "Donor Name = " . $_POST["donor_name"];
    $output[] = "Email Address = " . $_POST["email_address"];

    if ($_POST["donation_instructions"] == "") {
        $_POST["donation_instructions"] = "Field left blank";
    }
    $output[] = "Giving Instructions = " . $_POST["donation_instructions"];
    $message = join("\r\n",$output);

    $cusdon_paypal_email = $options['cusdon_paypal_email'];
    $cusdon_org = $options['cusdon_organization_name'];

    $recipient = $options['cusdon_notification_to_email'];
    $subject = "Disbursement details for donation from: " . $_POST["donor_name"];
    $from = $options['cusdon_notification_from_email'];
    $replyto = $options['cusdon_notification_reply_to_email'];

    // Don't know how to build the headers variable -- use default
    //$headers = 'From: ' . $cusdon_paypal_email . ' <' . $from . '>' . "\r\n";
    //$headers .= 'Reply-To: ' . $cusdon_paypal_email . ' <' . $replyto . '>' . "\r\n";
    //echo "<br>org = " . $cusdon_org . "<br>";
    //echo "<br>from = " . $from . "<br>";
    //echo "<br>replyto = " . $replyto . "<br>";
    //echo "<br>headers = " . $headers . "<br>";

    // echo "<br>recipient = " . $recipient . "<br>";
    // echo "<br>subject = " . $subject . "<br>";
    // echo "<br>message = " . $message . "<br>";
    wp_mail( $recipient, $subject, $message );
    ?>

<!-- Now set up Paypal form  -->

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="cusdon-second-form-hide">

    <input type="hidden" name="business"
        value="<?php echo $cusdon_paypal_email; ?>">

    <input type="hidden" name="cmd" value="_donations">

    <!-- Specify details about the contribution -->
    <input type="hidden" name="item_name" value="<?php echo $cusdon_org; ?>">

    <input type="hidden" name="currency_code" value="USD">

    <!-- Say you don't want a note - notes dont work with recurring donations -->
    <input type="hidden" name="no_note" value="1">

    <!-- Do the payment button -->

    <input type="image" name="submit" class='cusdon-hide' id="btn"
    src="<?php echo $options['cusdon_donate_image']; ?>"
    alt="Donate">
    <img alt="" width="1" height="1" class='cusdon-hide'
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
    </form>

    <!-- Display loading gif - Everything on this screen will be moved down off screen
    except for the message and loading gif. This is to indicate to the user that something is going on while the paypal transaction starts up
    -->
    <div style="text-align: center";>
        <h2 class="cusdon-wait-hdr">Please wait while we contact PayPal</h2>
        <img src="<?php echo plugin_dir_url( __FILE__ );?>images/loading.webp" class="cusdon-wait-gif" alt="Loading" title="Loading"/>
    </div>
    <?php

// script: wait until page is loaded and then auto click the submit button

    echo "<script type='text/javascript'>
        console.log('We see the script!');
        window.onload = function() {
        document.getElementById('btn').click();
        }
    </script>";
}
