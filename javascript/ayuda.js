document.addEventListener('DOMContentLoaded', function() {
    const helpButton = document.getElementById('help-button');
    const helpContent = document.getElementById('help-content');

    helpButton.addEventListener('click', function() {
        if (helpContent.style.display === 'block') {
            helpContent.style.display = 'none';
            helpContent.style.opacity = '0';
            helpContent.style.transform = 'translateY(20px)';
        } else {
            helpContent.style.display = 'block';
            helpContent.style.opacity = '1';
            helpContent.style.transform = 'translateY(0)';
        }
    });
});
