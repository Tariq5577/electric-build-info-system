<div class="buildings-container">
    <h2>🏢 Buildings Management</h2>
    
    <div class="section-toolbar">
        <button class="btn btn-success" onclick="showAddBuildingForm()">+ Add Building</button>
    </div>

    <div id="add-building-form" class="form-container" style="display: none;">
        <h3>Add New Building</h3>
        <form onsubmit="submitBuildingForm(event)">
            <div class="form-group">
                <label for="building-name">Building Name:</label>
                <input type="text" id="building-name" required>
            </div>
            <div class="form-group">
                <label for="building-address">Address:</label>
                <input type="text" id="building-address">
            </div>
            <div class="form-group">
                <label for="building-phone">Phone:</label>
                <input type="tel" id="building-phone">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="hideAddBuildingForm()">Cancel</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="buildings-table">
            <tr><td colspan="6" class="text-center">Loading...</td></tr>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadBuildings();
    });

    function loadBuildings() {
        fetch('src/api/buildings.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('buildings-table');
                tbody.innerHTML = '';
                if (data.data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center">No buildings found</td></tr>';
                    return;
                }
                data.data.forEach(building => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${building.id}</td>
                        <td>${building.name}</td>
                        <td>${building.address || '-'}</td>
                        <td>${building.phone || '-'}</td>
                        <td>${new Date(building.created_at).toLocaleDateString()}</td>
                        <td>
                            <button class="btn btn-small" onclick="editBuilding(${building.id})">Edit</button>
                            <button class="btn btn-small btn-danger" onclick="deleteBuilding(${building.id})">Delete</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                document.getElementById('buildings-table').innerHTML = '<tr><td colspan="6" class="text-center text-error">Error loading buildings</td></tr>';
            });
    }

    function showAddBuildingForm() {
        document.getElementById('add-building-form').style.display = 'block';
    }

    function hideAddBuildingForm() {
        document.getElementById('add-building-form').style.display = 'none';
    }

    function submitBuildingForm(event) {
        event.preventDefault();
        const name = document.getElementById('building-name').value;
        const address = document.getElementById('building-address').value;
        const phone = document.getElementById('building-phone').value;

        fetch('src/api/buildings.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({name, address, phone})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Building added successfully!');
                hideAddBuildingForm();
                loadBuildings();
                document.getElementById('building-name').value = '';
                document.getElementById('building-address').value = '';
                document.getElementById('building-phone').value = '';
            } else {
                alert('Error: ' + data.message);
            }
        });
    }

    function editBuilding(id) {
        alert('Edit functionality coming soon for building ' + id);
    }

    function deleteBuilding(id) {
        if (confirm('Are you sure you want to delete this building?')) {
            fetch('src/api/buildings.php', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Building deleted successfully!');
                    loadBuildings();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }
    }
</script>
