<?php
/**
 * Template part for displaying the archive page for journals.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package allard
 */ 

?>

<?php

   //the Args   https://codex.wordpress.org/Class_Reference/WP_Query#Parameters
    $args = array(
    'post_type' => 'journal',
    'posts_per_page' => -1,//show all posts and on one page
    'meta_query' => array(
      'volume_num' => array(key=>'allard_volume'),
      'issue_num' => array(key=>'allard_issue'),
      ),
    'orderby' =>  array( 'allard_volume' => 'DESC', 'allard_issue' => 'ASC' ),
  
);   
  
    // The Query Results object
    $query_results_journals = new WP_Query( $args );

    //count the number of times the query is looped
    $q_counter = 0;
    
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php echo __FILE__ . 'hello from file' ?>

	<header class="entry-header">
		THE HEADER
	</header><!-- .entry-header -->

	<div class="entry-content">
    <?php
    // The Loop
    if ( $query_results_journals->have_posts() ) {
      echo '<div class="all-journal-archives">';
     

	while ( $query_results_journals->have_posts() ) {
        //set up some variables
		
		if($q_counter==0){
			$query_results_journals->the_post();  //iterate the post variable forward once for the first iteration
      $num_volumes = 1 * get_post_meta( get_the_ID(), 'allard_volume', true );//sorted desc so the first result is the number of volumes
      $half_volumes = $num_volumes/2.0;
      //$is_even = ( $half_posts - floor($half_posts) ) == 0;
      if($is_even){echo "even";}else{echo "false";}
      echo 'there are this many volumes: ' . $num_volumes;
      echo 'half of the volumes is : ' . $half_volumes;
		}

		$q_counter+=1;
		
    $volume_number= 1 * get_post_meta( get_the_ID(), 'allard_volume', true );//current volume number
    $issues = ""; 
        
        //build the divs based on volume_number while the volume number is the same.
        while( $volume_number==get_post_meta( get_the_ID(), 'allard_volume', true ) ){       
            $issues .=  '<li> <a href="' . get_the_permalink() .'" title="'. '">'. get_the_title() .  '</a></li>';      
            $query_results_journals->the_post();  //iterate the post variable forward 
        }//endwhile for  divs based on volume_number
        ?>
        
        <?php

        if ( $volume_number == $num_volumes ) {
              echo ' <div class="journal-archives-left">';
            } elseif($volume_number == floor($half_volumes) ) {
              echo ' <div class="journal-archives-right">';
            }

         ?>
       <div class="a-journal">
                 <div class="big-volume-number">
                    Volume 
                     <?php echo $volume_number; ?>
                 </div>
                 <div class="volume-issues">
                     <ul>
                        <?php echo $issues; ?>
                     </ul>    
                </div>
        </div>
<?php
             if ( $volume_number == ceil($half_volumes)) {
              echo ' </div>';
            } elseif($volume_number == 1 ) {
              echo ' </div>';
            }
     
	}//end while have posts
    
	echo '</div>';//.all-journal-archives

} else {
	echo 'The Archive for Jounral Volumes is currently empty. ';//what to say when if have posts is false.
}
  
  /* Restore original Post Data */
  wp_reset_postdata();

	?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php allard_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
