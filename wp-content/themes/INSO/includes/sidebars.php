<?php
function truethemes_widgets_init() {
register_sidebar( );
add_action( 'widgets_init', 'truethemes_widgets_init' );
}
global $insoxin;
if($insoxin['switch_wow']) { $wow = 'wow bounceInUp'; }
if($insoxin['switch_triangle']) { $triangle = 'triangle'; }
if(isset($insoxin['sidebars'])){
    $dynamic_sidebar = $insoxin['sidebars'];
    if(!empty($dynamic_sidebar))
    {
        foreach($dynamic_sidebar as $key=>$sidebar)
        {
            if ( function_exists('register_sidebar') && ($sidebar <> ''))
            register_sidebar(
            array(
                'name'          => str_replace("_"," ",$sidebar),
                'id'            =>'sidebar-'.($key+1),
                'description'   => esc_html__( '动态边栏工具','insoxin' ),
                'before_title'  =>'<div class="sidebar_title"><h3>',
                'after_title'   =>'</h3></div>',
                'before_widget' => '<article   id="%1$s" class="sidebar_widget box %2$s '.$wow.' '.$triangle.'">',
                'after_widget'  => '</article>',
            ));
        }
    }

}
?>