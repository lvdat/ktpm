                </div>
                <div class="col-md-3">
                    <div class="sticky">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <? if(!login()): ?>
                                    <p>Đăng nhập để tối ưu hóa trải nghiệm và cá nhân hóa nội dung</p>
                                    <a href="/dangnhap" title="Đăng nhập" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP HỆ THỐNG</a>
                                <? else: ?>
                                    <img style="max-width: 43%;border: 3px solid #ab1170;border-radius: 50%" src="<?=getsv(MSSV)['avatar'];?>">
                                <? endif ?>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">Thông báo mới</div>
                            <ul class="list-group list-group-flush">
                                <?
                                $sql = "SELECT * FROM thongbao ORDER BY ID DESC LIMIT 5";
                                $kq = $conn->query($sql);
                                if($kq->num_rows == 0){
                                    echo 'Không có thông báo';
                                }else{
                                    while($e = mysqli_fetch_assoc($kq)){
                                        echo '<li class="list-group-item"><a href="/view/'.$e['ID'].'">'.$e['name'].'</a> <small><i class="text-muted">'.timeago($e['time']).'</i></small></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<? echo '<!-- Time server: '.time().'
Author: Le Van Dat-->'; ?>