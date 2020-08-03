@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            title:'Success!',
            text:"{{ Session::get('success') }}",
            icon: "success",
            timer:5000,
            //type:'success'
        }).then((value) => {
            location.reload();
        }).catch(swal.noop);
    </script>
@endif
