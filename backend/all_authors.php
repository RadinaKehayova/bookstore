<?php
require_once 'header.php';

$query = "SELECT  * FROM authors";
$result = $conn->query($query);

if (!$result) die("Fatal error");


?>

<table class="table table-hover">
  <thead >
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Име</th>
      <th scope="col">Биография</th>
      <th scope="col">Действие</th>
    </tr>
  </thead>
  <tbody>
      <?php
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
<tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo htmlspecialchars($row['bio']); ?></td>
      

      <td>
        <a href="<?php echo URLBASE;?>/view-authors.php?id=<?php echo $row['id'];?> "class = "btn btn-outline-primary">Преглед</a>
        <a href="<?php echo URLBASE;?>/edit-authors.php?id=<?php echo $row['id'];?>"class = "btn btn-outline-primary">Редактиране</a>
    </td>
    </tr>
            <?php
        }
      }
    ?>
  </tbody>
</table>

<?php
$result->close();
$conn->close();
?>