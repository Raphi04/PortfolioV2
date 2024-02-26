var random=0;
var count=0;
var nightc=0;
var minute=0;
var seconde=0;
var startClock=0;
var fail=0;
function start(){
    fail=0;
    count=0;
    minute=0;
    seconde=0
    startClock = setInterval(clock,1000);
    document.getElementsByClassName("game")[0].style.display="block";
    document.getElementById("gameMenu").style.display="flex";
    document.getElementsByClassName("inGame")[0].style.display="block";
    document.getElementById("menu").style.display="none";
    randomL();
    document.getElementsByClassName("count")[0].innerText="Your score is "+count;
    document.getElementsByClassName("time")[0].innerText="00:00";
}
function exit(){
    document.getElementsByClassName("game")[0].style.display="none";
    document.getElementById("resultScreen").style.display="none";    document.getElementById("menu").style.display="flex";
    clearInterval(startClock);

}
function randomL(){
    random = Math.random()*(90-0)+0;
    document.getElementById("circle").style.left=random+"%";
    random = Math.random()*(90-0)+0;
    document.getElementById("circle").style.top=random+"%";
}

function Success(){
    randomL();
    count++;
    document.getElementsByClassName("count")[0].innerText="Your score is "+count;
}
function Mistakes(){
    fail++;
}
function clock(){
    seconde++;
    if (seconde==60){
        seconde=0;
        minute++;
    }
    if (seconde<10){
        document.getElementsByClassName("time")[0].innerText="0"+minute+":"+"0"+seconde+"s";
    }else{
        document.getElementsByClassName("time")[0].innerText="0"+minute+":"+seconde+"s";
    }
    if(seconde==30){
        result();
    }
}
function night(){
    if(nightc==0){
        document.getElementById("nuit").src="Ressources/luneN.png";
        nightc=1;
    }else{
        document.getElementById("nuit").src="Ressources/lune.png";
        nightc=0;
    }
    document.getElementById("menu").classList.toggle("menu");
    document.getElementById("text").classList.toggle("text");
    document.getElementsByClassName("menuButton")[0].classList.toggle("menuButtonN");
    document.getElementsByClassName("exitGame")[0].classList.toggle("exitGameN");
    document.getElementsByClassName("exitGame")[1].classList.toggle("exitGameN");
    document.getElementsByClassName("game")[0].classList.toggle("gameN");
    document.getElementsByClassName("count")[0].classList.toggle("countN");
    document.getElementsByClassName("time")[0].classList.toggle("timeN");
    document.getElementsByClassName("inGame")[0].classList.toggle("inGameN");
    document.getElementsByClassName("result")[0].classList.toggle("resultN");
    console.log(nightc);
}
function result(){
    document.getElementById("gameMenu").style.display="none";
    document.getElementsByClassName("inGame")[0].style.display="none";
    document.getElementById("resultScreen").style.display="flex";
    if (seconde<10){
        document.getElementsByClassName("timeResult")[0].innerText="You spent : 0"+minute+":"+"0"+seconde+"s";
    }else{
        document.getElementsByClassName("timeResult")[0].innerText="You spent 0"+minute+":"+seconde+"s";
    }
    document.getElementsByClassName("mistakes")[0].innerText="Missed : "+(fail-count);
    document.getElementsByClassName("countResult")[0].innerText="Score : "+count;
}
