function vykreslovanie(){
    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource("sse.php");

        source.addEventListener('sse', (e)=> {
            console.log(e);
            var data = JSON.parse(e.data);
            if(data.x===0){
                if (data.y1!=="nedefinovane"){
                    document.getElementById('y1').checked = true;
                }
                else {
                    document.getElementById('y1').checked = false;
                }
                if (data.y2!=="nedefinovane"){
                    document.getElementById('y2').checked = true;
                }
                else {
                    document.getElementById('y2').checked = false;
                }
                if (data.y3!=="nedefinovane"){
                    document.getElementById('y3').checked = true;
                }
                else {
                    document.getElementById('y3').checked = false;
                }
            }

            document.getElementById("konzolaA").innerHTML = "Hodnota a: "+data.a+"<br>";
            document.getElementById("konzolaX").innerHTML = "Hodnota <br> x: "+data.x+"<br>";
            document.getElementById("konzolaY1").innerHTML = "Hodnota y1: "+data.y1+"<br>";
            document.getElementById("konzolaY2").innerHTML = "Hodnota y2: "+data.y2+"<br>";
            document.getElementById("konzolaY3").innerHTML = "Hodnota y3: "+data.y3+"<br>";
        }, false);

    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
}

