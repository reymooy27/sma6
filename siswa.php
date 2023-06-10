<?php
  require './partial/header.php';
  require './controllers/kelas.php';

  $conn = OpenCon();

  $id = $_REQUEST['id'];

  $sql = "SELECT * FROM siswa JOIN kelas ON kelas.id = siswa.kelasId WHERE siswa.id='$id'";
  $result = $conn->query($sql);
  $data = $result->fetch_assoc();
  $conn->close();
?>

<?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <div class="mb-3">
    <h1><?= strtoupper($data['nama'])?></h1>
    <h5><?= strtoupper($data['kelas'])?></h5>
  </div>

  <div class="d-flex justify-content-between mb-3">
    <div>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
        <img src="src/images/plus.svg" alt="">
        Tambah Pelanggaran
      </button>
    </div>
    <div>
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSiswa">
        <img src="src/images/edit.svg" alt="">
        Edit Siswa
      </button>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSiswa">
        <img src="src/images/trash.svg" alt="">
        Hapus Siswa
      </button>
    </div>
  </div>

  <div class="bg-white shadow p-3 rounded">
    <h4>Data Pelanggaran</h4>
    <table class="table table-hover mt-3">
        <tr class="table-dark">
          <th>No</th>
          <th>Pelanggaran</th>
          <th>Tanggal</th>
          <th>Sanksi</th>
          <th>Action</th>
        </tr>
        <tr>
          <td>0</td>
        </tr>
    </table>
  </div>

  <div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="editSiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editSiswaLabel">Edit Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="./controllers/editSiswa.php?id=<?= $id?>" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
          <div>
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" value="<?= $data['nama']?>" autofocus name="nama" required class="form-control">
          </div>
          <button type="submit" name="submit" class="btn btn-warning">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hapusSiswa" tabindex="-1" aria-labelledby="hapusSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus siswa ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="./controllers/hapusSiswa.php?id=<?= $data['id']?>">Hapus Siswa</a>
      </div>
    </div>
  </div>
</div>


<?php require './partial/footer.php'?>