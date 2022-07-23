let url = window.location.href;

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

const editController = (name, type, keypad_password, delay, token) => {
  $("#name").val(name);
  $("#type").val(type);
  $("#keypad_password").val(keypad_password);
  $("#delay").val(delay);
  $("#token").val(token);
};

$("#access").select2({
  placeholder: "Select Access",
  width: "100%",
});

const access_user = (uid, username, access) => {
  let list_access = JSON.parse(atob(access));
  $("#access").val(list_access).trigger("change");
  $("#uid").val(uid);
  $("#username").val(username);
};

const get_entries = () => {
  $.ajax({
    url: "/admin/management/get_entries",
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      $("#uid_user").val(data);
    },
  });
};

if (url.includes("guest_user")) {
  setInterval(() => {
    get_entries();
  }, 2000);
}
