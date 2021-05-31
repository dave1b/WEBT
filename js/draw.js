function draw() {
    let canvas = document.getElementById('canvas');
    let contex = canvas.getContext('2d');

    contex.fillStyle = "#ffff00";

    contex.lineWidth = "3";

    // Kreis/Coin 
    contex.beginPath();
    contex.arc(155, 155, 150, 0, 2 * Math.PI, true);
    contex.fillStyle = '#F8ECE0';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //Top to left to middle to  top
    contex.beginPath();
    contex.moveTo(155, 50);
    contex.lineTo(105, 150);
    contex.lineTo(155, 125);
    contex.lineTo(155, 50);
    contex.fillStyle = '#E6E6E6';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //Top to right to middle to  top
    contex.beginPath();
    contex.moveTo(155, 50);
    contex.lineTo(205, 150);
    contex.lineTo(155, 125);
    contex.lineTo(155, 50);
    contex.fillStyle = '#A4A4A4';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //left to mid-top to bot to left
    contex.beginPath();
    contex.moveTo(105, 150);
    contex.lineTo(155, 125);
    contex.lineTo(155, 190);
    contex.lineTo(105, 150);
    contex.fillStyle = '#848484';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //right to mid-top to bot to right
    contex.beginPath();
    contex.moveTo(205, 150);
    contex.lineTo(155, 125);
    contex.lineTo(155, 190);
    contex.lineTo(205, 150);
    contex.fillStyle = '#424242';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //Bot to top-left to bot
    contex.beginPath();
    contex.moveTo(155, 250);
    contex.lineTo(105, 165);
    contex.lineTo(155, 205);
    contex.lineTo(155, 250);

    contex.fillStyle = '#E6E6E6';
    contex.fill();
    contex.closePath();
    contex.stroke();

    //Bot to top-right to mid to bot
    contex.beginPath();
    contex.moveTo(155, 250);
    contex.lineTo(205, 165);
    contex.lineTo(155, 205);
    contex.lineTo(155, 250);
    contex.fillStyle = '#A4A4A4';
    contex.fill();
    contex.closePath();
    contex.stroke();
}

draw();