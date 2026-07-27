var Gid = localStorage.getItem("guest_id");
if (!Gid) {
  var timestamp = Date.now();
  localStorage.setItem("guest_id", timestamp);
  Gid = timestamp;
}

$(document).ready(function () {
  var guestId = Gid;

  $.ajax({
    url: "/demo/guestId/" + guestId,
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Handle success response here
    },
    error: function (xhr, status, error) {
      // Handle error here
    },
  });
});
