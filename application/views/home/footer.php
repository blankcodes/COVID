    <div id="loader" class="loader-div" hidden="hidden" data-backdrop="static" data-keyboard="false">
        <div class="loader-wrapper">
            <img src="<?=base_url('assets/img/loader.svg')?>" width="120" heigth="120">
        </div>
    </div>
    
    <div id="subscribe_notification" class="btn btn-circle btn-notify" data-toggle="tooltip" data-placement="left" title="Get notified when there's new case reported!">
        <img src="<?=base_url('assets/img/bell.png')?>" alt="notification" width="40"/>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="notify_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Get realtime updates for COVID-19 cases.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="margin-bottom-20">
                        Enter your email address
                    </div>
                   <div class="emailDiv">
                        <input type="text" class="form-control inputEmail" id="subs_email" />
                        <span class="floating-placeholder">Email address</span>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-round" id="save_email">Save</button>
                    <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                </div>
            </div>
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
    <script src="<?=base_url('assets/js/sweetalert.min.js')?>"></script>
    <script src="<?=base_url('assets/js/historical_data.js')?>"></script>

</body>
</html>