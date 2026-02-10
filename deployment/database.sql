-- Database Export for training_app
-- Generated on 2026-02-09 16:53:00



CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `failed_login_attempts` int(11) DEFAULT 0,
  `account_locked_until` datetime DEFAULT NULL,
  `last_failed_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_users` VALUES ('1', 'admin', '$2y$10$7m7apMfV755szi/Hdmtw3u90bNAsOIjwi8sTzfj5jl00Dom0u4Zzi', '1', '2026-02-03 19:45:28', '0', NULL, NULL);


CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(512) NOT NULL,
  `link_url` varchar(512) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `banners` VALUES ('1', 'Main Slider Image', 'images/banner/sliderImage.jpg', '', '1', '0', '2026-02-08 08:26:50');


CREATE TABLE `course_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `inquiry_type` varchar(50) DEFAULT 'WhatsApp',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `course_inquiries` VALUES ('1', '3', 'WhatsApp', '2026-02-06 20:28:03');


CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `fees` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` varchar(32) DEFAULT NULL,
  `image_path` varchar(512) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `courses` VALUES ('1', 'Hardware and Networking', '', '4 Months', '15000', 'Comprehensive hardware and networking training.', '1', '0', '2026-02-05 21:13:52', 'Professional Courses', NULL, 'Professional Courses', 'Hardware and Networking', NULL);
INSERT INTO `courses` VALUES ('3', 'Cloud Computing', 'cloud-computing', '6 Months', '25000', 'Master AWS, Azure, and Google Cloud platforms.', '1', '0', '2026-02-05 21:14:17', 'Professional Courses', NULL, 'Professional Courses', 'Cloud Computing', NULL);
INSERT INTO `courses` VALUES ('4', 'Red Hat Linux', 'red-hat-linux', '3 Months', '18000', 'Red Hat Certified System Administrator (RHCSA) training.', '1', '0', '2026-02-05 21:14:17', 'Professional Courses', NULL, 'Professional Courses', 'Red Hat Linux', NULL);
INSERT INTO `courses` VALUES ('5', 'C, C++', 'c-c-', '2 Months', '8000', 'This course is designed to build a strong programming base using C and C++. It focuses on logic building, structured programming, and problem-solving skills. Learners will work with real-world examples and programs, gaining the confidence required for higher-level programming, competitive exams, and software development careers.\r\nThe course also introduces functions, arrays, pointers, and basic object-oriented concepts in C++.  \r\nIt is ideal for beginners who want to start their journey in software development and coding.', '1', '0', '2026-02-05 21:14:17', 'Programming Languages', NULL, 'Programming Languages', 'C, C++', NULL);
INSERT INTO `courses` VALUES ('6', 'Java', 'java', '4 Months', '12000', 'Core and Advanced Java programming.', '1', '0', '2026-02-05 21:14:17', 'Programming Languages', NULL, 'Programming Languages', 'Java', NULL);
INSERT INTO `courses` VALUES ('7', 'Python', 'python', '3 Months', '10000', 'Python programming for data science and web dev.', '1', '0', '2026-02-05 21:14:17', 'Programming Languages', NULL, 'Programming Languages', 'Python', NULL);
INSERT INTO `courses` VALUES ('8', 'dsgds', 'dsgds', '12', '2346', 'gfhg', '1', '0', '2026-02-08 10:58:50', 'Professional Courses', NULL, 'Professional Courses', 'dsgds', NULL);


CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `source` varchar(64) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `enquiries` VALUES ('1', 'dipali', 'dipali@gmail.com', '1234567890', 'dfgdfgdf', 'registration', 'new', '2026-02-05 21:26:09');


CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `gallery` VALUES ('1', 'dfsd', 'Office', 'uploads/gallery/gallery_6985f7b7237a2.jpg', '1', '2026-02-06 19:46:23');
INSERT INTO `gallery` VALUES ('2', 'fghfh', 'Events', 'uploads/gallery/gallery_6985ff2ee9813.jpg', '1', '2026-02-06 20:18:14');


CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inquiry_type` varchar(50) NOT NULL,
  `reference_name` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inquiries` VALUES ('1', 'Service', 'Software Installation & Licensing', 'dipali', '8010331634', 'shindedipal@gmail.com', 'i want to installation', 'Pending', '2026-02-07 12:35:23');
INSERT INTO `inquiries` VALUES ('2', 'Service', 'Web Development', 'Test User', '1234567890', 'test@example.com', 'This is a test message from debug script.', 'Pending', '2026-02-07 12:39:16');
INSERT INTO `inquiries` VALUES ('3', 'Service', 'Web Development', 'Test User', '1234567890', 'test@example.com', 'This is a test message from debug script.', 'Pending', '2026-02-07 12:41:21');
INSERT INTO `inquiries` VALUES ('4', 'Service', 'System Installation & Formatting', 'Dipali Shinde', '8010331623', 'shindedipal@gmail.com', 'dfghj aksdjaks', 'Pending', '2026-02-07 12:44:14');
INSERT INTO `inquiries` VALUES ('5', 'Course', 'Hardware and Networking', 'Dipali Shinde', '8010331634', 'shindedipal@gmail.com', 'xfgdffgfds sas', 'Pending', '2026-02-07 12:46:38');
INSERT INTO `inquiries` VALUES ('6', 'Service', 'Debug Test Service', 'Debug User', '9999999999', 'debug@test.com', 'This is a debug test message.', 'Pending', '2026-02-07 12:48:13');
INSERT INTO `inquiries` VALUES ('7', 'Service', 'Simulation Test Service', 'Simulation User', '8888888888', 'simulation@test.com', 'This is a simulation test.', 'Pending', '2026-02-07 12:49:39');
INSERT INTO `inquiries` VALUES ('8', 'Course', 'Cloud Computing', 'Dipali Shinde', '8010331634', 'shindedipali@gmail.com', 'efksdfsk sdfjs', 'Pending', '2026-02-07 12:56:22');
INSERT INTO `inquiries` VALUES ('9', 'Course', 'Python', 'Dipali Shinde', '123456789', 'shindedipali@gmail.com', 'sdfsd saakj skfj', 'Pending', '2026-02-07 13:05:18');
INSERT INTO `inquiries` VALUES ('10', 'Course', 'Red Hat Linux', 'Dipali Shinde', '8010331634', 'shindedipali@gmail.com', 'sdfghk djkgldk', 'Pending', '2026-02-07 13:08:53');
INSERT INTO `inquiries` VALUES ('11', 'Course', 'Cloud Computing', 'Dipali Shinde', '1234567890', 'qweere560@gmail.com', 'sdfs dgdg', 'Pending', '2026-02-07 13:22:31');
INSERT INTO `inquiries` VALUES ('12', 'Service', 'Antivirus & Security Setup', 'adsdd', '1232321234', 'dipalishinde60@gmail.com', 'ty rtthgh ghf', 'Pending', '2026-02-07 14:51:45');
INSERT INTO `inquiries` VALUES ('13', 'Service', 'Software Installation & Licensing', 'adsdd', '1232321234', 'dipalishinde60@gmail.com', 'ty rtthgh ghf', 'Pending', '2026-02-07 14:51:56');
INSERT INTO `inquiries` VALUES ('14', 'Service', 'Software Installation & Licensing', 'hfdgf ghhg', '2345678909', 'dipalishind560@gmail.com', 'dhd hgjgh cvc', 'Pending', '2026-02-07 14:52:29');
INSERT INTO `inquiries` VALUES ('15', 'Course', 'Red Hat Linux', 'rtthdg', '2345678909', 'dipalishine560@gmail.com', 'sadf gr teet', 'Pending', '2026-02-07 14:53:18');
INSERT INTO `inquiries` VALUES ('16', 'Course', 'Python', 'Dipali Shinde', '08010331634', 'dipaliside560@gmail.com', 'fghfgh ghjgj', 'Pending', '2026-02-07 14:57:10');
INSERT INTO `inquiries` VALUES ('17', 'Course', 'Cloud Computing', 'Dipali Shinde', '234567890987', 'dipalishinde560@gmail.com', 'ertert fghf', 'Pending', '2026-02-07 14:57:47');
INSERT INTO `inquiries` VALUES ('18', 'Course', 'Cloud Computing', 'Dipali Shinde', '234567890987', 'dipalishinde560@gmail.com', 'ertert fghf', 'Pending', '2026-02-07 14:57:47');
INSERT INTO `inquiries` VALUES ('19', 'Course', 'Hardware and Networking', 'sdsd', '08010331634', 'dipalinde560@gmail.com', 'sd sdfs sfsd', 'Pending', '2026-02-08 06:42:13');
INSERT INTO `inquiries` VALUES ('20', 'Contact', 'General Inquiry', 'dipali dattatray shinde', '6789092345', 'dipali@gmail.com', 'dfgdg dfgdb df', 'Pending', '2026-02-08 06:51:02');
INSERT INTO `inquiries` VALUES ('21', 'Course', 'Hardware and Networking', 'komal bhate', '22010331634', 'dipaliscv560@gmail.com', 'cxczxc cvxc', 'Pending', '2026-02-08 06:59:53');
INSERT INTO `inquiries` VALUES ('22', 'Contact', 'General Inquiry', 'hdfds sdksd sjdjs', '2345678712', 'dghdj@gmail.com', 'sfhgd jdfghdf diufg', 'Pending', '2026-02-08 07:29:24');
INSERT INTO `inquiries` VALUES ('23', 'Service', 'CCTV Installation & Support', 'Dipali Shinde', '08010331634', 'dipalidfgdfhinde560@gmail.com', 'dsfsdfgfdgdf fd', 'Pending', '2026-02-08 07:30:49');
INSERT INTO `inquiries` VALUES ('24', 'Course', 'Java', 'komal jadhv', '2345678912', 'komal@gmail.com', 'sdfgksj dshjskldj', 'Pending', '2026-02-08 15:48:02');
INSERT INTO `inquiries` VALUES ('25', 'Course', 'Java', 'komal jadhv', '2345678912', 'komal@gmail.com', 'sdfgksj dshjskldj', 'Pending', '2026-02-08 15:48:11');
INSERT INTO `inquiries` VALUES ('26', 'Course', 'Java', 'komal jadhv', '2345678912', 'komal@gmail.com', 'sdfgksj dshjskldj', 'Pending', '2026-02-08 15:48:45');
INSERT INTO `inquiries` VALUES ('27', 'Course', 'Python', 'komal jadhv', '2345678912', 'komal@gmail.com', 'asdas sdsd', 'Pending', '2026-02-08 15:57:28');
INSERT INTO `inquiries` VALUES ('28', 'Course', 'Red Hat Linux', 'komal jadhv', '123456789', 'komal@gmail.com', 'cbxm djhdskf', 'Pending', '2026-02-08 17:11:36');
INSERT INTO `inquiries` VALUES ('29', 'Course', 'Red Hat Linux', 'sima', '123456789', 'kom12al@gmail.com', 'sdfjsfg jdfdj', 'Pending', '2026-02-08 17:26:14');
INSERT INTO `inquiries` VALUES ('30', 'Course', 'C, C++', 'dpa jadhv', '1234567898', 'ddsmal@gmail.com', 'dsgfh dfjjs', 'Pending', '2026-02-08 17:40:11');
INSERT INTO `inquiries` VALUES ('31', 'Course', 'Hardware and Networking', 'Suraj Mali', '1234567687', 'suraj582.sm@gmail.com', 'gsjd dgbdf', 'Pending', '2026-02-08 17:46:41');
INSERT INTO `inquiries` VALUES ('32', 'Course', 'C, C++', 'xdfsdfgfds', '08010331634', 'dipalishind560@gmail.com', 'djfgdk kjdk', 'Pending', '2026-02-08 19:18:20');
INSERT INTO `inquiries` VALUES ('33', 'Course', 'C, C++', 'dipali', '3456786543', 'sda@gmail.com', 'dfgjdfn', 'Pending', '2026-02-09 14:09:00');


CREATE TABLE `pages` (
  `key_name` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `data_json` text DEFAULT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `service_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `service_name` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('Pending','Assigned','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `service_requests` VALUES ('1', NULL, 'Office IT Infrastructure Support', 'ggdf', '08010331634', 'dipalishide560@gmail.com', 'pune', '2026-02-20', 'Morning (9 AM - 12 PM)', 'dfsdfsdfs', 'Pending', '2026-02-05 20:53:50');
INSERT INTO `service_requests` VALUES ('2', NULL, 'hchdf', 'hfghfg', '08010331634', 'dfdff@gmail.com', 'pune', '2026-03-05', 'Afternoon (12 PM - 4 PM)', 'hfghfhgfh', 'Pending', '2026-02-06 20:23:03');
INSERT INTO `service_requests` VALUES ('3', NULL, 'Web Development', 'Test User', '1234567890', 'test@example.com', NULL, NULL, NULL, 'This is a test service request.', 'Pending', '2026-02-08 08:02:54');
INSERT INTO `service_requests` VALUES ('4', NULL, 'CCTV Installation & Support', 'sd fdd', '08010331612', 'dipalishinde520@gmail.com', NULL, NULL, NULL, 'sdfs m,nm m,m', 'Pending', '2026-02-08 08:06:21');
INSERT INTO `service_requests` VALUES ('5', NULL, 'Web Development', 'Real User', '08010331634', 'dynamic@example.com', NULL, NULL, NULL, 'This is a real user input test.', 'Pending', '2026-02-08 08:11:31');
INSERT INTO `service_requests` VALUES ('6', NULL, 'LAN / Wi-Fi Setup', 'sajjan ghadge', '08010331612', 'dipalishinde60@gmail.com', NULL, NULL, NULL, 'sdsa cvb cbdbb', 'Pending', '2026-02-08 08:13:24');
INSERT INTO `service_requests` VALUES ('7', NULL, 'LAN / Wi-Fi Setup', 'yash', '123456789', 'yash@gmail.com', NULL, NULL, NULL, 'drgdf fddhdf', 'Pending', '2026-02-08 11:32:15');
INSERT INTO `service_requests` VALUES ('8', NULL, 'TestService', 'TestUser', '1234567890', 'test@example.com', NULL, NULL, NULL, 'TestMessage', 'Pending', '2026-02-09 14:06:05');


CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` VALUES ('1', 'Core IT', 'Computer / Laptop Support', 'Expert repair and support for desktops and laptops.', 'bi bi-laptop', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('2', 'Core IT', 'System Installation & Formatting', 'OS installation, formatting, and driver setup.', 'bi bi-hdd', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('3', 'Core IT', 'Software Installation & Licensing', 'Installing essential software and managing licenses.', 'bi bi-box-seam', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('4', 'Core IT', 'Antivirus & Security Setup', 'Protection against malware, viruses, and cyber threats.', 'bi bi-shield-check', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('5', 'Core IT', 'Data Backup & Recovery', 'Secure data backup solutions and disaster recovery.', 'bi bi-database', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('6', 'Networking & Office IT', 'LAN / Wi-Fi Setup', 'Complete local area network and Wi-Fi configuration.', 'bi bi-wifi', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('7', 'Networking & Office IT', 'Router & Switch Configuration', 'Advanced routing and switching setup for offices.', 'bi bi-router', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('8', 'Networking & Office IT', 'CCTV Installation & Support', 'Surveillance system installation and maintenance.', 'bi bi-camera-video', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('9', 'Networking & Office IT', 'Office IT Infrastructure Support', 'End-to-end IT infrastructure management.', 'bi bi-building', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('10', 'Networking & Office IT', 'AMC (Annual Maintenance)', 'Yearly maintenance contracts for hassle-free IT.', 'bi bi-tools', '1', '2026-02-05 19:57:13');
INSERT INTO `services` VALUES ('11', 'Core IT', 'hchdf', 'dfgdfg', '', '1', '2026-02-06 20:22:00');


CREATE TABLE `training_programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

