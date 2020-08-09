@if(Session::has('success'))
    <script type="text/javascript">
        Swal.fire({
            title:'Success!',
            text:"{{ Session::get('success') }}",
            icon: "success",
            timer:3000,
        })
    </script>
@endif

@if(Session::has('success_toast'))
    <!-- SweetAlert -->
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: "{{ Session::get('success_toast') }}"
        })
    </script>
@endif
