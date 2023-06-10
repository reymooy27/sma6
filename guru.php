<?php require './partial/header.php'?>
<?php 
  require './controllers/kelas.php';
  $conn = OpenCon();


  $sql = "SELECT * FROM guru";
  $result = $conn->query($sql);
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }
  $conn->close();
  // echo json_encode($data);

?>
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <div class="mb-3">
    <h3>Daftar Guru</h3>
  </div>

  <div class="d-flex justify-content-between mb-3">
    <div>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahGuru">
        <img src="src/images/plus.svg" alt="">
        Tambah Guru
      </button>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="tambahGuruLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahGuruLabel">Tambah Guru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./controllers/tambahGuru.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
        <div>
          <label for="nama_guru" class="form-label">Nama Guru</label>
          <input type="text" placeholder="Nama Guru" autofocus name="nama_guru" required class="form-control">
        </div>
        <div>
          <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
          <input type="text" placeholder="Tempat Lahir" autofocus name="tempat_lahir" class="form-control">
        </div>
        <div>
          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" autofocus name="tanggal_lahir" class="form-control">
        </div>
        <div>
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" placeholder="Alamat" autofocus name="alamat" class="form-control">
        </div>
        <div>
          <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="" class="form-select">
            <option selected value="Pilih Jenis Kelamin">Pilih Jenis Kelamin</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div>
          <label for="agama" class="form-label">Agama</label>
          <select name="agama" id="" class="form-select">
            <option selected value="Pilih Agama">Pilih Agama</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Islam">Islam</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
          </select>
        </div>
        <div>
          <label for="jabatan" class="form-label">Jabatan</label>
          <input type="text" placeholder="Jabatan" autofocus name="jabatan" class="form-control">
        </div>
        <div>
          <label for="no_telp" class="form-label">No. Telepon</label>
          <input type="text" placeholder="No. Telepon" autofocus name="no_telp" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>


  <div class="bg-white shadow p-3 rounded table-responsive">
    <table class="table table-hover table-striped table-sm display" id="datatable">
      <thead>
        <tr class="table-secondary">
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Nama</th>
          <th scope="col" class="text-center">Tempat/Tanggal Lahir</th>
          <th scope="col" class="text-center">Jenis Kelamin</th>
          <th scope="col" class="text-center">Agama</th>
          <th scope="col" class="text-center">Alamat</th>
          <th scope="col" class="text-center">Jabatan</th>
          <th scope="col" class="text-center">No. Telp</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $key=>$row):?>
          <tr>
            <td><?= $key + 1?></td>
            <td><?= strtoupper($row['nama_guru'])?></td>
            <td><?= $row['tempat_lahir'].', ' . $row['tanggal_lahir']?></td>
            <td><?= $row['jenis_kelamin']?></td>
            <td><?= $row['agama']?></td>
            <td><?= $row['alamat']?></td>
            <td><?= $row['jabatan']?></td>
            <td><?= $row['no_telp']?></td>
            <td class="d-flex gap-3">
              <button type="button" id="btn-edit-guru" class="btn btn-warning" data-id="<?= $row['id']?>" data-guru='{"id":"<?=$row['id']?>","nama_guru":"<?=$row['nama_guru']?>","tempat_lahir":"<?=$row['tempat_lahir']?>","tanggal_lahir":"<?=$row['tanggal_lahir']?>","jenis_kelamin":"<?=$row['jenis_kelamin']?>","agama":"<?=$row['agama']?>","alamat":"<?=$row['alamat']?>","jabatan":"<?=$row['jabatan']?>","no_telp":"<?=$row['no_telp']?>"}' data-bs-toggle="modal" data-bs-target="#editGuru">
                <img src="src/images/edit.svg" alt="">
              </button>
              <button type="button" id="btn-hapus-guru" class="btn btn-danger" data-id="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#hapusGuru">
                <img src="src/images/trash.svg" alt="">
              </button>
            </td>
          </tr>
          <?php endforeach?>
      </tbody>
    </table>

    <div class="modal fade" id="editGuru" tabindex="-1" aria-labelledby="editGuruLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editGuruLabel">Edit Guru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editGuru.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama_guru" class="form-label">Nama Guru</label>
              <input type="text" placeholder="Nama Guru" autofocus name="nama_guru" required class="form-control">
            </div>
            <div>
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" placeholder="Tempat Lahir" autofocus name="tempat_lahir" class="form-control">
            </div>
            <div>
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" autofocus name="tanggal_lahir" class="form-control">
            </div>
            <div>
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" placeholder="Alamat" autofocus name="alamat" class="form-control">
            </div>
            <div>
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="" class="form-select">
                <option selected value="Pilih Jenis Kelamin">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label for="agama" class="form-label">Agama</label>
              <select name="agama" id="" class="form-select">
                <option selected value="Pilih Agama">Pilih Agama</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
              </select>
            </div>
            <div>
              <label for="jabatan" class="form-label">Jabatan</label>
              <input type="text" placeholder="Jabatan" autofocus name="jabatan" class="form-control">
            </div>
            <div>
              <label for="no_telp" class="form-label">No. Telepon</label>
              <input type="text" placeholder="No. Telepon" autofocus name="no_telp" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="hapusGuru" tabindex="-1" aria-labelledby="hapusGuruLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus guru ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="./controllers/hapusGuru.php?id=">Hapus Guru</a>
      </div>
    </div>
  </div>
</div>

  
<script>
  $(document).ready(function () {
    $('#datatable').DataTable();
});
</script>
<?php require './partial/footer.php'?>