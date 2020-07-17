// Imports
import Chart from 'chart.js';
import $ from 'jquery';
import Moment from 'moment';

$(document).ready(function() {
    // Dynamic endpoint
    var url = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port + '/' + 'api' + window.location.pathname;

    // 
    getViews(url);

    // Setup chart.js
    var ctx = $('#viewsPerMonth');
    
    // Instancing new Chart
    var viewsPerMonth = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Novembre', 'Dicembre'],
            datasets: [
                {
                    data: [50, 200, 12, 1, 500, 680, 700, 81, 90, 101, 11, 12],
                    label: 'Visite/mese',
                    borderColor: '#ffdd01',
                    backgroundColor: 'rgba(0, 0, 0, .03'
                }
            ]
        },
        options: {
            showLines: true
        }
    });
});

function getViews(url) {
    fetch(url)
        .then( res => {
            return res.json();
        })
        .then( data => {
               var viewsArray = data.response.views;
               var timeStamps = [];

               viewsArray.forEach( e => {
                   timeStamps.push(e.created_at);
               });

               console.log(timeStamps);
            }
        );
}

function totalViews(data) {
    let totalViews = data.response[0].views.length;
    
    return totalViews;
}