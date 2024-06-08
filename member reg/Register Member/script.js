function validateRegisterForm() {
  var member_id = document.getElementById("member_id").value;
  var email = document.getElementById("email").value;
  var memberIdPattern = /^M\d{3}$/;
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!memberIdPattern.test(member_id)) {
    alert("Invalid Member ID format");
    return false;
  }

  if (!emailPattern.test(email)) {
    alert("Invalid email format");
    return false;
  }

  return true;
}
