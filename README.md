# Electric Build Information System

## Overview
A comprehensive electrical consumption tracking and billing system for multi-building, multi-tower, and multi-flat properties.

## Features

### 🏢 Building Management
- Add and manage multiple buildings
- Track building names and information
- Support for pre-loaded buildings (e.g., Southern Park-2)

### 🏗️ Tower Management
- Organize buildings into towers (Tower 1, Tower 2, Tower 3, etc.)
- Flexible tower configuration per building
- Tower-wise consumption tracking

### 🏠 Flat Management
- Add flats under each tower
- Store flat owner names
- Manage flat units per tower
- Support for 45+ flats per tower

### 💡 Consumption Tracking
- Record monthly meter readings for each flat
- Track current and previous month readings
- Automatic unit consumption calculation
- Configurable electricity rates

### 📊 Billing Reports
- Generate detailed bills per flat
- Calculate: (Current - Previous) × Unit Price
- Tower-wise billing summaries
- Building-wide reports
- Print-friendly format (4 flats per page)

### 📋 Admin Dashboard
- Building overview
- Tower summary
- Flat management interface
- Real-time data visualization

### 🔍 Audit Trail
- Log all changes (creation, updates, deletions)
- Track user actions
- Timestamp all transactions

### ⚡ Technical Features
- AJAX for real-time data processing
- RESTful API endpoints
- Database-backed storage
- User-friendly UI

## Project Structure

```
electric-build-info-system/
├── public/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── main.js
│       └── ajax.js
├── src/
│   ├── config/
│   │   └── database.php
│   ├── models/
│   │   ├── Building.php
│   │   ├── Tower.php
│   │   ├── Flat.php
│   │   └── Consumption.php
│   ├── controllers/
│   │   ├── BuildingController.php
│   │   ├── TowerController.php
│   │   ├── FlatController.php
│   │   └── ConsumptionController.php
│   ├── views/
│   │   ├── dashboard.php
│   │   ├── buildings/
│   │   ├── towers/
│   │   ├── flats/
│   │   ├── consumption/
│   │   └── reports/
│   ├── api/
│   │   ├── buildings.php
│   │   ├── towers.php
│   │   ├── flats.php
│   │   └── consumption.php
│   └── utils/
│       ├── Logger.php
│       ├── Validator.php
│       └── Calculator.php
├── database/
│   ├── schema.sql
│   └── seed-data.sql
├── docs/
│   ├── API.md
│   ├── DATABASE.md
│   └── INSTALLATION.md
├── index.php
└── composer.json
```

## Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/Tariq5577/electric-build-info-system.git
   cd electric-build-info-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup database**
   ```bash
   mysql -u root -p < database/schema.sql
   mysql -u root -p < database/seed-data.sql
   ```

4. **Configure settings**
   - Edit `src/config/database.php` with your database credentials
   - Update building and tower configurations

5. **Start the application**
   ```bash
   php -S localhost:8000
   ```

6. **Access the dashboard**
   - Open http://localhost:8000 in your browser
   - Default credentials: admin/admin

## Default Pre-loaded Data

### Building: Southern Park-2
- **Towers:** 3 (Tower A, Tower B, Tower C)
- **Flats per Tower:** 45
- **Total Flats:** 135
- **Unit Rate:** $0.12 per unit (configurable)

## API Endpoints

### Buildings
- `GET /api/buildings.php` - List all buildings
- `POST /api/buildings.php` - Create building
- `PUT /api/buildings.php` - Update building
- `DELETE /api/buildings.php` - Delete building

### Towers
- `GET /api/towers.php?building_id=1` - List towers
- `POST /api/towers.php` - Create tower
- `PUT /api/towers.php` - Update tower
- `DELETE /api/towers.php` - Delete tower

### Flats
- `GET /api/flats.php?tower_id=1` - List flats
- `POST /api/flats.php` - Create flat
- `PUT /api/flats.php` - Update flat
- `DELETE /api/flats.php` - Delete flat

### Consumption
- `POST /api/consumption.php` - Record reading
- `GET /api/consumption.php?flat_id=1` - Get consumption history
- `POST /api/consumption.php?action=bill` - Calculate bill

## Reports

### Available Reports
1. **Per-Flat Bill** - Individual flat consumption and charges
2. **Tower Summary** - All flats in a tower
3. **Building Report** - Complete building billing
4. **Monthly Statement** - Month-wise analysis

### Export Options
- PDF (print-friendly, 4 flats per page)
- Excel (detailed data)
- CSV (raw data)

## Technologies Used
- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **API:** RESTful JSON
- **Utilities:** AJAX, Composer

## License
MIT License

## Support
For issues and feature requests, please create an issue on GitHub.
