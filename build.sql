SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS required_help CASCADE;
DROP TABLE IF EXISTS about_content CASCADE;
DROP TABLE IF EXISTS partners CASCADE;
DROP TABLE IF EXISTS testimonials CASCADE;
DROP TABLE IF EXISTS project_highlights CASCADE;
DROP TABLE IF EXISTS messages CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS communities CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS support_offers CASCADE;

-- user
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255),
    lname VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    user_role ENUM('resident', 'admin', 'visitor') DEFAULT 'visitor'
) ENGINE=INNODB;

-- community
CREATE TABLE communities (
    community_id INT PRIMARY KEY AUTO_INCREMENT,
    comm_name VARCHAR(255),
    comm_description TEXT,
    comm_location TEXT,
    comm_connection_date TEXT,
    comm_img1 VARCHAR(255),
    comm_img2 VARCHAR(255),
    comm_img3 VARCHAR(255)
) ENGINE=INNODB;

-- project
CREATE TABLE projects (
    project_id INT PRIMARY KEY  AUTO_INCREMENT,
    title VARCHAR(255),
    proj_description TEXT,
    proj_image VARCHAR(255),
    proj_start DATE,
    proj_end DATE,
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (community_id) REFERENCES communities(community_id) ON DELETE CASCADE
) ENGINE=INNODB;

-- project highlights
CREATE TABLE project_highlights (
    highlight_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    title VARCHAR(255),
    proj_description TEXT,
    proj_image VARCHAR(255),
    proj_start DATE,
    proj_end DATE,
    user_id INT,
    community_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (community_id) REFERENCES communities(community_id) ON DELETE CASCADE
) ENGINE=INNODB;

-- Testimonial/Connectivity
CREATE TABLE testimonials (
    testimonial_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    community_id INT NOT NULL,
    story_text TEXT NOT NULL,
    video_url VARCHAR(255) NULL,
    category ENUM('Education', 'Economic', 'Health', 'Other') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (community_id) REFERENCES communities(community_id) ON DELETE CASCADE
) ENGINE=INNODB;

ALTER TABLE testimonials
ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
ADD COLUMN admin_comments TEXT;

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

--partner submission page
CREATE TABLE partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    support_type TEXT NOT NULL,
    message TEXT
)ENGINE=INNODB;

--submission table
CREATE TABLE support_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    community VARCHAR(255),
    requested_resources TEXT,
    company_name VARCHAR(255),
    contact_email VARCHAR(255),
    support_type VARCHAR(100),
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=INNODB;

-- insert statements with test data
INSERT INTO users (fname, lname, username, email, user_role) VALUES
('Serra', 'Arnold', 'sermarno', 'sermarno@iu.edu', 'admin'),
('Miranda', 'Hanes', 'mhanes', 'mhanes1@example.com', 'resident'),
('Joany', 'King', 'jking2', 'jking2@example.com', 'resident'),
('Jeremy', 'Adkins', 'jadkins3', 'jadkins3@example.com', 'visitor');

INSERT INTO messages (sender_id, recipient_id, message, sent_at) VALUES 
(3, 1, "Everything is going great so far!", '2025-01-12 17:52:18'),
(2, 1, "We have a question about the Community Center.", '2025-03-31 17:52:18'),
(4, 1, "Did we get any donations for our project?", '2025-03-31 14:52:18');

INSERT INTO communities (comm_name, comm_description, comm_location, comm_connection_date, comm_img1, comm_img2, comm_img3) VALUES
('Telebachillerato Agua Azul', 'Educational center supporting online learning in Quintana Roo.', 'Leona Vicario, Yucatan', '2022-09-07', 'img/comm1_1.jpeg', 'img/comm1_2.jpeg', 'img/comm1_3.jpeg'), 
('Secundaria Comunitaria Niños Héroes', 'School offering remote education access.', 'Slferino, Yucatan', '2019-03-02', 'img/comm1_1.jpeg', 'img/comm1_2.jpeg', 'img/comm1_3.jpeg'),
('Comisaría Municipal Yokdzonot Hu', 'Economic and social support for Maya women in agriculture.', 'Yokdzonot-Hú', '2022-07-13', 'img/comm1_1.jpeg', 'img/comm1_2.jpeg', 'img/comm1_3.jpeg');

INSERT INTO projects (title, proj_description, proj_image, proj_start, proj_end, user_id, community_id) VALUES
('Health Center', 'Supporting the processing and sharing of information reports with jurisdictions, hospitals, and the central health sector office.', 'uploads/health_center.jpeg', '2020-04-23', '2025-01-11', 1, 3),
('Migrant Shelter', 'Training refugees to access information about human rights and refugee assistance', 'uploads/shelter.png', '2017-11-14', '2020-05-24', 2, 2),
('Telesecondary School', 'Supporting Online Education', 'uploads/school.jpeg', '2022-06-05', '2024-09-07', 1, 1),
('Sustainable Landscapes Oaxaca', 'Promote productive projects through e-commerce, virtual training, and online education', 'uploads/e-commerce.jpeg', '2020-11-12', '2025-09-07', 1, 1),
('Community Center', 'Support education for adult women and indigenous girls, and promote ecotourism', 'uploads/community_center.jpeg', '2022-09-12', '2027-04-07', 2, 3);

INSERT INTO project_highlights (title, proj_description, proj_image, proj_start, proj_end, user_id, community_id) VALUES 
('Health Center', 'Supporting the processing and sharing of information reports with jurisdictions, hospitals, and the central health sector office.', 'uploads/health_center.jpeg', '2020-04-23', '2025-01-11', 1, 3),
('Migrant Shelter', 'Training refugees to access information about human rights and refugee assistance', 'uploads/shelter.png', '2017-11-14', '2020-05-24', 2, 2),
('Telesecondary School', 'Supporting Online Education', 'uploads/school.jpeg', '2022-06-05', '2024-09-07', 1, 1);

INSERT INTO testimonials (user_id, community_id, story_text, video_url, category)
VALUES
(2, 1, 'My name is Elisa Cercanche, I live in the community of Tiunca, municipality of Yaxcabá, I am a community educator in the community of San Marcos. Preschool level, for me the smart villages project is one, it is a support that has served us in the Community, in rural communities such as the Community of Tiuncá, since it has been used educationally.', 'uploads/elisa.mov', 'Education'),
(1, 3, "My name is Juanita Atzuk Heredia, I am from the community of Santa Cruz Chemax, Yucatán. It has been of many benefits to all of us in this Community because through them many community projects have been worked on, within which women's rights are covered, because in communities like these is where violence is suffered the most, because women You don't know all your rights. Of course, with programs like these smart villages, the risk of violence in the home can be minimized.
", 'uploads/juanita.mov', 'Education');

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

-- insert partnership data
INSERT INTO partners (company_name, contact_person, email, phone, support_type, message) VALUES
('Company Name', 'Contact Person', 'Email', 'Phone', 'Support Type', 'Message');