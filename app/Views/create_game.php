<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 600px; margin:auto;">
    <h2 class="w3-center">Registrar Partida Nova</h2>

    <form id="addGameForm" class="w3-container w3-card-4 w3-light-grey w3-padding-large">
        <label>Data de la Partida</label>
        <input class="w3-input w3-border" type="date" id="data" required>

        <label>Resultat</label>
        <select class="w3-select w3-border" id="resultat" required>
            <option value="" disabled selected>Selecciona resultat</option>
            <option value="victòria">Victòria</option>
            <option value="derrota">Derrota</option>
            <option value="empat">Empat</option>
        </select>

        <label>Puntuació</label>
        <input class="w3-input w3-border" type="number" id="puntuacio" min="0" required>

        <label>Durada (segons)</label>
        <input class="w3-input w3-border" type="number" id="durada" min="0" required>

        <label>Dificultat</label>
        <select class="w3-select w3-border" id="dificultat" required>
            <option value="" disabled selected>Selecciona dificultat</option>
            <option value="fàcil">Fàcil</option>
            <option value="normal">Normal</option>
            <option value="difícil">Difícil</option>
        </select>

        <button class="w3-button w3-blue w3-margin-top w3-block" type="submit">Registrar Partida</button>
    </form>
</div>

<script>
document.getElementById('addGameForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const token = localStorage.getItem('token');
    if (!token) {
        alert("Has d'iniciar sessió abans de registrar una partida.");
        return;
    }

    const data = document.getElementById('data').value;
    const resultat = document.getElementById('resultat').value;
    const puntuacio = document.getElementById('puntuacio').value;
    const durada = document.getElementById('durada').value;
    const dificultat = document.getElementById('dificultat').value;

    fetch('/pacman/v1/create_game', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify({
            data,
            resultat,
            puntuacio,
            durada,
            dificultat
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'ok') {
            alert(data.message || 'Partida registrada correctament!');
            this.reset();
        } else {
            alert('Error: ' + (data.message || 'No s\'ha pogut registrar la partida'));
        }
    })
});
</script>
<?= $this->endSection() ?>
