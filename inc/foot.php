                </div>
                <div class="col-md-3">
                    <div class="sticky">
                        <div class="card mb-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center">
                                    <? if(!login()): ?>
                                        <p>Đăng nhập để tối ưu hóa trải nghiệm và cá nhân hóa nội dung</p>
                                        <a href="/dangnhap" title="Đăng nhập" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP HỆ THỐNG</a>
                                    <? else: ?>
                                        <img style="max-width: 43%;border: 3px solid #ab1170;border-radius: 50%" src="<?=getsv(MSSV)['avatar'];?>">
                                    <? endif ?>
                                </li>
                                <? if(login()) :?>
                                <li class="list-group-item text-center"><?if(getsv(MSSV)['level'] > 0){echo '<span class="badge bg-danger"><i class="fas fa-user-shield"></i> ADMIN</span> ';}?><span class="badge bg-secondary"><?=MSSV?></span> <b><?=getsv(MSSV)['name']?></b></li>
                                <? endif ?>
                            </ul>
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
                        <div class="card mb-2">
                            <div class="card-header">Ai đang trực tuyến?</div>
                            <div class="card-body">
                            <?
                                $sql = "SELECT name, lastlogin, level FROM dssv";
                                $kq = $conn->query($sql);
                                $i = 0;
                                while($e = mysqli_fetch_assoc($kq)){
                                    $ago = time() - $e['lastlogin'];
                                    $name = $e['name'];
                                    if($i > 0 && $ago < 3600){
                                        echo ', ';
                                    }
                                    if($e['level'] > 0){
                                        $name = '<i class="fas fa-wrench" style="color:red"></i> '.$e['name'];
                                    }
                                    if($ago <= 60){
                                        echo '<b>'.$name.'</b> <i class="fas fa-circle" style="color:green"></i>';
                                    }elseif($ago > 60 && $ago < 3600){
                                        echo '<b>'.$name.'</b><span class="badge rounded-pill bg-light text-dark"><i>'.round($ago/60, 0).' phút trước</i></span>';
                                    }else{
                                        
                                    }
                                    $i++;
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-light text-center text-lg-start">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase"><i class="fas fa-cogs"></i> KTPM SYSTEM</h5>

                <p>
                Hệ thống thông tin của sinh viên lớp Kỹ thuật phần mềm. Ngoài ra còn là hệ thống luyện tập lập trình với các bài tập khó dễ khác nhau, trình biên dịch trực tiếp có thể giúp các bạn tìm lỗi sai, học hỏi để nâng cao trình độ!
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"><i class="fas fa-heart"></i> Special Thanks to</h5>

                <ul class="list-unstyled mb-0">
                <li>
                    <a href="https://mdbootstrap.com/" class="text-dark"><i class="fab fa-mdb"></i> MDBootstrap</a>
                </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"><i class="fas fa-chart-line"></i> STATS</h5>

                <ul class="list-unstyled mb-0">
                <li class="text-dark">
                <i class="far fa-clock"></i> Load trang trong 1.0E-6 giây
                </li>
                <li class="text-dark">
                <i class="fas fa-eye"></i> Total views:           </li>
                <li class="text-dark">
                    <i class="fas fa-code-branch"></i> Version: <?=VERSION?>
                </li>
                </ul>
            </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            KTPM <sup>K46</sup> SYSTEM © 2020-2021 BY 
            <a class="text-dark" target="_blank" href="https://www.facebook.com/vilogger.dev/">DATLEVAN</a>
        </div>
        <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </body>
</html>
<? echo '<!-- Time server: '.time().'
Author: Le Van Dat-->'; ?>