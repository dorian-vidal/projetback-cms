/* animation_davy */
function animation_davy(scroll_hauteur) {
    let animation_davy = document.getElementsByClassName("animation_davy");

    if (animation_davy) {
        let animation_davy_length = animation_davy.length;

        for (i = 0; i < animation_davy_length; i++) {
            let scroll_position = animation_davy[i].getBoundingClientRect().top - window.innerHeight + scroll_hauteur;
            let scroll_position2 = animation_davy[i].getBoundingClientRect().top + animation_davy[i].offsetHeight;
            
            if (scroll_position < 0 && scroll_position2 > 0) {
                if (animation_davy[i].className.indexOf("show") == -1) {
                    animation_davy[i].className += " show";
                }
            }
            else {
                if (animation_davy[i].className.indexOf("show") != -1) {
                    animation_davy[i].className = animation_davy[i].className.replace(" show", "");
                }
            }
        }
    }
}

window.addEventListener("scroll", () => {
    animation_davy(30);
}, false);

/* animation_scroll_header_davy */
function animation_scroll_header_davy() {
    let block_animation_scroll_header_davy = document.getElementsByClassName("block_animation_scroll_header_davy");
    
    if (block_animation_scroll_header_davy) {
        let block_animation_scroll_header_davy_length = block_animation_scroll_header_davy.length;
        
        for (i = 0; i < block_animation_scroll_header_davy_length; i++) {
            let pourcentage_animation_scroll_header_davy = (window.pageYOffset - block_animation_scroll_header_davy[i].offsetTop) / (block_animation_scroll_header_davy[i].offsetHeight);
            let position = i + 1;
            let var_animation_scroll_header_davy = "--var_animation_scroll_header_davy_" + position;

            if ((pourcentage_animation_scroll_header_davy >= 0) && (pourcentage_animation_scroll_header_davy <= 1)) {
                document.body.style.setProperty(var_animation_scroll_header_davy, pourcentage_animation_scroll_header_davy);
            }
            if (pourcentage_animation_scroll_header_davy < 0) {
                document.body.style.setProperty(var_animation_scroll_header_davy, 0);
            }
            if (pourcentage_animation_scroll_header_davy > 1) {
                document.body.style.setProperty(var_animation_scroll_header_davy, 1);
            }
        }
    }
}

window.addEventListener("scroll", () => {
    animation_scroll_header_davy();
}, false);

/* animation_scroll_davy */
function animation_scroll_davy() {
    let block_animation_scroll_davy = document.getElementsByClassName("block_animation_scroll_davy");

    if (block_animation_scroll_davy) {
        let block_animation_scroll_davy_length = block_animation_scroll_davy.length;

        for (i = 0; i < block_animation_scroll_davy_length; i++) {
            let pourcentage_animation_scroll_davy = (window.pageYOffset - block_animation_scroll_davy[0].offsetTop + window.innerHeight) / (window.innerHeight + block_animation_scroll_davy[0].offsetHeight);
            let position = i + 1;
            let var_animation_scroll_davy = "--var_animation_scroll_davy_" + position;

            if ((pourcentage_animation_scroll_davy >= 0) && (pourcentage_animation_scroll_davy <= 1)) {
                document.body.style.setProperty(var_animation_scroll_davy, pourcentage_animation_scroll_davy);
            }
            if (pourcentage_animation_scroll_davy < 0) {
                document.body.style.setProperty(var_animation_scroll_davy, 0);
            }
            if (pourcentage_animation_scroll_davy > 1) {
                document.body.style.setProperty(var_animation_scroll_davy, 1);
            }
        }
    }
}

window.addEventListener("scroll", () => {
    animation_scroll_davy();
}, false);