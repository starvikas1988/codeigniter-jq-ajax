<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD with CodeIgniter 3</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="<?= base_url('assets/js/custom.js'); ?>"></script> -->
</head>
<body>
    <h1>Users CRUD with AJAX</h1>

    <button id="addUserBtn">Add New User</button>
    <div id="userForm" style="display:none;">
        <input type="hidden" id="userId">
        <label for="name">Name:</label>
        <input type="text" id="name"><br>
        <label for="email">Email:</label>
        <input type="email" id="email"><br>
        <button id="saveUserBtn">Save</button>
    </div>

     <div>
        <form id="createForm">
        <input type="hidden" id="userId">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <button type="submit">Submit</button>
        </form>
    </div>

    <table id="usersTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- AJAX will dynamically populate this section -->
        </tbody>
    </table>

    <script>
        $(document).ready(function(){
            // Fetch and display users when the page loads
            fetchUsers();

            // Show user form to add new user
            $('#addUserBtn').click(function() {
                $('#userForm').show();
                $('#name').val('');
                $('#email').val('');
                $('#userId').val('');
            });

            // Save user (Add or Update)
            $('#saveUserBtn').click(function() {
                var userId = $('#userId').val();
                var name = $('#name').val();
                var email = $('#email').val();

                if (userId == '') {
                    // Add new user
                    $.ajax({
                        url: '<?= base_url('users/add_user') ?>',
                        type: 'POST',
                        data: {name: name, email: email},
                        success: function(response) {
                            $('#userForm').hide();
                            fetchUsers(); // Refresh the list
                        }
                    });
                } else {
                    // Update existing user
                    $.ajax({
                        url: '<?= base_url('users/update_user') ?>',
                        type: 'POST',
                        data: {id: userId, name: name, email: email},
                        success: function(response) {
                            $('#userForm').hide();
                            fetchUsers(); // Refresh the list
                        }
                    });
                }
            });

            // Edit user
            $(document).on('click', '.editUserBtn', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '<?= base_url('users/get_user_by_id') ?>',
                    type: 'POST',
                    data: {id: userId},
                    success: function(data) {
                        var user = JSON.parse(data);
                        $('#userForm').show();
                        $('#userId').val(user.id);
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                    }
                });
            });

            // Delete user
            $(document).on('click', '.deleteUserBtn', function() {
                var userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '<?= base_url('users/delete_user') ?>',
                        type: 'POST',
                        data: {id: userId},
                        success: function(response) {
                            fetchUsers(); // Refresh the list
                        }
                    });
                }
            });

            // Fetch all users
            function fetchUsers() {
                $.ajax({
                    url: '<?= base_url('users/fetch_users') ?>',
                    type: 'GET',
                    success: function(data) {
                        var users = JSON.parse(data);
                        var html = '';
                        $.each(users, function(index, user) {
                            html += '<tr>';
                            html += '<td>' + user.id + '</td>';
                            html += '<td>' + user.name + '</td>';
                            html += '<td>' + user.email + '</td>';
                            html += '<td><button class="editUserBtn" data-id="' + user.id + '">Edit</button>';
                            html += '<button class="deleteUserBtn" data-id="' + user.id + '">Delete</button></td>';
                            html += '</tr>';
                        });
                        $('#usersTable tbody').html(html);
                    }
                });
            }

            $('#createForm').submit((e)=>{
                e.preventDefault();
                console.log($(this).serialize());
                $.ajax({
                    url:"<?= base_url('users/post_user_data') ?>",
                    method:"POST",
                    data: $(this).serialize(),
                    dataType:"json",
                    success: (response)=>{
                        if (response.status == 'success') {
                             fetchUsers();

                              $('#createMessage').text("User Created successfully");
                              $('#createForm')[0].reset();
                        }else{
                            $('#createMessage').text(response.message);
                        }
                    }
                })
            })
        });
    </script>
</body>
</html>
