<?php

class m140513_135632_init_db extends CDbMigration
{
	public function up()
	{
            $this->execute("
                    DROP DATABASE omega
            ");
            
            $this->execute("
                    SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\"
            ");;

            $this->execute("
                    SET FOREIGN_KEY_CHECKS = 0
            ");
            
            $this->execute("
                    SET time_zone = \"+00:00\";
            ");
            
            $this->execute("
                    CREATE DATABASE omega
            ");

            $this->execute("
                    USE omega
            ");

            $this->execute("
                    CREATE TABLE IF NOT EXISTS `applicant` (
                        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `phone` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `cv` varchar(255) NOT NULL,
                        `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `date_periods` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `start_date` date NOT NULL,
                    `end_date` date NOT NULL,
                    `description` varchar(255) DEFAULT NULL,
                    `seminar_id` int(11) unsigned NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `fk_date_periods_seminar1` (`seminar_id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 
            ");
            
            $this->execute("
                    INSERT INTO `date_periods` (`id`, `start_date`, `end_date`, `description`, `seminar_id`) VALUES
                    (79, '2014-05-01', '2014-05-29', 'june', 9),
                    (80, '2014-05-07', '2014-05-17', 'july', 10),
                    (81, '2014-05-12', '2014-05-12', 'ased', 11),
                    (83,'2014-06-16','2014-06-20',NULL,13),(84,'2014-06-23','2014-06-27',NULL,13),
                    (85,'2014-06-30','2014-07-03',NULL,13),(86,'2014-07-07','2014-07-11',NULL,13),
                    (87,'2014-07-14','2014-07-18',NULL,13),(88,'2014-07-21','2014-07-25',NULL,13),
                    (89,'2014-07-28','2014-08-01',NULL,13),(90,'2014-08-04','2014-08-08',NULL,13),
                    (91,'2014-08-11','2014-08-15',NULL,13),(92,'2014-08-18','2014-08-22',NULL,13),
                    (93,'2014-08-25','2014-08-29',NULL,13),(94,'2014-06-16','2014-06-20',NULL,14),
                    (95,'2014-06-23','2014-06-27',NULL,14),(96,'2014-06-30','2014-07-03',NULL,14),
                    (97,'2014-07-07','2014-07-11',NULL,14),(98,'2014-07-14','2014-07-18',NULL,14),
                    (99,'2014-07-21','2014-07-25',NULL,14),(100,'2014-07-28','2014-08-01',NULL,14),
                    (101,'2014-08-04','2014-08-08',NULL,14),(102,'2014-08-11','2014-08-15',NULL,14),
                    (103,'2014-08-18','2014-08-22',NULL,14),(104,'2014-08-25','2014-08-29',NULL,14),
                    (105,'2014-06-16','2014-06-20',NULL,15),(106,'2014-06-23','2014-06-27',NULL,15),
                    (107,'2014-06-30','2014-07-03',NULL,15),(108,'2014-07-07','2014-07-11',NULL,15),
                    (109,'2014-07-14','2014-07-18',NULL,15),(110,'2014-07-21','2014-07-25',NULL,15),
                    (111,'2014-07-28','2014-08-01',NULL,15),(112,'2014-08-04','2014-08-08',NULL,15),
                    (113,'2014-08-11','2014-08-15',NULL,15),(114,'2014-08-18','2014-08-22',NULL,15),
                    (115,'2014-08-25','2014-08-29',NULL,15),(116,'2014-06-16','2014-06-20',NULL,16),
                    (117,'2014-06-23','2014-06-27',NULL,16),(118,'2014-06-30','2014-07-03',NULL,16),
                    (119,'2014-07-07','2014-07-11',NULL,16),(120,'2014-07-14','2014-07-18',NULL,16),
                    (121,'2014-07-21','2014-07-25',NULL,16),(122,'2014-07-28','2014-08-01',NULL,16),
                    (123,'2014-08-04','2014-08-08',NULL,16),(124,'2014-08-11','2014-08-15',NULL,16),
                    (125,'2014-08-18','2014-08-22',NULL,16),(126,'2014-08-25','2014-08-29',NULL,16),
                    (127,'2014-06-16','2014-06-20',NULL,17),(128,'2014-06-23','2014-06-27',NULL,17),
                    (129,'2014-06-30','2014-07-03',NULL,17),(130,'2014-07-07','2014-07-11',NULL,17),
                    (131,'2014-07-14','2014-07-18',NULL,17),(132,'2014-07-21','2014-07-25',NULL,17),
                    (133,'2014-07-28','2014-08-01',NULL,17),(134,'2014-08-04','2014-08-08',NULL,17),
                    (135,'2014-08-11','2014-08-15',NULL,17),(136,'2014-08-18','2014-08-22',NULL,17),
                    (137,'2014-08-25','2014-08-29',NULL,17),(138,'2014-06-16','2014-06-20',NULL,18),
                    (139,'2014-06-23','2014-06-27',NULL,18),(140,'2014-06-30','2014-07-03',NULL,18),
                    (141,'2014-07-07','2014-07-11',NULL,18),(142,'2014-07-14','2014-07-18',NULL,18),
                    (143,'2014-07-21','2014-07-25',NULL,18),(144,'2014-07-28','2014-08-01',NULL,18),
                    (145,'2014-08-04','2014-08-08',NULL,18),(146,'2014-08-11','2014-08-15',NULL,18),
                    (147,'2014-08-18','2014-08-22',NULL,18),(148,'2014-08-25','2014-08-29',NULL,18),
                    (149,'2014-06-16','2014-06-20',NULL,19),(150,'2014-06-23','2014-06-27',NULL,19),
                    (151,'2014-06-30','2014-07-03',NULL,19),(152,'2014-07-07','2014-07-11',NULL,19),
                    (153,'2014-07-14','2014-07-18',NULL,19),(154,'2014-07-21','2014-07-25',NULL,19),
                    (155,'2014-07-28','2014-08-01',NULL,19),(156,'2014-08-04','2014-08-08',NULL,19),
                    (157,'2014-08-11','2014-08-15',NULL,19),(158,'2014-08-18','2014-08-22',NULL,19),
                    (159,'2014-08-25','2014-08-29',NULL,19)
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `day_off` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `date` date NOT NULL,
                    `description` varchar(255) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `enroll_forms` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `form_id` int(11) NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `fk_enroll_forms_forms1_idx` (`form_id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 
            ");
            
            $this->execute("
                    INSERT INTO `enroll_forms` (`id`, `form_id`) VALUES
                    (1, 1),
                    (2, 1),
                    (3, 1),
                    (4, 1),
                    (5, 1),
                    (8, 1),
                    (6, 2),
                    (7, 2) 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `enroll_form_hillview` (
                    `enroll_form_id` int(11) NOT NULL,
                    `student_name` varchar(255) NOT NULL,
                    `parent_name` varchar(255) NOT NULL,
                    `address` varchar(255) DEFAULT NULL,
                    `parent_email` varchar(255) DEFAULT NULL,
                    `parent_phone` varchar(12) NOT NULL,
                    `food_alergies` varchar(45) DEFAULT NULL,
                    `additional_comments` text,
                    `grade` varchar(4) NOT NULL,
                    `class_day` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
                    `order_id` int(11) unsigned DEFAULT NULL,
                    KEY `fk_enroll_form_hillview_enroll_forms1_idx` (`enroll_form_id`),
                    KEY `fk_enroll_form_hillview_orders1_idx` (`order_id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 
            ");
            
            $this->execute("
                    INSERT INTO `enroll_form_hillview` (`enroll_form_id`, `student_name`, `parent_name`, `address`, `parent_email`, `parent_phone`, `food_alergies`, `additional_comments`, `grade`, `class_day`, `order_id`) VALUES
                    (1, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 1),
                    (2, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 2),
                    (3, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 3),
                    (4, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 4),
                    (5, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 5),
                    (8, 'student name', 'Parent name', NULL, NULL, '123456789', NULL, NULL, '2th', 'tuesday', 8) 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `enroll_form_knoll` (
                    `enroll_form_id` int(11) NOT NULL,
                    `student_name` varchar(255) NOT NULL,
                    `grade` varchar(4) NOT NULL,
                    `parent_name` varchar(255) NOT NULL,
                    `address` varchar(255) DEFAULT NULL,
                    `parent_email` varchar(255) DEFAULT NULL,
                    `parent_phone` varchar(12) NOT NULL,
                    `food_alergies` varchar(255) DEFAULT NULL,
                    `additional_comments` text,
                    `order_id` int(11) unsigned DEFAULT NULL,
                    KEY `fk_enroll_form_hillview_enroll_forms1_idx` (`enroll_form_id`),
                    KEY `fk_enroll_form_knoll_orders1_idx` (`order_id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 
            ");
            
            $this->execute("
                    INSERT INTO `enroll_form_knoll` (`enroll_form_id`, `student_name`, `grade`, `parent_name`, `address`, `parent_email`, `parent_phone`, `food_alergies`, `additional_comments`, `order_id`) VALUES
                    (6, 'My name', '1th', 'Parent Name', NULL, NULL, 'Parent Phone', NULL, NULL, 6),
                    (7, 'My name', '1th', 'Parent Name', NULL, NULL, 'Parent Phone', NULL, NULL, 7) 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `enroll_form_summer` (
                    `enroll_form_id` int(11) NOT NULL,
                    `student_name` varchar(255) NOT NULL,
                    `gender` enum('male','female') NOT NULL,
                    `current_school` varchar(255) DEFAULT NULL,
                    `student_address` varchar(255) NOT NULL,
                    `student_home_phone` varchar(12) DEFAULT NULL,
                    `student_cell_phone` varchar(12) NOT NULL,
                    `student_email` varchar(255) NOT NULL,
                    `parent_name_1` varchar(255) NOT NULL,
                    `parent_email_1` varchar(255) DEFAULT NULL,
                    `parent_name_2` varchar(255) DEFAULT NULL,
                    `parent_email_2` varchar(255) DEFAULT NULL,
                    `parent_name_emergency` varchar(255) NOT NULL,
                    `parent_phone_emergency` varchar(12) NOT NULL,
                    `parent_cell_emergency` varchar(12) NOT NULL,
                    `person_name_emergency` varchar(255) NOT NULL,
                    `person_cell_emergency` varchar(12) NOT NULL,
                    `person_phone_emergency` varchar(12) NOT NULL,
                    `person_relation_to_student` varchar(255) NOT NULL,
                    `physician_name` varchar(255) NOT NULL,
                    `physician_phone` varchar(12) NOT NULL,
                    `dentist_name` varchar(255) NOT NULL,
                    `dentist_phone` varchar(12) NOT NULL,
                    `food_alergies` varchar(255) DEFAULT NULL,
                    `medication_alergies` varchar(255) DEFAULT NULL,
                    `medication_currently_taken` varchar(255) DEFAULT NULL,
                    `last_tetanus_shot` date DEFAULT NULL,
                    `submit_date` date NOT NULL,
                    `order_id` int(11) unsigned DEFAULT NULL,
                    KEY `fk_enroll_form_hillview_enroll_forms1_idx` (`enroll_form_id`),
                    KEY `fk_enroll_form_summer_orders1_idx` (`order_id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `forms` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `table` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `table_UNIQUE` (`table`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 
            ");
            
            $this->execute("
                    INSERT INTO `forms` (`id`, `table`) VALUES
                    (1, 'enroll_form_hillview'),
                    (2, 'enroll_form_knoll'),
                    (3, 'enroll_form_summer') 
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `grade` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `title` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 
            ");
            
            $this->execute("
                    INSERT INTO `grade` (`id`, `title`) VALUES
                    (11, '1th'),
                    (12, '2th'),
                    (13,'8th-12th'),
                    (14,'4th-5th'),
                    (15,'6th-8th'),
                    (16,'5th-8th'),
                    (17,'6th-7th'),
                    (18,'5th-7th'),
                    (19,'8th'),
                    (20,'9th-12th')
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `orders` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `amount` decimal(10,0) NOT NULL,
                    `details` text NOT NULL,
                    `payment_status` enum('pending','canceled','completed','failed') NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9
            ");
            
            $this->execute("
                    INSERT INTO `orders` (`id`, `amount`, `details`, `payment_status`) VALUES
                    (1, 200, 'Hillview seminar payment', 'pending'),
                    (2, 200, 'Hillview seminar payment', 'pending'),
                    (3, 200, 'Hillview seminar payment', 'pending'),
                    (4, 200, 'Hillview seminar payment', 'pending'),
                    (5, 2, 'Hillview seminar payment', 'pending'),
                    (6, 3, 'Oak Knoll seminar payment', 'pending'),
                    (7, 3, 'Oak Knoll seminar payment', 'pending'),
                    (8, 2, 'Hillview seminar payment', 'pending')
            ");

            $this->execute("
                    CREATE TABLE IF NOT EXISTS `seminar` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `title` varchar(255) NOT NULL,
                    `description` varchar(255) DEFAULT NULL,
                    `price` decimal(10,0) NOT NULL,
                    `favourite` tinyint(1) NOT NULL DEFAULT '0',
                    `active` tinyint(1) NOT NULL DEFAULT '1',
                    `type` enum('summer','trimester') DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `title_UNIQUE` (`title`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12
            ");
            
            $this->execute("
                    INSERT INTO `seminar` (`id`, `title`, `description`, `price`, `favourite`, `active`, `type`) VALUES
                    (9, 'hillview', 'Writing Workouts at Hillview', 2, 1, 1, 'trimester'),
                    (10, 'knoll', 'Oak Knoll Creative Writing ', 3, 1, 1, 'trimester'),
                    (13,'Test Prep Boot Camp',NULL,275,0,1,'summer'),
                    (14,'Crafting  the personal essay statement',NULL,275,0,1,'summer'),
                    (15,'Of myths and monsters',NULL,275,1,1,'summer'),
                    (16,'Going to the dogs',NULL,275,1,1,'summer'),
                    (17,'Make‘em laugh',NULL,275,0,1,'summer'),
                    (18,'The power of story',NULL,275,0,1,'summer'),
                    (19,'Intro to literary analysis',NULL,275,0,1,'summer')
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `seminar_grade` (
                    `seminar_id` int(11) unsigned NOT NULL,
                    `grade_id` int(11) unsigned NOT NULL,
                    PRIMARY KEY (`seminar_id`,`grade_id`),
                    KEY `fk_seminar_has_grade_grade1` (`grade_id`),
                    KEY `fk_seminar_has_grade_seminar1` (`seminar_id`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
            ");
            
            $this->execute("
                    INSERT INTO `seminar_grade` (`seminar_id`, `grade_id`) VALUES
                    (9, 11),
                    (10, 11),
                    (9, 12),
                    (10, 12),
                    (11, 12),
                    (15,13),(16,13),(17,13),
                    (18,13),(19,13),(13,14),
                    (14,14),(14,15),(13,17),
                    (18,17),(15,18),(16,18),
                    (17,18),(13,19),(14,20)
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `student` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `name` varchar(255) DEFAULT NULL,
                    `created` datetime DEFAULT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9
            ");

            $this->execute("
                    INSERT INTO `student` (`id`, `name`, `created`) VALUES
                    (1, 'student name', '2014-05-07 17:37:28'),
                    (2, 'student name', '2014-05-07 19:40:46'),
                    (3, 'student name', '2014-05-08 14:27:56'),
                    (4, 'student name', '2014-05-08 14:36:11'),
                    (5, 'student name', '2014-05-08 14:36:52'),
                    (6, 'My name', '2014-05-08 16:55:37'),
                    (7, 'My name', '2014-05-08 16:56:03'),
                    (8, 'student name', '2014-05-12 12:03:08')
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `student_seminars` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `student_id` int(11) unsigned NOT NULL,
                    `seminar_id` int(11) unsigned NOT NULL,
                    `grade_id` int(11) unsigned NOT NULL,
                    `time_slot_id` int(11) unsigned DEFAULT NULL,
                    `date_period_id` int(11) unsigned DEFAULT NULL,
                    `enroll_form_id` int(11) NOT NULL,
                    `order_id` int(11) unsigned NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `fk_user_seminar_user1` (`student_id`),
                    KEY `fk_user_seminar_seminar1` (`seminar_id`),
                    KEY `fk_user_seminar_grade1` (`grade_id`),
                    KEY `fk_user_seminar_time1` (`time_slot_id`),
                    KEY `fk_user_seminar_date_periods1` (`date_period_id`),
                    KEY `fk_student_seminars_enroll_forms1_idx` (`enroll_form_id`),
                    KEY `fk_student_seminars_payments1_idx` (`order_id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9
            ");

            $this->execute("
                    INSERT INTO `student_seminars` (`id`, `student_id`, `seminar_id`, `grade_id`, `time_slot_id`, `date_period_id`, `enroll_form_id`, `order_id`) VALUES
                    (1, 1, 9, 12, NULL, NULL, 1, 1),
                    (2, 2, 9, 12, NULL, NULL, 2, 2),
                    (3, 3, 9, 12, NULL, NULL, 3, 3),
                    (4, 4, 9, 12, NULL, NULL, 4, 4),
                    (5, 5, 9, 12, NULL, NULL, 5, 5),
                    (6, 6, 10, 11, NULL, NULL, 6, 6),
                    (7, 7, 10, 11, NULL, NULL, 7, 7),
                    (8, 8, 9, 12, NULL, NULL, 8, 8)
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `tbl_migration` (
                    `version` varchar(255) NOT NULL,
                    `apply_time` int(11) DEFAULT NULL,
                    PRIMARY KEY (`version`)
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ");
            
            $this->execute("
                    CREATE TABLE IF NOT EXISTS `time_slot` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `start_time` time DEFAULT NULL,
                    `end_time` time DEFAULT NULL,
                    `seminar_id` int(11) unsigned NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `fk_time_seminar1` (`seminar_id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21
            ");
            
            $this->execute("
                    INSERT INTO `time_slot` (`id`, `start_time`, `end_time`, `seminar_id`) VALUES
                    (18, '12:30:00', '13:30:00', 9),
                    (19, '14:30:00', '16:00:00', 10),
                    (22,'09:30:00','12:00:00',13),(23,'14:00:00','16:30:00',13),
                    (24,'09:30:00','12:00:00',14),(25,'14:00:00','16:30:00',14),
                    (26,'09:30:00','12:00:00',15),(27,'14:00:00','16:30:00',15),
                    (28,'09:30:00','12:00:00',16),(29,'14:00:00','16:30:00',16),
                    (30,'09:30:00','12:00:00',17),(31,'14:00:00','16:30:00',17),
                    (32,'09:30:00','12:00:00',18),(33,'14:00:00','16:30:00',18),
                    (34,'09:30:00','12:00:00',19),(35,'14:00:00','16:30:00',19)
            ");
            
            $this->execute("
                    ALTER TABLE `date_periods`
                        ADD CONSTRAINT `fk_date_periods_seminar1` FOREIGN KEY (`seminar_id`) REFERENCES `seminar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `enroll_forms`
                        ADD CONSTRAINT `fk_enroll_forms_forms1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `enroll_form_hillview`
                        ADD CONSTRAINT `fk_enroll_form_hillview_enroll_forms1` FOREIGN KEY (`enroll_form_id`) REFERENCES `enroll_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_enroll_form_hillview_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `enroll_form_knoll`
                        ADD CONSTRAINT `fk_enroll_form_hillview_enroll_forms10` FOREIGN KEY (`enroll_form_id`) REFERENCES `enroll_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_enroll_form_knoll_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `enroll_form_summer`
                        ADD CONSTRAINT `fk_enroll_form_hillview_enroll_forms100` FOREIGN KEY (`enroll_form_id`) REFERENCES `enroll_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_enroll_form_summer_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `seminar_grade`
                        ADD CONSTRAINT `fk_seminar_has_grade_seminar1` FOREIGN KEY (`seminar_id`) REFERENCES `seminar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_seminar_has_grade_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `student_seminars`
                        ADD CONSTRAINT `fk_user_seminar_user1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_user_seminar_seminar1` FOREIGN KEY (`seminar_id`) REFERENCES `seminar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_user_seminar_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_user_seminar_time1` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_user_seminar_date_periods1` FOREIGN KEY (`date_period_id`) REFERENCES `date_periods` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_student_seminars_enroll_forms1` FOREIGN KEY (`enroll_form_id`) REFERENCES `enroll_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_student_seminars_payments1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ");
            
            $this->execute("
                    ALTER TABLE `time_slot`
                        ADD CONSTRAINT `fk_time_seminar1` FOREIGN KEY (`seminar_id`) REFERENCES `seminar` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ");
            
            
            
	}

	public function down()
	{
		echo "m140513_135632_db_update does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}