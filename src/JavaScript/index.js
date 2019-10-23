import React from 'react';
import ReactDom from 'react-dom';
import App from './App/App';
import App2 from './App2/App2';
import 'bootstrap/scss/bootstrap.scss';
import '../Styles/main.scss';

window.onload = () => {
    ReactDom.render(
        <App
            header="Dancing Mike"
            title="I'm having fun!"
            body="Swinging around makes me happy."
            image="/static/Dancing-Mike.png"
            button="Turn Around"
        />,
        document.getElementById('app')
    );

    ReactDom.render(
        <App2/>,
        document.getElementById('app2')
    );

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
    }, 2000);
};

