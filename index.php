<?php 

try{
    $pdo = new PDO('mysql:host=localhost;dbname=baza','root',null);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


$stmt = $pdo->query("SELECT * FROM tasks");

    

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
 
    <div class="w-25 p-3 mx-auto">
    <form action="newtask.php" method="POST">
                <div class="input-group  mb-3">
            <span class="input-group-text">Zadanie</span>
            <input name = "todo_name" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group mb-3 input-group-sm">
            <label for="customRange3" class="form-label">Wybierz priorytet</label>
            <input name = "todo_priority" type="range" class="form-range" min="0" max="6" step="1" id="customRange3">
            </div>
        <button type="submit" class="btn btn-success">Nowe zadanie</button>
</form>


    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nazwa zadania</th>
      <th scope="col">Priorytet</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
  <?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        $alpha = max(0,min(255,$row['priority']*80));
        

?>

    <tr>
      <td><?= $row['name'] ?></td>
      <td style="background-color:rgba(<?= $alpha ?>,60,0,0.4);"><?= $row['priority'] ?></td>
      <td> 
        <form action="delete.php" method="POST">
            <input type="hidden" name="todo_id" value="<?= $row['id'] ?>"> 
            <button type="submit" class="btn btn-warning">Zrobione</button>
        </form>
      </td>
    </tr>
      <?php }?>


  </tbody>
</table>


</div>

    
</body>
</html>