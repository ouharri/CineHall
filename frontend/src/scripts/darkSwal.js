export default function run() {
  const Swalmode = localStorage.getItem('mode')
    ? JSON.parse(localStorage.getItem('mode'))
    : window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    ? 'dark'
    : 'light'
  const swalDark1 = document.getElementsByClassName('swal2-modal')
  const swalDark2 = document.getElementsByClassName('swal2-container')
  const swalDark3 = document.getElementsByClassName(
    'swal2-success-circular-line-left',
  )
  const swalDark4 = document.getElementsByClassName(
    'swal2-success-circular-line-right',
  )
  const swalDark5 = document.getElementsByClassName('swal2-success-fix')
  if (Swalmode == 'dark') {
    swalDark1[0]?.classList.add('bg-gray-600');
    swalDark1[0]?.classList.add('text-gray-200');
    swalDark3[0]?.classList.add('hidden');
    swalDark4[0]?.classList.add('hidden');
    swalDark5[0]?.classList.add('hidden');
    swalDark2[0].style = 'background-color: rgb(218 218 218 / 40%) !important;';
  }
}
