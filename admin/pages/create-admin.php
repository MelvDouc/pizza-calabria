<h1>Créer un nouvel administrateur</h1>

<form action="../src/processing/processing.php?create-admin" method="POST">

  <div class="form-group">
    <label for="pseudo">Nom d'utilisateur</label>
    <input type="text" name="pseudo" id="pseudo" />
  </div>

  <div class="form-group">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" />
  </div>

  <div class="form-group">
    <label for="mdp1">Mot de passe</label>
    <input type="password" name="mdp1" id="mdp1" />
  </div>

  <div class="form-group">
    <label for="mdp2">Confirmer mot de passe</label>
    <input type="password" name="mdp2" id="mdp2" />
  </div>

  <input type="submit" value="Valider" />

</form>