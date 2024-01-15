<div class="bg-white p-8 shadow-md rounded-md max-w-md w-full" id="container-login">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
    <form id="form-login">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" placeholder="Your username" name="username" id="username-login" class="w-full border px-4 py-2 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" placeholder="Your password" name="password" id="password-login" class="w-full border px-4 py-2 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
    </form><br>
    <a href="#" class="nav-link" id="a-register">Belum punya akun?</a>
</div>
<script>
    $(document).ready(function() {
        $('#form-login').on('submit', function(e) {
            e.preventDefault();
            let username = $('#username-login').val();
            let password = $('#password-login').val();

            let user = {
                'username': username,
                'password': password
            }

            login(user);
        });

    });

    function login(user) {
        $.ajax({
            method: 'POST',
            url: "api/login",
            data: user,
            dataType: "json",
            success: function(response) {
                Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Login Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(function() {
                        $('#content').load('mahasiswa');
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
                        $('#content').load('welcome');
                    });
            }
        });
    }
</script>