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
$color = array(12=>'rgb(120,0,120)',
               14=>'rgb(7,109,149)',
               15=>'rgb(7,109,149)',
               10=>'rgb(37,162,73)',
               8=>'rgb(255,222,0)',
               9=>'rgb(255,222,0)',
               18=>'rgb(150,2,150)',
               19=>'rgb(20,150,110)',
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