$(document).ready(function($){
    var ulogintoken = getCookie("ulogintoken");
    //if (ulogintoken != '')
    //    uloginauth(ulogintoken);

    var user_social_info = getCookie("user_social_info");
    if (user_social_info != '') {
        user_social_info = $.parseJSON(user_social_info); 
        console.log(user_social_info);
    }

    $(document).ready(function(){

    	/* i will go btn */
    	//$(".i-will").click(function() {
    	$(document).on('click', '.i-will', function(e){

    		$(this).toggleClass('active');

            var button = $(this);

            $.ajax({
                url: "/ajax/i-will-go",
                type: 'post',
                dataType: 'json',
                data: {
                    profile_id:  profile_id, 
                    object_type: 'action', 
                    object_id:   $(this).data('action-id'), 
                },
            }).done(function(data){
                //data = $.parseJSON(data.toString());
                console.log(data);

                $(button).parents().find('.people-count').removeClass('hidden');
                $(button).parents().find('.people-count strong').html(+data.total);

                /*
                if (data.also_go == 1)
                    alert("Вы уже сказали, что пойдете. Всего пойдет людей: " + (data.count-1));
                else 
                    alert("Отлично! Вместе с вами пойдет людей: " + (data.count-1));
                */

            }).fail(function(data){
                console.log(data);
            });

        });
    });

});


	$(document).on('click', '#logout', function(e){
		e.preventDefault();
        setCookie("user_social_info", null);
        $(this).text("Войти");
        $(this).attr("id", "login");
	});


function uloginauth(token) {
    if(typeof ulogintoken == "undefined")
        setCookie("ulogintoken", token, "Mon, 01-Jan-2018 00:00:00 GMT", "/");
        
    $.getJSON("//ulogin.ru/token.php?host=" + encodeURIComponent(location.toString()) + "&token=" + token + "&callback=?", function(data){
        setCookie("user_social_info", data.toString());
        data = $.parseJSON(data.toString());
        console.log(data);
        if(!data.error){
            //alert("Привет, "+data.first_name+" "+data.last_name+"!");
            //alert("Добро пожаловать, "+data.first_name+"!");
            //$(".welcome_msg").html("Добро пожаловать, "+data.first_name+"!");

            $("select.city-select").val(data.city);
            city_select.setValue(data.city);
            
            $(".popup.auth").addClass("hidden");
            $(".overlay").addClass("hidden");

            $("#login").text("Выйти");
            $("#login").attr("id", "logout");

        } else {
            // Token expired
        }
    });
}

function setCookie (name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}