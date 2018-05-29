var categories;
var books;
var count = 0;
var lastCount;

$(function(){
  $("#lo").show();
	$.ajax({
		type: 'GET',
		url: 'http://localhost/childrenslibrarywithyii/web/index.php?r=searchbook%2Fcategories'
	}).done(function(data){
		categories = JSON.parse(data);
		var html = "";
		for(var i = 0; i < 5; i++) {
			html += htmlBuilder(categories[i]['name'], categories[i]['image']);	
		}
		$(".content4").html(html);
		createPagination();
	});


  $.ajax({
    type: 'GET',
    url: 'http://localhost/childrenslibrarywithyii/web/index.php?r=searchbook%2Ffirstbooks'
  }).done(function(data){
    var html = "";
    books = JSON.parse(data);
    lastCount = 0;
    for(var i = 0; i < books.length; i++) {
        count++;
        lastCount++;
        if (i == 0 || i == 3) {

           html += '<div style="height: 140px; padding: 0px 0px 0px 40px">';
        }
        html += '<div style="padding: 10px 30px; width: 30%; height: 140px; display: inline-block;">';
        html += '<div style="height: 80px;">';
        var src = imageExists(books[i]['image']) ? books[i]['image'] :'http://localhost/childrenslibrarywithyii/web/upload_bookcover/genericBookCover.jpg';
        html += '<img src="' + src +'" style="width: 100%; height: 80px;"></div>'
        html += '<div style="text-align: center; font-size: 10px">' + books[i]['title']  +'</div>';
        html += '<div style="text-align: center; font-size: 10px">' + books[i]['author']  +'</div></div>';

        if (i == 2 || i == 5) {
           html += '</div>';
        }
    }
    $("#lo").hide();
    html += '<div id="lo" style="display: none; width: 100%; height: 280px; padding: 70px 0; background-color: rgba(0,0,0,.9);"><div class="loader" style="margin-left: auto; margin-right: auto"></div></div></div>';
    $("#bookscon").html(html);
  });


	$(document).on("click", "#next", function(){
    var loader = '<div id="lo" style="display: none; width: 100%; height: 280px; padding: 70px 0; background-color: rgba(0,0,0,.9);"><div class="loader" style="margin-left: auto; margin-right: auto"></div></div></div>';
    $("#bookscon").html(loader);
    $("#lo").show();
      $.ajax({
        type: 'GET',
        url: 'http://localhost/childrenslibrarywithyii/web/index.php?r=searchbook%2Fgetbooksbyoffset',
        data: {offset : count}
      }).done(function(data){
          var html = "";
          books = JSON.parse(data);
          lastCount = 0;
          for(var i = 0; i < books.length; i++) {
              count++;
              lastCount++;
              if (i == 0 || i == 3) {

                 html += '<div style="height: 140px; padding: 0px 0px 0px 40px">';
              }
              html += '<div style="padding: 10px 30px; width: 30%; height: 140px; display: inline-block;">';
              html += '<div style="height: 80px;">';
              var src = imageExists(books[i]['image']) ? books[i]['image'] :'http://localhost/childrenslibrarywithyii/web/upload_bookcover/genericBookCover.jpg';
              html += '<img src="' + src +'" style="width: 100%; height: 80px;"></div>'
              html += '<div style="text-align: center; font-size: 10px">' + books[i]['title']  +'</div>';
              html += '<div style="text-align: center; font-size: 10px">' + books[i]['author']  +'</div></div>';

              if (i == 2 || i == 5) {
                 html += '</div>';
              }
          }
        $("#lo").hide();
        html += '<div id="lo" style="display: none; width: 100%; height: 280px; padding: 70px 0; background-color: rgba(0,0,0,.9);"><div class="loader" style="margin-left: auto; margin-right: auto"></div></div></div>';
        $("#bookscon").html(html);
      });
    
		
	});

  $(document).on("click", "#prev", function(){
    var loader = '<div id="lo" style="display: none; width: 100%; height: 280px; padding: 70px 0; background-color: rgba(0,0,0,.9);"><div class="loader" style="margin-left: auto; margin-right: auto"></div></div></div>';
    $("#bookscon").html(loader);
    $("#lo").show();
    count = count - (lastCount + (count - lastCount));

    $.ajax({
        type: 'GET',
        url: 'http://localhost/childrenslibrarywithyii/web/index.php?r=searchbook%2Fgetbooksbyoffset',
        data: {offset : count}
      }).done(function(data){
          var html = "";
          books = JSON.parse(data);
          lastCount = 0;
          for(var i = 0; i < books.length; i++) {
              count++;
              lastCount++;
              if (i == 0 || i == 3) {

                 html += '<div style="height: 140px; padding: 0px 0px 0px 40px">';
              }
              html += '<div style="padding: 10px 30px; width: 30%; height: 140px; display: inline-block;">';
              html += '<div style="height: 80px;">';
              var src = imageExists(books[i]['image']) ? books[i]['image'] :'http://localhost/childrenslibrarywithyii/web/upload_bookcover/genericBookCover.jpg';
              html += '<img src="' + src +'" style="width: 100%; height: 80px;"></div>'
              html += '<div style="text-align: center; font-size: 10px">' + books[i]['title']  +'</div>';
              html += '<div style="text-align: center; font-size: 10px">' + books[i]['author']  +'</div></div>';

              if (i == 2 || i == 5) {
                 html += '</div>';
              }
          }
        $("#lo").hide();
        html += '<div id="lo" style="display: none; width: 100%; height: 280px; padding: 70px 0; background-color: rgba(0,0,0,.9);"><div class="loader" style="margin-left: auto; margin-right: auto"></div></div></div>';
        $("#bookscon").html(html);
      });
  });



});



function htmlBuilder(catname, imgSrc) {
   var html = '<div>';
       html += '<div style="border: 1px solid red; border-radius: 40px; width:60px; display: inline-block; margin: 10px;">'
       var src = imageExists(imgSrc) ? imgSrc : 'http://localhost/childrenslibrarywithyii/web/upload_categoryimages/default_product.gif';
       html += '<img src="' + src +'" style="width: 100%; height: 100%; border-radius: 40px;">';
       html += '</div>';
       var fontsize = catname.length > 7 ? 12 : 16;
       html += '<label style="font-size:' + fontsize +'px;">' + catname + '</label>';
       html += '</div>';

   return html;
}




function createPagination() {
	var pagesNum = (categories.length % 5) != 0 ? ((categories.length / 5) + 1) : (categories.length / 5);
	$('.demo4_bottom').bootpag({
        total: pagesNum,
	    page: 1,
	    maxVisible: 2
    }).on("page", function(event, num){
        var set = num * 5;
        var html = "";
        	for(var i = (set - 5); i < set; i++) {
        		console.log(i);
        	   if(i < categories.length) {
        	   	html += htmlBuilder(categories[i]['name'], categories[i]['image']);	
        	   }	
			}
		$(".content4").html(html);
    });
}

function imageExists(image_url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', image_url, false);
    http.send();
    if (http.status != 404) {
      return(image_url.match(/\.(jpeg|jpg|gif|png)$/) != null);
    } else {

      return false;
    }
}
