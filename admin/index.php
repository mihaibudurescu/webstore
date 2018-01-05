<?php
include "../includes/head.php";
include "../includes/navbar_admin.php";
session_start();

$form_login = <<<FORM
	<form method ='post' action = '$_SERVER[PHP_SELF]'>
	User: <input type = 'text' name='username'><br>
	<br>
	Parola: <input type='password'  name='parola'> <br>
	<br>
	<input type='submit' name='login' class='btn btn-info' value='Login'>
	</form>
FORM;

//print_r($_POST);
//print_r($_SESSION);
?>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary text-center">
        <div class="panel-heading text-center">Panou control</div>
        <div class="panel-body">
<?php
	$msg = "";
	if (!isset($_SESSION['logat']) && (empty($_POST['username']) || empty($_POST['parola'])))
	{
		echo $form_login;
	}
	else
	{	
		if(!isset($_SESSION['logat']))
		{
			$username = $_POST['username'];
			$parola = $_POST['parola'];
			$query_useri = "SELECT * FROM `useri` where `utilizator` = '$username'";
			$rez = $db->query($query_useri);
			if (!$rez || ($rez[0]['parola'] !== $parola))
			{
				$msg = "Username sau parola gresite!";
				echo "$msg"."<p>" . $form_login;
			}
			else
			{
				$_SESSION['logat'] = true;		
			}
		}
		if(isset($_SESSION['logat']))
		{
			echo "<p><a href='mesaje.php' class='btn btn-warning' role='button'>Mesaje</a></p>
					  <a href='comenzi.php' class='btn btn-info' role='button'>Lista comenzi</a>
				";
		}
	}
	
?>					
			</div>
		</div>
	</div>
		
<?php
	if(isset($_SESSION['logat']))
	{	
		echo "<div class='col-sm-9 text-center'> 
			<div class='panel panel-success text-center'>
			<div class='panel-heading text-center'>Modifica Produse</div>
			<div class='panel-body'>";
		
			include "form_admin.php";
	}

?>
		</div>
	</div>
</body>
</html>
