<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 700px; margin:auto;">
    <h2 class="w3-center">Estadístiques de les teves partides</h2>

    <div id="statsBox" class="w3-card-4 w3-padding w3-margin-top w3-white">
        
        <div id="statsContent" class="w3-padding">
            <p class="w3-center">Carregant estadístiques...</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');
    const statsContent = document.getElementById('statsContent');

    if (!token) {
        statsContent.innerHTML = '<p class="w3-center w3-text-red">Has d\'iniciar sessió per veure les estadístiques.</p>';
        return;
    }

    fetch('/pacman/v1/get_user_stats', {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status !== 'ok') {
            statsContent.innerHTML = '<p class="w3-center w3-text-red">No s\'han pogut carregar les estadístiques.</p>';
            return;
        }

        const html = `
            <table class="w3-table-all w3-hoverable">
                <tr><th>Total de partides</th><td>${data.total}</td></tr>
                <tr><th>Partides guanyades</th><td>${data.guanyades}</td></tr>
                <tr><th>Partides perdudes</th><td>${data.perdudes}</td></tr>
                <tr><th>% de victòries</th><td>${data.percentatge_victories.toFixed(2)}%</td></tr>
                <tr><th>Mitjana de punts</th><td>${data.mitjana_punts.toFixed(2)}</td></tr>
                <tr><th>Mitjana de durada</th><td>${data.mitjana_durada.toFixed(2)} s</td></tr>
            </table>
        `;

        statsContent.innerHTML = html;
    })
});
</script>
<?= $this->endSection() ?>
