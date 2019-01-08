<?php
/**
 * Created by PhpStorm.
 * User: Entireno
 * Date: 15.04.2018
 * Time: 22:12
 */
session_start();
session_destroy();

?>
<div>
    <span>Çıkış işlemi Başarılı ,giriş sayfasına yönlendiriliyorsunuz...</span>
</div>
<?php
header('Refresh:2; url=../index.php');
?>
