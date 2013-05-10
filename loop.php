<?
	include "googleanalytics.php";
	if(is_home())
	{
		get_template_part( 'loop', 'slider' );
		get_template_part( 'loop', 'tile' );
		get_template_part( 'loop', 'news' );
	}
	else
	{ 
		if((!is_page()&&in_category('لیگ های مسابقه')))
		{
			get_template_part( 'loop', 'leage' );
		}
		else
		{
			get_template_part( 'loop', 'list' );
		} 
	}
?>
