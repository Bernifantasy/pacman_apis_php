<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding">
    <div class="w3-card-4 w3-white w3-padding-large w3-margin-auto " style="max-width:600px;">
        <h2 class="w3-center">Registrar-se</h2>

        <div id="msg" class="w3-panel w3-hide"></div>

        <form id="registerForm" class="w3-container">
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
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const nom_usuari = document.getElementById('nom_usuari').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirm = document.getElementById('password_confirm').value;
        const edad = document.getElementById('edad').value;
        const telefon = document.getElementById('telefon').value;
        const pais = document.getElementById('pais').value;

        fetch('/pacman/v1/create_user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
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
            .then(res => res.json())
            .then(data => {
                const msgBox = document.getElementById('msg');
                msgBox.className = 'w3-panel ' + (data.status === 200 ? 'w3-green' : 'w3-red');
                msgBox.classList.remove('w3-hide');
                msgBox.innerHTML = data.message || Object.values(data.messages || {}).join('<br>');
                if (data.status === 200) {
                    document.getElementById('registerForm').reset();
                }
            })
    });
</script>
<?= $this->endSection() ?>