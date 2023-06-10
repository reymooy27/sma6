document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('menu')
  const close = document.getElementById('close')
  const sidebar = document.getElementsByClassName('sidebar')
  const select = document.getElementById('kelas')
  const btnEdit = document.querySelectorAll('#btn-edit-siswa')
  const btnEditGuru = document.querySelectorAll('#btn-edit-guru')
  const btnEditMapel = document.querySelectorAll('#btn-edit-mapel')
  const modalEditForm = document.querySelector('#editSiswa form')
  const modalEditFormGuru = document.querySelector('#editGuru form')
  const modalEditFormMapel = document.querySelector('#editMapel form')
  const btnDelete = document.querySelectorAll('#btn-hapus-siswa')
  const modalDeleteAnchor = document.querySelector('#hapusSiswa a')
  const btnDeleteGuru = document.querySelectorAll('#btn-hapus-guru')
  const modalDeleteAnchorGuru = document.querySelector('#hapusGuru a')
  const btnDeleteMapel = document.querySelectorAll('#btn-hapus-mapel')
  const modalDeleteAnchorMapel = document.querySelector('#hapusMapel a')
  
  menu.addEventListener('click',()=>{
    sidebar[0].classList.toggle('open')
  })

  close.addEventListener('click',()=>{
    sidebar[0].classList.remove('open')
  })

  select?.addEventListener('change',()=>{
    const id = select?.value;
    window.location = 'kelas.php?id=' + id
  })

  btnEdit.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.siswa)
      console.log(data)
      modalEditForm['nama'].value = data.nama
      modalEditForm['nis'].value = data.nis
      modalEditForm['tempat_lahir'].value = data.tempat_lahir
      modalEditForm['tanggal_lahir'].value = data.tanggal_lahir
      modalEditForm['jenis_kelamin'].value = data.jenis_kelamin
      modalEditForm['agama'].value = data.agama
      modalEditForm['alamat'].value = data.alamat
      modalEditForm['nama_ayah'].value = data.nama_ayah
      modalEditForm['nama_ibu'].value = data.nama_ibu
      modalEditForm['pekerjaan_ayah'].value = data.pekerjaan_ayah
      modalEditForm['pekerjaan_ibu'].value = data.pekerjaan_ibu
      modalEditForm['thn_semester'].value = data.thn_semester
      modalEditForm['no_telp'].value = data.no_telp
      modalEditForm.action = `./controllers/editSiswa.php?id=${data?.id}`
    })
  })

  btnEditGuru.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.guru)
      console.log(data)
      modalEditFormGuru['nama_guru'].value = data.nama_guru
      modalEditFormGuru['tempat_lahir'].value = data.tempat_lahir
      modalEditFormGuru['tanggal_lahir'].value = data.tanggal_lahir
      modalEditFormGuru['jenis_kelamin'].value = data.jenis_kelamin
      modalEditFormGuru['agama'].value = data.agama
      modalEditFormGuru['alamat'].value = data.alamat
      modalEditFormGuru['jabatan'].value = data.jabatan
      modalEditFormGuru['no_telp'].value = data.no_telp
      modalEditFormGuru.action = `./controllers/editGuru.php?id=${data?.id}`
    })
  })

  btnEditMapel.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.mapel)
      console.log(data)
      modalEditFormMapel['nama_mapel'].value = data.nama_mapel
      modalEditFormMapel.action = `./controllers/editMapel.php?id=${data?.id_mapel}`
    })
  })

  btnDelete.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchor.href = `./controllers/hapusSiswa.php?id=${btn.dataset.id}`
    })
  })

  btnDeleteGuru.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorGuru.href = `./controllers/hapusGuru.php?id=${btn.dataset.id}`
    })
  })

  btnDeleteMapel.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorMapel.href = `./controllers/hapusMapel.php?id=${btn.dataset.id}`
    })
  })

})