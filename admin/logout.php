<?php
session_start();
$_SESSION['alogin']=="";
session_unset();

$_SESSION['errmsg']="Đăng xuất thành công";
?>
<script language="javascript">
document.location="index.php";
</script>
