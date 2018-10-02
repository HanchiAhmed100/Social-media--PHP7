Game.Lose = function(game){};

Game.Lose.prototype = {
	create: function(){
		this.bg = game.add.sprite(0,0,"bg");
		this.fg = game.add.sprite(0,0,"fg");
		
		game.add.sprite(0,60,"titleBanner");
		
		this.title = game.add.text(width/2,115,Game.TITLE,{font:"bold 36px Verdana", fill:"#fff"});
		this.title.anchor.setTo(0.5,0.5);
		
		this.restart = game.add.button(width/2,height-188,"restartButton",this.onRestart,this);
		this.restart.anchor.setTo(0.5,0.5);
		
		var tween = game.add.tween(this.restart.scale).to({x:1.2,y:1.2},500,"Linear",true,0,-1);
		tween.yoyo(true,100);
		
		if(Game.score > Game.bestScore){
			Game.bestScore = Game.score;
			localStorage.setItem("bestScore",Game.bestScore);
			Game.newBest = true;
		}
		else
			Game.newBest = false;
		
		this.scoreText = game.add.text(width/2,height/2-33,"SCORE: "+Game.score,{font:"bold 36px Verdana",fill:"#fff"});
		this.scoreText.anchor.setTo(0.5,0.5);
		
		this.bestScoreText = game.add.text(width/2,height/2+14,"BESTSCORE: "+Game.bestScore,{font:"bold 36px Verdana",fill:"#fff"});
		this.bestScoreText.anchor.setTo(0.5,0.5);
		
		if(Game.newBest){
			this.bestScoreText.text = "NEW BESTSCORE: " + Game.bestScore;
		}
	},
	
	update: function(){
		
	},
	
	onRestart: function(){
		game.state.start("Menu");
	}
};