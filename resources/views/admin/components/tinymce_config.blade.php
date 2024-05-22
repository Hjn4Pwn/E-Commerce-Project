<script src="https://cdn.tiny.cloud/1/{{ env('TinyMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
</script>

<script>
    tinymce.init({
        selector: 'textarea#editorTinyMCE',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>


<script>
    tinymce.init({
        selector: 'textarea#editorTinyMCE_list',
        plugins: 'lists',
        toolbar: 'undo redo | bold italic | bullist'
    });
</script>
