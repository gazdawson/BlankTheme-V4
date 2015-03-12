//HASHTAG URL - USE THIS URL FOR HASHTAG PICS
//var start_url = "https://api.instagram.com/v1/tags/"+hashtag+"/media/recent/?access_token="+access_token;
//USER URL - USE THIS URL FOR USER PICS
var start_url = "https://api.instagram.com/v1/users/"+user_id+"/media/recent/?access_token="+access_token;

//https://api.instagram.com/v1/tags/racehungry/media/recent?access_token=1836…6303057241113856435_1395676110362&_=1395676128688&max_tag_id=1343521624608

function loadEmUp(next_url) {

	//console.log("loadEmUp url:" + next_url);
	url = next_url;

	$(function() {
		$.ajax({
		type: "GET",
		dataType: "jsonp",
		cache: false,
		url: url ,
			
		success: function(data) {

			next_url = data.pagination.next_url;
			//count = data.data.length;
			//three rows of four
			count = 50; 

			//uncommment to see da codez
			//console.log("count: " + count );
			//console.log("next_url: " + next_url );
			//console.log("data: " + JSON.stringify(data) );

			for (var i = 0; i < count; i++) {
				if (typeof data.data[i] !== 'undefined' ) {
					//console.log("id: " + data.data[i].id);
					$("#instagram").append("<div class='instagram-wrap' id='photo' ><a target='_blank' class='instagram-link' href='" + data.data[i].link +"'><span class='likes-comments'><i class='fa fa-heart'></i> "+data.data[i].likes.count +"<i class='fa fa-comment'></i> "+ data.data[i].comments.count+"</span><img class='instagram-image' src='" + data.data[i].images.low_resolution.url +"' /></a></div>");  
				}  
			}     

			console.log("next_url: " + next_url);
			$("#showMore").hide();
			if (typeof next_url === 'undefined' || next_url.length < 10 ) {
				console.log("NO MORE");
				$("#showMore").hide();
				$( "#more" ).attr( "next_url", "");
			}


			else {
				//set button value
				console.log("displaying more");
				$("#showMore").show();
				$( "#more" ).attr( "next_url", next_url);
				last_url = next_url;

			}
			}
		});
	});
}


//CALL THE SCRIPT TO START...
$( document ).ready(function() {

	//APPEND LOAD MORE BUTTON TO THE BODY...
	$("#more" ).click(function() {
		var next_url = $(this).attr('next_url');
		loadEmUp(next_url);
		return false;
	});

	//start your engines
	loadEmUp(start_url);
});