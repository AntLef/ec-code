<?php ob_start(); ?>

<div class="landscape">
  <div class="bg-black">
    <div class="row no-gutters">
      <div class="col-md-6 full-height bg-white">
        <div class="auth-container">
          <h2><span>Cod</span>'Flix</h2>
          <h3>Nous Contacter</h3>

          <form method="post" action="index.php?action=signup" class="custom-form">

            <?php if(!$user->id): ?>
              <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="name" value="" id="email" class="form-control" />
              </div>
            <?php endif ?>

            <div class="form-group">
              <label for="text">Votre message</label>
              <textarea type="text" name="text" id="text" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" name="Valider" Value="Envoyer votre Message" class="btn btn-block bg-red" />
                </div>
              </div>
            </div>

            <span class="error-msg">
              <?= isset( $error_msg ) ? $error_msg : null; ?>
            </span>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require( __DIR__ . '/base.php'); ?>
