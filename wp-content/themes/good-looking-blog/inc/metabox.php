<?php 
/**
* Good Looking Blog Metabox for Sidebar Layout
*
* @package Good_Looking_Blog
*
*/ 

function good_looking_blog_add_sidebar_layout_box(){
    $postID         = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $shop_id        = get_option( 'woocommerce_shop_page_id' );
    $template       = get_post_meta( $postID, '_wp_page_template', true );
    $page_templates = array( 'templates/contact.php' );
    /**
     * Remove sidebar metabox in shop page
    */
    if( ! in_array( $template, $page_templates ) && ( $shop_id != $postID )  ){
        add_meta_box( 
            'glb_sidebar_layout',
            __( 'Sidebar Layout', 'good-looking-blog' ),
            'glb_sidebar_layout_callback', 
            array( 'page','post'),
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'good_looking_blog_add_sidebar_layout_box' );

$glb_sidebar_layout = array(    
    'default-sidebar'=> array(
    	 'value'     => 'default-sidebar',
    	 'label'     => __( 'Default Sidebar', 'good-looking-blog' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/sidebar/general-default.jpg'
   	),
    'no-sidebar'     => array(
    	 'value'     => 'no-sidebar',
    	 'label'     => __( 'Full Width', 'good-looking-blog' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/sidebar/general-full.jpg'
    ),
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
    	 'label'     => __( 'Left Sidebar', 'good-looking-blog' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/sidebar/general-left.jpg'         
    ),
    'right-sidebar' => array(
         'value'     => 'right-sidebar',
    	 'label'     => __( 'Right Sidebar', 'good-looking-blog' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/sidebar/general-right.jpg'         
     )    
);

function glb_sidebar_layout_callback(){
    global $post , $glb_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'glb_pro_sidebar_nonce' );
    ?>     
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'good-looking-blog' ); ?></em></td>
        </tr>    
        <tr>
            <td>
                <?php  
                    foreach( $glb_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_glb_sidebar_layout', true ); ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="glb_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />                               
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>
 <?php 
}

function good_looking_blog_save_sidebar_layout( $post_id ){
    global $glb_sidebar_layout;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'glb_pro_sidebar_nonce' ] ) || !wp_verify_nonce( $_POST[ 'glb_pro_sidebar_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
    
    $layout = isset( $_POST['glb_sidebar_layout'] ) ? sanitize_key( $_POST['glb_sidebar_layout'] ) : 'default-sidebar';

    if( array_key_exists( $layout, $glb_sidebar_layout ) ){
        update_post_meta( $post_id, '_glb_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, '_glb_sidebar_layout' );
    }
      
}
add_action( 'save_post' , 'good_looking_blog_save_sidebar_layout' );