function fillUserForm() {
    return fetch('http://localhost:5050/api/v1/users')
        .then(response => response.json())
        .then(users => {
            document.getElementById("users-table").innerHTML =
                users.map(user => `
                    <tr>
                    <td data-label="ID">${user.id}</td>
                    <td data-label="Name">${user.name}</td>
                    <td data-label="Email">${user.email}</td>
                    <td data-label="City">${user.city}</td>
                    <td><button  class="round-button" onclick="deleteUser(${user.id})"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>`).join('');

        });
}

function deleteUser(id) {
    fetch(`http://localhost:5050/api/v1/users/${id}`, {
        method: 'DELETE'
    }).then(() => {
        fillUserForm();
    });
}

window.onload = fillUserForm();