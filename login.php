<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Tlee2537", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} else {echo "Connected";}
?>
Login form
<hr>
<?PHP
	if(isset($_POST['submit'])){
		echo "Clicked";
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$captcha = trim($_POST['captcha']);
		if('captcha' == '123456'){
		$query = "SELECT * FROM AA_LOGIN WHERE username='$username' and password='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		}
		if($row){
			$_SESSION['ID'] = $row['ID'];
			$_SESSION['NAME'] = $row['NAME'];
			$_SESSION['SURNAME'] = $row['SURNAME'];
			echo '<script>window.location = "MemberPage.php";</script>';
		
		}else{
			echo "Login fail.";
		}
	};
	oci_close($conn);
?>

<form action='file:///E|/Engineering/Database/Login (2)/Login/login.php' method='post'>
	Username <br>
	<input name='username' type='input'><br>
	Password<br>
	<input name='password' type='password'><br>
    Captcha 123456<br>
    <input name='captcha' type='input'><br><br>
    <input name='submit' type='submit' value='Login'>
</form>
