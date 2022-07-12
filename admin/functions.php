<?php

function insert_category()
{
    global $connection;

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
}

function activate_edit_category()
{
    global $connection;

    if (isset($_GET['edit'])) {
        global $edit_mode;
        $edit_mode = true;
        $selected_cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = {$selected_cat_id}";
        $selected_category_query = mysqli_query($connection, $query);
        global $selected_id;
        global $selected_title;

        if ($selected_category_query) {


            $selected_data = mysqli_fetch_assoc($selected_category_query);

            $selected_id = $selected_data['cat_id'];
            $selected_title = $selected_data['cat_title'];
        }
    }
}

function update_category()
{
    global $connection;
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
}

function delete_category()
{
    global $connection;
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
}

function find_all_categories()
{
    global $connection;
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
<?php endwhile;
}
