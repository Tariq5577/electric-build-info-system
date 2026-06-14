/**
 * AJAX Helper Functions
 */

// Generic AJAX request
function ajaxRequest(url, method = 'GET', data = null) {
    return new Promise((resolve, reject) => {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            }
        };

        if (data && (method === 'POST' || method === 'PUT')) {
            options.body = JSON.stringify(data);
        }

        fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => resolve(data))
            .catch(error => reject(error));
    });
}

// Get buildings
function getBuildings() {
    return ajaxRequest('src/api/buildings.php');
}

// Get towers by building
function getTowersByBuilding(buildingId) {
    return ajaxRequest(`src/api/towers.php?building_id=${buildingId}`);
}

// Get flats by tower
function getFlatsByTower(towerId) {
    return ajaxRequest(`src/api/flats.php?tower_id=${towerId}`);
}

// Get consumption data
function getConsumption(flatId, month, year) {
    return ajaxRequest(`src/api/consumption.php?action=consumption&flat_id=${flatId}&month=${month}&year=${year}`);
}

// Get bill data
function getBill(flatId, month, year) {
    return ajaxRequest(`src/api/consumption.php?action=bill&flat_id=${flatId}&month=${month}&year=${year}`);
}

// Get tower consumption
function getTowerConsumption(towerId, month, year) {
    return ajaxRequest(`src/api/consumption.php?action=tower&tower_id=${towerId}&month=${month}&year=${year}`);
}

// Get building consumption
function getBuildingConsumption(buildingId, month, year) {
    return ajaxRequest(`src/api/consumption.php?action=building&building_id=${buildingId}&month=${month}&year=${year}`);
}

// Record reading
function recordReading(flatId, currentReading, month, year) {
    return ajaxRequest('src/api/consumption.php?action=record', 'POST', {
        flat_id: flatId,
        current_reading: currentReading,
        month: month,
        year: year
    });
}

// Add building
function addBuilding(name, address = '', phone = '') {
    return ajaxRequest('src/api/buildings.php', 'POST', {
        name: name,
        address: address,
        phone: phone
    });
}

// Update building
function updateBuilding(id, name, address = '', phone = '') {
    return ajaxRequest('src/api/buildings.php', 'PUT', {
        id: id,
        name: name,
        address: address,
        phone: phone
    });
}

// Delete building
function deleteBuilding(id) {
    return ajaxRequest('src/api/buildings.php', 'DELETE', { id: id });
}

// Add tower
function addTower(buildingId, name) {
    return ajaxRequest('src/api/towers.php', 'POST', {
        building_id: buildingId,
        name: name
    });
}

// Update tower
function updateTower(id, name) {
    return ajaxRequest('src/api/towers.php', 'PUT', {
        id: id,
        name: name
    });
}

// Delete tower
function deleteTower(id) {
    return ajaxRequest('src/api/towers.php', 'DELETE', { id: id });
}

// Add flat
function addFlat(towerId, flatNumber, ownerName = '') {
    return ajaxRequest('src/api/flats.php', 'POST', {
        tower_id: towerId,
        flat_number: flatNumber,
        owner_name: ownerName
    });
}

// Update flat
function updateFlat(id, flatNumber, ownerName = '') {
    return ajaxRequest('src/api/flats.php', 'PUT', {
        id: id,
        flat_number: flatNumber,
        owner_name: ownerName
    });
}

// Delete flat
function deleteFlat(id) {
    return ajaxRequest('src/api/flats.php', 'DELETE', { id: id });
}

// Handle AJAX errors
function handleAjaxError(error) {
    console.error('AJAX Error:', error);
    showNotification('An error occurred. Please try again.', 'error');
}

// Initialize AJAX with defaults
fetch.defaults = {
    timeout: 5000,
    retries: 1
};
