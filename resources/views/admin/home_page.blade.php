@extends('layouts.master_admin') 

@section('controll')
Trang chủ
@endsection

@section('content')
<!-- Info boxes -->

<!-- firebase 15/7/2019-->
<!-- The core Firebase JS SDK is always required and must be listed first -->
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->
    
<script src="{{asset('firebase/fb.js')}}"></script>

<script>
    var database = firebase.database();

    // get data
    var lastIndexOne = 0;

    var ref = firebase.database().ref('messages');

    ref.on("value", function(snapshot) {
      var value = snapshot.val();
      var htmls = [];
      $.each(value, function(index, value){
          if(value) {
			htmls.push('<div class="item"><img src="/images/admins/'+value.avatar+'" class="offline"><p class="message"><a href="" class="name">'+value.name+'<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '+moment(value.created_at, "YYYY-M-D H:m:s").fromNow()+'</small></a>'+value.message+'</p></div>');
          }    	
        lastIndexOne = index;
	  });

	  $('.online-messages').html(htmls);
	  
	  var objDiv = document.getElementById("chat-scroll");
	  objDiv.scrollTop = objDiv.scrollHeight;
	  
    }, function (error) {
      console.log("Error: " + error.code);
	});
	
</script>

<script>
	$("#getMessage").keypress(function(e) {
		var message = $('#getMessage').val().trim();
		if (e.keyCode == 13 && message.length > 0) {
			var user_id = $('#getUserId').val();
			var name = $('#getName').val();
			var avatar = $('#getAvatar').val();
			var now = new Date();
			var created_at = now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();

			$('#getMessage').val("");
			firebase.database().ref('messages').push({
					'user_id' : user_id,
					'name' : name,
					'avatar' : avatar,
					'message' : message,
					'created_at' : created_at,
				}
			);
		}
	});

	$('.btn-send-message').click(function(){
		var message = $('#getMessage').val().trim();
		if (message.length > 0) {
			var user_id = $('#getUserId').val();
			var name = $('#getName').val();
			var avatar = $('#getAvatar').val();
			var now = new Date();
			var created_at = now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();

			$('#getMessage').val("");
			firebase.database().ref('messages').push({
					'user_id' : user_id,
					'name' : name,
					'avatar' : avatar,
					'message' : message,
					'created_at' : created_at,
				}
			);
		}
	})
</script>

@endsection