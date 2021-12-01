/* nav_mobile_burger_davy */
function nav_mobile_burger_davy() {
    let nav_mobile_burger_davy = document.getElementsByClassName("nav_mobile_burger_davy");
    
    if (nav_mobile_burger_davy) {
        if (nav_mobile_burger_davy[0].className.indexOf("show") == -1) {
            nav_mobile_burger_davy[0].className += " show";
        }
        else {
            nav_mobile_burger_davy[0].className = nav_mobile_burger_davy[0].className.replace(" show", "");
        }
    }
}

let nav_icon_menu_mobile_burger_davy = document.getElementById("nav_icon_menu_mobile_burger_davy");

if (nav_icon_menu_mobile_burger_davy) {
    nav_icon_menu_mobile_burger_davy.addEventListener('click', nav_mobile_burger_davy);
}