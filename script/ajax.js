function test(id){
	alertify.prompt("modifier ton status.","",function(evt,value){
		$.post("assets/modifyPost.php",{id:id,content:value},function(a,b,c){if(b == "success"){alertify.success('Status modifier avec success!');}});
	});
}

function deletePost(id){
	alertify.confirm("Supprimer le status ?",function(){$.post("assets/deletePost.php",{id:id},function(a,b,c){if(b == "success"){alertify.success('Status supprimer avec success!');}})});
}

function addComment(id){
	alertify.prompt("commenter.","",function(evt,value){
		$.post("assets/addComment.php",{id:id,content:value},function(a,b,c){if(b == "success"){alertify.success('Vous avez commenter !');}});
	});
}

var t;
function likePost(id,id2,d){
	$.post("assets/likePost.php",{id:id},function(a,b,c){if(b == "success"){

		d.parentElement.getElementsByClassName("numLikes")[0].innerHTML=""+a.replace(/[a-z]/gi,"");
		if(a.replace(/[0-9]/g,"") == "unliked"){
			d.parentElement.getElementsByClassName("like")[0].className = d.parentElement.getElementsByClassName("like")[0].className.replace(/unliked/g,"liked").replace(/fa-heart-o/g,"fa-heart");
			$.post("assets/setLikeNotification.php",{uid2:id2},function(a,b,c){});
		}else{
			d.parentElement.getElementsByClassName("like")[0].className = d.parentElement.getElementsByClassName("like")[0].className.replace(/liked/g,"unliked").replace(/fa-heart/g,"fa-heart-o");
		}
		
		

	};});
	t=d;
}

function getUsers(){
	$.post("assets/getUsers.php",{},function(a,b,c){alert(a)});
}

function addFriendRequest(id2){
	$.post("assets/addFriendRequest.php",{id2:id2},function(a,b,c){});
}

function removeFriendRequest(id2){
	$.post("assets/removeFriendRequest.php",{id2:id2},function(a,b,c){});
}

function removeFriend(id2){
	$.post("assets/removeFriend.php",{id2:id2},function(a,b,c){});
}

function acceptFriendRequest(id2){
	$.post("assets/acceptFriendRequest.php",{id2:id2},function(a,b,c){});
}

function sendMessage(id2,content){
	$.post("assets/sendMessage.php",{id2:id2,content:content},function(a,b,c){});
}

function getFriendRequests(id,target){
	$(target).load("assets/getFriendRequests.php",{id:id},function(a,b){});
}