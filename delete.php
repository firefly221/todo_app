<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

try{
    $pdo = new PDO('mysql:host=localhost;dbname=baza','root',null);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :todo_id");
$stmt->bindParam(':todo_id',$_POST['todo_id']);
$stmt->execute();

}


header("Location: http://localhost/todo/index.php");
?>