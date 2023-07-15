
/** Insert Loan Estimated form data **/
function enqueue_scripts() {
    // Enqueue jQuery library
    wp_enqueue_script('jquery');
    // Enqueue your custom script
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom_scripts.js', array('jquery'), '1.0', true);
    // Pass the AJAX URL to the script
    wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

add_action( 'wp_ajax_nopriv_add_new_user', 'add_new_user' );
add_action( 'wp_ajax_add_new_user', 'add_new_user' );

function add_new_user(){
    if (isset( $_POST['estimate_debt'] ) ) {
        // echo "Helloooooooo";
        global $wpdb;
        
        $fname = sanitize_text_field($_POST["fname"]);
        $lname = sanitize_text_field($_POST["lname"]);
        $email = sanitize_text_field($_POST["eml"]);
        $phn = intval($_POST["phn"]);
        $estimate_debt = sanitize_text_field($_POST["estimate_debt"]);
        $current_pay = sanitize_text_field($_POST["current_pay"]);
        $tableName = 'Sxrt2X_loan_estimate';
        
        $insert_row = $wpdb->insert( 
                $tableName, 
                array( 
                    'first_name' => $fname, 
                    'last_name' => $lname, 
                    'phone_number' => $phn, 
                    'email' => $email,
                    'estimated_combined_debt' => $estimate_debt,
                    'current_on_payments' => $current_pay,
                )
            );
        // if row inserted in table
        
        if($insert_row){
            echo json_encode(array('res'=>true, 'message'=>'Thanks! your request has been placed. our excutive will contact soon'));
        }else{
            echo json_encode(array('res'=>false, 'message'=>'Something went wrong. Please try again later.'));
        }
        wp_die();
    }
}
