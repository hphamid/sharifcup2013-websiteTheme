<?
global $page, $paged;
wp_title( '|', true, 'right' );
echo bloginfo( 'name' );

$site_description = get_bloginfo( 'description', 'display' );

if ( $site_description && ( is_home() || is_front_page() ) )

echo " | $site_description";

if ( $paged >= 2 || $page >= 2 )

echo ' | ' . sprintf(  __('page %s','seminar'), max( $paged, $page ) );?>