$(document).ready(function () {
  $("#previous-services-link").on("click", function (e) {
    e.preventDefault();
    $("#pev-ser-content").show();
    $("#ref-content").hide();
    $("#cashback-content").hide();
    $("#profile-content").hide();
  });

  $("#referrals-link").on("click", function (e) {
    e.preventDefault();
    $("#pev-ser-content").hide();
    $("#ref-content").show();
    $("#cashback-content").hide();
    $("#profile-content").hide();
  });

  $("#cashback-link").on("click", function (e) {
    e.preventDefault();
    $("#pev-ser-content").hide();
    $("#ref-content").hide();
    $("#cashback-content").show();
    $("#profile-content").hide();
  });

  $("#profile-link").on("click", function (e) {
    e.preventDefault();
    $("#pev-ser-content").hide();
    $("#ref-content").hide();
    $("#cashback-content").hide();
    $("#profile-content").show();
  });

  $("#copy-button").on("click", function () {
    var copyText = document.getElementById("referral-link");
    copyText.select();
    document.execCommand("copy");
    alert("Referral link copied to clipboard!");
  });

  $("#facebook-share").on("click", function () {
    var link = document.getElementById("referral-link").value;
    window.open(
      "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(link),
      "_blank"
    );
  });

  $("#whatsapp-share").on("click", function () {
    var link = document.getElementById("referral-link").value;
    window.open(
      "https://api.whatsapp.com/send?text=" + encodeURIComponent(link),
      "_blank"
    );
  });

  // Edit and Save button functionality
  $("#edit-info").on("click", function () {
    var isReadOnly = $("input").prop("readonly");
    if (isReadOnly) {
      $("input").prop("readonly", false); // Enable input fields
      $(this).text("Save"); // Change button text to "Save"
    } else {
      $("input").prop("readonly", true); // Disable input fields
      $(this).text("Edit"); // Change button text to "Edit"
      // Add your save functionality here, if needed
      alert("Profile information saved!"); // Example save action
    }
  });
});
