<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
?>

<div class="inner-wrapper">
    <!-- SOL SİDEBAR BAŞLANGIÇ -->
    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
            <div class="sidebar-title">
                Yönetim
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">

                <!-- MENÜLER -->
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">
                        <li>
                            <a href="anasayfa.php?sayfa=duyurular">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <span>Duyurular</span>
                            </a>
                        </li>
                        <?php if($_SESSION['yetki']==1){?>
                        <li class="nav nav-parent">
                            <a href="#">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Apartmanlar</span>
                            </a>
							<ul class="nav nav-children">
                                <li>
                                    <a href="anasayfa.php?sayfa=site-a">
                                        A Blok
                                    </a>
                                </li>
								<li>
                                    <a href="anasayfa.php?sayfa=site-b">
                                        B Blok
                                    </a>
                                </li>
								<li>
                                    <a href="anasayfa.php?sayfa=site-c">
                                        C Blok
                                    </a>
                                </li>
								<li>
                                    <a href="anasayfa.php?sayfa=site-d">
                                        D Blok
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav nav-parent">
                            <a href="#">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span>Giderler</span>
                            </a>
							<ul class="nav nav-children">
                                <li class="nav-parent">
                                    <a href="#">
                                        Doğalgaz Faturaları
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-dogalgaz-a">
                                                A Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-dogalgaz-b">
                                                B Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-dogalgaz-c">
                                                C Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-dogalgaz-d">
                                                D Blok
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li class="nav-parent">
                                    <a href="#">
                                        Elektrik Faturaları
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-elektirik-a">
                                                A Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-elektirik-b">
                                                B Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-elektirik-c">
                                                C Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-elektirik-d">
                                                D Blok
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li class="nav-parent">
                                    <a href="#">
                                        Su Faturaları
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-su-a">
                                                A Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-su-b">
                                                B Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-su-c">
                                                C Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-su-d">
                                                D Blok
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li class="nav-parent">
                                    <a href="#">
                                        Diğer Giderler
                                    </a>
                                    <ul class="nav nav-children">
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-diger-a">
                                                A Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-diger-b">
                                                B Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-diger-c">
                                                C Blok
                                            </a>
                                        </li>
                                        <li>
                                            <a href="anasayfa.php?sayfa=giderler-diger-d">
                                                D Blok
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="anasayfa.php?sayfa=faturagir">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <span>Fatura Girişi</span>
                            </a>
                        </li>

						<li>
                            <a href="anasayfa.php?sayfa=sikayetler">
                                <i class="fa fa-warning" aria-hidden="true"></i>
                                <span>Şikayetler</span>
                            </a>
                        </li>
                        <li>
                            <a href="anasayfa.php?sayfa=kisiekle">
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                                <span>Kişi Ekle</span>
                            </a>
                        </li>

                        <li>
                            <a href="anasayfa.php?sayfa=mail">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>Mail Gönder</span>
                            </a>
                        </li>
                        <?php }?>
                        <?php if($_SESSION['yetki']==0){?>
                        <li>
                            <a href="anasayfa.php?sayfa=sikayet">
                                <i class="fa fa-warning" aria-hidden="true"></i>
                                <span>Şikayet Et</span>
                            </a>
                        </li>
                            <li>
                                <a href="anasayfa.php?sayfa=gecmis-detay-<?=$_SESSION['id']?>">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>Geçmiş Ödemelerim</span>
                                </a>
                            </li>
                            <li>
                                <a href="anasayfa.php?sayfa=detay-<?=$_SESSION['id']?>">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                    <span>Güncel Borclarım</span>
                                </a>
                            </li>



                        <?php }?>
                    </ul>

                </nav>

                <hr class="separator" />

                
            </div>

            <script>
                // Maintain Scroll Position
                if (typeof localStorage !== 'undefined') {
                    if (localStorage.getItem('sidebar-left-position') !== null) {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                            sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                        sidebarLeft.scrollTop = initialPosition;
                    }
                }
            </script>

        </div>

    </aside>
    <!-- SOL SİDEBAR BİTİŞ -->
