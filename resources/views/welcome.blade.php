<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- @include('admin.components.tinymce_config') --}}
</head>

<body>
    {{-- @include('admin.components.tinymce_config') --}}
    <form method="post">
        <textarea id="editorTinyMCE">Hello, Huyna!</textarea>
    </form>
    @include('admin.components.tinymce_config')
</body>

</html>
