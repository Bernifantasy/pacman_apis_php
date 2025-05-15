<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-content w3-padding-64" style="max-width:500px">
    <h2 class="w3-center">Inici de sessió</h2>

    <form id="loginForm" class="w3-container w3-card w3-padding w3-white">
        <label class="w3-text-blue"><b>Nom d’usuari o email</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" id="nom_usuari" required>

        <label class="w3-text-blue"><b>Contrasenya</b></label>
        <input class="w3-input w3-border w3-margin-bottom" type="password" id="password" required>

        <button class="w3-button w3-blue w3-block" type="submit">Entrar</button>
    </form>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const nom_usuari = document.getElementById('nom_usuari').value;
        const password = document.getElementById('password').value;

        fetch('http://localhost/pacman/v1/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nom_usuari,
                    password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    localStorage.setItem('token', data.token);
                    localStorage.setItem('logged', true);
                    alert('Login successful');
                    window.location.href = "/";
                } else {
                    alert(data.message || 'Error de login');
                }
            })
    });
</script>
<?= $this->endSection() ?>