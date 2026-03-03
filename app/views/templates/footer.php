    </div>
    <!-- End Content -->
</div>
<!-- End Wrapper -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>/js/script.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('.sidebar').toggleClass('active');
            $('#content').toggleClass('active');
        });
    });
</script>

</body>
</html>
