<?php include_once './includes/header.php'; ?>


<!-- Navigation -->
<?php include_once './includes/navigation/navigation.php'; ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
        </h1>
        <div class="row">

            <div class="col-xs-6">
                <?php
                if (isset($_POST['submit'])) {
                    $new_category = $_POST['cat_title'];

                    if (!$new_category || $new_category === '' || empty($new_category)) {
                        echo 'Please Add Valid category';
                    } else {
                        $query = "INSERT INTO categories(cat_title) VALUE ('{$new_category}')";
                        $result = mysqli_query($connection, $query);
                        if (!$result) {
                            die('Query Failed' . mysqli_error($connection));
                        }
                    }
                }
                ?>
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="add-category">Add Category</label>
                        <input name="cat_title" type="text" class="form-control" id="add-category" placeholder="Category Title">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>category title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = 'SELECT * FROM categories';
                            $select_all_categories_query = mysqli_query($connection, $query);
                            $index = 0;
                            while ($row = mysqli_fetch_assoc($select_all_categories_query)) :
                                $cat_title = $row['cat_title'];
                                $index++
                            ?>

                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $cat_title; ?></td>
                                    <td><i class="fa fa-edit"></i></td>
                                    <td><i class="fa fa-trash"></i></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include_once './includes/footer.php'; ?>