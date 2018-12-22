$(function(){
	$("a[rel='example_group']").fancybox({
	  'transitionIn':'elastic',
	  'transitionOut':'fade',
	  'titlePosition':'over',
	  'titleFormat': function(title,currentArray,currentIndex,currentOpts){
	    return '<span id="fancy-title-over">Image'+(currentIndex+1)+'/'+curenntArray.length+(title.length?'&nbsp;'+title:'')+'</span>';
	  }
	});
});

