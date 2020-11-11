
const form = document.getElementById('form');
const nik = document.getElementById('user_nik');
const namaDepan = document.getElementById('user_nama_depan');
const namaBelakang = document.getElementById('user_nama_belakang');
const password = document.getElementById('user_password_first');
const password2 = document.getElementById('user_password_second');
const email = document.getElementById('user_email');
const ktp = document.getElementById('user_ktp');
// const error = document.getElementById('error')


form.addEventListener('submit', (e)=>{
  e.preventDefault();

  checkInputs();
})

function checkInputs(){
  //get Values
  const nikValue = nik.value.trim();
  const namaDepanValue = namaDepan.value.trim();
  const namabelakangValue = namaBelakang.value.trim();
  const passwordValue = password.value.trim();
  const password2Value = password2.value.trim();
  const emailValue = email.value.trim();
  const ktpValue = ktp.value.trim();

  if (nikValue === ''){
    setErrorFor(nik, 'Nik harus diisi');
  }

  if (namaDepanValue === ''){
    setErrorFor(namaDepan, 'Nama harus diisi');
  }

  if (namabelakangValue === ''){
    setErrorFor(namaBelakang, 'Nama harus diisi');
  }

  if (passwordValue === ''){
    setErrorFor(password, 'Password harus diisi');
  }

  if (password2Value === ''){
    setErrorFor(password2, 'Konfirmasi Password anda');
  }

  else if(passwordValue !== password2Value) {
    setErrorFor(password2, 'Password tidak sama');
  }

  if (emailValue === ''){
    setErrorFor(email, 'Email harus diisi');
  }

  if (ktpValue === ''){
    setErrorFor(ktp, 'Upload KTP anda');
  }
}

function setErrorFor(input, messages) {
  const formGroup = input.parentElement;
  const small = formGroup.querySelector('small');

  //add error messages inside small
  small.innerText = messages;

  //add error class
  formGroup.className = 'form-group row error';
}
