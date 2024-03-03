import Swal from 'sweetalert2'

const SweetAlert = {
    install (app) {
        app.config.globalProperties.$swal = Swal
        app.config.globalProperties.$toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        })
    }
}

export default SweetAlert
