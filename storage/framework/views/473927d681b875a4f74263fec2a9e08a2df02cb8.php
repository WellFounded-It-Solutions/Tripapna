<footer class="main-footer">
<div class="float-right d-none d-sm-block">

</div>

</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>


<script src="<?php echo url('/'); ?>/dist/js/jquery.form.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/pertify.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/jquery.toast.min.js"></script>
<script src="<?php echo url('/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo url('/'); ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
<script>
 $('.select2').select2();
 $('.select3').select2();
 $('.select4').select2();
 $('.select5').select2();
 $(document).ready(function() {
    $('#summernote').summernote({
       placeholder: 'your Message',
       tabsize: 2,
       height: 150
    });
    $('#summernote2').summernote({
       placeholder: 'your Message',
       tabsize: 2,
       height: 150
    });
});
</script>
</body>
</html><?php /**PATH E:\client\tripapna\admin\resources\views/layouts/admin_footer.blade.php ENDPATH**/ ?>