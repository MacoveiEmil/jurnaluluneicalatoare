<?php
/**
 * Active Callback
 * 
 * @package Best_Recipe
*/

function best_recipe_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;

    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'category' ) return true;
    if ( $control_id == 'slider_pages' && $banner == 'slider_banner' && $slider_type == 'pages' ) return true;

    return false;
}