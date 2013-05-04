<? 
$cattype="slider";
$count=100;
$cattypeid=get_cat_ID($cattype);
$arg=array('numberposts'=>'-1','category'=>$cattypeid,'post_type'=>'post','post_status'=>'publish');
$posts=get_posts($arg);
?>
<div class="mc slider">
	<div id="jslidernews3" class="lof-slidecontent" >
		<div class="preload"><div></div></div>
		<div  class="button-previous">Previous</div>
		 <!-- MAIN CONTENT --> 
			<div class="main-slider-content" style="width:940px; height:450px;">
				<ul class="sliders-wrap-inner">
				<?
				$c=0;
				if ( sizeof($posts)) 
				{ 
					foreach($posts as $post)
					{ 
						if ($c<$count)
						{ setup_postdata($post);
						$image=get_the_post_thumbnail( $post->ID, array(940,450), array('class'=>'slide','title'=>$post->post_title));
						if(1)
						{echo '<li>';
						echo $image;
						$c++;
						echo '</li>';
						}
						}
					}
				}
				?>
				</ul>  	
			</div><!--main-slider-content-->
		<!-- END MAIN CONTENT --> 
		<!-- NAVIGATOR -->
			<div class="navigator-content">
				<div class="navigator-wrapper">
				</div><!--navigator-wrapper-->
   
			</div><!--navigator-content--> 
          <!----------------- END OF NAVIGATOR --------------------->
		<div class="button-next">Next</div>
	</div><!--jslidernews3-->
</div><!--mc-->