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
                        <div class="newsTitle">
                            <a href = "<? echo the_permalink(); ?>">
                                <?
                                if ( has_post_thumbnail()) {
                                    $image=wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                    $tobeecho = $image=get_the_post_thumbnail( $post->ID, array(30,30), array('class'=>'newsImage',style=>"position: relative; top:-2px;"));
                                ?>
                                    <span style="float:right ; width:auto;text-align: center;">
                                        <? echo $tobeecho ?>
                                        <? echo $post->post_title ;?>
                                    </span>
                                <?
                                }
                                else{?>
                                    <? echo $post->post_title ;?>
                                <?
                                }
                                ?>
                            </a>
                            <span class = "ndate">
                                <? echo $post->post_date ;?>
                            </span>
                        </div>
                        <div class="newsContent"><? the_excerpt() ; ?></div>
                    </div>
                    <?
                    $c++;
                }
            }
        }
    ?>
</div>
