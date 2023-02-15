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
  $sesssion=$_POST['sesssion'];
$ret=mysqli_query($bd, "insert into session(session) values('$sesssion')");
if($ret)
{
$_SESSION['msg']="Tạo buổi học thành công !!";
}
else
{
  $_SESSION['msg']="Error : Không thể tạo";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from session where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Đã xóa buổi học !!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Buổi học</title>
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
                        <h1 class="page-head-line">Buổi học </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Thêm buổi học
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="session" method="post">
   <div class="form-group">
    <label for="session">Thêm buổi học </label>
    <input type="text" class="form-control" id="sesssion" name="sesssion" placeholder="Buổi học" />
  </div>
 <button type="submit" name="submit" class="btn btn-default">Đồng ý</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quản lý buổi học
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Buổi học</th>
                                            <th>Ngày tạo</th>
                                            <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from session");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['session']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                            <td>
  <a href="session.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Xác nhận xóa buổi học?')">
                                            <button class="btn btn-danger">Xóa</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
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
</body>
</html>
<?php } ?>
