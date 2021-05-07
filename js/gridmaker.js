$(document).ready(function() {
  // Enable the colorpicker
  $(".colorpicker-component").colorpicker({
    "component" : ".input-group-text"
  });

  $("#colTotal").on("input", function() {
    $("#refColTotal").text($(this).val() || "0");
  });

  $("#btn_submit").click(function(evt) {
    evt.preventDefault();

    var form = $("#gridmaker-form");

    $.ajax({
      data: form.serialize(),
      type: form.attr("method"),
      url: form.attr("action"),
      dataType: "text",
      success: function(response) {
        $("#svg-preview").removeClass("d-none").html(response);

        // Scroll to bottom.
        window.scrollTo(0, document.body.scrollHeight);
      }
    });
  });
});
