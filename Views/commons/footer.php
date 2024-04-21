
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">M2L-COIN</a> Tous droits réservés. 
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							
                        </div>

                        <div class="col-md-5 text-center text-center m-0">
							Ceci est un projet qui a été réalisé dans le cadre d'un projet scolaire
                        </div>

                        <div class="col-md-4 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="<?php echo $GLOBALS['__HOST__']?>connexion">Se connecter</a>
                                <a href="<?php echo $GLOBALS['__HOST__']?><?= (isset($_SESSION["idU"])) && ($_SESSION != NULL) ? 'deposer-une-annonce' : 'connexion' ?>">Déposer une annonce</a>
                                
                            </div>
                        </div>

                        
                        
                    </div>
                    <div class="col-md-5 text-center mt-4 text-align-center" style="display: block; margin: auto">
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/wow/wow.min.js"></script>
    <script src="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/easing/easing.min.js"></script>
    <script src="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo $GLOBALS['__HOST__']?>/Assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo $GLOBALS['__HOST__']?>/Assets/js/main.js"></script>
</body>

</html>