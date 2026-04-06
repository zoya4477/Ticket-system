<!-- SweetAlert2 Toast Component -->
@if(session()->has('toast'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastData = @json(session('toast'));

        Swal.fire({
            toast: true,
            position: toastData.position || 'top-end',
            icon: toastData.icon || 'success',
            title: toastData.message || '',
            showConfirmButton: false,
            timer: toastData.timer || 3000,
            timerProgressBar: toastData.timerProgressBar !== undefined ? toastData.timerProgressBar : true,
            background: toastData.background || '#38a169',
            color: toastData.color || '#fff'
        });
    });
</script>
@endif