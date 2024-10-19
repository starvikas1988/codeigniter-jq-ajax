$(document).ready(function () {

    // Fetch all posts on page load
    fetchPosts();

    // Fetch posts from the server and display in the table
    function fetchPosts() {
        $.ajax({
            url: base_url + 'posts/fetch_posts',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let html = '';
                data.forEach(function (post) {
                    html += '<tr>';
                    html += '<td><img src="uploads/' + (post.image ? post.image : 'default.png') + '" width="50"></td>';
                    html += '<td>' + post.title + '</td>';
                    html += '<td>' + post.content + '</td>';
                    html += '<td><button class="editPostBtn" data-id="' + post.id + '">Edit</button>';
                    html += '<button class="deletePostBtn" data-id="' + post.id + '">Delete</button></td>';
                    html += '</tr>';
                });
                $('#postsTable tbody').html(html);
            }

            // success: function (data) {
            //     let html = '';
            //     $.each(data, function (index, post) {  // Use index if needed
            //         html += '<tr>';
            //         html += '<td>' + post.title + '</td>';
            //         html += '<td>' + post.content + '</td>';
            //         html += '<td><button class="editPostBtn" data-id="' + post.id + '">Edit</button>';
            //         html += '<button class="deletePostBtn" data-id="' + post.id + '">Delete</button></td>';
            //         html += '</tr>';
            //     });
            //     $('#postsTable tbody').html(html);
            // }
        });
    }

    // Open Add Post Modal
    $('#addPostBtn').click(function () {
        $('#addPostModal').show();
    });

    // Add new post
    // $('#savePostBtn').click(function () {
    //     let title = $('#postTitle').val();
    //     let content = $('#postContent').val();

    //     $.ajax({
    //         url: base_url + 'posts/add_post',
    //         type: 'POST',
    //         data: { title: title, content: content },
    //         success: function (response) {
    //             $('#addPostModal').hide();
    //             fetchPosts();  // Refresh the list of posts
    //         }
    //     });
    // });

    // Add post form submit
    $('#addPostForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url:   base_url + 'posts/add_post',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'error') {
                    $('#addPostErrors').html(response.errors);
                } else {
                    $('#addPostModal').hide();
                    fetchPosts();  // Refresh the posts list
                }
            }
        });
    });

     // Edit post form submit
     $('#editPostForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url:   base_url + 'posts/update_post', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'error') {
                    $('#editPostErrors').html(response.errors);
                } else {
                    $('#editPostModal').hide();
                    fetchPosts();  // Refresh the posts list
                }
            }
        });
    });

    // Open Edit Post Modal and fill the form with the post data
    $(document).on('click', '.editPostBtn', function () {
        let postId = $(this).data('id');

        $.ajax({
            url: base_url + 'posts/get_post',
            type: 'POST',
            data: { id: postId },
            dataType: 'json',
            success: function (data) {
                $('#editPostId').val(data.id);
                $('#editPostTitle').val(data.title);
                $('#editPostContent').val(data.content);
                $('#editPostModal').show();
            }
        });
    });

    // Update post
    // $('#updatePostBtn').click(function () {
    //     let id = $('#editPostId').val();
    //     let title = $('#editPostTitle').val();
    //     let content = $('#editPostContent').val();

    //     $.ajax({
    //         url:  base_url + 'posts/update_post',
    //         type: 'POST',
    //         data: { id: id, title: title, content: content },
    //         success: function (response) {
    //             $('#editPostModal').hide();
    //             fetchPosts();  // Refresh the list of posts
    //         }
    //     });
    // });

    // Delete post
    $(document).on('click', '.deletePostBtn', function () {
        let postId = $(this).data('id');  // Get the ID of the post to delete
       // console.log(postId);
        if (confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: base_url + 'posts/delete_post',
                type: 'POST',
                data: { id: postId },  // Send the ID to be deleted
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                       
                        fetchPosts();  // Refresh the posts list
                    } else {
                        alert('Error deleting post');
                    }
                }
            });
        }
    });
    
});
