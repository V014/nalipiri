document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `username=${username}&password=${password}`,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.role === 'admin') {
                window.location.href = 'admin-dashboard.html';
            } else {
                localStorage.setItem('customer_id', data.customer_id);
                window.location.href = 'customer-dashboard.html';
            }
        } else {
            document.getElementById('error-message').textContent = data.message;
        }
    });
});

// Customer Dashboard Logic
if (window.location.pathname.includes('customer-dashboard.html')) {
    const customerId = localStorage.getItem('customer_id');
    fetch(`php/customer-data.php?customer_id=${customerId}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#usage-table tbody');
            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.date}</td>
                    <td>${row.water_usage}</td>
                    <td>${row.electricity_usage}</td>
                `;
                tbody.appendChild(tr);
            });
        });
}

// Admin Dashboard Logic
if (window.location.pathname.includes('admin-dashboard.html')) {
    fetch('php/admin-data.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#admin-usage-table tbody');
            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.room_number}</td>
                    <td>${row.water_usage}</td>
                    <td>${row.electricity_usage}</td>
                    <td>${row.date}</td>
                `;
                tbody.appendChild(tr);
            });
        });
}
