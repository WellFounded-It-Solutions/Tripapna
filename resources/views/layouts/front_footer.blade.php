      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <script>
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
  <!--   Core JS Files   -->
  <script src="<?php echo url('/'); ?>/dist/js/jquery.form.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
  <script src="<?php echo url('/'); ?>/dist/js/pertify.js"></script>
  <script src="<?php echo url('/'); ?>/dist/js/jquery.toast.min.js"></script>
  <script src="<?php echo url('/'); ?>/hotelpanel/assets/js/core/popper.min.js"></script>
  <script src="<?php echo url('/'); ?>/hotelpanel/assets/js/core/bootstrap.min.js"></script>
</body>

</html>