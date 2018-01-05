<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

const PICDIR = "poze";

if(!isset($_SESSION['produse'])){
	$_SESSION['produse'] = [];
}

# procesare form
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(empty($_POST['denumire'])){
		echo "<h6>Denumirea nu poate lipsi</h6>";
	}elseif(empty($_FILES['poza']['tmp_name'])){
		echo "<h6>Uploadati o poza pt produs!</h6>";
	}else{
		$tmpname = $_FILES['poza']['tmp_name'];
		echo $tmpname;
		$lungime = filesize($tmpname);
		$f = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($f,$tmpname);
		finfo_close($f);
		echo "<p>Upload reusit</p>";
		echo "<p>Fisierul are $lungime octeti</p>";
		echo "<p>Tip MIME: $mime</p>";
		if($mime !== 'image/jpeg'){
			echo "<p>Fisierul nu este de tip JPG!</p>";
		}else{
			$newfile = tempnam(PICDIR, 'img_').".jpg";
			//$newfile = tempnam(PICDIR, 'img_');
			if(move_uploaded_file($tmpname, $newfile)){
					echo "<p>Fisier uploadat cu succes</p>";
					$_SESSION['produse'][] = [
						'denumire' => $_POST['denumire'],
						'poza' => basename($newfile)
					];
			}else{
					echo "<p>Eroare la salvarea fisierului</p>";
			}
		}
	}
}

# afisare lista produse
#echo "<pre>";print_r($_SESSION['produse']);echo "</pre>";

echo "<ul>";
foreach($_SESSION['produse'] as $produs){
	echo "<li>$produs[denumire] <img src='".PICDIR."/$produs[poza]' /></li>\n";
}
echo "</ul>";

# formular adaugare
?>

<form method='post' action='<?= $_SERVER['PHP_SELF'] ?>' enctype='multipart/form-data'>
Denumire: <input type='text' name='denumire' /><br />
Poza: <input type='file' name='poza' /><br />
<input type='submit' value='Adauga' />
</form>
