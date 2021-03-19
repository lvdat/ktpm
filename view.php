<?
require './inc/head.php';
if(isset($_GET['id'])){
    define('TB_ID', $_GET['id']);
    if(getthongbao(TB_ID) != 0){
        define('DATA_TB', getthongbao(TB_ID));
        $name = DATA_TB['name'];
        $nd = DATA_TB['noidung'];
        $author = DATA_TB['author'];
        $time = timeago(DATA_TB['time']);
        $title = $name.' - Hệ thống thông tin KTPM 04 K46';
    }else{
        header("Location: /");
    }
}else{
    header("Location: /");
}
?>
<div class="card mb-2">
    <div class="card-body">
        <h2><?=$name?></h2>
        <cite class="text-muted"><small>Bởi <b><?=$author?></b> (<?=$time?>)</small></cite>
        <p><?=$nd?></p>
    </div>
</div>
<?
require './inc/foot.php';
?>