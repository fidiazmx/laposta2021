$(document).ready(function () {
  // variable declaration
  var usersTable;
  var usersDataArray = [];
  // datatable initialization
  if ($("#users-list-datatable").length > 0) {
    usersTable = $("#users-list-datatable").DataTable({
      responsive: true,
      'columnDefs': [{
        "orderable": false,
        //"targets": [0, 8, 9]
        "oLanguage": {
		      "sSearch":         "Buscar:",
		      "oPaginate": {
		        "sFirst":       "Primero",
		        "sPrevious":    "Anterior",
		        "sNext":        "Siguiente",
		        "sLast":        "Último",
		      },
		      "sLengthMenu":    "Mostrar _MENU_ registros",
		      "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		      "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)"
		    }
      }]
    });
  };
  // on click selected users data from table(page named page-users-list)
  // to store into local storage to get rendered on second page named page-users-view
  
  // $(document).on("click", "#users-list-datatable tr", function () {
  //   $(this).find("td").each(function () {
  //     usersDataArray.push($(this).text().trim())
  //   })

  //   localStorage.setItem("usersId", usersDataArray[1]);
  //   localStorage.setItem("usersUsername", usersDataArray[2]);
  //   localStorage.setItem("usersName", usersDataArray[3]);
  //   localStorage.setItem("usersVerified", usersDataArray[5]);
  //   localStorage.setItem("usersRole", usersDataArray[6]);
  //   localStorage.setItem("usersStatus", usersDataArray[7]);
  // })
  // render stored local storage data on page named page-users-view
  // if (localStorage.usersId !== undefined) {
  //   $(".users-view-id").html(localStorage.getItem("usersId"));
  //   $(".users-view-username").html(localStorage.getItem("usersUsername"));
  //   $(".users-view-name").html(localStorage.getItem("usersName"));
  //   $(".users-view-verified").html(localStorage.getItem("usersVerified"));
  //   $(".users-view-role").html(localStorage.getItem("usersRole"));
  //   $(".users-view-status").html(localStorage.getItem("usersStatus"));
  //   // update badge color on status change
  //   if ($(".users-view-status").text() === "Banned") {
  //     $(".users-view-status").toggleClass("badge-light-success badge-light-danger")
  //   }
  //   // update badge color on status change
  //   if ($(".users-view-status").text() === "Close") {
  //     $(".users-view-status").toggleClass("badge-light-success badge-light-warning")
  //   }
  // }
  
});