-- BK Green Energy Database Schema
-- Run this on Hostinger MySQL after creating database: bk_green_energy

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    capacity_mw DECIMAL(10,2),
    location VARCHAR(255),
    state VARCHAR(100),
    client VARCHAR(255),
    scope_tags VARCHAR(500),
    year INT,
    description TEXT,
    image_path VARCHAR(255),
    status ENUM('completed', 'ongoing', 'planned') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo_path VARCHAR(255),
    short_note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS gallery_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NULL,
    image_path VARCHAR(255) NOT NULL,
    caption VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    company VARCHAR(255),
    location VARCHAR(255),
    message TEXT,
    source_page VARCHAR(50),
    status ENUM('new', 'contacted', 'converted', 'closed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admins (username, password_hash, role) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample project data
INSERT INTO projects (title, capacity_mw, location, state, client, scope_tags, year, description, status) VALUES
('Solar EPC Project - Madurai', 5.5, 'Madurai', 'Tamil Nadu', 'ABC Industries', 'Civil,MMS,DC Works,AC Works,Earthing', 2024, 'Complete EPC execution for 5.5 MW ground-mounted solar plant', 'completed'),
('Rooftop Solar - Chennai', 2.0, 'Chennai', 'Tamil Nadu', 'XYZ Corporation', 'MMS,DC Works,AC Works,SCADA', 2023, 'Commercial rooftop installation with SCADA integration', 'completed');
