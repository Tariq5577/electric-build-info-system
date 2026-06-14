<div class="consumption-container">
    <h2>⚡ Consumption & Billing</h2>
    
    <div class="section-toolbar">
        <button class="btn btn-success" onclick="showRecordReading()">+ Record Reading</button>
        <button class="btn btn-info" onclick="generateReport()">📊 Generate Report</button>
    </div>

    <div id="record-reading-form" class="form-container" style="display: none;">
        <h3>Record Meter Reading</h3>
        <form onsubmit="submitReading(event)">
            <div class="form-group">
                <label for="reading-flat">Flat:</label>
                <select id="reading-flat" required>
                    <option value="">Select Flat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reading-current">Current Reading:</label>
                <input type="number" id="reading-current" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="reading-month">Month:</label>
                <select id="reading-month" required>
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reading-year">Year:</label>
                <input type="number" id="reading-year" min="2020" max="2099" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Record</button>
                <button type="button" class="btn btn-secondary" onclick="hideRecordReading()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="consumption-section">
        <h3>📋 Billing Records</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Building</th>
                    <th>Tower</th>
                    <th>Flat</th>
                    <th>Owner</th>
                    <th>Month</th>
                    <th>Current Reading</th>
                    <th>Units</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="consumption-table">
                <tr><td colspan="9" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadFlats();
        loadConsumptionData();
        setCurrentMonth();
    });

    function setCurrentMonth() {
        const today = new Date();
        document.getElementById('reading-month').value = today.getMonth() + 1;
        document.getElementById('reading-year').value = today.getFullYear();
    }

    function loadFlats() {
        fetch('src/api/flats.php?tower_id=1')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('reading-flat');
                data.data.forEach(flat => {
                    const option = document.createElement('option');
                    option.value = flat.id;
                    option.textContent = `${flat.flat_number} - ${flat.owner_name}`;
                    select.appendChild(option);
                });
            });
    }

    function loadConsumptionData() {
        // Load sample consumption data
        const tbody = document.getElementById('consumption-table');
        const sampleData = [
            {building: 'Southern Park-2', tower: 'Tower A', flat: '101', owner: 'Ahmed Khan', month: 'June', reading: 1245, units: 150, rate: 0.12, amount: 18.00},
            {building: 'Southern Park-2', tower: 'Tower A', flat: '102', owner: 'Fatima Ali', month: 'June', reading: 1089, units: 125, rate: 0.12, amount: 15.00},
            {building: 'Southern Park-2', tower: 'Tower B', flat: '201', owner: 'Najib Hassan', month: 'June', reading: 1456, units: 180, rate: 0.12, amount: 21.60},
        ];
        tbody.innerHTML = '';
        sampleData.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.building}</td>
                <td>${row.tower}</td>
                <td>${row.flat}</td>
                <td>${row.owner}</td>
                <td>${row.month}</td>
                <td>${row.reading}</td>
                <td>${row.units}</td>
                <td>$${row.rate}</td>
                <td>$${row.amount.toFixed(2)}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    function showRecordReading() {
        document.getElementById('record-reading-form').style.display = 'block';
    }

    function hideRecordReading() {
        document.getElementById('record-reading-form').style.display = 'none';
    }

    function submitReading(event) {
        event.preventDefault();
        const flat_id = document.getElementById('reading-flat').value;
        const current_reading = document.getElementById('reading-current').value;
        const month = document.getElementById('reading-month').value;
        const year = document.getElementById('reading-year').value;

        fetch('src/api/consumption.php?action=record', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({flat_id, current_reading, month, year})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reading recorded successfully!');
                hideRecordReading();
                loadConsumptionData();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }

    function generateReport() {
        alert('Report generation coming soon!');
    }
</script>
