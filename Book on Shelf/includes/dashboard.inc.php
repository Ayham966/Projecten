<div class="col-12">
    <table class="table table-image">
        <thead>
        <tr>
            <th scope="col">Name of customer</th>
            <th scope="col">Name of book</th>
            <th scope="col">Email of customer</th>
        </tr>
        </thead>
        <tbody>

<?php
 if  (isset($_SESSION['admin'])) {
  echo '<br>
        <br>
        <h4 style="color: seagreen"> You can see here all borrowed books:</h4>
        <br>
        ';
     $stmt = $conn->prepare("SELECT
  *
FROM
  lenen
  JOIN customers ON lenen.FKuser = customers.id
  JOIN books ON lenen.Fkbook = books.id ");
     $stmt->execute();
     $allBooks = $stmt->fetchAll();
     foreach($allBooks as $row) {
         echo '
                  <tr>
                    <td>'.$row['first'].' '.$row['middel'].' '.$row['last'].'</td>
                    <td>'.$row['Name'].'</td>
                    <td>'.$row['email'].' </td>
                  </tr> ';
          }

      }
     else {
         header("location: php/login.php");

     }
?>

        </tbody>
    </table>
</div>

