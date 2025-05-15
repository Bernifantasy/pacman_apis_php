<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 900px; margin:auto;">
    <h2 class="w3-center">Rànquing de jugadors</h2>

    <div id="rankingBox" class="w3-card-4 w3-padding w3-white w3-margin-top">
        <div id="rankingContent" class="w3-responsive">
            <p class="w3-center">Carregant rànquing...</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/pacman/v1/get_top_users')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('rankingContent');

            if (data.status !== 'ok' || !data.jugadors || data.jugadors.length === 0) {
                container.innerHTML = '<p class="w3-center w3-text-red">No s\'han trobat jugadors.</p>';
                return;
            }

            let rows = data.jugadors.map(player => `
                <tr>
                    <td>${player.posicio}</td>
                    <td>${player.nom_usuari}</td>
                    <td>${player.partides}</td>
                    <td>${player.victories}</td>
                    <td>${player.derrotes}</td>
                    <td>${player.punts_totals}</td>
                </tr>
            `).join('');

            container.innerHTML = `
                <table class="w3-table-all w3-hoverable w3-striped">
                    <thead>
                        <tr class="w3-light-grey">
                            <th>#</th>
                            <th>Usuari</th>
                            <th>Partides</th>
                            <th>Victòries</th>
                            <th>Derrotes</th>
                            <th>Punts</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rows}
                    </tbody>
                </table>
            `;
        })
        .catch(err => {
            console.error(err);
            document.getElementById('rankingContent').innerHTML = '<p class="w3-center w3-text-red">Error carregant el rànquing.</p>';
        });
});
</script>
<?= $this->endSection() ?>
