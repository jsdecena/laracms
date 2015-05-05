var defaultFeatureImg = 'http://www.sendahpinoy.local/uploads/no-photo.jpg';

$(document).ready(function(){
	//POP UP A CONFIRM BOX ON A DELETE LINK
	$('#delete a.btn-danger').on('click', function(){
		
		var danger = confirm("Are you sure you want to delete?");
		
		if ( danger == true) {
			removePostFeatureImg();
			ajax_PostFeatureImg( 'remove' );
		    return true;
		} else {
		    return false;
		}
	});	

	$('#status a.btn-danger').on('click', function(){
		
		var danger = confirm("Enable?");
		
		if ( danger == true) {
		    return true;
		} else {
		    return false;
		}
	});

	$('#status a.btn-success').on('click', function(){
		
		var danger = confirm("Disable?");
		
		if ( danger == true) {
		    return true;
		} else {
		    return false;
		}
	});	
});

$(window).load(function(){

	$('.treeview-menu li a').on('click', function(){

		//CLEARS CONTENT FIRST BEFORE APPENDING
		$('#content-wrap').html('');
		
		//SET THE CONTENT URL
		var url = $(this).attr('href');
			url += " #content-body";

			$( "#content-wrap" ).load( url, function(){
				pageLoadCallback(url);
			});

		window.history.pushState({}, '', $(this).attr("href"));
		
		return false;
	});
});

function pageLoadCallback(url){
	urlObj = parseURL(url);
	if(urlObj.pathname.member.toUpperCase() == 'ADMIN'){
		switch (urlObj.pathname.page.toUpperCase()){
			case "POSTS":
				if(urlObj.pathname.action.toUpperCase() == "ADD")
					callbackPostAddPageLoad();
				break;
		}	
	}
}

function callbackPostAddPageLoad(){	
	CKEDITOR.replaceAll();
	$('#checkbox-list').iCheck({
		checkboxClass: 'icheckbox_minimal',
		handle: 'checkbox'
	});
}

function parseURL(url){
    var parser = document.createElement('a'),
        searchObject = {},
        queries, split, i;
    // Let the browser do the work
    parser.href = url;
    // Convert query string to object
    queries = parser.search.replace(/^\?/, '').split('&');
    for( i = 0; i < queries.length; i++ ) {
        split = queries[i].split('=');
        searchObject[split[0]] = split[1];
    }    

    return {
        protocol: parser.protocol,
        host: parser.host,
        hostname: parser.hostname,
        port: parser.port,
        pathname: parseUrlPathname(parser.pathname.trim()),
        search: parser.search,
        searchObject: searchObject,
        hash: parser.hash
    };
}

function parseUrlPathname(path){
	pathParts = path.split('/');
	urlDecoded = decodeURIComponent(pathParts[3]);
	urlDecoded = urlDecoded.trim();
	return{
		member : pathParts[1],
		page: pathParts[2],
		action: urlDecoded
	}
}

function removePostFeatureImg(){
	$('#delete img').attr('src', window.defaultFeatureImg);
}

function ajax_PostFeatureImg( action ){

	$.ajax({
		type: 'post',
		url: $('form').attr('action'),
		data: {
			ajax : true,
			action : action,
			subject : 'featuredImg'
		},
		dataType: 'json',
		error: ajaxErrorHandler
	})
	.success(function(data){
		console.log(data);
	})
}

function ajaxErrorHandler(xhr,status,error){
	console.log(xhr),
	console.log(status),
	console.log(error)
	return false;
}