<div class="dashboard-container">
    <h2>📊 Dashboard</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Buildings</h3>
            <p class="stat-number" id="building-count">-</p>
            <a href="index.php?page=buildings" class="btn btn-primary">Manage</a>
        </div>
        <div class="stat-card">
            <h3>Towers</h3>
            <p class="stat-number" id="tower-count">-</p>
            <a href="index.php?page=towers" class="btn btn-primary">Manage</a>
        </div>
        <div class="stat-card">
            <h3>Flats</h3>
            <p class="stat-number" id="flat-count">-</p>
            <a href="index.php?page=flats" class="btn btn-primary">Manage</a>
        </div>
        <div class="stat-card">
            <h3>Current Month</h3>
            <p class="stat-number" id="current-month">-</p>
            <a href="index.php?page=consumption" class="btn btn-primary">Track</a>
        </div>
    </div>

    <div class="dashboard-section">
        <h3>🏢 Southern Park-2 Overview</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Tower</th>
                    <th>Flats</th>
                    <th>Total Units</th>
                    <th>Average Bill</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tower-overview">
                <tr><td colspan="5" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>

    <div class="dashboard-section">
        <h3>💡 Recent Consumption Records</h3>
        <div id="recent-consumption" class="recent-list">
            Loading...
        </div>
    </div>
</div>

<script>
    // Load dashboard data
    document.addEventListener('DOMContentLoaded', function() {
        loadDashboardStats();
        loadTowerOverview();
        loadRecentConsumption();
    });

    function loadDashboardStats() {
        fetch('src/api/buildings.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('building-count').textContent = data.data.length;
            });
    }

    function loadTowerOverview() {
        // This would typically fetch from an API
        fetch('src/api/towers.php?building_id=1')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('tower-overview');
                tbody.innerHTML = '';
                data.data.forEach(tower => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${tower.name}</td>
                        <td>45</td>
                        <td>-</td>
                        <td>-</td>
                        <td><a href="#" class="btn btn-small">View</a></td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                document.getElementById('tower-overview').innerHTML = '<tr><td colspan="5" class="text-center text-error">Error loading data</td></tr>';
            });
    }

    function loadRecentConsumption() {
        const html = `
            <div class="consumption-item">
                <span>Tower A, Flat 101 - Ahmed Khan</span>
                <span class="badge">1,245 units</span>
            </div>
            <div class="consumption-item">
                <span>Tower B, Flat 201 - Najib Hassan</span>
                <span class="badge">1,089 units</span>
            </div>
            <div class="consumption-item">
                <span>Tower C, Flat 305 - Youssef Khalil</span>
                <span class="badge">1,456 units</span>
            </div>
        `;
        document.getElementById('recent-consumption').innerHTML = html;
    }
</script>
