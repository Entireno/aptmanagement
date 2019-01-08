<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
?>


<!doctype html>
<html class="fixed sidebar-left-sm">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>3RED-SİTE YÖNETİM PANELİ</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="assets/vendor/morris.js/morris.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
    <link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
    <link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
    <link rel="stylesheet" href="assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="assets/vendor/modernizr/modernizr.js"></script>

</head>
<body>
<section class="body">

    <!-- HEADER BAŞLANGIÇ -->
    <header class="header">
        <div class="logo-container">
            <a href="anasayfa.php" class="logo">
                <img src="assets/images/logo.png" height="35" alt="Rampesna" />
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

            <form action="pages-search-results.html" class="search nav-form" style="display: none">
                <div class="input-group input-search">
                    <input type="text" class="form-control" name="q" id="q" placeholder="Arama Yap...">
                    <span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
                </div>
            </form>

            <span class="separator" style="display: none;"></span>

            <!-- BİLDİRİMLER -->

            <ul class="notifications" >
                <li style="display: none;">
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="badge">3</span>
                    </a>

                    <div class="dropdown-menu notification-menu large">
                        <div class="notification-title">
                            <span class="pull-right label label-default">3</span>
                            Tasks
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <p class="clearfix mb-xs">
                                        <span class="message pull-left">Generating Sales Report</span>
                                        <span class="message pull-right text-dark">60%</span>
                                    </p>
                                    <div class="progress progress-xs light">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                    </div>
                                </li>

                                <li >
                                    <p class="clearfix mb-xs">
                                        <span class="message pull-left">Importing Contacts</span>
                                        <span class="message pull-right text-dark">98%</span>
                                    </p>
                                    <div class="progress progress-xs light">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                    </div>
                                </li>

                                <li >
                                    <p class="clearfix mb-xs">
                                        <span class="message pull-left">Uploading something big</span>
                                        <span class="message pull-right text-dark">33%</span>
                                    </p>
                                    <div class="progress progress-xs light mb-xs">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li style="display: none;">
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown" >
                        <i class="fa fa-envelope"></i>
                        <span class="badge">4</span>
                    </a>

                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="pull-right label label-default">120</span>
                            Toplam Mesaj
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
                                        </figure>
                                        <span class="title">Müşteri 1</span>
                                        <span class="message">Müşteri bilgi kısa mesaj denemesi...</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                        </figure>
                                        <span class="title">Müşteri 2</span>
                                        <span class="message truncate">Müşteri bilgi kısa mesaj denemesi...</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
                                        </figure>
                                        <span class="title">Müşteri 3</span>
                                        <span class="message">Müşteri bilgi kısa mesaj denemesi...</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <figure class="image">
                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                        </figure>
                                        <span class="title">Müşteri 4</span>
                                        <span class="message">Müşteri bilgi kısa mesaj denemesi...</span>
                                    </a>
                                </li>
                            </ul>

                            <hr />

                            <div class="text-right">
                                <a href="#" class="view-more">Hepsini Göster</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="display: none;">
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="badge">3</span>
                    </a>

                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="pull-right label label-default">3</span>
                            Alerts
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-thumbs-down bg-danger"></i>
                                        </div>
                                        <span class="title">Server is Down!</span>
                                        <span class="message">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-lock bg-warning"></i>
                                        </div>
                                        <span class="title">User Locked</span>
                                        <span class="message">15 minutes ago</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-signal bg-success"></i>
                                        </div>
                                        <span class="title">Connection Restaured</span>
                                        <span class="message">10/10/2016</span>
                                    </a>
                                </li>
                            </ul>

                            <hr />

                            <div class="text-right">
                                <a href="#" class="view-more">View All</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="assets/images/guest.png" alt="guest" class="img-circle" data-lock-picture="assets/images/kullanici.jpg" />
                    </figure>
                    <div class="profile-info" data-lock-name="Talha Can" data-lock-email="rampesna@gmail.com">
                        <span class="name"> <?php echo $_SESSION['ad']?></span>
                        <span class="role"><?= $_SESSION['yetki']==1 ? 'Yönetici':'Üye' ?></span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="anasayfa.php?sayfa=profil"><i class="fa fa-user"></i> Profili Görüntüle</a>
                        </li>
                        <li>
                            <a role="menuitem" style="display: none;" tabindex="-1" href="kilitle.php"><i class="fa fa-lock"></i> Ekranı Kilitle</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="system/cikis.php"><i class="fa fa-power-off"></i> Çıkış Yap</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    <!-- HEADER BİTİŞ -->
