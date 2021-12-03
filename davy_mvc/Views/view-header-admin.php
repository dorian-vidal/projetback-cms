<?php
// Déconnexion
if (isset($_POST['deconnexion'])) {
    deconnexion_davy();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Davy CRUD - <?php if ($bdd_table) {echo $bdd_table;} ?></title>
        <meta name="description" content="CRUD : Create, Read, Update, Delete">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?= URL ?>/Views/images/logo-icon-min.png">
        <link rel="stylesheet" href="<?= URL ?>/Views/css/style_bootstrap_grid.min.css">
        <link rel="stylesheet" href="<?= URL ?>/Views/css/style_nav_mobile.css">
        <link rel="stylesheet" href="<?= URL ?>/Views/css/style_bouton.css">
        <link rel="stylesheet" href="<?= URL ?>/Views/css/style.css">
        <link rel="stylesheet" href="<?= URL ?>/Views/css/style_admin.css">
    </head>
    
    <body>
        <div class="container">
            <div class="sidebar_admin_davy mt-5 pe-3 fixed_top_davy">
                <!-- Data -->
<?php
$pdo_statement_base = $pdo_object->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='$bdd_name'");
$pdo_statement_base->execute();
while ($table_data_base = $pdo_statement_base->fetch(PDO::FETCH_ASSOC)) :
?>
                <a href="<?= URL ?>/gestion.php?table=<?= $table_data_base['TABLE_NAME'] ?>" class="lien_admin_davy" title="<?= $table_data_base['TABLE_NAME'] ?>">
                    <svg class="icon_admin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-prefix="fas" data-icon="copy"><path fill="currentColor" d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z"></path></svg> <?= $table_data_base['TABLE_NAME'] ?>
                </a>
<?php
endwhile;
?>
                <hr class="hr_admin_davy">
                <form method="post" id="bouton_deconnecter_davy">
                    <!-- bouton_anim_davy -->
                    <a aria-label="Quitter" class="bouton_anim_davy bouton_envoyer width_full_davy bouton_full_davy" data-text="Déconnecter" title="Déconnecter">
                        <span>Q</span>
                        <span>u</span>
                        <span>i</span>
                        <span>t</span>
                        <span>t</span>
                        <span>e</span>
                        <span>r</span>
                        <input type="submit" id="deconnexion" name="deconnexion" value="Déconnecter" class="bouton_submit">
                    </a>
                </form>
            </div>

            <!-- nav_mobile_davy -->
            <div class="nav_mobile_davy">
                <div class="nav_mobile_center_davy">
                    <a href="" class="menu_mobile_davy lien_dashboard" title="Dashboard">
                        <svg class="icon_menu_mobile_davy" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-prefix="fas" data-icon="chart-pie"><path fill="currentColor" d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path></svg>
                        <br>
                        <p class="texte_menu_mobile_davy lien_dashboard">Dashboard</p>
                    </a>
                    <a href="" class="menu_mobile_davy lien_mail" title="Mail">
                        <svg class="icon_menu_mobile_davy" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-prefix="fas" data-icon="envelope-open"><path fill="currentColor" d="M512 464c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V200.724a48 48 0 0 1 18.387-37.776c24.913-19.529 45.501-35.365 164.2-121.511C199.412 29.17 232.797-.347 256 .003c23.198-.354 56.596 29.172 73.413 41.433 118.687 86.137 139.303 101.995 164.2 121.512A48 48 0 0 1 512 200.724V464zm-65.666-196.605c-2.563-3.728-7.7-4.595-11.339-1.907-22.845 16.873-55.462 40.705-105.582 77.079-16.825 12.266-50.21 41.781-73.413 41.43-23.211.344-56.559-29.143-73.413-41.43-50.114-36.37-82.734-60.204-105.582-77.079-3.639-2.688-8.776-1.821-11.339 1.907l-9.072 13.196a7.998 7.998 0 0 0 1.839 10.967c22.887 16.899 55.454 40.69 105.303 76.868 20.274 14.781 56.524 47.813 92.264 47.573 35.724.242 71.961-32.771 92.263-47.573 49.85-36.179 82.418-59.97 105.303-76.868a7.998 7.998 0 0 0 1.839-10.967l-9.071-13.196z"></path></svg>
                        <br>
                        <p class="texte_menu_mobile_davy lien_mail">Mail</p>
                    </a>
                    <a href="" class="menu_mobile_davy lien_parametres" title="Paramètres">
                        <svg class="icon_menu_mobile_davy" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" data-prefix="fas" data-icon="parametre"><path fill="currentColor" d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z"></path></svg>
                        <br>
                        <p class="texte_menu_mobile_davy lien_parametres">Paramètres</p>
                    </a>
                    <a class="menu_mobile_davy" title="Menu">
                        <div class="block_icon_menu_mobile_burger_davy">
                            <input id="nav_icon_menu_mobile_burger_davy" class="checkbox_pc_burger_davy" type="checkbox" name="menu_pc">
                            <span href="#" class="nav_icon_menu_mobile_burger_davy"><span></span></span>
                        </div><br>
                        <p class="texte_menu_mobile_davy">Menu</p>
                    </a>
                </div>
            </div>

            <!-- nav_mobile_burger_davy -->
            <div class="nav_mobile_burger_davy">
                <div class="m-5">
                    <a href="" title="Accueil" class="d-inline-block width_full_davy">Accueil</a>
                    <hr class="hr_admin_davy">
<?php
$pdo_statement_base = $pdo_object->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='$bdd_name'");
$pdo_statement_base->execute();
while ($table_data_base = $pdo_statement_base->fetch(PDO::FETCH_ASSOC)) :
?>
                    <a href="<?= URL ?>/gestion.php?table=<?= $table_data_base['TABLE_NAME'] ?>" title="<?= $table_data_base['TABLE_NAME'] ?>" class="d-inline-block width_full_davy lien_<?= $table_data_base['TABLE_NAME'] ?>"><?= $table_data_base['TABLE_NAME'] ?></a>
                    <hr class="hr_admin_davy">
<?php
endwhile;
?>
                    <form method="post" id="bouton_deconnecter_davy">
                        <!-- bouton_anim_davy -->
                        <a aria-label="Quitter" class="bouton_anim_davy bouton_envoyer width_full_davy bouton_full_davy" data-text="Déconnecter" title="Déconnecter">
                            <span>Q</span>
                            <span>u</span>
                            <span>i</span>
                            <span>t</span>
                            <span>t</span>
                            <span>e</span>
                            <span>r</span>
                            <input type="submit" id="deconnexion" name="deconnexion" value="Déconnecter" class="bouton_submit">
                        </a>
                    </form>
                    <br><br><br>
                </div>
            </div>
            <div class="main_admin_davy">
