<form action="../src/processing/processing.php?login" method="POST">

  <div class="form-group">
    <label for="uuid">Nom d'utilisateur ou adresse email</label>
    <input type="text" id="uuid" name="uuid" required />
  </div>

  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp" required />
  </div>

  <input type="submit" value="Valider" />

  <p>Mot de passe oublié ? <a href="#">Réinitialiser</a></p>
</form>