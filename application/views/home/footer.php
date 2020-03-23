    <div id="loader" class="loader-div" hidden="hidden" data-backdrop="static" data-keyboard="false">
        <div class="loader-wrapper">
            <img src="<?=base_url('assets/img/loader.svg')?>" width="120" heigth="120">
        </div>
    </div>

    <div class="margin-top-30">
        
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row footer-credits" >
                <div class="col-lg-3 col-6">
                    <h2>Source:</h2>
                    <ul>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="">Worldometers</a></li>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://doh.gov.ph">DOH</a></li>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/OfficialDOHgov/">DOH Facebook</a></li>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://who.int">WHO</a></li>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://news.google.com">Google News</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-6">
                    <h2>Referece:</h2>
                    <ul>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://github.com/NovelCOVID/API">NovelCOVID</a></li>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://github.com/CSSEGISandData/COVID-19">CSSEGISandData</a></li>

                    </ul>
                </div>

                <div class="col-lg-3 col-6">
                    <h2>Donations:</h2>
                    <ul>
                        <li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.globe.com.ph/about-us/newsroom/partners/gcash-users-donate-to-fight-covid-19.html">Gcash</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-6">
                    <h2>Developer:</h2>
                    <ul>
                        <li><a target="_blank" rel="noopener" href="https://github.com/blankcodes/covid19">Github</a></li>
                        <li><a target="_blank" rel="noopener" href="https://kenkarlo.com">Ken Karlo</a></li>
                    </ul>
                </div>
            </div>
        </div>

        
    </footer>
    <div class="footer-element">
        <div class="container ">
            <div class="text-center margin-top-20">
                Philippines COVID-19 Updates. &copy; <?=date('Y')?>
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