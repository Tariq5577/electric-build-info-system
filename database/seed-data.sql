-- Seed Data for Electric Build Information System
-- Pre-loaded: Southern Park-2 Building with 3 Towers and 45 Flats each

INSERT INTO buildings (name, address, phone) VALUES 
('Southern Park-2', '123 Southern Avenue, City Center', '+1-800-ELECTRIC');

-- Get the building ID
SET @building_id = LAST_INSERT_ID();

-- Insert Towers
INSERT INTO towers (building_id, name) VALUES 
(@building_id, 'Tower A'),
(@building_id, 'Tower B'),
(@building_id, 'Tower C');

-- Get Tower IDs
SET @tower_a = (SELECT id FROM towers WHERE building_id = @building_id AND name = 'Tower A');
SET @tower_b = (SELECT id FROM towers WHERE building_id = @building_id AND name = 'Tower B');
SET @tower_c = (SELECT id FROM towers WHERE building_id = @building_id AND name = 'Tower C');

-- Insert Flats for Tower A (1-45)
INSERT INTO flats (tower_id, flat_number, owner_name) VALUES 
(@tower_a, '101', 'Ahmed Khan'),
(@tower_a, '102', 'Fatima Ali'),
(@tower_a, '103', 'Hassan Mohammed'),
(@tower_a, '104', 'Layla Ibrahim'),
(@tower_a, '105', 'Omar Hassan'),
(@tower_a, '106', 'Noor Abdullah'),
(@tower_a, '107', 'Karim Ahmed'),
(@tower_a, '108', 'Amira Khalil'),
(@tower_a, '109', 'Ali Mansour'),
(@tower_a, '110', 'Hana Rashid'),
(@tower_a, '201', 'Samir Hassan'),
(@tower_a, '202', 'Dina Saleh'),
(@tower_a, '203', 'Walid Aziz'),
(@tower_a, '204', 'Sara Mohsen'),
(@tower_a, '205', 'Tariq Khalil'),
(@tower_a, '206', 'Leila Fahmy'),
(@tower_a, '207', 'Fadi Nassar'),
(@tower_a, '208', 'Maya Barakat'),
(@tower_a, '209', 'Youssef Salem'),
(@tower_a, '210', 'Rania Nabil'),
(@tower_a, '301', 'Mustafa Karim'),
(@tower_a, '302', 'Zainab Ahmed'),
(@tower_a, '303', 'Ibrahim Rashid'),
(@tower_a, '304', 'Aisha Fatima'),
(@tower_a, '305', 'Khaled Aziz'),
(@tower_a, '306', 'Mona Hassan'),
(@tower_a, '307', 'Adel Saleh'),
(@tower_a, '308', 'Yasmin Ali'),
(@tower_a, '309', 'Rashid Khan'),
(@tower_a, '310', 'Nadia Ibrahim'),
(@tower_a, '401', 'Sami Mohammed'),
(@tower_a, '402', 'Hiba Karim'),
(@tower_a, '403', 'Jamal Abdullah'),
(@tower_a, '404', 'Salma Rashid'),
(@tower_a, '405', 'Majed Aziz'),
(@tower_a, '406', 'Reem Hassan'),
(@tower_a, '407', 'Bassam Nabil'),
(@tower_a, '408', 'Dalia Fahmy'),
(@tower_a, '409', 'Wael Barakat'),
(@tower_a, '410', 'Rana Salem'),
(@tower_a, '501', 'Nizar Ahmed'),
(@tower_a, '502', 'Laila Khalil'),
(@tower_a, '503', 'Saad Hassan'),
(@tower_a, '504', 'Farah Mohsen'),
(@tower_a, '505', 'Karim Nassar');

-- Insert Flats for Tower B (1-45)
INSERT INTO flats (tower_id, flat_number, owner_name) VALUES 
(@tower_b, '101', 'Hamza Ali'),
(@tower_b, '102', 'Noor Karim'),
(@tower_b, '103', 'Samir Abdullah'),
(@tower_b, '104', 'Maryam Hassan'),
(@tower_b, '105', 'Faisal Ahmed'),
(@tower_b, '106', 'Zeina Rashid'),
(@tower_b, '107', 'Adnan Khan'),
(@tower_b, '108', 'Sana Aziz'),
(@tower_b, '109', 'Imran Saleh'),
(@tower_b, '110', 'Huda Mohammed'),
(@tower_b, '201', 'Najib Hassan'),
(@tower_b, '202', 'Lina Ibrahim'),
(@tower_b, '203', 'Ramzi Ahmed'),
(@tower_b, '204', 'Mariam Khalil'),
(@tower_b, '205', 'Jamal Barakat'),
(@tower_b, '206', 'Yasmin Salem'),
(@tower_b, '207', 'Anwar Ali'),
(@tower_b, '208', 'Dana Fahmy'),
(@tower_b, '209', 'Bashir Nabil'),
(@tower_b, '210', 'Ola Nassar'),
(@tower_b, '301', 'Tariq Hassan'),
(@tower_b, '302', 'Rima Rashid'),
(@tower_b, '303', 'Salim Aziz'),
(@tower_b, '304', 'Amira Khalil'),
(@tower_b, '305', 'Walid Ahmed'),
(@tower_b, '306', 'Hana Abdullah'),
(@tower_b, '307', 'Karim Hassan'),
(@tower_b, '308', 'Leila Mohammed'),
(@tower_b, '309', 'Fadi Ibrahim'),
(@tower_b, '310', 'Sara Khan'),
(@tower_b, '401', 'Youssef Aziz'),
(@tower_b, '402', 'Nadia Saleh'),
(@tower_b, '403', 'Adel Ahmed'),
(@tower_b, '404', 'Zainab Ali'),
(@tower_b, '405', 'Rashid Khalil'),
(@tower_b, '406', 'Aisha Hassan'),
(@tower_b, '407', 'Majed Barakat'),
(@tower_b, '408', 'Mona Salem'),
(@tower_b, '409', 'Sami Nassar'),
(@tower_b, '410', 'Rana Fahmy'),
(@tower_b, '501', 'Hamid Ahmed'),
(@tower_b, '502', 'Leila Khan'),
(@tower_b, '503', 'Hassan Aziz'),
(@tower_b, '504', 'Fatima Rashid'),
(@tower_b, '505', 'Khaled Abdullah');

-- Insert Flats for Tower C (1-45)
INSERT INTO flats (tower_id, flat_number, owner_name) VALUES 
(@tower_c, '101', 'Ibrahim Ali'),
(@tower_c, '102', 'Dina Hassan'),
(@tower_c, '103', 'Mohammed Ahmed'),
(@tower_c, '104', 'Hiba Rashid'),
(@tower_c, '105', 'Karim Khalil'),
(@tower_c, '106', 'Zainab Abdullah'),
(@tower_c, '107', 'Ali Aziz'),
(@tower_c, '108', 'Layla Saleh'),
(@tower_c, '109', 'Omar Khan'),
(@tower_c, '110', 'Noor Ahmed'),
(@tower_c, '201', 'Samir Hassan'),
(@tower_c, '202', 'Fatima Ibrahim'),
(@tower_c, '203', 'Jamal Mohammed'),
(@tower_c, '204', 'Maryam Khalil'),
(@tower_c, '205', 'Hassan Barakat'),
(@tower_c, '206', 'Sara Salem'),
(@tower_c, '207', 'Wael Nassar'),
(@tower_c, '208', 'Amira Fahmy'),
(@tower_c, '209', 'Rashid Nabil'),
(@tower_c, '210', 'Ola Ahmed'),
(@tower_c, '301', 'Fadi Hassan'),
(@tower_c, '302', 'Leila Rashid'),
(@tower_c, '303', 'Adel Aziz'),
(@tower_c, '304', 'Aisha Khan'),
(@tower_c, '305', 'Youssef Khalil'),
(@tower_c, '306', 'Hana Abdullah'),
(@tower_c, '307', 'Khaled Ahmed'),
(@tower_c, '308', 'Mariam Hassan'),
(@tower_c, '309', 'Tariq Ibrahim'),
(@tower_c, '310', 'Nadia Mohammed'),
(@tower_c, '401', 'Sami Barakat'),
(@tower_c, '402', 'Zainab Salem'),
(@tower_c, '403', 'Majed Nassar'),
(@tower_c, '404', 'Mona Fahmy'),
(@tower_c, '405', 'Hamza Nabil'),
(@tower_c, '406', 'Reem Ahmed'),
(@tower_c, '407', 'Bassam Hassan'),
(@tower_c, '408', 'Dalia Rashid'),
(@tower_c, '409', 'Imran Aziz'),
(@tower_c, '410', 'Rana Khan'),
(@tower_c, '501', 'Nizar Khalil'),
(@tower_c, '502', 'Rima Abdullah'),
(@tower_c, '503', 'Salim Ahmed'),
(@tower_c, '504', 'Hiba Hassan'),
(@tower_c, '505', 'Walid Ibrahim');

-- Insert Sample Consumption Data (Last 3 Months)
INSERT INTO consumption (flat_id, current_reading, month, year) 
SELECT id, ROUND(RAND() * 1000 + 100, 2), 4, 2026 FROM flats LIMIT 135;

INSERT INTO consumption (flat_id, current_reading, month, year) 
SELECT id, ROUND(RAND() * 1000 + 50, 2), 3, 2026 FROM flats LIMIT 135;

INSERT INTO consumption (flat_id, current_reading, month, year) 
SELECT id, ROUND(RAND() * 1000, 2), 2, 2026 FROM flats LIMIT 135;
