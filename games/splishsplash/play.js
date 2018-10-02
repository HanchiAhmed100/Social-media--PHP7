Game.Play = function(game){};
var a;

Game.Play.prototype = {
	create: function(){
		this.bg = game.add.sprite(0,0,"bg");
		this.fg = game.add.tileSprite(0,0,width,height,"fg");
		
		this.player = game.add.sprite(width/2,692-12,"player");
		this.player.anchor.set(0.5);
		this.player.vely = -Game.playerSpeed;
		this.player.animations.add("up",[0,0,0,0,1]);
		this.player.animations.add("down",[2]);
		
		this.coin = game.add.sprite(width/2,120,"coin");
		this.coin.y = 120+this.coin.height/2;
		this.coin.anchor.setTo(0.5,0.5);
		
		this.topBorder = game.add.sprite(138,55,"border");
		this.topBorder.animations.add("stretch",[2,0]);
		
		this.enemies = game.add.group();
		this.enemies.createMultiple(10,"green");
		this.enemies.createMultiple(10,"red");
		this.enemies.createMultiple(10,"blue");
		
		var timer = game.time.create(false);
		timer.loop(Game.spawnRate,this.spawnEnemies,this);
		timer.start();
		
		this.bottomBorder = game.add.sprite(138,692,"border");
		this.bottomBorder.animations.add("stretch",[1,0]);
		
		this.score = 0;
		
		this.scoreLabel = game.add.text(69,50,"0",{font:"bold 64px Verdana",fill:"#fff"});
		this.scoreLabel.anchor.set(0.5);
		
		this.springSound = game.add.sound("spring",1);
		this.deathSound = game.add.sound("death",0.5);
		this.coinSound = game.add.sound("coin",0.1);
		
		game.input.onDown.add(this.onTap,this);
	},
	
	update: function(){
		this.player.y+=this.player.vely;
		if(this.player.y-this.player.height/2<this.topBorder.y+this.topBorder.height/2){
			this.player.y = this.topBorder.y+this.topBorder.height/2+this.player.height/2;
			this.player.vely *= -1;
			this.topBorder.animations.play("stretch",10,false);
			shakeWorld = Game.shakeIntensity;
			if(!Game.mute)this.springSound.play();
		}
		if(this.player.y+this.player.height/2>this.bottomBorder.y+this.topBorder.height/2){
			this.player.y = this.bottomBorder.y+this.topBorder.height/2-this.player.height/2;
			this.player.vely *= -1;
			this.bottomBorder.animations.play("stretch",10,false);
			shakeWorld = Game.shakeIntensity;
			if(!Game.mute)this.springSound.play();
		}
		if(collide(this.player,this.coin,Game.coinRadius)){
			if(this.coin.y == 120+this.coin.height/2)
				this.coin.y = 627+this.coin.height/2;
			else
				this.coin.y = 120+this.coin.height/2;
			
			this.score++;
			this.scoreLabel.text = this.score;
			
			if(!Game.mute)this.coinSound.play();
		}
		
		this.coin.angle += 0.5;
		
		if(this.player.vely<0)
			this.player.animations.play("down",1);
		else
			this.player.animations.play("up",8);
		
		this.updateEnemies();
		
		if (shakeWorld > 0) {
			var rand1 = game.rnd.integerInRange(-10,10);
			var rand2 = game.rnd.integerInRange(-10,10);
			game.world.setBounds(0, rand2, game.width + rand1, game.height + rand2);
			shakeWorld--;
			if (shakeWorld == 0) {
				game.world.setBounds(0, 0, game.width,game.height); // normalize after shake?
			}
		}
		this.fg.tilePosition.x -= Game.waveSpeed;
	},
	
	onTap: function(){
		this.player.vely *= -1;
	},
	
	spawnEnemy: function(){
		//enemy = this.enemies.getFirstExists(false);
		tmp = Math.floor(Math.random()*29);
		enemy = this.enemies.getAt(tmp);
		while(enemy.alive){
			tmp = Math.floor(Math.random()*29);
			enemy = this.enemies.getAt(tmp);
		}
		if(enemy){
			enemy.anchor.set(0.5);
			left = Math.random()<0.5;
			var yy = Math.floor(Math.random()*12)*48;
			enemy.reset(left ?-50:width+50,105+yy);
			enemy.scale.x = left?-1:1;
			enemy.velx = left?Game.enemySpeed:-Game.enemySpeed;
			enemy.animations.add("chop",[0,1]);
			enemy.animations.play("chop",5,true);
		}
		return enemy;
	},
	
	updateEnemies: function(){
		for(i=0;i<this.enemies.length;i++){
			e=this.enemies.getAt(i);
			e.x+=e.velx;
			if(e.alive && (e.x<-50 || e.x>width+50))
				e.kill();
			if(collide(e,this.player,Game.enemyRadius)){
				if(!Game.mute)this.deathSound.play();
				Game.score = this.score;
				game.state.start("Lose");
			}
		}
	},
	
	spawnEnemies: function(){;
		spawnCount = 1+Math.floor(this.score/50);
		for(i=0;i<spawnCount;i++){
			this.spawnEnemy();
		}
	}
};