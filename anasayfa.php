<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: Entireno
 * Date: 17.04.2018
 * Time: 17:43
 */
session_start();
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}

 include ("system/baglan.php");
 include("system/fonksiyon.php");

 include ("moduller/header.php");
 include ("moduller/sol-sidebar.php");
  $_GET=array_map('filtrele',$_GET);
  if(!isset($_GET['sayfa'])){
      $_GET['sayfa']='anasayfa';
  }
 $parcalanan= parcala($_GET['sayfa']);
  if(is_array($parcalanan)){
      $sayfa=$parcalanan[0];
  }
  else{
      $sayfa=$parcalanan;
  }

  Switch($sayfa){
      case 'duyurular':
          require_once 'duyurular.php';
          break;
      case 'site':
      require_once 'site-a.php';
         break;
      case 'faturagir':
          require_once 'faturagir.php';
          break;
      case 'giderler':
        require_once 'giderler.php';
          break;
      case 'sikayetler':
          require_once 'sikayetler.php';
          break;
      case 'kisiekle':
          require_once 'kisiekle.php';
          break;
      case 'sikayet':
          require_once 'sikayet.php';
          break;
      case 'mail':
          require_once 'mail.php';
          break;
      case 'sikayetdetay':
          require_once 'sikayetdetay.php';
          break;
      case 'gecmis':
          require_once 'gecmis-detay.php';
          break;
      case 'kisiduzenle':
          require_once 'kisiduzenle.php';
          break;
      case 'detay':
          require_once 'detay.php';
          break;
      case 'profil':
          require_once 'profilduzenle.php';
          break;
      case'duyuruekle':
          require_once 'duyurugir.php';
          break;

      default:
          require_once 'duyurular.php';
          break;
  }





include ("moduller/sag-sidebar.php");
include ("moduller/footer.php");
?>