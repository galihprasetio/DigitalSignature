/* SQL Manager Lite for MySQL                              5.7.2.52112 */
/* ------------------------------------------------------------------- */
/* Host     : localhost                                                */
/* Port     : 3306                                                     */
/* Database : themes                                                   */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

SET FOREIGN_KEY_CHECKS=0;

/* Dropping database objects */

DROP PROCEDURE IF EXISTS `doc_update_next_approval`;
DROP PROCEDURE IF EXISTS `doc_update_document_approval`;
DROP FUNCTION IF EXISTS `generate_doc`;
DROP FUNCTION IF EXISTS `doc_get_first_approval`;
DROP TABLE IF EXISTS `work_flow_detail`;
DROP TABLE IF EXISTS `work_flow`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `section`;
DROP TABLE IF EXISTS `role_has_permissions`;
DROP TABLE IF EXISTS `province`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
DROP TABLE IF EXISTS `oauth_clients`;
DROP TABLE IF EXISTS `oauth_auth_codes`;
DROP TABLE IF EXISTS `oauth_access_tokens`;
DROP TABLE IF EXISTS `model_has_roles`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `model_has_permissions`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `migrations`;
DROP TABLE IF EXISTS `history_document`;
DROP TABLE IF EXISTS `documents`;
DROP TABLE IF EXISTS `document_approval`;
DROP TABLE IF EXISTS `department`;

/* Structure for the `department` table : */

CREATE TABLE `department` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `department` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=16 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `document_approval` table : */

CREATE TABLE `document_approval` (
  `id_document` INTEGER(11) NOT NULL,
  `id_user` INTEGER(11) NOT NULL,
  `status` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_action` DATETIME NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `documents` table : */

CREATE TABLE `documents` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doc_number` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_type` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_submit_date` DATETIME DEFAULT NULL,
  `doc_status_number` INTEGER(11) DEFAULT NULL,
  `doc_author` INTEGER(11) DEFAULT NULL,
  `doc_status` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_subject` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_current_author` INTEGER(11) DEFAULT NULL,
  `doc_body` TEXT COLLATE utf8mb4_unicode_ci,
  `doc_file` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `history_document` table : */

CREATE TABLE `history_document` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_document` INTEGER(11) DEFAULT NULL,
  `id_user` INTEGER(11) DEFAULT NULL,
  `activity` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentar` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_date` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=35 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `migrations` table : */

CREATE TABLE `migrations` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=22 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `permissions` table : */

CREATE TABLE `permissions` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=85 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `model_has_permissions` table : */

CREATE TABLE `model_has_permissions` (
  `permission_id` INTEGER(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`permission_id`, `model_id`, `model_type`),
  KEY `model_has_permissions_model_id_model_type_index` USING BTREE (`model_id`, `model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `roles` table : */

CREATE TABLE `roles` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=10 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `model_has_roles` table : */

CREATE TABLE `model_has_roles` (
  `role_id` INTEGER(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`role_id`, `model_id`, `model_type`),
  KEY `model_has_roles_model_id_model_type_index` USING BTREE (`model_id`, `model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oauth_access_tokens` table : */

CREATE TABLE `oauth_access_tokens` (
  `id` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` INTEGER(11) DEFAULT NULL,
  `client_id` INTEGER(10) UNSIGNED NOT NULL,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` TEXT COLLATE utf8mb4_unicode_ci,
  `revoked` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `oauth_access_tokens_user_id_index` USING BTREE (`user_id`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oauth_auth_codes` table : */

CREATE TABLE `oauth_auth_codes` (
  `id` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` INTEGER(11) NOT NULL,
  `client_id` INTEGER(10) UNSIGNED NOT NULL,
  `scopes` TEXT COLLATE utf8mb4_unicode_ci,
  `revoked` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oauth_clients` table : */

CREATE TABLE `oauth_clients` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INTEGER(11) DEFAULT NULL,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` TINYINT(1) NOT NULL,
  `password_client` TINYINT(1) NOT NULL,
  `revoked` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `oauth_clients_user_id_index` USING BTREE (`user_id`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oauth_personal_access_clients` table : */

CREATE TABLE `oauth_personal_access_clients` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` INTEGER(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `oauth_personal_access_clients_client_id_index` USING BTREE (`client_id`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oauth_refresh_tokens` table : */

CREATE TABLE `oauth_refresh_tokens` (
  `id` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` USING BTREE (`access_token_id`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `password_resets` table : */

CREATE TABLE `password_resets` (
  `email` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  KEY `password_resets_email_index` USING BTREE (`email`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `province` table : */

CREATE TABLE `province` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=98 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `role_has_permissions` table : */

CREATE TABLE `role_has_permissions` (
  `permission_id` INTEGER(10) UNSIGNED NOT NULL,
  `role_id` INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`permission_id`, `role_id`),
  KEY `role_has_permissions_role_id_foreign` USING BTREE (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `section` table : */

CREATE TABLE `section` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_department` INTEGER(11) DEFAULT NULL,
  `section` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=14 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `sessions` table : */

CREATE TABLE `sessions` (
  `id` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `ip_address` VARCHAR(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` TEXT COLLATE utf8mb4_unicode_ci,
  `payload` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` INTEGER(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` USING BTREE (`id`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `users` table : */

CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_department` INTEGER(11) DEFAULT NULL,
  `id_section` INTEGER(11) DEFAULT NULL,
  `tittle` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateofbirth` DATE DEFAULT NULL,
  `office_phone` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell_phone` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_description` TEXT COLLATE utf8mb4_unicode_ci,
  `image` VARCHAR(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign` TEXT COLLATE utf8mb4_unicode_ci,
  `remember_token` VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `users_email_unique` USING BTREE (`email`)
) ENGINE=InnoDB
AUTO_INCREMENT=40 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `work_flow` table : */

CREATE TABLE `work_flow` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=30 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `work_flow_detail` table : */

CREATE TABLE `work_flow_detail` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_work_flow` INTEGER(11) NOT NULL,
  `step_number` INTEGER(11) NOT NULL,
  `status` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sentBack` TINYINT(1) NOT NULL,
  `check` TINYINT(1) NOT NULL,
  `approve` TINYINT(1) NOT NULL,
  `reject` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=29 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Definition for the `doc_get_first_approval` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `doc_get_first_approval`(
        `in_email` VARCHAR(250),
        `in_step_number` INTEGER
    )
    RETURNS VARCHAR(250) CHARACTER SET latin1
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
Declare approval varchar(255);
select `wfd`.author from work_flow_detail wfd
left join work_flow wf
on wfd.`id_work_flow` = wf.id
left join department d
on wf.name = d.`id`
left join users u
on d.id = u.`id_department`
where u.email = in_email
and wfd.step_number = in_step_number into approval;
  RETURN(approval) ;
END$$

DELIMITER ;

/* Definition for the `generate_doc` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `generate_doc`()
    RETURNS VARCHAR(255) CHARACTER SET latin1
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
declare run_number int;
declare code_apps varchar(20);
declare code_years varchar(20);
declare doc_number varchar(255);
select count(*) from `documents` into run_number;
set code_apps = 'DGS';
select YEAR(now()) into code_years;
set doc_number =  concat(run_number,'-',code_apps,'-',code_years);
  RETURN (doc_number) ;
END$$

DELIMITER ;

/* Definition for the `doc_update_document_approval` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `doc_update_document_approval`(
        IN `in_id_document` INTEGER,
        IN `in_id_user` INTEGER,
        IN `in_status` VARCHAR(255),
        IN `in_date_action` DATETIME
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
declare checking INT(11);

select count(*) from 
`document_approval` 
where id_document = in_id_document
and id_user = in_id_user into checking;

if checking < 1 THEN
insert into document_approval(id_document,id_user,status,date_action)
values(in_id_document,in_id_user,in_status,in_date_action);
else
update document_approval set date_action = in_date_action 
where id_document = in_id_document 
and id_user = in_id_user;
end if;
END$$

DELIMITER ;

/* Definition for the `doc_update_next_approval` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `doc_update_next_approval`(
        IN `in_department` VARCHAR(255),
        IN `in_step_number` INTEGER,
        IN `in_doc_number` VARCHAR(255)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
declare author varchar(255);
declare status varchar(255);
declare total_approval int(11);
declare id_approval  int(11);

select wfd.author from work_flow_detail wfd
left join `work_flow` wf
on wf.`id` = wfd.`id_work_flow`
left join `department` d
on `wf`.name = d.id
where d.department = in_department
and wfd.`step_number` = in_step_number + 1 into author;

select wfd.`status` from work_flow_detail wfd
left join `work_flow` wf
on wf.`id` = wfd.`id_work_flow`
left join `department` d
on `wf`.name = d.id
where d.department = in_department
and wfd.`step_number` = in_step_number + 1 into status;

select count(*) from work_flow_detail wfd
left join work_flow wf
on wfd.`id_work_flow`= wf.id
left join department d
on wf.name = d.`id`
where d.department = in_department into total_approval;

IF in_step_number >= total_approval THEN
set status = 'Completed' ;
End if;

select id from users where 
email = author into id_approval;
UPDATE documents
set doc_current_author = id_approval, 
doc_status_number = doc_status_number + 1,
doc_status = status,
updated_at = now()
where doc_number = in_doc_number;
END$$

DELIMITER ;

/* Data for the `department` table  (LIMIT 0,500) */

INSERT INTO `department` (`id`, `department`, `created_at`, `updated_at`) VALUES
  (2,'Engineering Maintenance','2019-07-19 13:26:48','2019-07-22 08:17:57'),
  (3,'Information Technology','2019-07-19 13:27:54','2019-07-19 13:27:54'),
  (4,'Logistic','2019-07-19 13:31:57','2019-07-19 13:31:57'),
  (5,'HRPA','2019-07-19 13:32:07','2019-07-19 13:32:07'),
  (6,'Finance & Accounting','2019-07-19 13:32:31','2019-07-19 13:32:31'),
  (7,'General Affairs','2019-07-19 13:32:46','2019-07-19 13:32:46'),
  (8,'Marketing','2019-07-19 13:32:56','2019-07-19 13:32:56'),
  (9,'Purchasing','2019-07-19 13:33:02','2019-07-19 13:33:02'),
  (10,'Distribution','2019-07-19 13:33:09','2019-07-19 13:33:09'),
  (11,'Shipping & Receiving','2019-07-19 13:33:19','2019-07-19 13:33:19'),
  (12,'Production','2019-07-19 13:33:28','2019-07-19 13:33:28'),
  (13,'Technical','2019-07-19 13:33:38','2019-07-19 13:33:38'),
  (14,'Safety & Environment','2019-07-19 13:33:52','2019-07-19 13:33:52'),
  (15,'Quality Assurance','2019-07-19 13:34:07','2019-07-19 13:34:07');
COMMIT;

/* Data for the `document_approval` table  (LIMIT 0,500) */

INSERT INTO `document_approval` (`id_document`, `id_user`, `status`, `date_action`, `created_at`, `updated_at`) VALUES
  (1,37,'Submited Document','2019-08-30 10:47:00',NULL,NULL),
  (1,38,'Checked Document','2019-08-30 10:47:32',NULL,NULL),
  (1,39,'Approved Document','2019-08-30 10:47:49',NULL,NULL),
  (2,37,'Submited Document','2019-09-09 09:10:39',NULL,NULL),
  (3,37,'Submited Document','2019-09-02 11:13:36',NULL,NULL),
  (3,38,'Checked Document','2019-09-03 07:53:31',NULL,NULL),
  (3,39,'Approved Document','2019-09-03 07:54:12',NULL,NULL),
  (2,38,'Checked Document','2019-09-09 13:00:24',NULL,NULL);
COMMIT;

/* Data for the `documents` table  (LIMIT 0,500) */

INSERT INTO `documents` (`id`, `doc_number`, `doc_type`, `doc_submit_date`, `doc_status_number`, `doc_author`, `doc_status`, `doc_subject`, `doc_current_author`, `doc_body`, `doc_file`, `created_at`, `updated_at`) VALUES
  (1,'0-DGS-2019','Pemberitahuan','2019-08-30 10:46:59',3,37,'Completed','Pemberitahuan Terkait dengan pengiriman paket',NULL,'Perlu kami informasikan bahwa untuk pengiriman Paket PT. Maju Bersama menjelang Libur Hari Raya Idul Fitri, kami berlakukan sistem pengiriman sebagai berikut:\r\n\r\n  1. Batas Terakhir Penerimaan pesanan dan konfirmasi pembayaran adalah tgl 9 Juli 2015 dan akan di lakukan pengiriman pada tanggal 10 Juli 2015 dengan maksimal penyampaian ditujuan tanggal 15 Juli 2015.\r\n  2. Pemesanan dan konfirmasi pembayaran diluar dari Batas Terakhir tersebut (9 Juli 2015) akan dilakukan pengiriman pada Senin tanggal 27 Juli 2015.\r\nSistem ini kami berlakukan untuk menghindari tidak sampai/ hilangnya paket ditengah kesibukan pengiriman JNE sewaktu lebaran.',NULL,'2019-08-30 10:46:59','2019-08-30 10:47:49'),
  (2,'1-DGS-2019','Pemberitahuan','2019-08-30 15:42:09',1,37,'Waiting Accepted Supervisor','Pemberitahuan Terkait dengan pengiriman paketdd',38,'<div>sdgsdgsdg</div><div>sdgsdg</div><div>sdgsdg</div><div>sdg</div><div>sdgs</div>',NULL,'2019-08-30 15:42:09','2019-09-09 13:37:43'),
  (3,'2-DGS-2019','testing document approval','2019-09-02 11:13:36',3,37,'Completed','Delegation of Authority',NULL,'<h2 style=\"color: rgb(10, 10, 8); font-weight: 600; line-height: 1.3; margin: 0px; font-size: 26px; font-family: Lato, Roboto, Arial, Tahoma, sans-serif; padding: 0px;\"><span id=\"HTML5_Textarea_Attributes\">HTML5 Textarea Attributes</span></h2><div>HTML5 introduced a few new attributes which can be used with textarea elements. Here are some of the most important:</div><ul style=\"list-style-position: inside; margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Lato, Roboto, Arial, Tahoma, sans-serif; font-size: 10px;\"><li style=\"list-style-type: none;\"><code style=\"font-family: monospace, monospace; font-size: 10px;\">form</code>: Associates the textarea with a form. Use the ID attribute of the form as the value for the textarea form attributes. This allows you to place a textarea anywhere on a webpage, even outside of the form element, and still have the contents of the textarea included when the form is submitted.</li><li style=\"list-style-type: none;\"><code style=\"font-family: monospace, monospace; font-size: 10px;\">maxlength</code>&nbsp;and&nbsp;<code style=\"font-family: monospace, monospace; font-size: 10px;\">minlength</code>: Used to specify a minimum or maximum number of characters that may be entered into a textarea.</li><li style=\"list-style-type: none;\"><code style=\"font-family: monospace, monospace; font-size: 10px;\">placeholder</code>: Adds placeholder text to the textarea that disappears as soon as a user places the cursor inside of the element.</li><li style=\"list-style-type: none;\"><code style=\"font-family: monospace, monospace; font-size: 10px;\">required</code>: Requires that the textarea contain content prior to allowing form submission.</li><li style=\"list-style-type: none;\"><a href=\"https://html.com/attributes/textarea-wrap/\" style=\"background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(63, 136, 197); transition: all 0.2s ease-in-out 0s;\"><code style=\"font-family: monospace, monospace; font-size: 10px;\">wrap</code></a>: Specifies whether or not hard-returns should be added to the content submitted in a textarea.</li></ul><span style=\"color: rgb(0, 0, 0); font-family: Lato, Roboto, Arial, Tahoma, sans-serif; font-size: 10px;\"><br><br>Read more:&nbsp;<a href=\"https://html.com/tags/textarea/#ixzz5yKytzoAI\" style=\"background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(0, 51, 153); transition: all 0.2s ease-in-out 0s;\">https://html.com/tags/textarea/#ixzz5yKytzoAI</a></span><br>',NULL,'2019-09-02 11:13:36','2019-09-03 07:54:12');
COMMIT;

/* Data for the `history_document` table  (LIMIT 0,500) */

INSERT INTO `history_document` (`id`, `id_document`, `id_user`, `activity`, `commentar`, `activity_date`, `created_at`, `updated_at`) VALUES
  (1,1,37,'Submit Document','','2019-08-30 10:47:00','2019-08-30 10:47:00','2019-08-30 10:47:00'),
  (2,1,38,'Checked Document','','2019-08-30 10:47:32','2019-08-30 10:47:32','2019-08-30 10:47:32'),
  (3,1,39,'Approved Document','','2019-08-30 10:47:49','2019-08-30 10:47:49','2019-08-30 10:47:49'),
  (4,2,37,'Submit Document','','2019-08-30 15:42:09','2019-08-30 15:42:09','2019-08-30 15:42:09'),
  (5,3,37,'Submit Document','','2019-09-02 11:13:36','2019-09-02 11:13:36','2019-09-02 11:13:36'),
  (6,2,38,'Sent Back Document','tolong revisi document attachment','2019-09-02 11:17:07','2019-09-02 11:17:07','2019-09-02 11:17:07'),
  (7,3,38,'Checked Document','','2019-09-03 07:53:31','2019-09-03 07:53:31','2019-09-03 07:53:31'),
  (8,3,39,'Approved Document','','2019-09-03 07:54:12','2019-09-03 07:54:12','2019-09-03 07:54:12'),
  (9,2,37,'Modified Document','','2019-09-09 09:09:45','2019-09-09 09:09:45','2019-09-09 09:09:45'),
  (10,2,37,'Submit Document','','2019-09-09 09:10:39','2019-09-09 09:10:39','2019-09-09 09:10:39'),
  (11,2,38,'Checked Document','','2019-09-09 13:00:24','2019-09-09 13:00:24','2019-09-09 13:00:24'),
  (33,2,39,'Reject Document','','2019-09-09 13:35:38','2019-09-09 13:35:38','2019-09-09 13:35:38'),
  (34,2,39,'Reject Document','Permintaan tidak dapat dipenuhi','2019-09-09 13:37:43','2019-09-09 13:37:43','2019-09-09 13:37:43');
COMMIT;

/* Data for the `migrations` table  (LIMIT 0,500) */

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (1,'2014_10_12_000000_create_users_table',1),
  (2,'2014_10_12_100000_create_password_resets_table',1),
  (3,'2019_06_21_035627_create_permission_tables',2),
  (4,'2016_06_01_000001_create_oauth_auth_codes_table',3),
  (5,'2016_06_01_000002_create_oauth_access_tokens_table',3),
  (6,'2016_06_01_000003_create_oauth_refresh_tokens_table',3),
  (7,'2016_06_01_000004_create_oauth_clients_table',3),
  (8,'2016_06_01_000005_create_oauth_personal_access_clients_table',3),
  (9,'2019_06_24_055317_create_products_table',4),
  (10,'2019_07_16_142936_create_sessions_table',5),
  (11,'2019_07_19_090249_create_department_table',6),
  (12,'2019_07_19_090346_create_section_table',6),
  (13,'2019_07_22_082125_create_section_table',7),
  (14,'2019_07_23_142811_create_province_table',8),
  (15,'2019_07_25_091532_create_documents_table',9),
  (16,'2019_07_25_111345_create_flow_document_table',10),
  (17,'2019_07_25_111418_create_button_type_table',10),
  (18,'2019_07_30_104406_create_work_flow_table',11),
  (19,'2019_07_30_105038_create_work_flow_detail_table',12),
  (20,'2019_08_09_101041_create_history_document',13),
  (21,'2019_08_22_094706_create_document_approval_table',14);
COMMIT;

/* Data for the `permissions` table  (LIMIT 0,500) */

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
  (1,'role-list','web','2019-06-21 04:00:29','2019-06-21 04:00:29'),
  (2,'role-create','web','2019-06-21 04:00:29','2019-06-21 04:00:29'),
  (3,'role-edit','web','2019-06-21 04:00:29','2019-06-21 04:00:29'),
  (4,'role-delete','web','2019-06-21 04:00:29','2019-06-21 04:00:29'),
  (69,'department-list','web','2019-07-19 09:18:40','2019-07-19 09:18:40'),
  (70,'department-create','web','2019-07-19 09:18:40','2019-07-19 09:18:40'),
  (71,'department-edit','web','2019-07-19 09:18:40','2019-07-19 09:18:40'),
  (72,'document-list','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (73,'document-create','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (74,'document-edit','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (75,'user-list','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (76,'user-create','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (77,'user-edit','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (78,'section-list','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (79,'section-edit','web','2019-08-29 08:29:18','2019-08-29 08:29:18'),
  (80,'section-create','web','2019-08-29 08:31:07','2019-08-29 08:31:07'),
  (81,'workflow-list','web','2019-08-29 08:31:07','2019-08-29 08:31:07'),
  (82,'workflow-edit','web','2019-08-29 08:31:07','2019-08-29 08:31:07'),
  (83,'workflow-create','web','2019-08-29 08:31:07','2019-08-29 08:31:07'),
  (84,'user-profile','web','2019-08-29 09:07:01','2019-08-29 09:07:01');
COMMIT;

/* Data for the `roles` table  (LIMIT 0,500) */

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
  (4,'Operator','web','2019-07-12 10:52:01','2019-07-22 07:20:02'),
  (5,'administrator','web','2019-07-19 08:05:44','2019-07-19 08:05:44'),
  (9,'user','web','2019-08-29 08:31:54','2019-08-29 08:31:54');
COMMIT;

/* Data for the `model_has_roles` table  (LIMIT 0,500) */

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
  (5,'App\\User',29),
  (5,'App\\User',37),
  (9,'App\\User',38),
  (9,'App\\User',39);
COMMIT;

/* Data for the `oauth_clients` table  (LIMIT 0,500) */

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
  (1,NULL,'Laravel Personal Access Client','ev8BexYTS0ZxIq1GYLKmYsc8ctvHUgmKS0pU02En','http://localhost',1,0,0,'2019-06-21 04:09:07','2019-06-21 04:09:07'),
  (2,NULL,'Laravel Password Grant Client','li6jrBQ5Jw7NZth78YmYLCAbWmWfV07ZQAjY1EAG','http://localhost',0,1,0,'2019-06-21 04:09:07','2019-06-21 04:09:07');
COMMIT;

/* Data for the `oauth_personal_access_clients` table  (LIMIT 0,500) */

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
  (1,1,'2019-06-21 04:09:07','2019-06-21 04:09:07');
COMMIT;

/* Data for the `password_resets` table  (LIMIT 0,500) */

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
  ('galihprasetio89@gmail.com','$2y$10$btV1y04yeZ7KwtOJHGgNGOAcfYe5OfH1nPups..lOoxJSBr6EJwtq','2019-07-02 08:39:04'),
  ('approvalsupervisor@gmail.com','$2y$10$Veu1ErS7bS0A3ipx1hFmAesv8/qj4NiW5xqYz4XhaOP.cx2tEQF.K','2019-08-15 08:44:30');
COMMIT;

/* Data for the `province` table  (LIMIT 0,500) */

INSERT INTO `province` (`id`, `province`, `created_at`, `updated_at`) VALUES
  (64,'Aceh\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (65,'Bali\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (66,'Banten\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (67,'Bengkulu\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (68,'Gorontalo\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (69,'Jakarta\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (70,'Jambi\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (71,'Jawa Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (72,'Jawa Tengah\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (73,'Jawa Timur\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (74,'Kalimantan Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (75,'Kalimantan Selatan\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (76,'Kalimantan Tengah\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (77,'Kalimantan Timur\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (78,'Kalimantan Utara\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (79,'Kepulauan Bangka Belitung\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (80,'Kepulauan Riau\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (81,'Lampung\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (82,'Maluku\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (83,'Maluku Utara\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (84,'Nusa Tenggara Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (85,'Nusa Tenggara Timur\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (86,'Papua\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (87,'Papua Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (88,'Riau\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (89,'Sulawesi Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (90,'Sulawesi Selatan\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (91,'Sulawesi Tengah\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (92,'Sulawesi Tenggara\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (93,'Sulawesi Utara\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (94,'Sumatera Barat\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (95,'Sumatera Selatan\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (96,'Sumatera Utara\r','2019-07-23 14:44:32','2019-07-23 14:44:32'),
  (97,'Yogyakarta','2019-07-23 14:44:32','2019-07-23 14:44:32');
COMMIT;

/* Data for the `role_has_permissions` table  (LIMIT 0,500) */

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
  (1,5),
  (2,5),
  (3,5),
  (4,5),
  (69,5),
  (70,5),
  (71,5),
  (72,5),
  (72,9),
  (73,5),
  (73,9),
  (74,5),
  (74,9),
  (75,5),
  (75,9),
  (76,5),
  (77,5),
  (78,5),
  (79,5),
  (80,5),
  (81,5),
  (82,5),
  (83,5),
  (84,5),
  (84,9);
COMMIT;

/* Data for the `section` table  (LIMIT 0,500) */

INSERT INTO `section` (`id`, `id_department`, `section`, `created_at`, `updated_at`) VALUES
  (9,3,'Staff IT Infrasturcture','2019-07-22 19:51:29','2019-07-22 19:51:29'),
  (10,3,'Software Development','2019-07-22 19:51:46','2019-08-22 14:32:24'),
  (11,2,'Staff Engineering Mechanical','2019-07-22 19:52:08','2019-07-22 19:52:08'),
  (12,2,'Staff Engineering Electrical','2019-07-22 19:52:26','2019-07-23 13:00:31'),
  (13,3,'Head Department Information Technology','2019-08-19 15:46:53','2019-08-19 15:46:53');
COMMIT;

/* Data for the `users` table  (LIMIT 0,500) */

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_department`, `id_section`, `tittle`, `position`, `dateofbirth`, `office_phone`, `cell_phone`, `region`, `job_description`, `image`, `sign`, `remember_token`, `created_at`, `updated_at`) VALUES
  (37,'Galih Prasetio','galihprasetio89@gmail.com',NULL,'$2y$10$e1t5SSIOYtGsE8lFbQvveuZ/ZP1yTmOjYLvYNH/QpTbjYrKC5U6P.',3,10,'Senior IT','IT Development','2019-08-14','085722427525','85722427525','Jawa Barat','sdgsdgsdg','1567126463.png','data:image/png;base64,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','2019-08-12 10:16:28','2019-08-30 08:27:53'),
  (38,'Supervisor','approvalsupervisor@gmail.com',NULL,'$2y$10$NDluwDEjNN8USVcWRuMk3ehDPPiwm6c0pVgbMnwJGx.AvNFdG4IZK',3,9,'Supervisor Information Technology','Supervisor Information Technology','2019-08-14','085722427525','85722427525','placeholder','Testing','1567126677.png','data:image/png;base64,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',NULL,'2019-08-13 08:46:25','2019-09-02 11:15:58'),
  (39,'Head Department','approvalheaddepartment@gmail.com',NULL,'$2y$10$OHQmt1XbzTiEFLazJoTvEO3Uy314ImIhHFKWrrsawSmORD7PTAQu6',3,9,'Head Department Information Technology','Head Department Information Technology','2019-08-13','085722427525','85722427525','Jawa Barat','dsgsdgsdgsd','1567126660.png','data:image/png;base64,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',NULL,'2019-08-13 08:47:42','2019-08-30 07:57:40');
COMMIT;

/* Data for the `work_flow` table  (LIMIT 0,500) */

INSERT INTO `work_flow` (`id`, `name`, `created_at`, `updated_at`) VALUES
  (27,'3','2019-08-13 08:59:51','2019-08-13 08:59:51'),
  (28,'2','2019-08-21 10:27:10','2019-08-21 10:27:10'),
  (29,'4','2019-08-21 13:43:48','2019-08-21 13:43:48');
COMMIT;

/* Data for the `work_flow_detail` table  (LIMIT 0,500) */

INSERT INTO `work_flow_detail` (`id`, `id_work_flow`, `step_number`, `status`, `author`, `sentBack`, `check`, `approve`, `reject`, `created_at`, `updated_at`) VALUES
  (22,27,1,'Waiting Accepted by Supervisor','approvalsupervisor@gmail.com',1,1,0,0,'2019-08-13 08:59:51','2019-08-21 11:09:51'),
  (23,27,2,'Waiting Accepted Head Department','approvalheaddepartment@gmail.com',1,0,1,1,'2019-08-13 08:59:51','2019-08-13 08:59:51'),
  (24,28,1,'Waiting Accepted by galih','galihprasetio89@gmail.com',1,1,1,1,'2019-08-21 10:27:10','2019-08-21 11:08:33'),
  (25,29,1,'Waiting Accepted by Sr Staff','galihprasetio89@gmail.com',0,0,1,0,'2019-08-21 13:43:48','2019-08-21 13:44:48'),
  (26,29,2,'Waiting Accepted by Supervisor','approvalsupervisor@gmail.com',1,1,1,1,'2019-08-21 13:43:48','2019-08-21 13:43:48'),
  (27,29,3,'Waiting Accepted by Super Intendent','approvalsupervisor@gmail.com',0,1,0,1,'2019-08-21 13:43:48','2019-08-21 13:45:42'),
  (28,29,4,'Waiting Accepted by Head Department','approvalheaddepartment@gmail.com',1,0,1,0,'2019-08-21 13:43:48','2019-08-21 13:46:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;