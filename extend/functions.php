<?php
/**
 * allard custon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package allard
 */

//includes
require get_template_directory() . '/extend/allard-post-types/Allard-Custom-Post-Types.php';



//functions
function allard_after_content(){
	
	echo "<p class='allard-disclaimer'>The Canadian Journal of Family Law/Revue Canadienne de Droit Familial
	is an academic legal publication. We do not provide legal services nor
	do we respond to questions of a legal nature. The content on this site
	is not intended to be a substitute or forum for legal advice.
	For legal advice, please contact your local Bar Society for lawyers
	who practice in your area. </p> ";
}

function allard_query_args($post_type, $posts_per_page, $cmb_volume, $cmb_issue ){
	//the Args   https://codex.wordpress.org/Class_Reference/WP_Query#Parameters
	//use post_per_page = -1 to show all posts
	
	return array(
    'post_type' => $post-type,
    'posts_per_page' => $posts_per_page,
    'meta_query' => array(
    	'volume_num' => array(key=>$cmb_volume),
    	'issue_num' => array(key=>$cmb_issue),
    	),
    'orderby' =>  array( 'volume_num' => 'DESC', 'issue_num' => 'ASC' ),
	);
}