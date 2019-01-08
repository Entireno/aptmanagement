<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
$parcalanan=parcala($_GET['sayfa']);
$sayfa=$db->prepare('SELECT ilk,son,miktar FROM '.$parcalanan[1].' WHERE  blok=? GROUP BY ilk');
$sayfa->execute([strtoupper($parcalanan[2])]);
$sayfaparametre=$sayfa->fetchAll(PDO::FETCH_ASSOC);

?>

				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2><?=strtoupper($parcalanan[2])?> Bloğu - <?=strtoupper($parcalanan[1])?> Fatura Geçmişi</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Toplam Tutar</th>
                                <th>Daire Başına Ödenecek Tutar</th>
                                <th class="hidden-xs">Son Ödeme Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php foreach ($sayfaparametre as $blokgecmis):?>
                                <td><?=$blokgecmis['ilk']?></td>
                                <td><?=ceil($blokgecmis['miktar']*say($blokgecmis['ilk'],$parcalanan[1]))?> TL
                                </td>
                                <td><?=$blokgecmis['miktar']?></td>
                                <td class="center hidden-xs"><?=$blokgecmis['son']?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
				</section>

