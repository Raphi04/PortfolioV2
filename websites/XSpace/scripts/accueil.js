function movetoPresentation(){
    document.getElementById("presentation").scrollIntoView({behavior: "smooth", block: "center"});
}
function move(){
    document.getElementById("down").classList.toggle("move");
}
setInterval(move, 600);
