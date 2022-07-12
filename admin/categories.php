<?php include_once './includes/header.php'; ?>


<!-- Navigation -->
<?php include_once './includes/navigation/navigation.php'; ?>

<?php $edit_mode = false; ?>


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

                <?php
                if (isset($_POST['update'])) {
                    echo 'here';

                    $new_category = $_POST['cat_title'];
                    $old_category_id = $_GET['edit'];

                    echo $old_category_id;
                    echo $new_category;
                    if (!$new_category || $new_category === '' || empty($new_category)) {
                        echo 'Please Add Valid category';
                    } else {

                        $query = "UPDATE categories SET cat_title = '{$new_category}' WHERE cat_id = '{$old_category_id}'";
                        $result = mysqli_query($connection, $query);


                        if (!$result) {
                            echo mysqli_error($connection);
                        } else {
                            header("Location: categories.php");
                        }
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <?php
                        if (isset($_GET['edit'])) {
                            $edit_mode = true;
                            $selected_cat_id = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE cat_id = {$selected_cat_id}";
                            $selected_category_query = mysqli_query($connection, $query);
                            $selected_id = '';
                            $selected_title = '';

                            if ($selected_category_query) {


                                $selected_data = mysqli_fetch_assoc($selected_category_query);

                                $selected_id = $selected_data['cat_id'];
                                $selected_title = $selected_data['cat_title'];
                            }
                        }

                        ?>
                        <label for="add-category">
                            <?php
                            if ($edit_mode) {
                                echo 'Edit Category';
                            } else {
                                echo 'Add Category';
                            }
                            ?>
                        </label>

                        <input name="cat_title" type="text" class="form-control" id="add-category" placeholder="Category Title" value="<?php if ($edit_mode && $selected_title) echo $selected_title;
                                                                                                                                        else echo '' ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="<?php if ($edit_mode) echo 'update';
                                                                            else echo 'submit' ?>">
                            <?php
                            if ($edit_mode) {
                                echo 'Edit Category';
                            } else {
                                echo 'Add Category';
                            }
                            ?>
                        </button>
                    </div>
                    <?php echo $edit_mode; ?>
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
                            // list all categories
                            $query = 'SELECT * FROM categories';
                            $select_all_categories_query = mysqli_query($connection, $query);
                            $index = 0;
                            while ($row = mysqli_fetch_assoc($select_all_categories_query)) :
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                $index++
                            ?>

                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $cat_title; ?></td>
                                    <td><a href="categories.php?edit=<?php echo $cat_id ?>"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="categories.php?delete=<?php echo $cat_id ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                            <?php
                            if (isset($_GET['delete'])) {
                                $selected_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$selected_cat_id}";
                                $delete_query = mysqli_query($connection, $query);

                                if ($delete_query) {
                                    header('Location: categories.php');
                                } else {
                                    echo mysqli_error($connection);
                                }
                            }
                            ?>
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