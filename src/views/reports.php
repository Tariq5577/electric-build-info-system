<div class="reports-container">
    <h2>📊 Reports & Analytics</h2>
    
    <div class="reports-options">
        <div class="report-card">
            <h3>Per-Flat Bills</h3>
            <p>Generate individual bills for each flat</p>
            <button class="btn btn-primary" onclick="generatePerFlatBills()">Generate</button>
        </div>
        <div class="report-card">
            <h3>Tower Summary</h3>
            <p>Get consumption and billing for entire tower</p>
            <button class="btn btn-primary" onclick="generateTowerReport()">Generate</button>
        </div>
        <div class="report-card">
            <h3>Building Report</h3>
            <p>Complete building billing and statistics</p>
            <button class="btn btn-primary" onclick="generateBuildingReport()">Generate</button>
        </div>
        <div class="report-card">
            <h3>Monthly Statement</h3>
            <p>Month-wise consumption analysis</p>
            <button class="btn btn-primary" onclick="generateMonthlyStatement()">Generate</button>
        </div>
    </div>

    <div id="report-output" class="report-output" style="display: none;">
        <div class="report-header">
            <h3 id="report-title">Report</h3>
            <div class="report-actions">
                <button class="btn btn-success" onclick="printReport()">🖨️ Print</button>
                <button class="btn btn-info" onclick="exportPDF()">📥 PDF</button>
                <button class="btn btn-secondary" onclick="closeReport()">Close</button>
            </div>
        </div>
        <div id="report-content" class="report-content"></div>
    </div>
</div>

<script>
    function generatePerFlatBills() {
        showReport('Per-Flat Bills Report', `
            <table class="table">
                <thead>
                    <tr>
                        <th>Tower</th>
                        <th>Flat</th>
                        <th>Owner</th>
                        <th>Current Reading</th>
                        <th>Previous Reading</th>
                        <th>Units Used</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="8" class="text-center">Loading bill data...</td></tr>
                </tbody>
            </table>
        `);
    }

    function generateTowerReport() {
        showReport('Tower Summary Report', `
            <div class="report-section">
                <h4>Tower A Summary</h4>
                <p><strong>Total Flats:</strong> 45</p>
                <p><strong>Total Units (June):</strong> 6,750 units</p>
                <p><strong>Total Revenue:</strong> $810.00</p>
                <p><strong>Average per Flat:</strong> $18.00</p>
            </div>
        `);
    }

    function generateBuildingReport() {
        showReport('Building Report - Southern Park-2', `
            <div class="report-section">
                <h4>Building Summary</h4>
                <p><strong>Building Name:</strong> Southern Park-2</p>
                <p><strong>Total Towers:</strong> 3</p>
                <p><strong>Total Flats:</strong> 135</p>
                <p><strong>Total Units (June):</strong> 20,250 units</p>
                <p><strong>Total Revenue:</strong> $2,430.00</p>
            </div>
            <div class="report-section">
                <h4>Tower-wise Breakdown</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tower</th>
                            <th>Flats</th>
                            <th>Units</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Tower A</td><td>45</td><td>6,750</td><td>$810.00</td></tr>
                        <tr><td>Tower B</td><td>45</td><td>6,750</td><td>$810.00</td></tr>
                        <tr><td>Tower C</td><td>45</td><td>6,750</td><td>$810.00</td></tr>
                    </tbody>
                </table>
            </div>
        `);
    }

    function generateMonthlyStatement() {
        showReport('Monthly Statement', `
            <div class="report-section">
                <h4>June 2026 Statement</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Units</th>
                            <th>Rate</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>April 2026</td><td>19,800</td><td>$0.12</td><td>$2,376.00</td></tr>
                        <tr><td>May 2026</td><td>20,100</td><td>$0.12</td><td>$2,412.00</td></tr>
                        <tr><td>June 2026</td><td>20,250</td><td>$0.12</td><td>$2,430.00</td></tr>
                    </tbody>
                </table>
            </div>
        `);
    }

    function showReport(title, content) {
        document.getElementById('report-title').textContent = title;
        document.getElementById('report-content').innerHTML = content;
        document.getElementById('report-output').style.display = 'block';
    }

    function closeReport() {
        document.getElementById('report-output').style.display = 'none';
    }

    function printReport() {
        window.print();
    }

    function exportPDF() {
        alert('PDF export coming soon!');
    }
</script>
