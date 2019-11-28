<?php   
	$cs = 'mysql:host=localhost;dbname=ykahifdu_Shiurim';
	$user = 'ykahifdu_Shiurim';
	$password = 'Fishguys1!Shiurim';
	$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    
    try {
        $db = new PDO($cs, $user, $password, $options);
    } catch(PDOException $e) {
        die($e->getMessage());
    }
?>