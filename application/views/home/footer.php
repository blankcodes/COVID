    <div id="loader" class="loader-div" hidden="hidden" data-backdrop="static" data-keyboard="false">
        <div class="loader-wrapper">
            <img src="<?=base_url('assets/img/loader.svg')?>" width="120" heigth="120">
        </div>
    </div>


    <footer class="footer" id="footer_wrapper">
        <div class="container">
            <div class="__preload-data"></div>
            <div class="___preload-data"></div>
            <div class="_preload-data"></div>
        </div>  
    </footer>
    <div class="footer-element">
        <div class="container ">
            <div class="text-center margin-top-20">
                &copy; <?=date('Y')?> Philippines COVID-19 Updates
            </div>
        </div>
    </div>

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