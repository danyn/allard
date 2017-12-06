<?php 
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}



add_action( 'cmb2_admin_init', 'allard_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function allard_register_metabox() {
	$prefix = 'allard_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_allard = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'journal', 'cmb2' ),
		'object_types'  => array( 'journal' ), // Post type
	) );
	
	
	$cmb_allard->add_field( array(
		'name' => esc_html__( 'Year', 'cmb2' ),
		'desc' => esc_html__( 'Year of publication', 'cmb2' ),
		'id'   => $prefix . 'year',
		'type' => 'text_small',
	) );
	


	$cmb_allard->add_field( array(
		'name' => esc_html__( 'Volume', 'cmb2' ),
		'desc' => esc_html__( 'Volume Number', 'cmb2' ),
		'id'   => $prefix . 'volume',
		'type' => 'text_small',
	) );
	
	
	$cmb_allard->add_field( array(
		'name' => esc_html__( 'Number', 'cmb2' ),
		'desc' => esc_html__( 'The issue number within a given Volume', 'cmb2' ),
		'id'   => $prefix . 'issue',
		'type' => 'text_small',
	) );
	


	$cmb_allard->add_field( array(
		'name'    => esc_html__( 'Synopsis - Articles, Essay Contest Winner, Book Review', 'cmb2' ),
		'desc'    => esc_html__( 'Synopsis of the journal issue without any abstracts', 'cmb2' ),
		'id'      => $prefix . 'wysiwyg',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 25,
		),
	) );

}