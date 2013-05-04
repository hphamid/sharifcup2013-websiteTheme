<div id="container">
	<? 
	$cattype="لیگ های مسابقه";
	$cattypeid=get_cat_ID($cattype);
	$arg=array('numberposts'=>'-1','category'=>$cattypeid,'post_type'=>'post','post_status'=>'publish');
	$posts=get_posts($arg);
	?>

	<ul id="lab-grid" class="clearfix">
	<?	if ( sizeof($posts)) 
		{ ?> 
		<?	foreach($posts as $post)
			{ $tobeecho = "";
				setup_postdata($post);
				if($post->post_title=='معرفی')
				{
					$image=get_the_post_thumbnail( $post->ID, array(400,210), array('class'=>'slide','title'=>$post->post_title));
					$categ=get_the_category();
					
					foreach($categ as $category){
					  $ok = true;
					  foreach($categ as $cat2){
					    if($cat2->category_parent == $category->cat_ID){
					      $ok = false;
					    }
					  }
					  if($ok == true){
					    if($tobeecho == ""){
					    	$tobeecho='';
					    	if($category->category_parent!=$cattypeid ){
					    		$temp = get_category( $category->category_parent);
					    		$tobeecho = $temp->cat_name.": ";
					    	}
					      $tobeecho .= $category->cat_name;
					    }
					  }
					}
					?>
					<li class="tile" style="display: list-item;">
						<a href="<? echo the_permalink(); ?>" alt="<? echo $tobeecho; ?>">
							<? echo $image; ?>
						</a>
						<div class="small-caption">
							<span><? echo $tobeecho; ?></span>
						</div>
						<div class="js-overlay-caption-content" style="display:none">
							<h4><? echo $tobeecho; ?></h4>
							<p><? the_excerpt() ; ?>
					 			<a href="<? echo the_permalink(); ?>">ادامه</a>
							</p>
						</div>
					</li>
				<? }
			}
	 } 
	?>
	</ul>
</div><!--#container-->