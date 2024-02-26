var clicked=0;
function view(img, check){
    if(clicked==0){
        document.getElementById(check).setAttribute("type", "text");
        document.getElementById(check).setAttribute("alt", "invisible");
        document.getElementById(img).src="ressources/invisible.png";
        clicked=1;
    }else{
        document.getElementById(check).setAttribute("type", "password");
        document.getElementById(check).setAttribute("alt", "invisible");
        document.getElementById(img).src="ressources/visible.png";
        clicked=0;
    }
}
