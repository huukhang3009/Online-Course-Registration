<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$studentname=$_POST['studentname'];
$studentregno=$_POST['studentregno'];
$password=md5($_POST['password']);
$pincode = rand(100000,999999);
$ret=mysqli_query($bd, "insert into students(studentName,StudentRegno,password,pincode) values('$studentname','$studentregno','$password','$pincode')");
if($ret)
{
$_SESSION['msg']="Đăng ký thành công !!";
}
else
{
  $_SESSION['msg']="Error : không thể đăng ký";
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Thêm sinh viên</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Thêm sinh viên  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Thêm sinh vien
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="studentname">Tên sinh viên</label>
    <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Tên sinh viên" required />
  </div>

 <div class="form-group">
    <label for="studentregno">Mã số sinh viên   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" onBlur="userAvailability()" placeholder="Mã số sinh viên" required />
     <span id="user-availability-status1" style="font-size:12px;">
  </div>



<div class="form-group">
    <label for="password">Mật khẩu  </label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required />
  </div>   

 <button type="submit" name="submit" id="submit" class="btn btn-default">Đồng ý</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>





        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
