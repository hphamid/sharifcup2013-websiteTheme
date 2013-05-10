<?
/*
*this file is for changing page color with category
*
*/
 //in this part I try to find league!
$categories=get_the_category();
foreach($categories as $category){
  $ok = true;
  foreach($categories as $cat2){
    if($cat2->category_parent == $category->cat_ID){
      $ok = false;
    }
  }
  if($ok == true&&((!is_category())||is_category($category->cat_ID))){
    if(!isset($league)){
      $league = array('name' => $category->cat_name, 'id' => $category->cat_ID);
    }
    else
      { 
        $league = '';
      }
  }
}
$color = array(12=>'rgb(197,0,181)',
               14=>'rgb(7,109,149)',
               15=>'rgb(7,109,149)',
               10=>'rgb(119,192,67)',
               8=>'rgb(248,236,38)',
               9=>'rgb(248,236,38)',
               18=>'rgb(0,216,242)',
               19=>'rgb(0,216,242)',
              );
?>
<script type="text/javascript">
      $(document).ready(function(){
        jQuery("#ajax").append("<style>body{"
          +"background-image:url(\"<?echo get_template_directory_uri() ?>/timthumb.php?src=./images/backgroundall.jpg&w="+$(window).width()+"&h="+$(window).height()+"&q=80\");"
          +"}"
          +"</style>"
          );
      });
</script>
<style>
body{
  background-color: <? echo $color[$league['id']] ?>;
}
.leftmenue{
  background-image: url('<? echo get_template_directory_uri(); ?>/images/small/<? echo $league["id"]?>.jpg');
}
</style>