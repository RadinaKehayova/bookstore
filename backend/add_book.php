<?php
require_once 'header.php';

$sql_authors = "SELECT id, name FROM authors";
$result_authors = $conn->query($sql_authors);

$sql_categories = "SELECT id, title FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_publishers = "SELECT id, title FROM publishers";
$result_publishers = $conn->query($sql_publishers);

$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Добавяне на нова книга</h5>
                <div class="card-body">
                    <form action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="isbn">ISBN *</label>
                                <input type="text" class="form-control required" id="isbn" name="isbn" required>
                            </div>
                            <div class="col-12">
                                <label for="title">Заглавие *</label>
                                <input type="text" class="form-control required" id="title" name="title" required>
                            </div>
                            <div class="col-12">
                                <label for="author">Автор *</label>
                                <select class="form-control required" id="author" name="author">
                                    <?php
                                    if ($result_authors->num_rows > 0) {
                                        while ($row = $result_authors->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="category">Категория *</label>
                                <select class="form-control required" id="category" name="category">
                                    <?php
                                    if ($result_categories->num_rows > 0) {
                                        while ($row = $result_categories->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="year">Година</label>
                                <input type="text" class="form-control" id="year" name="year">
                            </div>
                            <div class="col-12">
                                <label for="description">Описание</label>
                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="cover">Добавяне на снимка</label>
                                <input type="file" class="form-control" id="cover" name="cover" accept="image/*" />
                            </div>
                            <div class="col-12">
                                <label for="lang">Език</label>
                                <input type="text" class="form-control" id="lang" name="lang">
                            </div>
                            <div class="col-12">
                                <label for="price">Цена *</label>
                                <input type="number" class="form-control required" id="price" name="price" required>
                            </div>
                            <div class="col-12">
                                <label for="publisher">Издател *</label>
                                <select class="form-control required" id="publisher" name="publisher">
                                    <?php
                                    if ($result_publishers->num_rows > 0) {
                                        while ($row = $result_publishers->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-12">
                                <input type="submit" id="btn-save" class="btn btn-primary" name="submit" value="Добавяне">
                                <p id="warning" style="padding-top: 10px;color:red;"></p>
                                <p id="success" style="padding-top: 10px;color:green;"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#btn-save').unbind().bind('click', function (e) {
            e.preventDefault();
            var isbn = $('#isbn').val();
            var title = $('#title').val();
            var author = $('#author').val();
            var category = $('#category').val();
            var year = $('#year').val();
            var description = $('#description').val();
            var cover = $('#cover').val();
            var lang = $('#lang').val();
            var price = $('#price').val();
            var publisher = $('#publisher').val();
            
            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('cover', $('input[type=file]')[0].files[0]);
            
            if(isbn != "" && title != "" && category != "" && price != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,
//                    data: {
//                        isbn: isbn,
//                        title: title,
//                        author: author,
//                        category: category,
//                        year: year,
//                        description: description,
//                        cover: cover,
//                        lang: lang,
//                        price: price,
//                        publisher: publisher,
//                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    url: 'includes/book/create.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Книгата е добавена успешно.');
                        } else if(dataResult.statusCode == 201 && dataResult.flag != ""){
                            switch (dataResult.flag){
                                case 1: 
                                    $('#warning').html('Your file extension must be .jpg, .jpeg or .png');
                                    break;
                                case 2:
                                    $('#warning').html('File too large!');
                                    break;
                                case 3:
                                    $('#warning').html('Failed to upload file.');
                                    break;
                            }
                        } else {
                            alert("Error");
                        }
                    }
                });
            } else {
                $('form').addClass('validate');
            }
        });
    });
</script>