#
#<?php die('Forbidden.'); ?>
#Date: 2020-11-14 22:40:23 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2020-11-14T22:40:23+00:00	INFO ::1	update	Update started by user Super User (906). Old version is 3.9.12.
2020-11-14T22:40:29+00:00	INFO ::1	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.9.22-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20201114%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20201114T224021Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=35977edcf1e54744da1187e1ca734c6ee977e29388ef31bbbbc0fb1919d5cfc6.
2020-11-14T22:40:52+00:00	INFO ::1	update	File Joomla_3.9.22-Stable-Update_Package.zip downloaded.
2020-11-14T22:40:52+00:00	INFO ::1	update	Starting installation of new version.
2020-11-14T22:44:16+00:00	INFO ::1	update	Finalising installation.
2020-11-14T22:44:19+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__categories` MODIFY `description` mediumtext;.
2020-11-14T22:44:21+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__categories` MODIFY `params` text;.
2020-11-14T22:44:22+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__fields` MODIFY `default_value` text;.
2020-11-14T22:44:23+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__fields_values` MODIFY `value` text;.
2020-11-14T22:44:23+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__finder_links` MODIFY `description` text;.
2020-11-14T22:44:26+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__modules` MODIFY `content` text;.
2020-11-14T22:44:29+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_body` mediumtext;.
2020-11-14T22:44:32+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_params` text;.
2020-11-14T22:44:36+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_images` text;.
2020-11-14T22:44:39+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_urls` text;.
2020-11-14T22:44:42+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metakey` text;.
2020-11-14T22:44:47+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadesc` text;.
2020-11-14T22:44:47+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-03-04. Query text: ALTER TABLE `#__users` DROP INDEX `username`;.
2020-11-14T22:44:48+00:00	INFO ::1	update	Ran query from file 3.9.16-2020-03-04. Query text: ALTER TABLE `#__users` ADD UNIQUE INDEX `idx_username` (`username`);.
2020-11-14T22:44:48+00:00	INFO ::1	update	Ran query from file 3.9.19-2020-05-16. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_title` varchar(400) NOT NULL DEFAULT '.
2020-11-14T22:44:48+00:00	INFO ::1	update	Ran query from file 3.9.19-2020-06-01. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2020-11-14T22:44:48+00:00	INFO ::1	update	Ran query from file 3.9.21-2020-08-02. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2020-11-14T22:44:48+00:00	INFO ::1	update	Ran query from file 3.9.22-2020-09-16. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2020-11-14T22:44:49+00:00	INFO ::1	update	Deleting removed files and folders.
2020-11-14T22:45:23+00:00	INFO ::1	update	Cleaning up after installation.
2020-11-14T22:45:23+00:00	INFO ::1	update	Update to version 3.9.22 is complete.
