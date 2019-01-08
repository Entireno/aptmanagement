<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
$sikayet=$db->prepare('SELECT s_id,id,baslik FROM sikayetler');
$sikayet->execute();
$sikayetler=$sikayet->fetchAll(PDO::FETCH_ASSOC);
?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Sikayetler</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                                <thead>
                                <tr>
                                    <th>Blok</th>
                                    <th>Daire No</th>
                                    <th>Ad Soyad</th>
                                    <th>Şikayet Başlığı</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sikayetler as $goruntule):?>
                                <?php $kisi=kisi($goruntule['s_id']); ?>

                                <tr>
                                    <td><?=strtoupper($kisi['blok'])?> Blok</td>
                                    <td><?=strtoupper($kisi['daire'])?> </td>
                                    <td><?=strtoupper($kisi['ad'])?> </td>
                                    <td><a href="anasayfa.php?sayfa=sikayetdetay-<?=$goruntule['id']?>"><?=$goruntule['baslik']?> </a></td>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
				</section>

