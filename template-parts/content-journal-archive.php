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

	//get the args for our query defined in extend/functions.php
	$args = allard_query_args('journal', -1, 'allard_volume', 'allard_issue');
  
    // The Query Results object
    $query_results_journals = new WP_Query( $args );

    //count the number of times the query is looped
    $q_counter = 0;
    
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
	<div class="entry-content">
   
    <?php
    // The Loop
    if ( $query_results_journals->have_posts() ) {
      echo '<div class="all-journal-archives">';
     

	while ( $query_results_journals->have_posts() ) {	
		if($q_counter==0){
		    //iterate the post variable forward once for the first iteration
			$query_results_journals->the_post();  
		  ?>
	  	  
		  	<div class="volume-summary">
   			  <h1>Past Issues</h1>
   			  <p>
   			  	<span>Canadian Journal of Family Law</span><br>
			  	Volume 1, Number 1, 1978 - <?php echo get_the_title() ?>
			  </p>
  			</div> 
  			
	<?php
			//sorted desc so the first result is the number of volumes
			$num_volumes = 1.0 * get_post_meta( get_the_ID(), 'allard_volume', true );
		  	//determine half of the volumes for layout reasons
			$half_volumes = $num_volumes/2.0;
		    //should yield 0.5 for odd numbers and 0 for even
			$is_even = ( $half_volumes - floor($half_volumes) ) == 0;

		}
		
	  	//keep track of the number of iterations for layout reasons
		$q_counter+=1;
		
	  //current volume number		
	  $volume_number= 1 * get_post_meta( get_the_ID(), 'allard_volume', true );

	  //build the divs for issues based on volume_number while the volume number is the same This is an accumulator to be used in the following divs.		
	  $issues = ""; 
     
		while( $volume_number==get_post_meta( get_the_ID(), 'allard_volume', true ) ){       
				$issues .=  '<li> <a href="' . get_the_permalink() .'" title="'. '">'. get_the_title() .  '</a></li>';      
				$query_results_journals->the_post();  //iterate the post variable forward 
		}
		?>
        
		<?php
	  
	  //create the divs for layout based on number of volumes not related to number of posts!
 
	  if($is_even){
		$div_break = $half_volumes;
	  }else{
		$div_break = floor($half_volumes);
	  }
	  
		if ( $volume_number == $num_volumes ) {
		  //write an opening div when its the most recent volume
					echo ' <div class="journal-archives journal-archives-left">';
				} elseif($volume_number == $div_break ) {
		  //write an opening div when at half volume mark
					echo ' <div class="journal-archives journal-archives-right">';
				}

		 ?>
	 <div class="a-journal">
	 	<div class="big-volume-number">
			Volume <?php echo $volume_number; ?>
	 	</div>
		<div class="volume-issues">
			<ul>
				<?php echo $issues; ?>
		 	</ul>    
		</div>
	</div>
<?php
   
   if ( $volume_number == ($div_break + 1)) {
		//write the closing div for  .journal-archives-left 
	 	echo ' </div>';
  	} elseif($volume_number == 1 ) {
	  //write the closing div for .journal-archives-right when the volume represents the final volume in the result, this is the first volume published.
		echo ' </div>';
   }
     
	}//end while have posts
    
	echo '</div>';//.all-journal-archives
	  
// have posts is false.
} else {
	echo 'The Archive for Jounral Volumes is currently empty. ';
}
  
  /* Restore original Post Data */
  wp_reset_postdata();

?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php allard_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
