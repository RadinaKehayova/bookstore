<?php
require_once 'header.php';

$query = "SELECT books.*, authors.name FROM books INNER JOIN authors ON books.author_id = authors.id";
$result = $conn->query($query);

if (!$result) die("Fatal error");


?>

<table class="table table-hover">
  <thead >
    <tr>
      <th scope="col">ISBN</th>
      <th scope="col">Заглавие</th>
      <th scope="col">Автор</th>
      <th scope="col">Създадена на</th>
      <th scope="col">Действие</th>
    </tr>
  </thead>
  <tbody>
      <?php
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
<tr>
      <td><?php echo htmlspecialchars($row['isbn']); ?></td>
      <td><?php echo htmlspecialchars($row['title']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo date("d.m.Y", strtotime($row['created_at'])); ?></td>
    <td>
        <a href="<?php echo URLBASE;?>/view-book.php?id=<?php echo $row['id'];?> "class = "btn btn-outline-primary">Преглед</a>
        <a href="<?php echo URLBASE;?>/edit-book.php?id=<?php echo $row['id'];?>"class = "btn btn-outline-primary">Редактиране</a>
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