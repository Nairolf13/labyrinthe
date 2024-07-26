document.addEventListener('keydown', function(event) {
    let direction;
    switch (event.key) {
        case 'ArrowUp':
            direction = 'up';
            break;
        case 'ArrowDown':
            direction = 'down';
            break;
        case 'ArrowLeft':
            direction = 'left';
            break;
        case 'ArrowRight':
            direction = 'right';
            break;
        default:
            return; 
    }

   
    let form = document.createElement('form');
    form.method = 'POST';

    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'direction';
    input.value = direction;

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
});
