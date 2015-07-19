function tests() {
	//alert($("#inputType option:selected").text());
	if ($("#inputType option:selected").text() !== null) {
		type=$("#inputType option:selected").text();
	}
	else {
		type="Read";
	}
	if(document.getElementById("inputTarget") !== null) {
		if (document.getElementById("inputTarget").value != "") {
			target=document.getElementById("inputTarget").value;
		}
		else {
			target="/tmp";
		}
	}
	if(document.getElementById("inputSize") !== null) {
		if (document.getElementById("inputSize").value != "") {
			size=document.getElementById("inputSize").value;
		}
		else {
			size="100";
		}
	}
	var url = "tests.php?type="+type+"&size="+size+"&target="+target;
	loading();
	//$("#tests").html
	$.get(url, function(data) {
        $("#tests").html(data);
        $.get("history.php", function(data) {
	        $("#history").html(data);
	    });
    }).fail(function() {
        alert( "error" );
    })
    .always(function() {
        unloading();
        //alert( "finished" );
    });
}

function loading() {
	$("#tests").html("<p><img src='img/ajax-loader.gif'/></p>");
}