<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->



<script src="{{ asset('backend/ckeditor/ckeditor.js') }}" charset="utf-8"></script>

<script type="text/javascript">
    CKEDITOR.replace('content', {language: '{{ GetLanguage() }}'});
</script>
