<?php 

    $isValid = true;

    


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $todo_name = $_POST['todo_name'] ?? '';
        $todo_name = htmlspecialchars($todo_name);
        $todo_priority = $_POST['todo_priority'] + 1;

        

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=baza','root',null);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $stmt = $pdo->prepare("INSERT INTO tasks(name,priority) VALUES(:name,:priority)");
        $stmt->bindParam(":name", $todo_name);
        $stmt->bindParam(":priority", $todo_priority);
        $stmt->execute();
    }

    header("Location: http://localhost/todo/index.php");
        
    




?>
