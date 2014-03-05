
 (    (                           (        )                 (           (    (     
 )\ ) )\ )    (        (          )\ )  ( /(           (     )\ )        )\ ) )\ )  
(()/((()/(    )\       )\   (    (()/(  )\()) (   (    )\   (()/(   (   (()/((()/(  
 /(_))/(_))((((_)(   (((_)  )\    /(_))((_)\  )\  )\((((_)(  /(_))  )\   /(_))/(_)) 
(_)) (_))   )\ _ )\  )\___ ((_)  (_))   _((_)((_)((_))\ _ )\(_))_  ((_) (_)) (_))   
/ __|| _ \  (_)_\(_)((/ __|| __| |_ _| | \| |\ \ / / (_)_\(_)|   \ | __|| _ \/ __|  
\__ \|  _/   / _ \   | (__ | _|   | |  | .` | \ V /   / _ \  | |) || _| |   /\__ \  
|___/|_|    /_/ \_\   \___||___| |___| |_|\_|  \_/   /_/ \_\ |___/ |___||_|_\|___/ 
==================================================================================== 
    SIMON SCOTT, G2SCOTTS, 997716690   	 YASIR AFAQ, C2AFAQYA, 996290106                                                                              
==================================================================================== 

	Alien invaders are trying to take over the planet and the Earth needs your help!  

Welcome to Space Invaders!  We have developed a game with images and sounds from the 

original game leaving players with a classic arcade-like Space Invaders experience. 

The game rules are similar to those of the classic, players get 3 lives which are 

finite. There is no way to gain lives and the lives do not reset after each level. 

The game continues as long as players have lives remaining.  There are 84 invaders 

in every level and the speed at which they move increases as players reach higher

levels.
 
In our code, the user defined object include:
*********************************************

	The Classes for these objects keep track of the x and y position, direction and 

speed on the canvas.  Method class.update increments these x and y positions.

(1) Invader --- function Invader (_x, _y, _imgSrc, _imgSrcA) 

(2) Projectile --- function Projectile (_x, _y, _imgSrc, _imgSrcA, _speed, _type)

(3) Player Ship --- function Player (_x, _y, _imgSrc)
 
(4) update() --- Updates the direction and position of Invaders and Missiles.

(5) Refresh(canvas) --- Redraws the various elements onto the canvass, using their x and y positions.

(6) impactChack() --- Checks for impact between Missiles and player or Enemies and if found removes the affected objects.

Data Structures:
****************

	We implemented two one dimensional array type data structures in our code, one for the invader objects and the other for the projectile objects.  The array is indexed by the unique ID of the invader or the projectile.  

Enhancements:
*************

	Sound files from the original game have been used.

