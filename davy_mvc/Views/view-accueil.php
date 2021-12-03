<?php
require_once("view-header.php");
foreach($articles as $article):
?>

        <h2><?= $article->titre(); ?></h2>

<?php
endforeach;
require_once("view-footer.php");
?>