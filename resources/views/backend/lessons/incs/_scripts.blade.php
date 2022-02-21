
<script src="{{ asset('backend/ckeditor/ckeditor.js') }}" charset="utf-8"></script>

<script type="text/javascript">
    CKEDITOR.replace('content', {language: '{{ GetLanguage() }}'});
</script>
