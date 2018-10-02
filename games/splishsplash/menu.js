Game.Menu = function(game){};

Game.Menu.prototype = {
	create: function(){
		this.bg = game.add.sprite(0,0,"bg");
		this.fg = game.add.sprite(0,0,"fg");
		
		this.player = game.add.sprite(width/2,692-12,"player");
		this.player.anchor.set(0.5);
		this.player.frame = 2;
		
		this.bottomBorder = game.add.sprite(138,692,"border");
		
		game.add.sprite(0,60,"titleBanner");
		
		this.title = game.add.text(width/2,115,Game.TITLE,{font:"bold 36px Verdana", fill:"#fff"});
		this.title.anchor.setTo(0.5,0.5);
		
		this.play = game.add.button(width/2,height/2,"playButton",this.onPlay,this);
		this.play.anchor.setTo(0.5,0.5);
		
		var tween = game.add.tween(this.play.scale).to({x:1.2,y:1.2},500,"Linear",true,0,-1);
		tween.yoyo(true,100);
		
		this.muteButton = game.add.button(width-50,height-50,"muteButton",this.onMute,this);
		this.muteButton.anchor.setTo(0.5,0.5);
		this.muteButton.tint = Game.mute ? 0x555555 : 0xffffff;
	},
	
	onPlay: function(){
		game.state.start("Play");
	},
	
	onMute: function(){
		Game.mute = !Game.mute;
		if(Game.mute)
			this.muteButton.tint = 0x555555;
		else
			this.muteButton.tint = 0xffffff;
		
		localStorage.setItem("muted",Game.mute);
	},
	
	onMusicMute: function(){
		Game.musicMute = !Game.musicMute;
		if(Game.musicMute)
			this.musicMuteButton.tint = 0x555555;
		else
			this.musicMuteButton.tint = 0xffffff;
		
		localStorage.setItem("musicMuted",Game.musicMute);
	}
};