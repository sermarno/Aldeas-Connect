DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS communities CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS project_requests CASCADE;

-- user
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('resident', 'admin', 'visitor')
) ENGINE=INNODB;

-- community
CREATE TABLE communities (
    community_id INT PRIMARY KEY AUTO_INCREMENT,
    comm_name VARCHAR(255), -- if applicable
    comm_description TEXT,
    comm_location TEXT
) ENGINE=INNODB;

-- project
CREATE TABLE projects (
    project_id INT PRIMARY KEY  AUTO_INCREMENT,
    title VARCHAR(255),
    proj_description TEXT,
    proj_start DATE,
    proj_end DATE,
    request_status ENUM('approved', 'denied', 'pending') DEFAULT 'pending',
    admin_comments TEXT, -- message from admin about decision
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (community_id) REFERENCES communities(community_id)
) ENGINE=INNODB;

-- project requests
CREATE TABLE project_requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    req_description TEXT,
    proj_start DATE,
    proj_end DATE,
    res_comments TEXT, -- for any additional information (questions, comments, concerns, help needed)
    req_status ENUM('approved', 'denied', 'pending'),
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (community_id) REFERENCES communities(community_id)
) ENGINE=INNODB;

-- insert statements with test data
INSERT INTO communities (comm_name, comm_description, comm_location) VALUES
('Community 1', 'Community 1 description', 'Community 1 location'), 
('Community 2', 'Community 2 description', 'Community 2 location'),
('Community 3', 'Community 3 description', 'Community 3 location');

INSERT INTO projects (title, proj_description, proj_start, proj_end, request_status, admin_comments, user_id, community_id) VALUES
('Project 1', 'Project 1 description', '2020-11-12', '2025-9-7', 'pending', null, 1, 1);

INSERT INTO users (full_name, username, email, user_password, user_role) VALUES
('User 1', 'user1', 'user1@example.com', 'password1', 'resident'),
('User 2', 'user2', 'user2@example.com', 'password2', 'admin');

INSERT INTO project_requests (title, req_description, proj_start, proj_end, res_comments, req_status, user_id, community_id) VALUES
('Project Req 1', 'Project Req 1 description', '2022-11-09', '2026-01-03', 'Resident Comments 1', 'pending', 1, 1);