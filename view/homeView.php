<?php

$title = "Accueil";

?>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center fullHeight">
      <div class="container">
        <img class="img-fluid mb-4 d-block mx-auto" src="public/img/profile.png" alt="">
        <h1 class="text-uppercase mb-0">Anthony Cecconato</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Vos idées sont nos projets</h2>
        <a class="btn btn-xl btn-outline-light mt-3 js-scroll-trigger" href="#about">
          <i class="fa fa-info mr-2"></i>
           Voir ma présentation
        </a>
      </div>
    </header>

    <!-- about Section -->
    <section class="about fullHeight" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Présentation</h2>
        <hr class="star-dark mb-5">
          <div class="row">
            <div class="col-12">
              <p>
                J'ai fait trois ans d'apprentissage en mécanique automobile avant de me réorienter vers le développement informatique, un milieu qui me passionne
                depuis mon adolescence.
              </p>
              <p>
                Je suis actuellement inscrit à la formation "Développeur d'application PHP / Symfony" du MOOC Openclassrooms, qui propose un diplôme enregistré au RNCP,
                de niveau 2 et reconnu par l'État.
              </p>
              <p>
                J'ai l'ambition de continuer à apprendre d'autres technologies après ma formation. Je pense commencer par apprendre JavaScript et quelques Framework,
                puis améliorer mes compétences Frontend pour devenir plus autonome dans la création d'un projet de A à Z, et avoir des compétences dans plusieurs domaines
                afin de mieux m'intégrer dans des équipes de développement.
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center mt-5">
                <a class="btn btn-xl btn-outline-dark mb-1" href="public/CV.pdf" target="_blank">
                  <i class="fas fa-download mr-2"></i>
                  Voir mon CV !
                </a>
                <a class="btn btn-xl btn-outline-dark mb-1 js-scroll-trigger" href="#skills">
                  <i class="fas fa-cogs mr-2"></i>
                  Mes compétences !
                </a>
            </div>
          </div>
        </div>

      <div class="d-none d-md-block img-divider mt-5"></div>

    </section>

    <!-- skills Section -->
    <section class="fullHeight mx-auto" id="skills">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary">Compétences</h2>
        <hr class="star-dark mb-5">

        <div class="row lineOfSkills">

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
                <h3><i class="fab fa-html5 "></i>
                  HTML5
                  <span class="d-block">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                  </span>
                </h3>
          </div>

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
              <h3><i class="fab fa-css3"></i>
                CSS3
                <span class="d-block">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                </span>
              </h3>
          </div>

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
            <h3>
              <i class="fab fa-php"></i>
              PHP
              <span class="d-block">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
              </span>
            </h3>
          </div>

        </div>

        <div class="row lineOfSkills">

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
            <h3>
              <i class="fab fa-css3"></i>
               Bootstrap 3 / 4
               <span class="d-block">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
              </span>
            </h3>
          </div>

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
            <h3>
              <i class="fab fa-github"></i>
               Git
              <span class="d-block">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
              </span>
            </h3>
          </div>

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
                <h3><i class="fas fa-database "></i>
                  SQL / Merise 2
                  <span class="d-block">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                  </span>
                </h3>
          </div>

        </div>
        <div class="row lineOfSkills">

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
            <h3>
              <i class="fas fa-code"></i>
               Lua
              <span class="d-block">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </span>
            </h3>
          </div>

          <div class="skill col-sm-12 col-md-4 bg-light border py-2 my-1">
            <h3>
              <i class="fab fa-wordpress"></i>
               Wordpress
              <span class="d-block">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
              </span>
            </h3>
          </div>
        </div>

        <div class="row">
          <div class="col-12 text-center mt-5">
            <a class="btn btn-xl btn-outline-dark js-scroll-trigger mb-1" href="#contact">
              <i class="far fa-envelope"></i>
              Contactez-moi !
            </a>
            <a class="btn btn-xl btn-outline-dark mb-1" href="blog.html">
              <i class="fas fa-eye"></i>
              Voir le blog
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="fullHeight" id="contact">
      <div class="container-fluid">
        <h2 class="text-center text-uppercase mb-0">Contactez moi</h2>
        <hr class="star-dark mb-5">
        <div class="row">

          <div class="col-12 col-lg-8 mx-auto">
            <form method="POST" action="#" name="contactForm" id="contactForm">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Nom</label>
                  <input class="form-control" id="name" type="text" placeholder="Nom" required="required">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Adresse email</label>
                  <input class="form-control" id="emailAddr" type="text" placeholder="Adresse email" required="required">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Numéro de téléphone</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Numéro de téléphone (Optionnel)">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Message</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required"></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Envoyer mon message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>