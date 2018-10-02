var game = new Phaser.Game(width,height,Phaser.AUTO);

game.state.add("Load",Game.Load);
game.state.add("Menu",Game.Menu);
game.state.add("Play",Game.Play);
game.state.add("Lose",Game.Lose);

game.state.start("Load");