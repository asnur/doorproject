// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "oLanguage": {
      "sSearch": "Cari : "
    },
    responsive: true,
  });
});
