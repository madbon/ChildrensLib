$(document).ready(function(){
	$("#content-slider").lightSlider({
	    loop:true,
	    keyPress:true,
	    item:5,
	    slideMargin: 10,
	    autoWidth: false

	});

	var overlay = document.getElementById("overlay");
	var viewer = new Viewer(overlay, {
        url: 'data-original',
        title: false,
        toolbar: false,
        fullscreen: true
      });

	viewer.show();

	var viewerContainer = document.getElementsByClassName("viewer-container")[0];
	viewerContainer = $(viewerContainer);
	viewerContainer.append('<div class="vSAction"><a class="vSPrev"></a><a class="vSNext"></a></div>');
	viewerContainer.on('click', '.vSPrev', function(){
		viewer.prev(true);
	});


	viewerContainer.on('click', '.vSNext', function(){
		viewer.next(true);
	});

	$(".thumbnail").click(function(el){
		var index = $(this).data("id");
		viewer.view(index);
	}); 

	$(document).on('click', '#readmore', function() {
		viewer.show();  
	});
});

