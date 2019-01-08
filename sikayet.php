<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i>X</i> Site Yönetimi</h2>
    </header>
    <form class="form-horizontal form-bordered" method="post" action="#">
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">Başlık</label>
            <div class="col-md-6">
                <input name="baslik" type="text" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="textareaAutosize">Şikayetinizin İçeriği</label>
            <div class="col-md-6">
                <textarea name="icerik" class="form-control" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea>
            </div>
        </div>
        <br>
        <br>
        <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Şikayeti Gönder</button>
    </form>

<?php
if(isset($_POST['submit'])){
    array_map('filtrele',$_POST);
    if(!post('baslik')){
        echo '<div><span style="color: red;  "><b>Lütfen başlığı giriniz</b></span></div>';

    }
    elseif (!post('icerik')){

        echo '<div><span style="color: red;  "><b>Lütfen İçeriği giriniz</b></span></div>';
    }
    else{
        $id=$_SESSION['id'];
        $ekle=$db->prepare('INSERT INTO sikayetler SET s_id=?,baslik=?,icerik=?');
        $ekle->execute([$id,$_POST['baslik'],$_POST['icerik']]);
        if($ekle){
            echo '<div><span style="color: green;  "><b>Başarıyla Eklendi</b></span></div>';
            header('Refresh:1; url=anasayfa.php?sayfa=sikayet');
        }
        else{
            echo '<div><span style="color: red;  "><b>Bir Hata oluştu Lütfen yöneticinize başvurun</b></span></div>';
        }
    }


}
?>
</section>