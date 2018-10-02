<script type="text/javascript" src="script/jquery.min.js"></script>
<script type="text/javascript" src="script/jquery.cropit.js"></script>
<script type="text/javascript" src="script/bootstrap.min.js"></script>
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript" src="script/iziToast.min.js"></script>
<script type="text/javascript" src="script/iziModal.min.js"></script>
<script type="text/javascript" src="script/alertify.min.js"></script>
</body>
</html>

<script type="text/javascript">
	var ttt;
	setInterval(function(){
		$.post("assets/getUnseenNotifications.php",{},function(a,b,c){$("#nNotifications").html(a)});
		$.post("assets/getUnopenedNotifications.php",{},function(a,b,c){ttt = JSON.parse(a); for(var i=0;i<ttt.length;i++){iziToast.show({message:ttt[i].name+" à aimer votre poste.",position: 'bottomRight',color:'blue'})} $.post("assets/setNotificationsOpened.php",{},function(a,b,c){})});

	},1000);
</script>