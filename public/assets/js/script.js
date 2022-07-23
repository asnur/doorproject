const editUserAdmin = (id, username, password) => {
  $("#id").val(id);
  $("#username").val(username);
  $("#password").val(password);
};

const editGuestUser = (uid, username) => {
  $("#uid").val(uid);
  $("#username").val(username);
};

let table = $("#dataTableLog").DataTable({
  dom: "Bfrtip",
  buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
});

const filterLog = () => {
  table.column(2).search($("#access").val()).draw();
  table.column(3).search($("#date").val()).draw();
};
