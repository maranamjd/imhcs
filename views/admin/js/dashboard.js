$(document).ready(function(){
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var config = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'My First dataset',
        backgroundColor:
            'rgba(40, 167, 69, 0.2)',
        borderColor:
            'rgba(40, 167, 69, 0.2)',
        data: [
          1234,
          1234,
          1234,
          1234,
          1234,
          1234,
          1234
        ],
        fill: false,
      }, {
        label: 'My Second dataset',
        fill: false,
        backgroundColor:
            'rgba(0, 123, 255, 0.2)',
        borderColor:
            'rgba(0, 123, 255, 0.2)',
        data: [
          7346,
          7346,
          7346,
          7346,
          7346,
          7346,
          7346
        ],
      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Chart.js Line Chart'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value'
          }
        }]
      }
    }
  };

  window.onload = function() {
    var ctx = document.getElementById('graph').getContext('2d');
    window.myLine = new Chart(ctx, config);
  };

});
