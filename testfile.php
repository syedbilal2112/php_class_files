

<?php
class server {
    public function __construct() {
        // Example for adding script.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_example' ) );
        add_action( 'wp_ajax_ajax_file_import', array( $this, 'ajax_import_example' ) );
    }

    public function enqueue_example() {
        wp_register_script(
            'example-js',
            FILE_URL,
            array(),
            VERSION,
            false
        );
        wp_enqueue_script( 'example-js' );

        $data = array(
            'import_nonce'  => wp_create_nonce( 'ajax_file_import_nonce' ),
        );

        wp_localize_script( 'example-js', 'localizedData', $data );
    }

    public function ajax_import_example() {
        check_ajax_referer( 'ajax_file_import_nonce' );

        $raw_content = array();
        $i = 0;
        while ( isset( $_FILES[ 'file_' . $i ] ) ) {
            $file_arr = $_FILES[ 'file_' . $i ];
            $file_content = file_get_contents( $file_arr['tmp_name'] );
            $raw_content[]  = json_decode( $file_content );
            $i++;
        }

        $new_data = array();
        // Do Stuff with new data.
        update_option( 'example_database', $new_data );

        // (OPTIONAL) Add data to return to AJAX Success
        $rtn_data = array(
            'action'               => 'apl_import',
            '_ajax_nonce'          => wp_create_nonce( 'alt_ajax' ),
        );
        echo json_encode( $rtn_data );
        // END (OPTIONAL).

        die();
    }
}
?>