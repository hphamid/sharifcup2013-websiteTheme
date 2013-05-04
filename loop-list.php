<div class="list">
	<?php 	
	
	if ( ! have_posts() ) : ?>
	<div class="rtext">
		<h1 class="title">
        پیدا نشد!!
        </h1>
		<div class="textcontent">
			<p>
            متاسفانه مطلب مورد نظر پیدا نشد شاید با جستجوی کلمات مشابه بتوانید مطلب مورد نظر خود را پیدا کنید
            </p>
		</div><!-- .entry-content -->
		</div>
		<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="rtext">
		<div class="titlem"><a href="<?php  echo the_permalink(); ?>">
			<? the_title(); ?></a>
            	</div><!--titlem-->		
		<div class="textcontent">
			<?php the_content( __( 'ادامه ی مطلب <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( 'ویرایش'); ?>
		</div><!-- .content --></div><!-- #post-## -->
<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav" class="navigation">
					<div class="nav-previous"><?php next_posts_link(  '<span class="meta-nav">&larr;</span> مطالب قدیمی تر '); ?></div>
					<div class="nav-next"><?php previous_posts_link(  'مطالب جدیدتر <span class="meta-nav">&rarr;</span>'); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
</div>