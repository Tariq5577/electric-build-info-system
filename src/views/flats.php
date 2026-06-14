<div class="flats-container">
    <h2>🏠 Flats Management</h2>
    
    <div class="section-toolbar">
        <button class="btn btn-success" onclick="showAddFlatForm()">+ Add Flat</button>
        <button class="btn btn-info" onclick="showBulkImport()">📥 Bulk Import</button>
    </div>

    <div id="add-flat-form" class="form-container" style="display: none;">
        <h3>Add New Flat</h3>
        <form onsubmit="submitFlatForm(event)">
            <div class="form-group">
                <label for="flat-tower">Tower:</label>
                <select id="flat-tower" required>
                    <option value="">Select Tower</option>
                </select>
            </div>
            <div class="form-group">
                <label for="flat-number">Flat Number:</label>
                <input type="text" id="flat-number" placeholder="101" required>
            </div>
            <div class="form-group">
                <label for="flat-owner">Owner Name:</label>
                <input type="text" id="flat-owner" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="hideAddFlatForm()">Cancel</button>
            </div>
        </form>
    </div>

    <div id="flats-list" class="flats-section">
        <h3>Tower A Flats (1-45)</h3>
        <div id="flats-grid" class="flats-grid">
            Loading...
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const towerId = urlParams.get('tower_id') || 1;

    document.addEventListener('DOMContentLoaded', function() {
        loadTowers();
        loadFlats();
    });

    function loadTowers() {
        fetch('src/api/towers.php?building_id=1')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('flat-tower');
                data.data.forEach(tower => {
                    const option = document.createElement('option');
                    option.value = tower.id;
                    option.textContent = tower.name;
                    select.appendChild(option);
                });
            });
    }

    function loadFlats() {
        fetch(`src/api/flats.php?tower_id=${towerId}`)
            .then(response => response.json())
            .then(data => {
                const grid = document.getElementById('flats-grid');
                grid.innerHTML = '';
                if (data.data.length === 0) {
                    grid.innerHTML = '<p class="text-center">No flats found</p>';
                    return;
                }
                data.data.forEach(flat => {
                    const card = document.createElement('div');
                    card.className = 'flat-card';
                    card.innerHTML = `
                        <div class="flat-card-header">
                            <strong>Flat ${flat.flat_number}</strong>
                        </div>
                        <div class="flat-card-body">
                            <p><strong>Owner:</strong> ${flat.owner_name}</p>
                            <div class="flat-actions">
                                <a href="index.php?page=consumption&flat_id=${flat.id}" class="btn btn-small">View Bills</a>
                                <button class="btn btn-small btn-danger" onclick="deleteFlat(${flat.id})">Delete</button>
                            </div>
                        </div>
                    `;
                    grid.appendChild(card);
                });
            })
            .catch(error => {
                document.getElementById('flats-grid').innerHTML = '<p class="text-center text-error">Error loading flats</p>';
            });
    }

    function showAddFlatForm() {
        document.getElementById('add-flat-form').style.display = 'block';
    }

    function hideAddFlatForm() {
        document.getElementById('add-flat-form').style.display = 'none';
    }

    function showBulkImport() {
        alert('Bulk import functionality coming soon!');
    }

    function submitFlatForm(event) {
        event.preventDefault();
        const tower_id = document.getElementById('flat-tower').value;
        const flat_number = document.getElementById('flat-number').value;
        const owner_name = document.getElementById('flat-owner').value;

        fetch('src/api/flats.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({tower_id, flat_number, owner_name})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Flat added successfully!');
                hideAddFlatForm();
                loadFlats();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }

    function deleteFlat(id) {
        if (confirm('Are you sure you want to delete this flat?')) {
            fetch('src/api/flats.php', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Flat deleted successfully!');
                    loadFlats();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }
    }
</script>
