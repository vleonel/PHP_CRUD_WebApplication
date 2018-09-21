// Attaching event handlers to the buttons
$(document).ready(function(){
  // When dropdown changes
  // Call this method
  $("#donor").change(donorDropDownChange);
});

function donorDropDownChange(){
  // hard coding kyle's id
  // let kyleId = 6;
  let donorId = getUserId();
  // Built in jQuery method
  $.ajax({
    type: "GET",
    url: "selectuser.php",
    data: {
      id: donorId
    },
    success: function(data){
      let details = JSON.parse(data);
       $("#name").val(details["name"]);
       $("#email").val(details["email"]);
       $("#phone").val(details["phone"]);
       $("#id").val(details["id"]);
    }
  });
}

function getUserId(){
  let idNumber = $("#donor").val();
  let separator = idNumber.indexOf("-");
  idNumber = idNumber.substring(0, separator);
  let parseId = parseInt(idNumber);
  return parseId;
}
