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
$coursecode=$_POST['coursecode'];
$coursename=$_POST['coursename'];
$courseunit=$_POST['courseunit'];
$seatlimit=$_POST['seatlimit'];
$ret=mysqli_query($bd, "insert into course(courseCode,courseName,courseUnit,noofSeats) values($coursecode,$coursename,$courseunit,$seatlimit)");
if($ret)
{
$_SESSION['msg']="Tạo môn học thành công !!";
}
else
{
  $_SESSION['msg']="Lỗi: không thể tạo môn học";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from course where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Xóa thành công!!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Môn học</title>
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
                        <h1 class="page-head-line">Môn học  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Thêm môn học
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="coursecode">Mã số môn học </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Mã số khóa học" required />
  </div>

 <div class="form-group">
    <label for="coursename">Tên Môn học  </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Tên khóa học" required />
  </div>

<div class="form-group">
    <label for="courseunit">Số tiết học  </label>
    <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Số tiết học" required />
  </div> 

<div class="form-group">
    <label for="seatlimit">Sỉ số  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Sỉ số" required />
  </div>   

 <button type="submit" name="submit" class="btn btn-default">Đồng ý</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quản lý môn học
                        </div>
                       
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã số môn học</th>
                                            <th>Tên môn học </th>
                                            <th>Số tiết học</th>
                                            <th>Sỉ số</th>
                                             <th>Ngày tạo</th>
                                             <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from course");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courseCode']);?></td>
                                            <td><?php echo htmlentities($row['courseName']);?></td>
                                            <td><?php echo htmlentities($row['courseUnit']);?></td>
                                             <td><?php echo htmlentities($row['noofSeats']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                            <td>
                                            <a href="edit-course.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Chỉnh sửa</button> </a>                                        
  <a href="course.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Xác nhận xóa?')">
                                            <button class="btn btn-danger">Xóa</button>
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
