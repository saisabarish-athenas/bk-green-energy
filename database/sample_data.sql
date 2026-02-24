-- Sample Data for BK Green Energy
-- Run this after schema.sql to populate with sample data

-- Insert sample clients
INSERT INTO clients (name, short_note) VALUES
('ABC Industries', '5.5 MW Solar EPC Project - Complete turnkey solution'),
('XYZ Corporation', 'Commercial Rooftop Installation with SCADA integration'),
('Green Tech Solutions', 'Hybrid Energy System - Solar + Battery Storage'),
('Solar Innovations Ltd', 'Industrial Solar Farm - 10 MW capacity'),
('Renewable Energy Co', 'Multiple rooftop installations across facilities'),
('Power Systems Inc', 'Ground-mounted solar plant with MMS structure');

-- Insert sample gallery images (using existing images from assets)
INSERT INTO gallery_images (project_id, image_path, caption) VALUES
(1, 'assets/images/WhatsApp Image 2026-02-13 at 11.20.37 AM(1).jpg', 'Solar Panel Installation - Madurai Project'),
(1, 'assets/images/WhatsApp Image 2026-02-13 at 11.20.40 AM.jpg', 'Ground Mounted System - 5.5 MW'),
(2, 'assets/images/WhatsApp Image 2026-02-13 at 11.20.42 AM.jpeg', 'Rooftop Solar Installation - Chennai'),
(2, 'assets/images/WhatsApp Image 2026-02-13 at 11.20.43 AM(1).jpg', 'Commercial Solar Farm'),
(NULL, 'assets/images/Mega Solar Installation Project.png', 'Mega Solar Installation Project'),
(NULL, 'assets/images/Industrial Energy Transformation.jpeg', 'Industrial Energy Transformation'),
(NULL, 'assets/images/Smart Hybrid Energy System.jpeg', 'Smart Hybrid Energy System');

-- Add more sample projects
INSERT INTO projects (title, capacity_mw, location, state, client, scope_tags, year, description, status) VALUES
('Rooftop Solar - Industrial Complex', 3.2, 'Coimbatore', 'Tamil Nadu', 'Green Tech Solutions', 'MMS,DC Works,AC Works,SCADA', 2024, 'Industrial rooftop installation with advanced monitoring system', 'completed'),
('Ground Mounted Solar Plant', 10.0, 'Tirunelveli', 'Tamil Nadu', 'Solar Innovations Ltd', 'Civil,MMS,DC Works,AC Works,Earthing,SCADA', 2023, 'Large scale ground-mounted solar plant with complete EPC scope', 'completed'),
('Hybrid Solar System', 1.5, 'Salem', 'Tamil Nadu', 'Renewable Energy Co', 'MMS,DC Works,AC Works,Battery Integration', 2024, 'Solar + Battery storage hybrid system for 24/7 power', 'ongoing'),
('Commercial Rooftop Array', 2.8, 'Trichy', 'Tamil Nadu', 'Power Systems Inc', 'MMS,DC Works,AC Works', 2023, 'Multiple rooftop installations across commercial buildings', 'completed');
