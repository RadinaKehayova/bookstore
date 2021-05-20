<?php
require_once 'header.php';

$query = "SELECT  * FROM orders";
$result = $conn->query($query);

if (!$result) die("Fatal error");


?>

<table class="table table-hover">
  <thead >
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ISBN</th>
      <th scope="col">ID на клиента</th>
      <th scope="col">Дата</th>
      <th scope="col">Цена</th>
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
      <td><?php echo htmlspecialchars($row['book_isbn']); ?></td>
      <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
      <td><?php echo htmlspecialchars($row['purchase_date']); ?></td>
      <td><?php echo htmlspecialchars($row['total']); ?></td> 

      <td>
        <a href="<?php echo URLBASE;?>/view-orders.php?id=<?php echo $row['id'];?> "class = "btn btn-outline-primary">Преглед</a>
        <a href="<?php echo URLBASE;?>/edit-orders.php?id=<?php echo $row['id'];?>"class = "btn btn-outline-primary">Редактиране</a>
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