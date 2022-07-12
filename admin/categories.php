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

                insert_category();

                delete_category();

                update_category();
                ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <?php activate_edit_category(); ?>
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

                            find_all_categories();
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