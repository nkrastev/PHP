<?php
//hide category by name and by ID
add_action( 'woocommerce_product_query', 'ts_custom_pre_get_posts_query' );
function ts_custom_pre_get_posts_query( $q ) 
{
	$tax_query = (array) $q->get( 'tax_query' );
	$tax_query[] = array(
	'taxonomy' => 'product_cat',
	'field' => 'slug',
	'terms' =>array( 'Item1','Item2'), // Don't display products these categories
	'operator' => 'NOT IN'
	);
	$q->set( 'tax_query', $tax_query );
}

add_filter( 'woocommerce_product_categories_widget_args', 'woo_product_cat_widget_args' );
function woo_product_cat_widget_args( $cat_args ) {
	$cat_args['exclude'] = array('000001'); //dont display the categories in widgets from these IDs, replace IDs
	return $cat_args;
}

?>
