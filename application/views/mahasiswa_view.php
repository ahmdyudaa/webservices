<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Tambahkan link JavaScript Bootstrap dan Popper.js (diperlukan oleh Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Mahasiswa</h2>
        <button type="button" class="btn btn-primary mb-3" id="btn-tambah">Tambah</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="mahasiswa-list"></tbody>
        </table>
    </div>

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah">
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <input type="text" class="form-control" id="nim" name="nim">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa:</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan:</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-nim">NIM:</label>
                            <input type="text" class="form-control" id="edit-nim" name="nim" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-nama">Nama Mahasiswa:</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="edit-jurusan">Jurusan:</label>
                            <input type="text" class="form-control" id="edit-jurusan" name="jurusan">
                        </div>
                        <div class="form-group">
                            <label for="edit-alamat">Alamat:</label>
                            <textarea class="form-control" id="edit-alamat" name="alamat"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            getMahasiswa();
        })

        $(document).on('click', '#btn-edit', function() {
            console.log("masuk")
            let id = $(this).data('id');
            findMahasiswa(id);
            $('#editModal').modal('show');
        });

        $(document).on('click', '#btn-delete', function() {

            let id = $(this).data('id');
            deleteMahasiswa(id);
        });

        $(document).on('click', '#btn-tambah', function() {
            $('#tambahModal').modal('show');
        });

        $(document).on('submit', '#form-tambah', function(e) {
            e.preventDefault();
            addMahasiswa();
        });

        $(document).on('submit', '#form-edit', function(e) {
            e.preventDefault();
            editMahasiswa();
        });

        function getMahasiswa() {
            $.ajax({
                url: 'http://localhost/webservices/index.php/api/mahasiswa',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, mahasiswa) {
                        $('#mahasiswa-list').append(`
                            <tr data-id="${mahasiswa.id}">
                                <td>${mahasiswa.nim}</td>
                                <td>${mahasiswa.nama}</td>
                                <td>${mahasiswa.jurusan}</td>
                                <td>${mahasiswa.alamat}</td>
                                <td>
                                <button type="button" id="btn-edit" class="btn btn-warning btn-edit" data-id="${mahasiswa.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                </button>
                                <button type="button" id="btn-delete" class="btn btn-danger btn-hapus" data-id="${mahasiswa.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg> 
                                </button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(error) {
                    console.log('Gagal mengambil data mahasiswa:', error);
                }
            });
        }

        function addMahasiswa() {
            let dataMahasiswa = {
                "nama": $('#nama').val(),
                "nim": $('#nim').val(),
                "jurusan": $('#jurusan').val(),
                "alamat": $('#alamat').val(),
            }

            $.ajax({
                method: 'POST',
                url: "api/mahasiswa/add/",
                dataType: "json",
                data: dataMahasiswa,
                success: function(response) {
                    console.log(response);
                    $('#tambahModal').modal('hide');
                    $('#mahasiswa-list').html("");
                    getMahasiswa();
                }
            });
        }

        function findMahasiswa(id) {
            $.ajax({
                method: 'GET',
                url: "api/mahasiswa/find/" + id,
                dataType: "json",
                success: function(response) {
                    $('#edit-id').val(id);
                    $('#edit-nim').val(response.nim);
                    $('#edit-nama').val(response.nama);
                    $('#edit-jurusan').val(response.jurusan);
                    $('#edit-alamat').val(response.alamat);
                }
            });
        }

        function editMahasiswa() {
            let id = $('#edit-id').val();

            let dataMahasiswa = {
                "nama": $('#edit-nama').val(),
                "nim": $('#edit-nim').val(),
                "jurusan": $('#edit-jurusan').val(),
                "alamat": $('#edit-alamat').val(),
            }

            $.ajax({
                method: 'POST',
                url: "api/mahasiswa/edit/" + id,
                dataType: "json",
                data: dataMahasiswa,
                success: function(response) {
                    console.log(response);
                    $('#editModal').modal('hide');
                    $('#mahasiswa-list').html("");
                    getMahasiswa();
                }
            });
        }

        function deleteMahasiswa(id) {
            $.ajax({
                method: 'DELETE',
                url: "api/mahasiswa/delete/" + id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#mahasiswa-list').html("");
                    getMahasiswa();
                }
            });
        }
    </script>
</body>

</html>