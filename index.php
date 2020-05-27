<!DOCTYPE html>
<html>

<head>
    <title>SmashZone</title>
    <link rel="icon" href="style/favicon.ico" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="style/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; margin-bottom: 20px; height: 55px;">
        <a class="logo" href="index.php">
            <div><img class="main" src="style/SmashZone2.png" /><img class="ball" src="style/SmashZoneIcon.png" />
            </div>
        </a>
        <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse rubriques" id="navbarNav">
            <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-inline rubriquecolor">
                    Effectuer une recherche :
                </li>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='offres/list_offers.php'" type="button">Partenaires</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='liste_joueurs.php'" type="button">Joueurs</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                </form>
                <form class="form-inline ml-5">
                    <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch" onclick="location.href='offres/new_offer.php'" type="button">Poster une annonce</button>
                </form>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/login.php'" type="button">Se
                    connecter/S'inscrire</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <h1 class="mb-4">Dernières infos</h1>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">Champion du monde tennis très fort là maintenant</h3>
                <p class="text-sm-left"> Maintes fois, précisément la phrase que le besoin de prendre l'offensive
                    dans ce cas que le ministre reprenait sa place de six mille braves en tant de manières qu'elle
                    gardait près d'elle pour être sa meilleure huile d'olive.</p>
            </div>
        </div>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">Blablabla post sur le tennis t'as capté</h3>
                <p class="text-sm-left"> Uniformément aussi, la parole de son frère le duc d'une voix sèche, donnant
                    libre cours à vos ego naturellement vachards. Fils de soldat et de citoyen ; et se tournant vers
                    moi, je puis nombrer en elle plusieurs lacunes, la plupart de celles du paradis.</p>
            </div>
        </div>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">AwayFromNetwork sponsorise le projet (c'est faux)</h3>
                <p class="text-sm-left"> Persuadé que ce sera impossible, répondit le greffier, un peu fat auprès
                    des femmes ? Indisposée par cette vision, qui est restée inachevée. Conscience, que vous
                    poursuivez, ils se retirèrent avec respect.</p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4" style="background-color: #264653; margin-bottom: 20px; height: 55px;">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left" style="background-color: #264653;">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="background-color: #264653;">© 2020 Copyright:
            <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
</body>

</html>