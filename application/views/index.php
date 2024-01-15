<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Tambahkan link JavaScript Bootstrap dan Popper.js (diperlukan oleh Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="bg-gray-100 h-screen flex items-center justify-center" id="content"></div>

    <script>
        $(document).ready(function () {
            $('#content').load('main');
            $(document).on('click', '#a-register',function(e){
                e.preventDefault();
                $('#content').load('main/register');
            })
            $(document).on('click', '#a-login',function(e){
                e.preventDefault();
                $('#content').load('main');
            })
        });
    </script>
</body>

</html>
