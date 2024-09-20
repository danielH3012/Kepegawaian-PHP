<?php
//session_start();
require 'config.php';
 require 'header.php'; 
//include('sidebar.php');
//if (!isset($_SESSION['iduser'])) {
  // header("Location: login.php");
    //exit();
//}

$iduser = $_SESSION['user'];

// Ambil data user dari database
$stmt = $conn->prepare("SELECT username, email FROM user WHERE id_user = ?");
$stmt->bind_param("i", $iduser);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Ambil data nama usaha dan alamat dari database
$stmt = $conn->prepare("SELECT nama, alamat FROM namausaha LIMIT 1");
$stmt->execute();
$stmt->bind_result($namaUsaha, $alamatUsaha);
$stmt->fetch();
$stmt->close();

// Ambil data dari tabel departemen
$result = $conn->query("SELECT * FROM pegawai");

// Dapatkan nomor urut terbaru untuk iddep baru
$jabatan = $conn->query("SELECT * FROM jabatan");

// Dapatkan nomor urut terbaru untuk iddep baru
$departemen1 = $conn->query("SELECT * FROM departemen");

// Dapatkan nomor urut terbaru untuk iddep baru
$jabatan1 = $conn->query("SELECT * FROM jabatan");

// Dapatkan nomor urut terbaru untuk iddep baru
$departemen2 = $conn->query("SELECT * FROM departemen");

// Dapatkan nomor urut terbaru untuk iddep baru
$stmt = $conn->query("SELECT * FROM pegawai ORDER BY id_pegawai DESC LIMIT 1");
$latestiddep = $stmt->fetch_row();
$urut = 1;
if ($latestiddep) {
    $latestNumber = $latestiddep[0];
    $urut = $latestNumber + 1;
}
$newiddep = $urut;

// Simpan pesan ke variabel dan hapus dari session
$message = null;
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>


<div class="wrapper">
    <header>
        <h4><?php echo htmlspecialchars($namaUsaha); ?></h4>
        <p><?php echo htmlspecialchars($alamatUsaha); ?></p>
    </header>

   <?php include 'sidebar.php'; ?>
    <div class="content" id="content">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h4>Pegawai</h4>
                    <div>
                        <button type="button" class="btn btn-primary mb-3 mr-2" data-bs-toggle="modal" data-bs-target="#adddepartemenModal"><i class='fas fa-plus'></i> Add </button>
                        <button type="button" class="btn btn-secondary mb-3" id="printButton"><i class='fas fa-print'></i> Print</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="departemenTable" class="table table-bordered table-striped table-hover">    
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Id Pegawai</th>
                                    <th>Id Departemen</th>
                                    <th>Id Jabatan</th>
                                    <th>Nama Pegawai</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    $no = 1;
                                    while ($departemen = $result->fetch_row()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $no++ . "</td>";
                                        echo "<td class='text-center'><img style= \"height: 50px; width: 50px;\" src= ". $departemen[7] ."</td>";
                                        echo "<td class='text-center'>" . $departemen[0] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[1] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[2] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[3] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[4] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[5] . "</td>";
                                        echo "<td class='text-center'>" . $departemen[6] . "</td>";
                                        echo "<td class='text-center'>";
                                        echo "<div class='d-flex justify-content-center'>";
                                        echo "<button class='btn btn-warning btn-sm edit-btn mr-1' data-bs-toggle='modal' data-bs-target='#editdepartemenModal'
                                        data-id='" . htmlspecialchars($departemen[0]) . "
                                        ' data-id_departemen='" . htmlspecialchars($departemen[1]) .  "
                                        ' data-id_jabatan='" . htmlspecialchars($departemen[2]) .  "
                                        ' data-name='" . htmlspecialchars($departemen[3]) .  "
                                        ' data-alamat='" . htmlspecialchars($departemen[4]) .  "
                                        ' data-telp='" . htmlspecialchars($departemen[5]) .  "
                                        ' data-email='" . htmlspecialchars($departemen[6]) .  "
                                        '><i class='fas fa-edit'></i> Edit</button>";
                                        echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . htmlspecialchars($departemen[0]) . "'><i class='fas fa-trash'></i> Delete</button>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</div>

<!-- Modal Add departemen -->
<div class="modal fade" id="adddepartemenModal" tabindex="-1" aria-labelledby="adddepartemenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adddepartemenModalLabel">Add pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_pegawai.php" method="post"  enctype="multipart/form-data">
                    <div class="mb-3">
                    <label for="id" class="form-label">Id pegawai</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($newiddep); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="id_departemen" class="form-label">Id Departemen</label>
                        <select name="id_departemen" id="edit_id_departemen" required>
                    <?php 
                        while ($pilihan1 = $departemen1->fetch_row()) {
                            echo "<option value=". $pilihan1[0].">". $pilihan1[0]."</option>" ; 
                    }
                    ?> 
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_jabatan" class="form-label">Id Jabatan</label>
                        <select name="id_jabatan" id="edit_id_jabatan" required>
                    <?php 
                        while ($hasil = $jabatan->fetch_row()) {
                            echo "<option value=". $hasil[0].">". $hasil[0]."</option>" ; 
                    }
                    ?> 
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama pegawai</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_telp" class="form-label">no telepon</label>
                        <input type="text" class="form-control" id="edit_telp" name="telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <button type="submit" class="btn btn-primary" value="Upload File">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
?>
<!-- Modal Edit departemen -->
<div class="modal fade" id="editdepartemenModal" tabindex="-1" aria-labelledby="editdepartemenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editdepartemenModalLabel">Edit departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_pegawai.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="edit_iddep" class="form-label">id pegawai</label>
                        <input type="text" class="form-control" id="edit_iddep" name="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="id_departemen" class="form-label">Id Departemen</label>
                        <select name="id_departemen" id="edit_id_departemen" required>
                    <?php 
                        while ($pilihan = $departemen2->fetch_row()) {
                            echo "<option value=". $pilihan[0].">". $pilihan[0]."</option>" ; 
                    }
                    ?> 
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_jabatan" class="form-label">Id Jabatan</label>
                        <select name="id_jabatan" id="edit_id_jabatan" required>
                    <?php 
                        while ($hasil = $jabatan1->fetch_row()) {
                            echo "<option value=". $hasil[0].">". $hasil[0]."</option>" ; 
                    }
                    ?> 
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama pegawai</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_telp" class="form-label">no telepon</label>
                        <input type="text" class="form-control" id="edit_telp" name="telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <button type="submit" class="btn btn-primary" value="Upload File">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Adjust DataTables' scrolling to avoid overlapping with the footer
        function adjustTableHeight() {
            var footerHeight = $('footer').outerHeight();
            var tableHeight = 'calc(100vh - 290px - ' + footerHeight + 'px)';

            $('#departemenTable').DataTable().destroy();
            $('#departemenTable').DataTable({
                "pagingType": "simple_numbers",
                "scrollY": tableHeight,
                "scrollCollapse": true,
                "paging": true
            });
        }

        // Call the function to adjust table height initially
        adjustTableHeight();

        // Adjust table height on window resize
        $(window).resize(function() {
            adjustTableHeight();
        });

        // Populate edit modal with data
        $('#editdepartemenModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var iddep = button.data('id');
            var nama = button.data('name');
            var id_departemen = button.data('id_departemen');
            var id_jabatan = button.data('id_jabatan');
            var alamat = button.data('alamat');
            var email = button.data('email');
            var telp = button.data('telp');
            
            var modal = $(this);
            modal.find('#edit_iddep').val(iddep);
            modal.find('#edit_nama').val(nama);
            modal.find('#edit_id_departemen').val(id_departemen);
            modal.find('#edit_alamat').val(alamat);
            modal.find('#edit_id_jabatan').val(id_jabatan);
            modal.find('#edit_email').val(email);
            modal.find('#edit_telp').val(telp);
        });

        // Show message if it exists in the session
        <?php if ($message): ?>
            Swal.fire({
                title: '<?php echo $message['type'] === 'success' ? 'Success!' : 'Error!'; ?>',
                text: '<?php echo $message['text']; ?>',
                icon: '<?php echo $message['type'] === 'success' ? 'success' : 'error'; ?>'
            });
        <?php endif; ?>

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var iddep = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'Apa benar data tersebut dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_pegawai.php',
                        type: 'POST',
                        data: { iddep: iddep },
                        success: function(response) {
                            console.log(response); // Debugging
                            if (response.includes('Success')) {
                                Swal.fire(
                                    'Deleted!',
                                    'Data berhasil dihapus.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText); // Debugging
                            Swal.fire(
                                'Error!',
                                'An error occurred: ' + error,
                                'error'
                            );
                        }
                    });
                }
            });   
        });        
        //Print ke PDF        
        $(document).ready(function() {
            // Other existing scripts...

            // Handle print button click
            $('#printButton').click(function() {
                window.location.href = 'print_departemen.php';
            });
        });
    });
</script>
</body>
</html>

