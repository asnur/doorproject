let url = window.location.href;

const editUserAdmin = (id, username, password) => {
  $("#id").val(id);
  $("#username").val(username);
  $("#password").val(password);
};

const editGuestUser = (uid, nama) => {
  $("#uid").val(uid);
  $("#nama").val(nama);
};

let table = $("#dataTableLog").DataTable({
  oLanguage: {
    sSearch: "Cari : ",
  },
  dom: "Bfrtip",
  buttons: ["excelHtml5", "pdfHtml5"],
  responsive: true,
  ordering: false,
  bInfo: true,
  columnDefs: [{ targets: 3, type: "date-eu" }],
});

let collect = []
let startDate, finalDate

$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var element = $('#dataTableLog tbody tr').eq(dataIndex)

    collect[dataIndex] = element.find('td').eq(3).attr('data-time') ?? collect[dataIndex]

    var min = new Date(startDate);
    var max = new Date(finalDate);
    var date = new Date(collect[dataIndex]);

    if (
        ( min === null && max === null ) ||
        ( min === null && date <= max ) ||
        ( min <= date   && max === null ) ||
        ( min <= date   && date <= max )
    ) {
        return true;
    }
    return false;
  }
);

$("#dates").daterangepicker({
  opens: 'left',
  autoUpdateInput: false,
  locale: {
    cancelLabel: 'Clear'
  },
  ranges: {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(2, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
 }
}, function (start, end, label) {
  startDate = start.format('YYYY-MM-DD')
  finalDate = end.format('YYYY-MM-DD')
});

$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
});

$('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
});

// Parse Date to Format Month Indonesia
const parseDate = (date) => {
  let dateParse = new Date(date);
  let month = dateParse.getMonth();

  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  let year = dateParse.getFullYear();
  let day = dateParse.getDate();
  if (monthNames[month] == undefined) {
    return "";
  } else {
    let dateIndo = day + " " + monthNames[month] + " " + year;
    return dateIndo;
  }
};

const filterLog = () => {
  table.column('').search('').draw();
  table.column(2).search($("#access").val()).draw();
  console.log(parseDate($("#date").val()), $("#access").val());
};

// const filterLog = () => {
//   table.column(2).search($("#access").val()).draw();
//   table
//     .column(3)
//     .search(parseDate($("#date").val()))
//     .draw();
//   console.log(parseDate($("#date").val()), $("#access").val());
// };

const editController = (name, type, keypad_password, delay, token) => {
  $("#name").val(name);
  $("#type").val(type);
  $("#keypad_password").val(keypad_password);
  $("#delay").val(delay);
  $("#token").val(token);
};

$("#access").select2({
  placeholder: "Pilih Akses",
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
      console.log("entries", data);
    },
  });
};

const delete_entries = () => {
  $.ajax({
    url: "/api/delete_entries",
    type: "POST",
    success: function () {
      console.log("entries deleted");
    },
  });
};

if (url.includes("guest_user")) {
  setInterval(() => {
    get_entries();
  }, 2000);
} else {
  delete_entries();
}

const confirm_delete = (elem, id) => {
  Swal.fire({
    title: "Apakah anda yakin ingin menghapus data ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#1CC789",
    cancelButtonColor: "#E33A29",
    confirmButtonText: "Iya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.isConfirmed) {
      $(`#${elem}-${id}`).submit();
    }
  });
};

const invalid_alert = (element, name) => {
  let length = element.value.length;
  console.log(length);
  if (length == 0) {
    element.setCustomValidity(`Kolom ${name} tidak boleh kosong`);
  } else if (length < 5) {
    element.setCustomValidity(`Kolom ${name} minimal 5 karakter`);
  } else {
    //reset
    element.setCustomValidity("");
  }
};
