<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter 3 AJAX CRUD</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var base_url = '<?= base_url() ?>';  // Set base_url for use in custom.js
    </script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</head>
<body>

<div class="container">
    <h1>AJAX CRUD in CodeIgniter 3</h1>

    <!-- Button to open the Add Post modal -->
    <button id="addPostBtn">Add New Post</button>

    <!-- Table to display posts -->
    <table border="1" id="postsTable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Posts will be loaded here by AJAX -->
        </tbody>
    </table>

    <!-- Add Post Form (Modal) -->
    <!-- <div id="addPostModal" style="display: none;">
        <h2>Add New Post</h2>
        <label>Title:</label>
        <input type="text" id="postTitle"><br>
        <label>Content:</label>
        <textarea id="postContent"></textarea><br>
        <label>Image:</label>
        <input type="file" name="image" id="postImage"><br>
        <button id="savePostBtn">Save Post</button>
    </div> -->

    <!-- Edit Post Form (Modal) -->
    <!-- <div id="editPostModal" style="display: none;">
        <h2>Edit Post</h2>
        <input type="hidden" id="editPostId">
        <label>Title:</label>
        <input type="text" id="editPostTitle"><br>
        <label>Content:</label>
        <textarea id="editPostContent"></textarea><br>
        <label>Image:</label>
        <input type="file" name="image" id="editPostImage"><br>
        <button id="updatePostBtn">Update Post</button>
    </div> -->

    <!-- Add Post Modal -->
    <div id="addPostModal" style="display: none;">
            <h2>Add New Post</h2>
            <div id="addPostErrors"></div>
            <form id="addPostForm" enctype="multipart/form-data">
                <label>Title:</label>
                <input type="text" name="title" id="postTitle"><br>
                <label>Content:</label>
                <textarea name="content" id="postContent"></textarea><br>
                <label>Image:</label>
                <input type="file" name="image" id="postImage"><br>
                <button type="submit">Save Post</button>
            </form>
        </div>

    <!-- Edit Post Modal -->
    <div id="editPostModal" style="display: none;">
            <h2>Edit Post</h2>
            <div id="editPostErrors"></div>
            <form id="editPostForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editPostId">
                <label>Title:</label>
                <input type="text" name="title" id="editPostTitle"><br>
                <label>Content:</label>
                <textarea name="content" id="editPostContent"></textarea><br>
                <label>Image:</label>
                <input type="file" name="image" id="editPostImage"><br>
                <button type="submit">Update Post</button>
            </form>
        </div>
</div>

</body>
</html>
