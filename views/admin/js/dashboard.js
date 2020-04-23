$(document).ready(function(){
  var common_disease = document.getElementById('common_disease').getContext('2d');
  var patients = document.getElementById('patients').getContext('2d');
  var checkups = document.getElementById('checkups').getContext('2d');
  var patient_age = document.getElementById('patient_age').getContext('2d');

  function set_common_disease(diseases){
    var labels = Object.keys(diseases).map(key => {return key});
    var data = Object.values(diseases).map(value => {return value});
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          backgroundColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          borderColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          data: data
        }],
        labels: labels
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

  function set_patients(number_patients){
    var data = Object.values(number_patients).map(number => {return number});
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var config = {
			type: 'line',
			data: {
				labels: MONTHS,
				datasets: [{
					label: 'Number Of Patients Monthly',
					backgroundColor: ['rgba(40, 167, 69, 0.2)'],
					borderColor: ['rgba(40, 167, 69, 0.2)'],
					data: data,
					fill: true,
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
							labelString: 'Number'
						}
					}]
				}
			}}
    window.patients = new Chart(patients, config);

  }




  function set_checkups(checkup_gender){
    var labels = Object.keys(checkup_gender).map(keys => {return keys});
    var data = Object.values(checkup_gender).map(values => {return values});
    var config = {
      type: 'pie',
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
          data: data
        }],
        labels: labels
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


  function set_patient_age(patient_ages){
    var labels = Object.keys(patient_ages).map(keys => {return keys});
    var data = Object.values(patient_ages).map(values => {return values});
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          backgroundColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          borderColor: [
            'rgba(40, 167, 69, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          data: data
        }],
        labels: labels
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



  $.ajax({
    url: url+"admin/chart",
    method: 'post',
    dataType: 'json',
    data: {key: true},
    success: function(data){
      set_common_disease(data['diseases']);
      set_patients(data['number_patients']);
      set_checkups(data['gender']);
      set_patient_age(data['ages']);
    }
  });





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
