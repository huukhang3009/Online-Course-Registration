<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$id=intval($_GET['id']);
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$coursecode=$_POST['coursecode'];
$coursename=$_POST['coursename'];
$courseunit=$_POST['courseunit'];
$seatlimit=$_POST['seatlimit'];
$ret=mysqli_query($bd, "update course set courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit',updationDate='$currentTime' where id='$id'");
if($ret)
{
$_SESSION['msg']="Cập nhật môn học thành công !!";
}
else
{
  $_SESSION['msg']="Error : không thể cập nhật";
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
    <title>Admin | môn học</title>
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
                        <h1 class="page-head-line">Cập nhật môn học </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Môn học
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($bd, "select * from course where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>Cập nhật lần cuối lúc</b> :<?php echo htmlentities($row['updationDate']);?></p>
   <div class="form-group">
    <label for="coursecode">Mã môn học </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Mã môn" value="<?php echo htmlentities($row['courseCode']);?>" required />
  </div>

 <div class="form-group">
    <label for="coursename">Tên môn học </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Tên môn" value="<?php echo htmlentities($row['courseName']);?>" required />
  </div>

<div class="form-group">
    <label for="courseunit">Số tiết  </label>
    <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Số tiết" value="<?php echo htmlentities($row['courseUnit']);?>" required />
  </div>  

<div class="form-group">
    <label for="seatlimit">Sỉ số  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Sỉ số" value="<?php echo htmlentities($row['noofSeats']);?>" required />
  </div>  


<?php } ?>
 <button type="submit" name="submit" class="btn btn-default"><i class=" fa fa-refresh "></i> Cập nhật</button>
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
</body>
</html>
<?php } ?>
