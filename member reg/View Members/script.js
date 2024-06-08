document.addEventListener('DOMContentLoaded', function() {
    fetch('get_members.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('membersTableBody');
            data.forEach(member => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${member.id}</td>
                    <td>${member.firstname}</td>
                    <td>${member.lastname}</td>
                    <td>${member.birthday}</td>
                    <td>${member.email}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching member data:', error));
});
