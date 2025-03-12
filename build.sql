DROP TABLE IF EXISTS required_help CASCADE;
DROP TABLE IF EXISTS about_content CASCADE;
DROP TABLE IF EXISTS testimonials CASCADE;
DROP TABLE IF EXISTS project_highlights CASCADE;
DROP TABLE IF EXISTS project_requests CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS communities CASCADE;
DROP TABLE IF EXISTS messages CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- user
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255),
    lname VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    user_role ENUM('resident', 'admin', 'visitor') DEFAULT 'visitor'
) ENGINE=INNODB;

-- messages 
CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    recipient_id INT NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (recipient_id) REFERENCES users(user_id) ON DELETE CASCADE
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
    proj_image VARCHAR(255),
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
    proj_image VARCHAR(255),
    proj_start DATE,
    proj_end DATE,
    request_status ENUM('approved', 'denied', 'pending') DEFAULT 'pending',
    admin_comments TEXT,
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (community_id) REFERENCES communities(community_id)
) ENGINE=INNODB;

-- project highlights
CREATE TABLE project_highlights (
    project_id INT,
    title VARCHAR(255),
    proj_description TEXT,
    proj_image VARCHAR(255),
    proj_start DATE,
    proj_end DATE,
    user_id INT,
    community_id INT,
    FOREIGN KEY (community_id) REFERENCES communities(community_id)
) ENGINE=INNODB;

-- Testimonial/Connectivity
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

--about page editing
CREATE TABLE about_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(255),
    content TEXT,
    image_path VARCHAR(255)
) ENGINE=INNODB;

-- insert statements with test data
INSERT INTO users (fname, lname, username, email, user_role) VALUES
('fname', 'lname', 'user1', 'user1@example.com', 'resident'),
('fname2', 'lname2', 'user2', 'user2@example.com', 'resident'),
('fname3', 'lname3', 'user3', 'user3@example.com', 'visitor');

INSERT INTO communities (comm_name, comm_description, comm_location) VALUES
('Community 1', 'Community 1 description', 'Community 1 location'), 
('Community 2', 'Community 2 description', 'Community 2 location'),
('Community 3', 'Community 3 description', 'Community 3 location');

INSERT INTO projects (title, proj_description, proj_image, proj_start, proj_end, request_status, admin_comments, user_id, community_id) VALUES
('Project 1', 'Project 1 description', null, '2020-11-12', '2025-09-07', 'approved', 'Looks great! Let us know if you need any help.', 1, 1),
('Project 2', 'Project 2 description', null, '2022-09-12', '2027-04-07', 'approved', 'I look forward to seeing your progress!', 2, 3),
('Project 5', 'Project 5 description', null, '2025-09-12', '2026-10-15', 'approved', 'Your project has been approved!', 1, 3);

INSERT INTO project_highlights (title, proj_description, proj_image, proj_start, proj_end, user_id, community_id) VALUES 
('Health Center', 'Supporting the processing and sharing of information reports with jurisdictions, hospitals, and the central health sector office.', 'uploads/health_center.jpeg', '2020-04-23', '2025-01-11', 1, 3),
('Migrant Shelter', 'Training refugees to access information about human rights and refugee assistance', 'uploads/shelter.png', '2017-11-14', '2020-05-24', 2, 2),
('Telesecondary School', 'Supporting Online Education', 'uploads/school.jpeg', '2022-06-05', '2024-09-07', 1, 1);

INSERT INTO project_requests (title, proj_description, proj_image, proj_start, proj_end, request_status, admin_comments, user_id, community_id) VALUES
('Project 3', 'Project 3 description', null, '2025-04-09', '2026-01-03', 'pending', null, 1, 1),
('Project 4', 'Project 4 description', null, '2025-11-09', '2028-11-04', 'pending', null, 2, 2);

INSERT INTO testimonials (user_id, community_id, story_text, video_url, category, status)
VALUES
(2, 1, 'My name is Elisa Cercanche, I live in the community of Tiunca, municipality of Yaxcabá, I am a community educator in the community of San Marcos. Preschool level, for me the smart villages project is one, it is a support that has served us in the Community, in rural communities such as the Community of Tiuncá, since it has been used educationally.', 'uploads/sample_video.mp4', 'Education', 'approved'),
(1, 3, "My name is Juanita Atzuk Heredia, I am from the community of Santa Cruz Chemax, Yucatán. It has been of many benefits to all of us in this Community because through them many community projects have been worked on, within which women's rights are covered, because in communities like these is where violence is suffered the most, because women You don't know all your rights. Of course, with programs like these smart villages, the risk of violence in the home can be minimized.
", 'uploads/sample_video.mp4', 'Education', 'approved');
(3, 2, "My name is Jenny Beatriz Bracamonte, I am here from Cusama, Yucatán, well I am very grateful to the intelligent villages who have put us on the Internet and it is a benefit that has benefited us a lot, because well I can publish my sauces, everything my product that I am selling and it has helped me a lot.", 'uploads/sample_video.mp4', 'Economic', 'approved')

INSERT INTO required_help (community, req_resources) VALUES
('Yokdzonot-Hu, Yaxkabá', 'More carving tools.'),
('Tikum, Tekax', 'More containers.'),
('Hunukú, Temozón', 'More computers for online resources.'),
('Cazumá, Cazumá', 'More wifi routers for intenet.');

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
