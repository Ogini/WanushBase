import 'bootstrap/scss/bootstrap.scss';
import '../Styles/main.scss';

$('body').addClass('test');

const getRandomInt = max => {
    return Math.floor(Math.random() * Math.floor(max));
};

let oldBackgroundColor = null;
let oldCellIndex = null;
window.setInterval(function() {
    const cells = $('td');
    if (oldBackgroundColor !== null && oldCellIndex !== null) {
        $(cells[oldCellIndex]).css('backgroundColor', oldBackgroundColor);
    }
    let cellIndex = getRandomInt(cells.length);
    while (cellIndex === oldCellIndex) {
        cellIndex = getRandomInt(cells.length);
    }
    oldBackgroundColor = $(cells[cellIndex]).css('backgroundColor');
    $(cells[cellIndex]).css('backgroundColor', 'rgb(' + getRandomInt(256) + ', ' + getRandomInt(256) + ', ' + getRandomInt(256));
    oldCellIndex = cellIndex;
}, 10000);
