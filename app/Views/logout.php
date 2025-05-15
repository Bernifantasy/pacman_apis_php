<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>
<div class="w3-container w3-content w3-padding-64" style="max-width: 500px;">
    <h2 class="w3-center">Tancar Sessió</h2>
    <button id="logoutBtn" class="w3-button w3-red w3-block">Logout</button>
</div>

<script>
    document.getElementById('logoutBtn').addEventListener('click', async () => {
        const token = localStorage.getItem('token');
        if (!token) {
            alert('No hi ha token guardat.');
            return;
        }

        fetch('/pacman/v1/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(data => {
                if (data.status === 200) {
                    alert('Sessió tancada correctament.');
                    localStorage.removeItem('token');
                    localStorage.removeItem('logged');
                    window.location.href = '/';
                } else {
                    alert('Error en tancar sessió.');
                }
            });


    });
</script>
<?= $this->endSection() ?>