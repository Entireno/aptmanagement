<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
$duyuru=$db->prepare('SELECT * FROM duyurular');
$duyuru->execute();
$duyurular=$duyuru->fetchAll(PDO::FETCH_ASSOC);
$elektirik=$db->prepare('SELECT SUM(miktar) AS toplam FROM elektirik WHERE durum!=1 ');
$elektirik->execute();
$elektirikborc=$elektirik->fetch(PDO::FETCH_ASSOC);
$su=$db->prepare('SELECT SUM(miktar) AS toplam FROM su WHERE durum!=1  ');
$su->execute();
$suborc=$su->fetch(PDO::FETCH_ASSOC);
$diger=$db->prepare('SELECT SUM(miktar) AS toplam FROM diger WHERE durum!=1 ');
$diger->execute();
$digerborc=$diger->fetch(PDO::FETCH_ASSOC);
$dogalgaz=$db->prepare('SELECT SUM(miktar) AS toplam FROM dogalgaz WHERE durum!=1 ');
$dogalgaz->execute();
$dogalgazborc=$dogalgaz->fetch(PDO::FETCH_ASSOC);

$sitetoplamborc=$suborc['toplam']+$elektirikborc['toplam']+$dogalgazborc['toplam']+$digerborc['toplam'];

$gelektirik=$db->prepare('SELECT SUM(miktar) AS toplam FROM elektirik WHERE durum!=1 AND gecikme!=0');
$gelektirik->execute();
$gelektirikborc=$gelektirik->fetch(PDO::FETCH_ASSOC);
$gsu=$db->prepare('SELECT SUM(miktar) AS toplam FROM su WHERE durum!=1 AND gecikme!=0 ');
$gsu->execute();
$gsuborc=$gsu->fetch(PDO::FETCH_ASSOC);
$gdiger=$db->prepare('SELECT SUM(miktar) AS toplam FROM diger WHERE durum!=1 AND gecikme!=0');
$gdiger->execute();
$gdigerborc=$gdiger->fetch(PDO::FETCH_ASSOC);
$gdogalgaz=$db->prepare('SELECT SUM(miktar) AS toplam FROM dogalgaz WHERE durum!=1 AND gecikme!=0 ');
$gdogalgaz->execute();
$gdogalgazborc=$gdogalgaz->fetch(PDO::FETCH_ASSOC);
$gecikmelitoplamborc=$gsuborc['toplam']+$gelektirikborc['toplam']+$gdigerborc['toplam']+$gdogalgazborc['toplam'];
$kisiguncelborc=guncelborc($_SESSION['id']);
$kisigecikmeliborc=gecikmeli($_SESSION['id']);

?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2> Duyurular </h2>
                    </header>

                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-secondary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-secondary">
                                            <i class="fa fa-try" ></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title"><?=$_SESSION['yetki']==1?'Sitenin Toplam Borcu':'Şuanki borcum'?></h4>
                                            <div class="info">
                                                <strong class="amount"><?=$_SESSION['yetki']==1? karaktersinirla($sitetoplamborc):karaktersinirla($kisiguncelborc)?></strong>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                        </div>

                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-secondary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-secondary">
                                            <i class="fa fa-try"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title"><?=$_SESSION['yetki']==1?'Toplam Geciken Borc miktarı':'Geciktirdiğim'?></h4>
                                            <div class="info">
                                                <strong class="amount"><?=$_SESSION['yetki']==1? karaktersinirla($gecikmelitoplamborc):karaktersinirla($kisigecikmeliborc)?></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <br>

                    <br>
                    <div class="toggle" data-plugin-toggle>
                        <?php foreach ($duyurular as $goster):?>
                        <section class="toggle">
                            <label><?=$goster['baslik']?></label>
                            <p><?=$goster['icerik']?> </p>
                            <?php if($_SESSION['yetki']==1){ ?>
                            <form action="#" method="post" name="<?=$goster['baslik']?>">
                            <p class="m-none" align="right">
                                <button type="submit" onclick=" return ShowConfirm()" name="submit" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary">Duyuruyu Kaldır</button>
                                <input type="hidden" name="kaldir"  value="<?=$goster['id']?>">
                            </p>
                            </form>
                            <?php } ?>
                        </section>
                        <?php endforeach; ?>
                        <br>
                        <?php if($_SESSION['yetki']==1){ ?>
                        <a href="anasayfa.php?sayfa=duyuruekle" style="text-decoration: none;"><button type="button" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Yeni Duyuru Gir</button></a>
                        <?php } ?>
                    </div>

        <?php
        if(isset($_POST['submit'])){
          $kaldir=$_POST['kaldir'];
          $duyurukaldir=$db->prepare('DELETE FROM duyurular WHERE id=?');
          $basarili=$duyurukaldir->execute([$kaldir]);
          if($basarili){
           header('Refresh:1; url=anasayfa.php?sayfa=duyurular');
          }

        }

        ?>

                </section>
<script type="text/javascript">

    function ShowConfirm() {
        var confirmation = confirm("Duyuruyu kaldırmak istediğinize emin misiz ?");
        if (confirmation) {
        }
        return confirmation;
    };

</script>