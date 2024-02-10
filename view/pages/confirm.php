<?php require_once(dirname(__FILE__, 2) . '/templates/head.php'); ?>

<div id="intro" class="w3-row">
    <div id="promo">
        <img id="promo_img" src="<?php echo $_SERVER['BASE_URL']; ?>images/noi_onvedelem2.jpg" alt="Nyílt Nap" />
    </div>
</div>
<div id="reg_msg_container" class="w3-panel w3-grey w3-padding w3-center"><?php echo $message; ?></div>

<?php require_once(dirname(__FILE__, 2) . '/templates/footer.php');