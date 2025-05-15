<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 600px; margin:auto;">
    <h2 class="w3-center">Actualitzar Dades de l'Usuari</h2>
    <form id="updateUserForm" class="w3-container w3-card-4 w3-light-grey w3-padding-large">
        <label>Nom</label>
        <input class="w3-input w3-border" type="text" name="nom_usuari" id="nom_usuari" required>

        <label>Correu electrònic</label>
        <input class="w3-input w3-border" type="email" name="email" id="email" required>

        <label>Contrasenya</label>
        <input class="w3-input w3-border" type="password" name="password" id="password" required minlength="4">

        <label>Repetir contrasenya</label>
        <input class="w3-input w3-border" type="password" name="password_confirm" id="password_confirm" required>

        <label>Edat</label>
        <input class="w3-input w3-border" type="number" name="edad" id="edad" required>

        <label>Telèfon</label>
        <input class="w3-input w3-border" type="text" name="telefon" id="telefon" required>

        <label>País</label>
        <input class="w3-input w3-border" type="text" name="pais" id="pais" required>

        <button class="w3-button w3-blue w3-block w3-margin-top" type="submit">Registrar-se</button>
    </form>
</div>

<script>
    document.getElementById('updateUserForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const token = localStorage.getItem('token');
        if (!token) {
            alert("No hi ha token. Has d'iniciar sessió.");
            return;
        }

        const nom_usuari = document.getElementById('nom_usuari').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirm = document.getElementById('password_confirm').value;
        const edad = document.getElementById('edad').value;
        const telefon = document.getElementById('telefon').value;
        const pais = document.getElementById('pais').value;

        fetch('/pacman/v1/update_user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify({
                    nom_usuari,
                    email,
                    password,
                    password_confirm,
                    edad,
                    telefon,
                    pais
                })
            })
            .then(data => {
                if (data.status === 200) {
                    alert('Usuari actualitzat correctament.');
                } else {
                    alert('Error en l\'actualització de l\'usuari.');
                }
            });
    });
</script>
<?= $this->endSection() ?>