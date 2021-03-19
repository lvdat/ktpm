<?
$title = 'Trang chủ - Trang thông tin cho sinh viên KTPM A4';
require './inc/head.php';
?>
<div class="card mb-2">
    <div class="card-header bg-primary text-white"><i class="fas fa-bell"></i> Thông báo mới nhất</div>
    <div class="card-body">
        <?
            $sql = "SELECT * FROM thongbao ORDER BY ID DESC LIMIT 3";
        ?>
    </div>
</div>

<div class="card mb-2">
    <div class="card-header bg-success text-white">
        <i class="fas fa-search"></i> Tra cứu lớp học phần HK2
    </div>
    <div class="card-body">
        <p class="card-text"><i class="fas fa-user-graduate"></i> Chọn học phần:</p>
            <div class="input-group input-group-lg mb-3">
                <select name="mahp" id="mahp" style="max-width: 90%">
            <option selected disabled>Chọn học phần để tra cứu </option>
                <?php
                    $sql = "SELECT * FROM hocphan";
                    $kq = $conn->query($sql);
                    if($kq->num_rows > 0){
                    while($e = mysqli_fetch_assoc($kq)){
                        echo '<option value="'.$e['ID'].'" class="se">'.$e['mahp'].' - '.$e['name'].'</option>';
                    }
                    }else{
                    echo 'Lấy dữ liệu lỗi';
                    }
                ?>
                </select>
            </div>
            <div id="lophocphan">
            </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                var key = $('select');
                key.change(function(){
                    $('#lophocphan').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                    var data = key.val();
                    $.ajax({
                    url : '/data.php?entry=showlophp',
                    type : 'POST',
                    data: {mahp:data},
                    success : function(res){
                        $('#lophocphan').html(res);
                    }
                    });
                });
            });
        </script>

<?
require './inc/foot.php';
?>