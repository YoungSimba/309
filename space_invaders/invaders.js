$(document).ready(function(){main();});


//Images

var invaderA = new Image();
invaderA.src = "images/invader1.png";

var invaderB = new Image();
invaderB.src = "images/invader12.png";

var orangeAlien = new Image();
orangeAlien.src = "images/invader2.png";

var orangeAlienA = new Image();
orangeAlienA.src = "images/invader22.png";

var ship = new Image();
ship.src = "images/ship.png";

var missileImg = new Image();
missileImg.src = "images/projectile.png";

var enemyMissileImg1 = new Image();
enemyMissileImg1.src = "images/eprojectile.png";

var enemyMissileImg2 = new Image();
enemyMissileImg2.src = "images/eprojectile2.png";


//Initilize
var frameRate = 30;
var gameCanvas;

var display;

var gameOver = false;
var wave = 1;

// Invaders
var updateLogic = false;
var direction = 1;
var invaderSpeed = 5;
var invaderYAxis = 0;
var invaderIdCounter = 0;
var invaderCount = 0;
var invaders = {};


// Player
var players = {};
var missileIdCounter = 0;
var missileCount = 0;
var missiles = {};

// Event Handeling
rightArrow = false;
leftArrow = false;
fire = false;

function keyStrokeDown(evt) {
  if (evt.keyCode == 39) rightArrow = true;
  else if (evt.keyCode == 37) leftArrow = true;
  if (evt.keyCode == 32){
	fire = true;
	var missile = new Projectile(players[0].x + (players[0]._width/2), players[0].y - 10, missileImg, missileImg, 5, 1);
	spawnMissle(missile);
  };
}

function keyStrokeUp(evt) {
  if (evt.keyCode == 39) rightArrow = false;
  else if (evt.keyCode == 37) leftArrow = false;
  if (evt.keyCode == 32) fire = false;
}

$(document).keydown(keyStrokeDown);
$(document).keyup(keyStrokeUp);

function startGame() {
	var player = new Player(10,scoreCanvas.height - 30, ship);
	spawnPlayer(player);
	
	for(var i = 0; i<= 11; i++){
		for(j = 0; j <=6; j++){
			if (j == 0){
				var enemy = new Invader(10 + (i*34), 40 + (j*25), orangeAlien, orangeAlienA);
			}else{
				var enemy = new Invader(10 + (i*34), 40 + (j*25), invaderA, invaderB);
			}
			spawnInvader(enemy);
		}
	}
}

function update(){
	
	display.redraw();
	
	if (gameOver != true){	
		for (var id in players){
			var player = players[id];
			
			if (player._lives < 0){
				$('#gameover').fadeIn(2000);
				gameOver = true;
			}
			
			player.update(100);
			$('#player_score').html(player._score);
		}
		
		for (var id in missiles) {
			var projectile = missiles[id];
			projectile.update(100);
		}
		
		if (updateLogic == true){
			updateLogic = false;
			direction = -direction;
			invaderSpeed = -invaderSpeed;
			invaderYAxis = 10;
		}
		
		for (var id in invaders) {
			var enemy = invaders[id];
			enemy.delay = (invaderCount * 20) - (wave * 10);
			
			if (enemy.delay <=50 ){
				enemy.delay = 50;
			}
			
			enemy.update(100);
			
			if (enemy._fire == true){
				enemy._fire = false;
				var projectile = new Projectile(enemy.x + (enemy._width/2), enemy.y + 10, enemyMissileImg1, enemyMissileImg2, -5, 2);
				spawnMissle(projectile);
			}
		}
		
		invaderYAxis = 0;
		
		impactCheck();
	}
}

//Add/Remove

function spawnInvader(enemy){
	invaders[enemy.id] = enemy;
	display.spawnInvader(enemy);
	++invaderCount;
}

function killInvader(enemy)
{
    delete invaders[enemy.id];
    display.killInvader(enemy);
    --invaderCount;
	
	if(invaderCount == 0){
		incrementInvaders();
	}
}

function spawnPlayer(player){
	players[player.id] = player;
	display.spawnPlayer(player);
}

function spawnMissle(projectile){
	missiles[projectile.id] = projectile;
	display.spawnMissle(projectile);
	++missileCount;
}

function killMissle (projectile)
{
    delete missiles[projectile.id];
    display.killMissle(projectile);
    --missileCount;
}

function resizeCanvas ()
{

	gameCanvas.width    = 570;
	gameCanvas.height   = 350;
	scoreCanvas.width    = 570;
	scoreCanvas.height    = 350;
		
	$('#game_bezel').css('left', (document.width / 2) - ($('#game_bezel').width() / 2) + 'px');
		
	if (display != null) {
		display.init(gameCanvas);
	}
	
}

function impactCheck(){
	for (var id in missiles) {
		var projectile = missiles[id];
		
		if(projectile._type == 1){
			for (var eid in invaders) {
				var enemy = invaders[eid];
				
				if (projectile.x >= enemy.x && projectile.x <= (enemy.x + enemy._width)){
					if (projectile.y <= (enemy.y + enemy._height) && projectile.y >= (enemy.y)){
						killInvader(enemy);
						killMissle(projectile);
						players[0]._score += 100;
					}
				}
			}
		}else{
			for (var pid in players) {
				var player = players[pid];
				if (projectile.x >= player.x && projectile.x <= (player.x + player._width)){
					if (projectile.y <= (player.y + player._height) && projectile.y >= (player.y)){
						killMissle(projectile);
						player._lives --;
					}
				}
			}
		}
		
		if (projectile.y <=0 || projectile.y > gameCanvas.height){
			killMissle(projectile);
		}
	}
	
}

function incrementInvaders() {
	wave++;
	for(i = 0; i<= 11; i++){
		for(j = 0; j <=6; j++){
			if (j == 0){
				var enemy = new Invader(10 + (i*34), 40 + (j*25), orangeAlien, orangeAlienA);
			}else{
				var enemy = new Invader(10 + (i*34), 40 + (j*25), invaderA, invaderB);
			}
			spawnInvader(enemy);
		}
	}
}




(function () {
	
	function Refresh(canvas){
		this._enemies  = {};
		this._player = {};
		this._projectiles = {};
		this.init(canvas);
	}

	this.Refresh = Refresh;

	Refresh.prototype.init = function (canvas)
	{
		this._canvas    = canvas;
		this._context   = this._canvas.getContext("2d");
		this._width     = this._canvas.width;
		this._height    = this._canvas.height;
	};

	Refresh.prototype.redraw = function ()
	{
		draw.call(this);
	};
    
	Refresh.prototype.spawnInvader = function (enemy)
    {
        this._enemies[enemy.id] = enemy;
    };
	
	Refresh.prototype.killInvader = function (enemy)
    {
        delete this._enemies[enemy.id];
    };
	
	Refresh.prototype.spawnPlayer = function (player)
    {
        this._player[player.id] = player;
    };
	
	Refresh.prototype.spawnMissle = function (projectile)
    {
        this._projectiles[projectile.id] = projectile;
    };
	
	Refresh.prototype.killMissle = function (projectile)
    {
        delete this._projectiles[projectile.id];
    };

    function draw ()
    {
        this._context.clearRect(0, 0,this._width, this._height);
		this._context.fillStyle = 'black';
		for (var id in this._enemies) {
			var enemy = this._enemies[id];		
			this._context.save();
			if (enemy.frame == 1){
				this._context.drawImage(enemy.imgSrc, enemy.x, enemy.y);
			}else{
				this._context.drawImage(enemy.imgSrcA, enemy.x, enemy.y);
			}
			
			this._context.restore();
		}
		
		for (var id in this._player) {
			var player = this._player[id];		
			this._context.save();
			this._context.drawImage(player.imgSrc, player.x, player.y);
			
			for (i=0; i<= player._lives; i++){
				this._context.drawImage(player.imgSrc, (this._width / 2) + 180 + (i * 38), 10);
			}
			
			this._context.restore();
		}
		
		for (var id in this._projectiles) {
			var projectile = this._projectiles[id];		
			this._context.save();
			
			if (projectile.frame == 1){
				this._context.drawImage(projectile.imgSrc, projectile.x, projectile.y);
			}else{
				this._context.drawImage(projectile.imgSrcA, projectile.x, projectile.y);
			}
			
			this._context.restore();
		}
		
    }

})();

function Invader (_x, _y, _imgSrc, _imgSrcA)
    {
        this.id = invaderIdCounter++; 
        this.x  = _x;
        this.y  = _y;
        this._time  = 0;
		
		this.imgSrc = _imgSrc;
		this.imgSrcA = _imgSrcA;
		this.frame = 1;
		
		this.delay = 720;
		this._width = 20;
		this._height = 16;
		this._moveSpeed = 6;
		this._fire = false;

    Invader.prototype.update = function (timeDelta)
    {
		this._time += timeDelta;
		
		if (this._time >= this.delay){
			
			var fireTest = Math.floor(Math.random() * (this.delay + 1));

			if (fireTest < (this.delay / 100)){
				this._fire = true;
			}
			
			if (this.x + (this._width + 6) >= gameCanvas.width && direction == 1){
				updateLogic = true;
			}
			else if(this.x - 6 <= 0 && direction != 1){
				updateLogic = true;
			}
			
			this.frame = -this.frame;
			this.x += invaderSpeed;
			this._time = 0;
		}
        
		this.y += invaderYAxis;
    };
    
};


function Projectile (_x, _y, _imgSrc, _imgSrcA, _speed, _type)
    {
        this.id = missileIdCounter++; 
        this.x  = _x;
        this.y  = _y;
		this.imgSrc = _imgSrc;
		this.imgSrcA = _imgSrcA;
		this._width = 30;
		this._speed = _speed;
		this.delay = 500;
		this.frame = 1;
		this._time = 0;
		this._type = _type;

    Projectile.prototype.update = function (timeDelta)
    {
		this._time += timeDelta;
		this.y -= this._speed;
		if (this._time >= this.delay){
			this._time = 0;
			this.frame = -this.frame;
		}
    };
    
};

function Player (_x, _y, _imgSrc)
    {
    	idCounter = 0;
        this.id = idCounter; 
        this.x  = _x;
        this.y  = _y;
		this.imgSrc = _imgSrc;
		
		this._width = 30;
		this._height = 16;
		this._speed = 5;
		this._lives = 2;
		this._score = 0;

    Player.prototype.update = function (timeDelta)
    {
		this._time += timeDelta;
		
		if (rightArrow == true){
			if (this.x + (this._width + 6) <= gameCanvas.width){
				this.x += this._speed;
			}
		}
		
		if (leftArrow == true){
			if (this.x - 6 >= 0){
				this.x -= this._speed;
			}
		}
    };
    
};

function main ()
{
    gameCanvas  = document.getElementById("invaders-canvas");
    scoreCanvas  = document.getElementById("score-canvas");
	resizeCanvas();
    display    = new Refresh(gameCanvas);
    startGame();
    window.setInterval(update, Math.ceil(1000 / frameRate));
}      