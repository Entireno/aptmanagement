<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
 include '404.php';
 exit();
}
 $parcalanan=parcala($_GET['sayfa']);
 $sayfa=$db->prepare('SELECT * FROM sakin WHERE  blok=?');
 $sayfa->execute([strtoupper($parcalanan[1])]);
 $sayfaparametre=$sayfa->fetchAll(PDO::FETCH_ASSOC);
?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2><?=strtoupper($parcalanan[1]) ?> Bloğu</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                                <thead>
                                <tr>
                                    <th>Daire No</th>
                                    <th>Adı Soyadı</th>
                                    <th>İletişim Numarası</th>
                                    <th>Güncel Borç</th>
                                    <th>Ödeme Geçmişi</th>
                                    <th>Düzenleme</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="#" method="post">
                                <?php foreach ($sayfaparametre as $sayfaicerik): ?>
                                    <tr>
                                        <td><?=$sayfaicerik['daire'] ?></td>
                                        <td><?=$sayfaicerik['ad'] ?></td>
                                        <td><?=$sayfaicerik['tel'] ?></td>
                                        <td><a href="anasayfa.php?sayfa=detay-<?=$sayfaicerik['id']?>"><?=guncelborc($sayfaicerik['id'])?></a></td>
                                        <td><a href="anasayfa.php?sayfa=gecmis-detay-<?=$sayfaicerik['id']?>">Sorgula</a></td>
                                        <td class="actions-hover actions-fade">
                                            <a href="anasayfa.php?sayfa=kisiduzenle-<?=$sayfaicerik['id']?>"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </form>
                                </tbody>

                            </table>
                        </div>
                    </div>
				</section>