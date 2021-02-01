<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

$admin_post_url = esc_url( admin_url("admin-post.php"));

?>
<!-- The below form will collect the donor's name and email and the giving 
     instructions. After submission of the form, "process_form_data" in cusdon-donations.php will get control. There a Paypal request form will 
     and that form will be auto submitted. The admin will need to reconcile 
     the email details with the paypal transactions. There is a chance that
     user will not complete the paypal transaction which will result in an 
     orphan email which could be used to reach out to the user to offer help.
-->

<!-- Display user instructions on how donations are done (replace cr/nl with <br>) -->   
<div class="cusdon-instructions"><?php echo nl2br($options['cusdon_how_to']); ?></div>

<form method="POST" action="" class='cusdon-donations-form donation-form'>
    <input name="cusdon-submit" type="hidden" value="Submit" />
 <?php 
    if (empty($options['cusdon_paypal_email'])) {
        die('Paypal email unavailable');
    }

    if (empty($options['cusdon_organization_name'])) {
        die('Organization name unavailable');
    }
?>
    <!-- Fields for Donor name, email addr and Donation instructions
      for transaction email -->
    <table>
      <tr>
        <td>
          <input type="text" name="donor_name" class="cusdon-field" maxlength="200" placeholder= "Your Name" required>
        </td>
      </tr>
      <tr>
        <td>
          <input type="email" name="email_address" class="cusdon-field" maxlength="200"  placeholder= "Your Email Address" required>
        </td>
      </tr>
      <tr>
        <td>
          <textarea name="donation_instructions" class="cusdon-field" rows="5" cols="60" maxlength="500" placeholder= "Donation Instructions - General Fund will be used if this field is left empty"></textarea>
        </td>
      </tr>
      <tr>
        <td>
          <!-- now the submit button -->
           <input type="image" src="<?php echo $options['cusdon_donate_image']; ?>"  alt="PayPal - The safer, easier way to pay online!" >
        </td>
      </tr>
    </table>
</form>