//Gestion de la barre de navigation lors des différentes actions (scroll et menu)
window.onscroll = function() {
    let allHeader = document.querySelectorAll("header");
    let menuCollapsed = document.getElementById("menu-collapse");
    
    if (window.scrollY > 0){
        if (menuCollapsed.classList.contains("displayNone")) {
            allHeader.forEach(header => {
                header.classList.add("blackHeader");
            });
        }
    } else {
        if (menuCollapsed.classList.contains("displayNone")) {
            allHeader.forEach(header => {
                header.classList.remove("blackHeader");
            });
        }
    }
}


//Afficher et retirer le menu quand on clique sur le bouton hamburger
function Menu() {
    let menu = document.getElementById("menu-collapse");
    let menuIcon = document.getElementById("menuIcon");
    let header = document.getElementById("menu-phone");

    if (window.scrollY == 0) {
        header.classList.toggle("blackHeader");

    } else {
        header.classList.add("blackHeader");
    }
    menu.classList.toggle("displayNone");
    setTimeout(() => menu.classList.toggle("opacityNone"), 100);
    menuIcon.classList.toggle("fa-bars");
    menuIcon.classList.toggle("fa-xmark");
}

//Observer des sections
let sections = document.querySelectorAll("body > section");
let allNavLinks = document.querySelectorAll(".headerLink");

//Options de l'observer
let options = {
    root: null,
    rootMargin: "0px",
    threshold: 0.6,
};

//Création de l'observer
let observer = new IntersectionObserver(callback, options);

//On observe la cible
sections.forEach(section => {
    observer.observe(section);
});

//Définition du callback
function callback(entries, observer) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            allNavLinks.forEach(link => {
                link.classList.remove("activeHeader");
            });
            let currentSection = entry.target.dataset.sectionname;
            let currentNavLink = document.getElementById("nav-"+currentSection);
            if(currentNavLink) {
                currentNavLink.classList.add("activeHeader");
            }
        }
    });
}

//Gestion des filtres du portfolio
function applyFilter(filter) {
    //Déclaration des variables pour la sélection du filtre
    let alreadySelected = document.querySelector(".selectedTag");
    let newSelect = document.querySelector("#"+filter);

    //Déclaration des variables pour l'affichage des projets
    let allProjects = document.querySelectorAll(".project");
    let allDevProjects = document.querySelectorAll(".project.dev");
    let allGraphismProjects = document.querySelectorAll(".project.graphism");
    let allRedactionProjects = document.querySelectorAll(".project.redaction");

    //Affichage du bon filtre
    alreadySelected.classList.remove("selectedTag");
    newSelect.classList.add("selectedTag");

    //Test de la valeur du filtre pour afficher les bon projets
    switch(filter) {
        case "allProjects" :
            allProjects.forEach(project => {
                project.closest("a").classList.remove("displayNone");
            });
            break;

        case "devProjects" :
            allProjects.forEach(project => {
                project.closest("a").classList.add("displayNone");
            })
            allDevProjects.forEach(devProject => {
                devProject.closest("a").classList.remove("displayNone");
            })
            break;

        case "graphismProjects" :
            allProjects.forEach(project => {
                project.closest("a").classList.add("displayNone");
            })
            allGraphismProjects.forEach(graphismProject => {
                graphismProject.closest("a").classList.remove("displayNone");
            })
            break;

        case "redactionProjects" :
            allProjects.forEach(project => {
                project.closest("a").classList.add("displayNone");
            })
            allRedactionProjects.forEach(redactionProject => {
                redactionProject.closest("a").classList.remove("displayNone");
            })
            break;
    }
}

//Affichage des information au survol des projets
function displayMoreInfo(div) {
    let divSelected = document.getElementById(div);
    let h4 = document.querySelector("#"+div+" h4");
    let p = document.querySelector("#"+div+" p");

    divSelected.classList.add("visible");
    setTimeout(() => {
        h4.classList.remove("displayNone");
        p.classList.remove("displayNone");
    },320);
}

function hideMoreInfo(div) {
    let divSelected = document.getElementById(div);
    let h4 = document.querySelector("#"+div+" h4");
    let p = document.querySelector("#"+div+" p");

    h4.classList.add("displayNone");
    p.classList.add("displayNone");
    divSelected.classList.remove("visible");
    setTimeout(() => {
        h4.classList.add("displayNone");
        p.classList.add("displayNone");
    },321);
}




