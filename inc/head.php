<?
// include file config server
include $_SERVER['DOCUMENT_ROOT'].'/inc/all.php';

//Xử lý cookie
if(isset($_COOKIE['path']) && !isset($_SESSION['logged'])){
    if(getcookie($_COOKIE['path']) == "0"){
        setcookie("path", "", time() - 60, "/","", 0);
        echo '<script>alert("Cookie của bạn không hợp lệ, vui lòng đăng nhập lại");</script>';
        header("Location: /login.php");
    }else{
        $_SESSION['logged'] = getcookie($_COOKIE['path']);
    }
}elseif(isset($_SESSION['logged']) && !isset($_COOKIE['path'])){
    $mssv = $_SESSION['logged'];
    $path = str_random(8).'_'.str_random(4).'_'.str_random(5).'_'.str_random(100);
    setrawcookie('path', $path, time() + 864000);
    $sql = "INSERT INTO cookie (path, mssv) VALUES ('$path', '$mssv')";
    $conn->query($sql);
}
if(login()){
    define('MSSV', $_SESSION['logged']);
    updateexp($_SESSION['logged'], 1);
    $mssv = $_SESSION['logged'];
    $time = time();
    $sql = "UPDATE dssv SET lastlogin = $time WHERE mssv = '$mssv'";
    $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <title><?if(isset($title)){echo $title;}else{echo 'Hệ thống thông tin cho KTPM 04';}?></title>
        <!-- Meta area -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/asset/css/main.css?v=<?=time()?>">
        <link href="/fontawesome/css/all.css" rel="stylesheet">

        <!-- Javascript -->
        <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/asset/js/jquery.min.js"></script>
        <? if(isset($editor)): ?>
        <link rel="stylesheet" href="/quill/quill.snow.css">
        <script type="text/javascript" src="/quill/quill.min.js"></script>
        <? endif ?>
        <script type="text/javascript">
            function time() {
            var today = new Date();
            var weekday=new Array(7);
            weekday[0]="Chủ Nhật";
            weekday[1]="Thứ Hai";
            weekday[2]="Thứ Ba";
            weekday[3]="Thứ Tư";
            weekday[4]="Thứ Năm";
            weekday[5]="Thứ Sáu";
            weekday[6]="Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            m=checkTime(m);
            s=checkTime(s);
            nowTime = h+":"+m+":"+s;
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;

            tmp='<span class="date">'+today+' | '+nowTime+'</span>';

            $('#clock_vitri').html(tmp);

            clocktime=setTimeout("time()","1000","JavaScript");
            function checkTime(i)
            {
                if(i<10){
                i="0" + i;
                }
                return i;
            }
            }
        </script>
    </head>
    <body onload="time()">
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/" title="Trang chủ">
                <img src="/asset/image/logo.png" alt="" width="30" class="d-inline-block align-top">
                KTPM04
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/" title="Trang chủ"><i class="fas fa-home"></i> Trang chủ</a>
                </li>
                <li class="nav-item">
                <a target="_blank" class="nav-link" href="//codetrain.co" title="CodeTrain - Luyện lập trình trực tuyến"><i class="fas fa-code"></i> Luyện lập trình</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/chat" title="Phòng trò chuyện"><i class="fas fa-comments"></i> Phòng trò chuyện</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <? if(login()) :?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?=getsv(MSSV)['avatar']?>" alt="" width="25" class="d-inline-block align-top" style="border: 1px solid #ab1170;border-radius: 50%">
                            <?=getsv(MSSV)['name'].' '.MSSV?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <? if(getsv(MSSV)['level'] > 0): ?>
                                <li><a class="dropdown-item" title="Quản lí" href="/admin"><i class="fas fa-user-shield"></i> Admin Panel</a></li>
                            <? endif ?>
                            <li><a class="dropdown-item" href="/profile/edit" title="Cài đặt tài khoản"><i class="fas fa-cog"></i> Cài đặt tài khoản</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout" title="Đăng xuất khỏi hệ thống"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                <? else: ?>
                    <li class="nav-item"><a href="/dangnhap" title="Đăng nhập hệ thống" class="nav-link"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                <? endif ?>
            </ul>
            </div>
        </div>
    </nav>
    <!-- end nav -->
    <div class="container-md" id="maintxt">
        <div class="row d-flex justify-content-center" id="row">
            <div class="d-none d-md-block col-md-3">
              <div class="sticky"><div class="card">
              <div class="card-header"><i class="fas fa-cogs"></i> Hệ thống</div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item text-center"><?=date("d/m/Y | H:i:s")?></li>
                <li class="list-group-item">IP: <?=getip()?></li>
                <li class="list-group-item">Lượt xem trang: </li>
                <li class="list-group-item">Load trang trong: <span id="load_time"></span>ms
                <script>
                window.onload = function () {
                    var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart; 
                    $('#load_time').html(loadTime); 
                }
                </script> </li>
                </ul>
              </div>
            </div></div>
            <div class="col-md-6">