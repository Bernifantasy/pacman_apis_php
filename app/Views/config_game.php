<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 600px; margin:auto;">
    <h2 class="w3-center">Configuració del Joc</h2>

    <form id="configGameForm" class="w3-container w3-card-4 w3-light-grey w3-padding-large">

        <label>Tema</label>
        <select class="w3-select w3-border" id="tema" required>
            <option value="" disabled selected>Selecciona un tema</option>
            <option value="fosc">Fosc</option>
            <option value="clar">Clar</option>
        </select>

        <label>Dificultat</label>
        <select class="w3-select w3-border" id="dificultat" required>
            <option value="" disabled selected>Selecciona dificultat</option>
            <option value="facil">Facil</option>
            <option value="normal">Normal</option>
            <option value="dificil">Dificil</option>
        </select>

        <label>Música</label>
        <select class="w3-select w3-border" id="musica" required>
            <option value="" disabled selected>Musica</option>
            <option value="on">Activada</option>
            <option value="off">Desactivada</option>
        </select>

        <button class="w3-button w3-green w3-margin-top w3-block" type="submit">Desar configuració</button>
    </form>
</div>

<script>
    document.getElementById('configGameForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const token = localStorage.getItem('token');
        if (!token) {
            alert("Has d'iniciar sessió abans de configurar el joc.");
            return;
        }

        const tema = document.getElementById('tema').value;
        const dificultat = document.getElementById('dificultat').value;
        const musica = document.getElementById('musica').value;

        const config = { tema, dificultat, musica };

        fetch('/pacman/v1/config_game', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify(config)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                alert(data.message || 'Configuració desada correctament');
            } else {
                alert('Error: ' + (data.message || 'No s\'ha pogut desar la configuració'));
            }
        })
    });
</script>
<?= $this->endSection() ?>
