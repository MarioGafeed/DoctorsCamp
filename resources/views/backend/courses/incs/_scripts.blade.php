<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
    $(document).ready(function() {
         $('input[name=name]').on('keyup', function(event) {
             $('input[name=slug]').val(($(this).val().toLowerCase()).split(" ").join("-"))
         });
    });
</script>
