<?php require_once '../includes/header.php'; ?>
<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<head>

    <meta charset="utf-8" />
    <title>Gamedev Canvas Workshop</title>
    <style>
    	* { padding: 0; margin: 0; }
    	canvas { background: #eee; display: block; margin: 0 auto; }
    </style>
</head>
<body>

<canvas id="mycanvas" width="415" height="250"></canvas>

<script>
	// JavaScript code goes here
</script>

</body>
</html>

<script>
$(document).ready(function(){
    graficacurvas("mycanvas");    

});

function graficacurvas(nomcamvas){
    var canvas = document.getElementById("mycanvas"); 
    console.log(canvas);
    var ancho = canvas.width; 
    var alto = canvas.height;
    //var ancho = 480; 
    //var alto = 360;
    var ctx = canvas.getContext("2d");

    {//curva s 
    ctx.beginPath();
    ctx.lineWidth = 2;
    ctx.strokeStyle = "#385C94";
    ctx.strokeRect(40,40, ancho-50, alto-60);
    //ctx.moveTo(35,alto-20+(alto-60)/10);
    //ctx.strokeStyle = "#f00";
    ctx.font="bold 10px calibri"; //estilo de texto
    ctx.textAlign="right";
    for(i=1;i<11;i++){
        ctx.moveTo(38,alto-20-(alto-60)/10*i);
        ctx.lineTo(43,alto-20-(alto-60)/10*i); 
        
        ctx.fillText((10*i).toString()+"%",35,alto-20-(alto-60)/10*i+3); //texto con método stroke  
        //ctx.lineTo(45,50);   
    }
    
    ctx.stroke();

    //ctx.fillStyle = "#FF0000";
    //ctx.fill();
    ctx.closePath();
    }
}
</script>