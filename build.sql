DROP TABLE IF EXISTS messages CASCADE;
DROP TABLE IF EXISTS project_requests CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS required_help;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS communities CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS project_requests CASCADE;
DROP TABLE IF EXISTS testimonials CASCADE;

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
    project_id INT,
    title VARCHAR(255),
    proj_description TEXT,
    proj_start DATE,
    proj_end DATE,
    request_status ENUM('approved', 'denied', 'pending') DEFAULT 'pending',
    admin_comments TEXT,
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (community_id) REFERENCES communities(community_id)
) ENGINE=INNODB;

-- Tetimonial/Connectivity
CREATE TABLE testimonials (
    testimonial_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    community_id INT NOT NULL,
    story_text TEXT NOT NULL,
    video_url VARCHAR(255) NULL, -- Optional video testimonial
    category ENUM('Education', 'Economic', 'Health', 'Other') NOT NULL,
    status ENUM('pending', 'approved', 'denied') DEFAULT 'pending', -- Admin approval status
    admin_comments TEXT NULL, -- Admin feedback
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (community_id) REFERENCES communities(community_id) ON DELETE CASCADE
) ENGINE=INNODB;
-- community help needed
CREATE TABLE required_help (
    help_id INT AUTO_INCREMENT,
    community VARCHAR(255) NOT NULL,
    req_resources VARCHAR(255),
    PRIMARY KEY (help_id)
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
('Project 1', 'Project 1 description', '2020-11-12', '2025-09-07', 'approved', 'Looks great! Let us know if you need any help.', 1, 1),
('Project 2', 'Project 2 description', '2022-09-12', '2027-04-07', 'approved', 'I look forward to seeing your progress!', 2, 3),
('Project 5', 'Project 5 description', '2025-09-12', '2026-10-15', 'approved', 'Your project has been approved!', 1, 3);

INSERT INTO project_requests (title, proj_description, proj_start, proj_end, request_status, admin_comments, user_id, community_id) VALUES
('Project 3', 'Project 3 description', '2025-04-09', '2026-01-03', 'pending', null, 1, 1),
('Project 4', 'Project 4 description', '2025-11-09', '2028-11-04', 'approved', "This is a really great project to work on!", 2, 2);

INSERT INTO project_requests (title, req_description, proj_start, proj_end, res_comments, req_status, user_id, community_id) VALUES
('Project Req 1', 'Project Req 1 description', '2022-11-09', '2026-01-03', 'Resident Comments 1', 'pending', 1, 1);

INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status)
VALUES
(1, 1, 'My name is Elisa Cercanche, I live in the community of Tiunca, municipality of Yaxcabá, I am a community educator in the community of San Marcos. Preschool level, for me the smart villages project is one, it is a support that has served us in the Community, in rural communities such as the Community of Tiuncá, since it has been used educationally.', 'uploads/sample_video.mp4', 'Education', 'approved'),
(2, 3, 'My name is Juanita Atzuk Heredia, I am from the community of Santa Cruz Chemax, Yucatán. It has been of many benefits to all of us in this Community because through them many community projects have been worked on, within which women's rights are covered, because in communities like these is where violence is suffered the most, because women You don't know all your rights. Of course, with programs like these smart villages, the risk of violence in the home can be minimized.
', 'uploads/sample_video.mp4', 'Education', 'approved');
INSERT INTO required_help (community, req_resources) VALUES
('Yokdzonot-Hu, Yaxkabá', 'More carving tools.'),
('Tikum, Tekax', 'More containers.'),
('Hunukú, Temozón', 'More computers for online resources.'),
('Cazumá, Cazumá', 'More wifi routers for intenet.');

INSERT INTO messages (message_text, sender_id, receiver_id) VALUES
("hello", 2, 1),
("hi", 1, 2);
