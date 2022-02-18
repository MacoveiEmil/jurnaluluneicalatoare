<?php
/**
 * Active Callback
 * 
 * @package Good_Looking_Blog
*/

if ( ! function_exists( 'good_looking_blog_banner_ac' ) ) :
/**
 * Active Callback for Banner Slider
*/
function good_looking_blog_banner_ac( $control ){
    $banner           = $control->manager->get_setting( 'ed_banner_section' )->value();
    $control_id       = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_content' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_two_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_btn_two_link' && $banner == 'static_banner' ) return true;
    
    return false;
}
endif;