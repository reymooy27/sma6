document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('menu')
  const close = document.getElementById('close')
  const sidebar = document.getElementsByClassName('sidebar')
  const select = document.getElementById('kelas')
  const btnEdit = document.querySelectorAll('#btn-edit-siswa')
  const modalEditInput = document.querySelector('#editSiswa input')
  const modalEditForm = document.querySelector('#editSiswa form')
  const btnDelete = document.querySelectorAll('#btn-hapus-siswa')
  const modalDeleteAnchor = document.querySelector('#hapusSiswa a')
  
  menu.addEventListener('click',()=>{
    sidebar[0].classList.toggle('open')
  })

  close.addEventListener('click',()=>{
    sidebar[0].classList.remove('open')
  })

  select.addEventListener('change',()=>{
    const id = select.value;
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

  btnDelete.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchor.href = `./controllers/hapusSiswa.php?id=${btn.dataset.id}`
    })
  })

})