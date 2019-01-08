<?php
include ("system/baglan.php");
include("system/fonksiyon.php");
session_start();


?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="keywords" content="grafik tasarim, logo tasarim, kartvizit tasarim, kurumsal kimlik, kurumsal kimlik tasarim, yazilim, web tasarim," />
		<meta name="description" content="Rampesna Grafik ve Yazılım">
		<meta name="author" content="rampesna.com">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
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
		<!-- SAYFA BAŞLANGICI -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="giris.php" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i>Apartman Yönetim Sistemi</h2>
					</div>
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group mb-lg">
								<label>Kullanıcı Adı</label>
								<div class="input-group input-group-icon">
									<input name="kullanici" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Şifre</label>
									<a href="#" style="display: none;" class="pull-right">Şifremi Unuttum</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="sifre" type="password" class="form-control input-lg" />
                                    <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default" style="display: none;">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="submit" class="btn btn-primary hidden-xs">Giriş Yap</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Giriş Yap</button>
								</div>
							</div>
							<span class="mt-lg mb-lg line-thru text-center text-uppercase" style="display: none;">
								<span>or</span>
							</span>
							<div class="mb-xs text-center"  style="display: none;">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>
							<p class="text-center" style="display: none;">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a></p>
						</form>
                        <?php
                        if(isset($_POST['submit'])){
                            $_POST = array_map('filtrele', $_POST);
                        if(!post('kullanici')){
                            echo'<div><span style="color: red;  "><b>Kullanıcı Adı Boş girilemez</b></span></div>';
                                                    }
                        elseif (!post('sifre')){
                            echo '<div><span style="color: red;  "><b>Sifre boş olamaz</b></span></div>';

                        }
                            else {
                                $ad=post('kullanici');
                                $sifre=post('sifre');
                                $sorgu = $db->prepare('SELECT ad,yetki,id FROM sakin WHERE eposta= ? AND sifre= ?');
                                $sorgu->execute(array($ad,md5($sifre)));
                                $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
                                if($sonuc){
                                    $_SESSION['ad']=$sonuc[0]["ad"];
                                    $_SESSION['yetki']=$sonuc[0]['yetki'];
                                    $_SESSION['id']=$sonuc[0]['id'];
                                    $_SESSION['oturum']=true;
                                    header('Refresh:1; url=anasayfa.php');

                                }
                                else{
                                    echo '<div><span style="color: red;  "><b>Eposta veya Şifrenizi yanlış girdiniz</b></span></div>';
                                }
                            }
                        }


                        ?>
					</div>
				</div>
				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. Tüm Hakları 3 Red Group Tarafından Saklıdır.</p>
			</div>
		</section>
		<!-- end: page -->
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-  datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
	</body>

</html>

