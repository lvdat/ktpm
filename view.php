<?
require './inc/head.php';
$view = 0;
if(isset($_GET['id'])){
    define('TB_ID', $_GET['id']);
    if(getthongbao(TB_ID) != 0){
        define('DATA_TB', getthongbao(TB_ID));
        $name = DATA_TB['name'];
        $nd = DATA_TB['noidung'];
        $author = DATA_TB['author'];
        $time = timeago(DATA_TB['time']);
        $title = $name.' - Hệ thống thông tin KTPM 04 K46';
        $view = 1;
    }
}
?>
<? if($view  == 1) : ?>
<div class="card mb-2">
    <div class="card-body">
        <h2><?=$name?></h2>
        <cite class="text-muted"><small>Bởi <b><?=$author?></b> (<?=$time?>)</small></cite>
        <p><?=$nd?></p>
    </div>
</div>
<div class="card mb-2">
<div class="card-header">Phản hồi cho bài viết</div>
<div class="card-body">
    <? if(login()) :?>
    <div class="row">
        <div class="col-2 text-center"><img src="<?=getsv(MSSV)['avatar']?>" style="max-width: 70%; border-radius: 50%; bodrder: 1px solid #000" /></div>
        <div class="col-10">
            <form id="comment">
                <textarea class="form-control mb-2" name="noidung" id="comment_nd"></textarea>
                <button type="submit" name="gui" class="btn btn-success btn-sm">Phản hồi</button>
            </form>
            <script type="text/javascript">

            </script>
        </div>
    </div>
    
    <? endif ?>
    
</div></div>
<? else: ?>
<? endif ?>
<?
require './inc/foot.php';
?>