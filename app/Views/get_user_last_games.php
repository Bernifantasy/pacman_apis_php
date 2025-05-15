<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-padding-64" style="max-width: 700px; margin:auto;">
    <h2 class="w3-center">Les teves darreres partides</h2>

    <div id="gameList" class="w3-responsive w3-card-4 w3-padding-16">
        <table class="w3-table-all w3-hoverable">
            <thead>
                <tr class="w3-light-grey">
                    <th>Data</th>
                    <th>Resultat</th>
                    <th>Punts</th>
                    <th>Durada (s)</th>
                </tr>
            </thead>
            <tbody id="gamesTableBody">
                <tr><td colspan="4" class="w3-center">Carregant...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const tbody = document.getElementById('gamesTableBody');

    if (!token) {
        tbody.innerHTML = '<tr><td colspan="4" class="w3-center w3-text-red">Has d\'iniciar sessió per veure les teves partides.</td></tr>';
        return;
    }

    fetch('/pacman/v1/get_user_last_games', {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status !== 'ok' || !data.partides || data.partides.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="w3-center">No hi ha partides registrades.</td></tr>';
            return;
        }

        tbody.innerHTML = '';
        data.partides.forEach(p => {
            const row = `
                <tr>
                    <td>${p.data}</td>
                    <td>${p.guanyat}</td>
                    <td>${p.punts}</td>
                    <td>${p.durada}</td>
                </tr>`;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    })
});
</script>
<?= $this->endSection() ?>
