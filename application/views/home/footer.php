    <div id="loader" class="loader-div" hidden="hidden" data-backdrop="static" data-keyboard="false">
        <div class="loader-wrapper">
            <img src="<?=base_url('assets/img/loader.svg')?>" width="120" heigth="120">
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="text-right margin-top-30">
            Reference: <a target="_blank" rel="noopener noreferrer" href="https://github.com/NovelCOVID/API">NovelCOVID</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
    <script>
        var base_url = '<?=base_url()?>';	
        var country = 'philippines';
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="<?=base_url('assets/bootstrap4/popper.js')?>"></script>
    <script src="<?=base_url('assets/bootstrap4/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/chart.min.js')?>"></script>
    <script src="<?=base_url('assets/js/historical_data.js')?>"></script>

</body>
</html>