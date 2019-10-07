<?php
include_once('header.php');
include_once('nav.php');
?>
<?php
    $masinhvien = $ho = $ngaySing = $email = "" ;
    // var_dump($_SERVER);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $masinhvien = $_REQUEST["txtMasv"] ;
        $ho = $_REQUEST["txtTen"];
        $email = $_REQUEST["email"];
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Bạn nhập email đúng định dạng";
    }
    else
        echo "Bạn nhập email sai định dạng";
     var_dump($_FILES);
    move_uploaded_file($_FILES["avatar"]["tmp_name"],"upload/avatar.jpg");
}
?>
<div id="content-wrapper">
    <div class="container-fluid">
        <form action = "" method = "post" enctype="multipart/form-data">
            <div>
                <label>Mã Sinh viên</label>
            </div>
            <div class = "form-group">
                <input type="text" name = "txtMasv" class="form-control" value = <?php echo $masinhvien?>>
            </div>
            <div class = "form-group">
                <label>Họ tên</label>
            </div>
            <div class = "form-group">
                <input type="text" name = "txtTen" class="form-control" value = <?php echo $ho?>>
            </div>
            <div class = "form-group">
                <label>Ngay sinh</label>
            </div>
            <div class = "form-group">
                <input type="date" name = "date" class="form-control" value = <?php echo $ngaySing?>>
            </div>
            <div class = "form-group">
                <label>Email</label>
            </div>
            <div class = "form-group">
                <input type="email" name = "email" class="form-control" value = <?php echo $email?>>
            </div>
            <div>
                <label>Ảnh đại diện</label>
            </div>
            <div>
                <input type="file" name="avatar">
            </div>
            <div class = "form-group">
                <button type = "submit">Lưu</button>
            </div>

        </form>
    </div>
</div>


<?php
include_once('footer.php');
?>