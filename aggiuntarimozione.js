document.addEventListener('DOMContentLoaded', (event) => {
    const preferitiButtons = document.querySelectorAll('.preferiti');
    
    preferitiButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const prodottoId = this.getAttribute('data-id');

            fetch(`aggiungiPreferiti.php?id=${prodottoId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    });
});