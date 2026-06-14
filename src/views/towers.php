<div class="towers-container">
    <h2>🏗️ Towers Management</h2>
    
    <div class="section-toolbar">
        <button class="btn btn-success" onclick="showAddTowerForm()">+ Add Tower</button>
    </div>

    <div id="add-tower-form" class="form-container" style="display: none;">
        <h3>Add New Tower</h3>
        <form onsubmit="submitTowerForm(event)">
            <div class="form-group">
                <label for="tower-building">Building:</label>
                <select id="tower-building" required>
                    <option value="">Select Building</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tower-name">Tower Name:</label>
                <input type="text" id="tower-name" placeholder="Tower A" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="hideAddTowerForm()">Cancel</button>
            </div>
        </form>
    </div>

    <div id="towers-by-building" class="towers-section">
        <h3>Southern Park-2 Towers</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Tower Name</th>
                    <th>Flats</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="towers-table">
                <tr><td colspan="4" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadBuildings();
        loadTowers();
    });

    function loadBuildings() {
        fetch('src/api/buildings.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('tower-building');
                data.data.forEach(building => {
                    const option = document.createElement('option');
                    option.value = building.id;
                    option.textContent = building.name;
                    select.appendChild(option);
                });
            });
    }

    function loadTowers() {
        // Load towers for building 1 (Southern Park-2)
        fetch('src/api/towers.php?building_id=1')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('towers-table');
                tbody.innerHTML = '';
                if (data.data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center">No towers found</td></tr>';
                    return;
                }
                data.data.forEach(tower => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${tower.name}</td>
                        <td>45</td>
                        <td>${new Date(tower.created_at).toLocaleDateString()}</td>
                        <td>
                            <a href="index.php?page=flats&tower_id=${tower.id}" class="btn btn-small">View Flats</a>
                            <button class="btn btn-small btn-danger" onclick="deleteTower(${tower.id})">Delete</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                document.getElementById('towers-table').innerHTML = '<tr><td colspan="4" class="text-center text-error">Error loading towers</td></tr>';
            });
    }

    function showAddTowerForm() {
        document.getElementById('add-tower-form').style.display = 'block';
    }

    function hideAddTowerForm() {
        document.getElementById('add-tower-form').style.display = 'none';
    }

    function submitTowerForm(event) {
        event.preventDefault();
        const building_id = document.getElementById('tower-building').value;
        const name = document.getElementById('tower-name').value;

        fetch('src/api/towers.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({building_id, name})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Tower added successfully!');
                hideAddTowerForm();
                loadTowers();
                document.getElementById('tower-name').value = '';
            } else {
                alert('Error: ' + data.message);
            }
        });
    }

    function deleteTower(id) {
        if (confirm('Are you sure you want to delete this tower?')) {
            fetch('src/api/towers.php', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Tower deleted successfully!');
                    loadTowers();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }
    }
</script>
