document.getElementById('accountType').addEventListener('change', function() {
    const accountTypes = document.querySelectorAll('.account-type');
    accountTypes.forEach(div => div.style.display = 'none');
    
    const selectedType = this.value;
    switch(selectedType) {
        case 'savings':
            document.getElementById('saving').style.display = 'block';
            break;
        case 'current':
            document.getElementById('current').style.display = 'block';
            break;
        case 'business':
            document.getElementById('business').style.display = 'block';
            break;
    }
});