<?php
$query = "SELECT * FROM posts";
$posts_selection_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($posts_selection_query)) :

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