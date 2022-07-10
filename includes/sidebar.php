<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
            <!-- /.input-group -->
        </form>
        <!-- /form search form -->
    </div>

    <!-- Blog Categories Well -->
    <?php

    $query = 'SELECT * FROM categories';
    $select_all_categories_query = mysqli_query($connection, $query);

    ?>
    <div class="well">
        <h4>Blog Categories</h4>

        <ul class="list-unstyled">

            <?php
            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                $cat_title = $row['cat_title'];
                echo "<li><a href=''>{$cat_title}</a></li>";
            }

            ?>
        </ul>

        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php' ?>

</div>