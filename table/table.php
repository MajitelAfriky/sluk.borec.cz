<?php
  include_once 'conn.php';
  if (isset($_GET["id"])) {
    $Klic=$_GET["id"];
    $delete=mysqli_query($connection, "DELETE FROM `List` WHERE `Klic`= '$Klic'");
    header("location:table");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
      $sql = "SELECT * from List";
      if ($result = mysqli_query($connection, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      printf("(%d) Rádia NSJ2023", $rowcount);
    }
  ?>
  </title>
  <link rel="icon" href="radio.ico">
  <link rel="stylesheet" href="table.css">
</head>
<body>
  <table id="myTable">
    <thead>
      <tr>
        <th class="point" onclick="sortTable(0)">ID rádia</th>
        <th class="point" onclick="sortTable(1)">Jméno</th>
        <th>               
          <form action="form.php" method="POST" class="frm">
            <input class="input" type="text" name="Id" placeholder="ID">
            <input class="input" type="text" name="Jmeno" placeholder="Jméno">
            <button type="submit" name="submit" class="submit">Potvrdit</button>
          </form>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
          }
        $sql = "SELECT * FROM List";
        $result = $connection->query($sql);
        if (!$result) {
          die("Invalit query: " . $connection_error);
          }
        while ($row = $result->fetch_assoc()) {
          echo 
            "<tr>
              <td>".$row["Id"]."</td>
              <td>".$row["Jmeno"]."</td>
              <td class='edit'>
                ".$row["Cas"]."
                <a href='table.php?id=".$row["Klic"]."' class='btn'>Smazat</a>
              </td>
            </tr>";     
          }
      ?>
      <script>
        function sortTable(n) {
  
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("myTable");
          switching = true;
          dir = "asc"; 
          while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
              shouldSwitch = false;
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  shouldSwitch = true;
                  break;
                }
              }
            }
            if (shouldSwitch) {
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
        
              switchcount ++;      
            } else {
              if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
              }
            }
          }
        }
      </script>
    </tbody>
  </table>
<footer>
  <?php
    $sql = "SELECT * from List";
    if ($result = mysqli_query($connection, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      printf("Celkem je vypůjčeno %d\n rádií.", $rowcount);
    }
  ?>
</footer>
</body>
</html>