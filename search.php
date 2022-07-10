<?php
include_once './includes/db.php';
include_once './includes/header.php';

// navigation
include_once './includes/navigation.php';

?>

<?php
if (isset($_POST['submit'])) {

    $search = $_POST['search'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    $search_query = mysqli_query($connection, $query);

    // if there is query error
    if (!$search_query) {
        die('query failed ' . mysqli_error($connection));
    }

    $count = mysqli_num_rows($search_query);
    // if there is no result
    if ($count === 0) {
        echo "No result found with {$search}";
    }
}

?>


<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Search Page
            <small><?php echo $search; ?></small>
        </h1>

        <!-- Search Result -->

        <?php
        while ($row = mysqli_fetch_assoc($search_query)) :

            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_auth = $row['post_auth'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_thumb = $row['post_thumb'];

        ?>
            <article>
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_auth; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <time><?php echo $post_date; ?></time></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_thumb; ?>" alt="">
                <hr>
                <p><?php echo substr($post_content, 0, 200) ?></p>
                <a class="btn btn-primary" href="post/<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            </article>

        <?php
        endwhile;
        ?>
        <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul>

    </div>

    <!-- Blog Sidebar Widgets Column -->


</div>
<!-- /.row -->

<hr>



<!-- footer -->
<?php include_once './includes/footer.php'; ?>