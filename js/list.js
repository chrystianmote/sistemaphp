const cells = document.getElementsByTagName('td');
for (let cell of cells) {
    if(cell.innerHTML == ' - '){
        cell.style.textAlign  = 'center';
    }
}