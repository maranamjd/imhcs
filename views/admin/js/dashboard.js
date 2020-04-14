$(document).ready(function(){
  var common_disease = document.getElementById('common_disease').getContext('2d');
  var patients = document.getElementById('patients').getContext('2d');
  var checkups = document.getElementById('checkups').getContext('2d');
  var patient_age = document.getElementById('patient_age').getContext('2d');

  function set_common_disease(){
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          backgroundColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          data: [10, 20, 30]
        }],
        labels: [
          'Red',
          'Yellow',
          'Blue'
        ]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Common Disease'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        }
      }
    };
    window.common_disease = new Chart(common_disease, config);

  }

  function set_patients(){
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var config = {
			type: 'line',
			data: {
				labels: MONTHS,
				datasets: [{
					label: 'Number',
					backgroundColor: ['rgba(40, 167, 69, 0.2)'],
					borderColor: ['rgba(40, 167, 69, 0.2)'],
					data: [3,15,3,4,7,12,20,23,1,9,10,25],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Patients'
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
			}}
    window.patients = new Chart(patients, config);

  }




  function set_checkups(){
    var config = {
      type: 'bar',
      data: {
        datasets: [{
          backgroundColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)'
          ],
          data: [10, 20]
        }],
        labels: [
          'Male',
          'Female'
        ]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Patients'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        }
      }
    };
    window.patients = new Chart(checkups, config);

  }


  function set_patient_age(){
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          backgroundColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
          ],
          data: [10, 20, 8]
        }],
        labels: [
          '12 Below',
          'Teenagers',
          'Adults'
        ]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Patients'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        }
      }
    };
    window.patients = new Chart(patient_age, config);

  }


  set_common_disease();
  set_patients();
  set_checkups();
  set_patient_age();




  // scales: {
  //   xAxes: [{
  //     display: true,
  //     scaleLabel: {
  //       display: true,
  //       labelString: 'Month'
  //     }
  //   }],
  //   yAxes: [{
  //     display: true,
  //     scaleLabel: {
  //       display: true,
  //       labelString: 'Value'
  //     }
  //   }]
  // }


});
