var width = 480;
var height = 800;
var shakeWorld = 0;


Game.score = 0;
Game.bestScore = localStorage.getItem("bestScore") == null ? 0: localStorage.getItem("bestScore");
Game.newBest = false;

Game.mute = localStorage.getItem("muted") == null ? false : localStorage.getItem("muted");
Game.musicMute = localStorage.getItem("musicMuted") == null ? false : localStorage.getItem("musicMuted");

function pow(a){
	return a*a;
}

function collide(e1,e2,radius){
	return Math.sqrt(pow(e1.x-e2.x)+pow(e1.y-e2.y)) < radius*2;
}

Game.Load = function(game){}

Game.Load.prototype = {
	preload: function(){
		game.stage.backgroundColor = "#EEEEEE";
		this.text = game.add.text(width/2,height/2,"Loading...");
		this.text.anchor.setTo(0.5,0.5);
		
		//LOADING
		game.load.image("titleBanner","assets/gfx/titleBanner.png");
		game.load.image("playButton","assets/gfx/playButton.png");
		game.load.image("muteButton","assets/gfx/muteButton.png");
		game.load.image("musicMuteButton","assets/gfx/musicMuteButton.png");
		game.load.image("restartButton","assets/gfx/restartButton.png");
		
		
		game.load.image("bg","assets/gfx/bg.png");
		game.load.image("fg","assets/gfx/fg.png");
		game.load.spritesheet("player","assets/gfx/player.png",32,32);
		game.load.spritesheet("green","assets/gfx/green.png",48,48);
		game.load.spritesheet("red","assets/gfx/red.png",48,48);
		game.load.spritesheet("blue","assets/gfx/blue.png",48,48);
		game.load.spritesheet("border","assets/gfx/border.png",204,53);
		game.load.image("coin","assets/gfx/coin.png");
		
		game.load.audio("spring","assets/sfx/spring.wav");
		game.load.audio("death","assets/sfx/death.wav");
		game.load.audio("coin","assets/sfx/coin.wav");
		
		//SCALING
		//game.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
		game.scale.scaleMode = Phaser.ScaleManager.EXACT_FIT;
		game.scale.setScreenSize();
	},
	
	create: function(){
		game.state.start("Menu");
	}
};