<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
$parcalanan=parcala($_GET['sayfa']);
$sikayet=$db->prepare('SELECT baslik,icerik FROM sikayetler WHERE id=?');
$sikayet->execute([$parcalanan[1]]);
$sikayetler=$sikayet->fetch(PDO::FETCH_ASSOC);
$sikayetkisi=$db->prepare('SELECT s_id FROM sikayetler WHERE id=?');
$sikayetkisi->execute([$parcalanan[1]]);
$kisiid=$sikayetkisi->fetch(PDO::FETCH_ASSOC);
$kisi=kisi($kisiid['s_id']);

?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Sikayet Detay / <?=$sikayetler['baslik']?></h2>
                    </header>
                    <header class="panel-heading">
                        <h2 class="panel-title"><?=$sikayetler['baslik']?></h2>
                    </header>
                    <div class="panel-body">
                        <blockquote>
                            <p>
                                <?=$sikayetler['icerik']?>
                            </p>
                            <small><?=$kisi['ad']?>, <cite title="Magazine X"><?=$kisi['blok']?> Blok / Daire <?=$kisi['daire']?> </cite></small>
                        </blockquote>
                    </div>
                    <form class="form-horizontal form-bordered" method="get">
                        <a href="anasayfa.php?sayfa=mail-<?=$kisiid['s_id']?>" style="text-decoration: none;"><button type="button" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Cevap Yaz</button></a>
                    </form>
				</section>
