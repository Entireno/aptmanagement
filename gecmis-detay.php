<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
$parcalanan=parcala($_GET['sayfa']);
if($_SESSION['yetki']!=1){
    if($_SESSION['id']!=$parcalanan[2]){
        header('Location: anasayfa.php?sayfa=gecmis-detay-'.$_SESSION['id']);
    }
}
$e=$db->prepare('SELECT tarih,gecikme,miktar FROM elektirik WHERE s_id=? AND durum!=0 ');
$d=$db->prepare('SELECT tarih,gecikme,miktar FROM dogalgaz WHERE s_id=? AND durum!=0 ');
$di=$db->prepare('SELECT tarih,gecikme,miktar FROM diger WHERE s_id=? AND durum!=0 ');
$s=$db->prepare('SELECT tarih,gecikme,miktar FROM su  WHERE s_id=? AND durum!=0 ');
$e->execute([$parcalanan[2]]);
$d->execute([$parcalanan[2]]);
$di->execute([$parcalanan[2]]);
$s->execute([$parcalanan[2]]);
$eb=$e->fetchAll(PDO::FETCH_ASSOC);
$deb=$d->fetchAll(PDO::FETCH_ASSOC);
$dib=$di->fetchAll(PDO::FETCH_ASSOC);
$sb=$s->fetchAll(PDO::FETCH_ASSOC);
$kisi=$db->prepare('SELECT ad FROM sakin WHERE  id=?');
$kisi->execute([$parcalanan[2]]);
$kisiisim=$kisi->fetch(PDO::FETCH_ASSOC);

?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2><?=$kisiisim['ad']?> - ÖDEME GEÇMİŞİ</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Borç Miktarı</th>
                                <th>Ödenme durumu</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sb as $su):?>
                            <tr class="<?= $su['gecikme']==1 ? 'warning':'success'?>">
                                <td><?=$su['tarih']?></td>
                                <td><?=$su['miktar']?></td>

                                <td><?= $su['gecikme']==1 ? 'GECİKMELİ ÖDENDİ':'ÖDENDİ'?></td>
                            </tr>
                            <?php endforeach;?>
                            <?php foreach ($eb as $elektirik):?>
                                <tr class="<?= $elektirik['gecikme']==1 ? 'warning':'success'?>">
                                    <td><?=$elektirik['tarih']?></td>
                                    <td><?=$elektirik['miktar']?></td>

                                    <td><?= $elektirik['gecikme']==1 ? 'GECİKMELİ ÖDENDİ':'ÖDENDİ'?></td>
                                </tr>
                            <?php endforeach;?>
                            <?php foreach ($dib as $diger):?>
                                <tr class="<?= $diger['gecikme']==1 ? 'warning':'success'?>">
                                    <td><?=$diger['tarih']?></td>
                                    <td><?=$diger['miktar']?></td>

                                    <td><?= $diger['gecikme']==1 ? 'GECİKMELİ ÖDENDİ':'ÖDENDİ'?></td>
                                </tr>
                            <?php endforeach;?>
                            <?php foreach ($deb as $dogalgaz):?>
                                <tr class="<?= $dogalgaz['gecikme']==1 ? 'warning':'success'?>">
                                    <td><?=$dogalgaz['tarih']?></td>
                                    <td><?=$dogalgaz['miktar']?></td>

                                    <td><?= $dogalgaz['gecikme']==1 ? 'GECİKMELİ ÖDENDİ':'ÖDENDİ'?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
				</section>

