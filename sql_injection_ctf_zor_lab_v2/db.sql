
CREATE DATABASE IF NOT EXISTS ctf_zor;
USE ctf_zor;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255)
);

INSERT INTO users (username, password) VALUES ('admin', 'admin123');

CREATE TABLE logs_hidden_xA23 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(255),
    meta TEXT
);

INSERT INTO logs_hidden_xA23 (action, meta) VALUES
('admin.login.success', 'Login başarılı [log id: 3001]'),
('user.reset.password', 'Parola sıfırlama e-postası gönderildi.'),
('backup.created', 'Sistem yedeği alındı.');
