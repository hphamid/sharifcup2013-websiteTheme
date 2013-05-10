<?
$cattype="news";
$count=100;
$cattypeid=get_cat_ID($cattype);
$arg=array('numberposts'=>'-1','category'=>$cattypeid,'post_type'=>'post','post_status'=>'publish');
$posts=get_posts($arg);
?>
<div id="news" class="accordionWrapper">
    <?
        $c=1;
        if ( sizeof($posts)) 
            { 
            foreach($posts as $post)
            {   
                if ($c<=$count)
                { setup_postdata($post);
                    ?>
                    <div class="set set<? echo $c ?>">
                        <div class="newsTitle"><a href = "<? echo the_permalink(); ?>"><? echo $post->post_title ;?></a> <span class = "ndate"><? echo $post->post_date ;?></span></div>
                        <div class="newsContent"><? the_excerpt() ; ?></div>
                    </div>
                    <?
                    $c++;
                }
            }
        }
    ?>
</div>