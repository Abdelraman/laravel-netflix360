@if (session('success'))
    <script>
        new Noty({
            layout: 'topRight',
            text: "{{session('success') }}",
            killer: true,
            timeout: 2000,
        }).show();
    </script>
@endif