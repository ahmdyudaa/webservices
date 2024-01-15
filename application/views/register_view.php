<div class="bg-white p-8 shadow-md rounded-md max-w-md w-full" id="container-register">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
    <form id="form-register">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" placeholder="Your username" name="username" id="username-register" class="w-full border px-4 py-2 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" placeholder="Your password" name="password" id="password-register" class="w-full border px-4 py-2 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Register</button>
    </form><br>
    <a href="#" class="nav-link" id="a-login">Sudah punya akun?</a>
</div>
<script>
    $(document).ready(function() {
        $('#form-register').on('submit', function(e) {
            e.preventDefault();
            let username = $('#username-register').val();
            let password = $('#password-register').val();
            
            let user = {
                'username': username,
                'password': password
            }

            register(user);
        });
    });

    function register(user) {
        $.ajax({
            method: 'POST',
            url: "api/register",
            data: user,
            dataType: "json",
            success: function(response) {
                Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Register Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(function() {
                        $('#content').load('main');
                    });
            },
            error: function(response) {
                Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "Login Failed",
                        showConfirmButton: false,
                        timer: 1000
                    })
                    .then(function() {
                        $('#content').load('main/register');
                    });
            }
        });
    }
</script>