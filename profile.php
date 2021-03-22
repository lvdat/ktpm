<?
$title = 'Tài khoản';
include './inc/head.php';
$mssv = MSSV;
if(login()){
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action == 'view'){
            if(isset($_GET['mssv'])){
                $mssv = $_GET['mssv'];
            }
        }
    }else{
        header("Location: /");
    }
}else{
    header("Location: /dangnhap");
}
?>
<? if($action == 'view') :?>
<? elseif($action == 'edit'): 
    $navbar = '<div class="card mb-2"><div class="card-header bg-primary text-white">Cài đặt tài khoản</div><ul class="list-group list-group-flush"><a class="list-group-item list-group-item-action" href="/profile/edit/general"><i class="fas fa-user-cog"></i> Thông tin chung</a><a class="list-group-item list-group-item-action" href="/profile/edit/avatar"><i class="fas fa-image"></i> Ảnh đại diện</a><a class="list-group-item list-group-item-action" href="/profile/edit/security"><i class="fas fa-shield-alt"></i> Bảo mật</a></ul></div>';
    ?>
    <div class="card mb-2"><div class="card-body">Chào mừng bạn đến với trang quản trị người dùng!</div></div>
    <? if(!isset($_GET['edit_action'])) : ?>
        <?=$navbar?>
    <? else: ?>
    <script>
        $('#head_addon').html('<?=$navbar?>');
    </script>
    <? $action_edit = $_GET['edit_action']; 
    if($action_edit == 'general') :?>
    <div class="card mb-2"><div class="card-header bg-success text-white">Cài đặt chung</div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <div class="alert alert-primary" role="alert">
        Một số mục không thể chỉnh sửa do là thông tin cố định. Nếu có sai sót vui lòng liên hệ mình để chỉnh sửa nhé, các thông tin này sẽ được sử dụng trong các công việc liên quan đến lớp, Đoàn,... và sẽ được bảo mật tất cả
        </div></li>
        <li class="list-group-item">
            <div class="form-group row">
            <div class="col-md-2 text-center">Tên SV: </div><div class="col-md-10"><input class="form-control" disabled value="<?=getsv(MSSV)['name']?>"></div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="form-group row">
            <div class="col-md-2 text-center">MSSV: </div><div class="col-md-10"><input class="form-control" disabled value="<?=MSSV?>"></div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="form-group row">
            <div class="col-md-2 text-center">Email: </div><div class="col-md-10"><input class="form-control" disabled value="<?=getsv(MSSV)['mail']?>"></div>
            </div>
        </li>
    </ul>
    
    
    
    </div>
    <? elseif($action_edit == 'avatar') :?>

    <? elseif($action_edit == 'security') :?>
    <? endif ?>

    <? endif ?>
<? endif ?>
<?
include './inc/foot.php';
?>