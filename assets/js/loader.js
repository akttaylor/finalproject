document.addEventListener('DOMContentLoaded', () => {
    const loader = document.querySelector('.loader');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500); 
        }, 1000); 
    }
});
