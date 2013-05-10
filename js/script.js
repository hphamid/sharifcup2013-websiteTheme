/***********************Tile******************/
var BD = {

	init: function(){},

	setupLabGrid: function(container){
		
		$(container).jsquares({
			js_image: 'li', // target (div) holding info
			js_caption: '.small-caption', // target caption
			js_caption_overlay_spacing: 4, // caption overlay padding/spacing... sort of
			js_caption_width: 400, // caption overlay width
			js_caption_height:210, // caption overlay height
			js_shuffle_in: false, // have the pictures all fade in on page load?
			js_fade_on_hover: true, // do we want the images to fade on hover or just change opacity?
			js_caption_slide_down: true // do we want the caption to slide down or just appear?
		});
		
	}
	
}
/*********************init*********************/	
$(document).ready(function(){		
			activateslider();
			activatetile();
			activatenews();
			makembutton();
			preventlinks();
	var oldhash = location.hash;
	if(oldhash!="")
	{
		hashchange(oldhash);
	}
	//if (ajax==0)
		//showajax();
	setInterval(function(){
	  if(location.hash !== oldhash){
	    oldhash = location.hash;
		hashchange(oldhash);
	  }
	}, 300);
	var menu= $('#cmenu').get(0);
	var topmenu= $('#topmenu').get(0);
	$(window).scroll(function(){
		//document.title=$(topmenu).offset().top<=$(window).scrollTop()
		if($(topmenu).offset().top<=$(window).scrollTop())
			{
				$(menu).removeClass('cmenu');
				$(menu).addClass('mfixed');
			}
		else{
			$(menu).removeClass('mfixed');
			$(menu).addClass('cmenu');
		}
	})
});
function activateslider()
{
	var buttons = { previous:$('#jslidernews3 .button-previous') ,
						next:$('#jslidernews3 .button-next') };
		$('#jslidernews3').lofJSidernews( { interval:5000,
											 	easing:'easeOutBounce',
												duration:1200,
												auto:true,
												mainWidth:940,
												mainHeight:450,
												navigatorHeight		: 100,
												navigatorWidth		: 310,
												maxItemDisplay:3,
												buttons:buttons} );					
}
function preventlinks()
{
	$('#menu-item-39,#menu-item-41,#menu-item-45,#menu-item-122').children('a').click(function(event){ //preventing leage clicks
  event.preventDefault();
	});
}
function activatenews()
{
	$("#news").msAccordion({vertical:true});
}
function activatetile()
{
	BD.init();
	BD.setupLabGrid('#lab-grid');
}
function makembutton(){
	$('.melement').mousedown(function(){
		$(this).addClass('melementClicked')
	})
	$('.melement').mouseup(function(){
		$(this).removeClass('melementClicked')
	})
	$('.melement').mouseout(function(){
		$(this).removeClass('melementClicked')
	})
}
/******************AJAX********************/
function hashchange(hash){
	ajax=1;
	$("#loading").show(700)
	var address="";
	if(location.search)
		address='http://'+location.host+location.pathname+location.search+hash.replace("#!","&");
	else
		address='http://'+location.host+location.pathname+hash.replace("#!","?");
	//document.title=address;
	document.title='loading...';
	$.post(address,{AJAX:"true"},function(data){
		$('#ajax').fadeOut(600,function(){
			$('#ajax').html(data);
			$('#ajax').hide();
			$('#ajax').fadeIn(600,function(){
				ajax=0;
				try
				{
					loadjavascript();
				}
				catch(err)
				{
					;
				}
			if($('#slider'))
			{
				activateslider();
				activatetile();
				activatenews();
			}
			})
			$.post(address,{AJAX:"true",title:"true"},function(data){
			document.title=data;
			$("#loading").hide(500)
			})
		})
	})
}