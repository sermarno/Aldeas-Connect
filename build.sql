DROP TABLE IF EXISTS messages CASCADE;
DROP TABLE IF EXISTS project_requests CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS required_help;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS communities CASCADE;
DROP TABLE IF EXISTS about_content CASCADE;

-- user
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('resident', 'admin', 'visitor')
) ENGINE=INNODB;

-- messages 
CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    message_text TEXT NOT NULL,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    FOREIGN KEY (sender_id) REFERENCES users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES users(user_id)
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

-- community help needed
CREATE TABLE required_help (
    help_id INT AUTO_INCREMENT,
    community VARCHAR(255) NOT NULL,
    req_resources VARCHAR(255),
    PRIMARY KEY (help_id)
) ENGINE=INNODB;

--about page editing
CREATE TABLE about_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(255),
    content TEXT,
    image_path VARCHAR(255)
) ENGINE=INNODB;


-- insert statements with test data
INSERT INTO users (full_name, username, email, user_password, user_role) VALUES
('User 1', 'user1', 'user1@example.com', 'password1', 'resident'),
('User 2', 'user2', 'user2@example.com', 'password2', 'admin');

INSERT INTO communities (comm_name, comm_description, comm_location) VALUES
('Community 1', 'Community 1 description', 'Community 1 location'), 
('Community 2', 'Community 2 description', 'Community 2 location'),
('Community 3', 'Community 3 description', 'Community 3 location');

INSERT INTO projects (title, proj_description, proj_start, proj_end, request_status, admin_comments, user_id, community_id) VALUES
('Project 1', 'Project 1 description', '2020-11-12', '2025-09-07', 'pending', null, 1, 1),
('Project 2', 'Project 2 description', '2022-09-12', '2027-04-07', 'approved', 'I look forward to seeing your progress!', 2, 3);

INSERT INTO project_requests (title, req_description, proj_start, proj_end, res_comments, req_status, user_id, community_id) VALUES
('Project Req 1', 'Project Req 1 description', '2022-11-09', '2026-01-03', 'Resident Comments 1', 'pending', 1, 1);

INSERT INTO required_help (community, req_resources) VALUES
('Yokdzonot-Hu, Yaxkabá', 'More carving tools.'),
('Tikum, Tekax', 'More containers.'),
('Hunukú, Temozón', 'More computers for online resources.'),
('Cazumá, Cazumá', 'More wifi routers for intenet.');

INSERT INTO messages (message_text, sender_id, receiver_id) VALUES
("hello", 2, 1),
("hi", 1, 2);

-- insert initial data for about content
INSERT INTO about_content (section, content, image_path) VALUES
('Our Mission', 'Our main goal is to provide free internet access to rural communities around the country of Mexico. So far,
    we
    have been able to provide free internet access to over 80 communities in various states throughout the
    country.
    Each community works together on a project ranging from health, education, and tourism to name a few. Giving
    these communities the tools to improve their surroundings builds their confidence and allows them to tap
    into
    their full potential as people.', 'img/smartvillages.jpg'),
('Why?', 'We believe that internet access is a human right. As technology progresses, internet access has become
    essential
    if an individual wants to participate in society. Providing free internet access to these communities in
    need
    allows them to learn valuable technical skills as well as build a strong bond with their peers as they work
    on
    projects together that will benefit their community for years to come.', '');