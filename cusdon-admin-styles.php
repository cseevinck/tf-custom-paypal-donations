<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
add_action('admin_head', 'cusdon_custom_styles');
add_action('admin_head', 'cusdon_custom_scripts');

function cusdon_custom_styles() {
  echo '<style>
    #cusdon-admin {
      background-color:#b5b5b5;
      margin-bottom: -50px! important; 
    }
    #cusdon-admin h2 {
      margin: 20px! important;
      padding-top: 20px! important;
    }
    #cusdon-admin input.wide {
      width:500px;
    }
    .cusdon_form_section {
      background-color:#b5b5b5; 
      margin-bottom:30px;
      padding:30px;
    }
    input[type=text] {
      background-image: none! important;
    }
    .form-table {
      margin: 20px;
  }
  </style>';
}

function cusdon_custom_scripts() {
  echo '
  <script>
    jQuery(document).ready(function($) {
      $(".cusdon_form_section .enable").each(function() {
        $row = $(this).closest("tr").siblings();
        
        if ($(this).is(":checked")) {
          console.log("show");
          $row.show();
        }
        else {
          console.log("hide");
          $row.hide();
        }
      });
    
      $(".cusdon_form_section .enable").click(function() {
        $row = $(this).closest("tr").siblings();
        $row.toggle();
      });
    });
  </script>';
}
?>