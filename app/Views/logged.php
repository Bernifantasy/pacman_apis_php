<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-content w3-padding-64" style="max-width: 500px;">
    <h2 class="w3-center">Comprovar Sessió</h2>
    <button id="checkSessionBtn" class="w3-button w3-blue w3-block">Comprovar si estic connectat</button>
</div>
<script>
    document.getElementById('checkSessionBtn').addEventListener('click', async () => {
        const token = localStorage.getItem('token');
        if (!token) {
            alert('No hi ha token guardat, no estàs connectat.');
            return;
        }

        fetch('http://localhost/pacman/v1/logged', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                }

            })
            .then(data => {
                if (data.status === 200) {
                    alert('Sessió activa.');
                } else {
                    alert('Sessió no vàlida o expirada.');
                }
            });

    });
</script>
<?= $this->endSection() ?>