
<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Ho_Chi_Minh');
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($bd, "SELECT password FROM  students where password='".md5($_POST['cpass'])."' && studentRegno='".$_SESSION['login']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($bd, "update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where studentRegno='".$_SESSION['login']."'");
$_SESSION['msg']="Thay đổi mật khẩu thành công !!";
}
else
{
$_SESSION['msg']="Mật khẩu không khớp !!";
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
    <title>Sinh viên | Thay đổi mật khẩu</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Mật khẩu trống !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("Mật khẩu mới trống!!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Xác thực mật khẩu trống !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Mật khẩu không trùng khớp !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>
<body>
<?php include('includes/header.php');?>

<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Thay đổi mật khẩu</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Thay đổi mật khẩu
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="chngpwd" method="post" onSubmit="return valid();">
   <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu hiện tại</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="cpass"  />
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu mới</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="newpass"  />
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" />
  </div>
 
  <button type="submit" name="submit" class="btn btn-default">Đồng ý</button>
                           <hr />
   



</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
        </div>
    </div>
    
  <?php include('includes/footer.php');?>
   
    <script src="assets/js/jquery-1.11.1.js"></script>

    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
