function confirmDelete() {
    var memberId = document.getElementById('memberId').value;
    if (memberId === "") {
        alert("Please enter a Member ID.");
        return false;
    }
    return confirm("Delete relevant member?");
}
