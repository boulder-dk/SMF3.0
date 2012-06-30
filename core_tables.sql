#
# Encoding: Unicode (UTF-8)
#

DROP TABLE IF EXISTS `acl_privileges`;
CREATE TABLE `acl_privileges` (
  `id_privilege` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `privilege_module` varchar(255) NOT NULL,
  `privilege_name` varchar(255) NOT NULL,
  `privilege_group` varchar(255),
  `privilege_user` int(8) unsigned NOT NULL DEFAULT 0,
  `privilege_allow` int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_privilege`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

# ------------------------------------------------------------------
# Optional

DROP TABLE IF EXISTS `acl_roles`;

CREATE TABLE `acl_roles` (
  `id_role` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `role_inherits` varchar(255) NOT NULL,
  `role_module` int(4) unsigned NOT NULL DEFAULT 0,
  `role_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `acl_roles`
	(`id_role`, `role_name`, `role_inherits`, `role_module`, `role_title`)
VALUES
	(1, 'admin', '', 0, 'Administrator'),
	(2, 'member', '', 0, 'Member');

# ------------------------------------------------------------------

DROP TABLE IF EXISTS `api_hooks`;

CREATE TABLE `api_hooks` (
  `id_api_hook` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `api_hook_namespace` varchar(255) NOT NULL,
  `api_hook_name` varchar(255) NOT NULL,
  `api_hook_callback` varchar(255) NOT NULL,
  `api_hook_owner` varchar(255) NOT NULL,
  `api_hook_enabled` int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_api_hook`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `api_hooks`
    (`id_api_hook`, `api_hook_namespace`, `api_hook_name`, `api_hook_callback`, `api_hook_owner`, `api_hook_enabled`)
VALUES
    (1, 'core', 'user-search', 'Core_API,userSearch', 'com.fustrate.core', 1);

# ------------------------------------------------------------------

DROP TABLE IF EXISTS `hooks`;

CREATE TABLE `hooks` (
  `id_hook` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_namespace` varchar(255) NOT NULL,
  `hook_name` varchar(255) NOT NULL,
  `hook_callback` varchar(255) NOT NULL,
  `hook_owner` varchar(255) NOT NULL,
  `hook_enabled` int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_hook`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

# ------------------------------------------------------------------

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id_module` int(4) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `module_url` varchar(255) NOT NULL,
  `module_identifier` varchar(255) NOT NULL,
  `module_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

# ------------------------------------------------------------------

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id_route` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `route_url` varchar(255) NOT NULL,
  `route_module` int(4) unsigned NOT NULL,
  `route_parent` int(8) unsigned NOT NULL DEFAULT 0,
  `route_title` varchar(255) NOT NULL,
  `route_method` varchar(255) NOT NULL,
  `route_default` int(1) unsigned NOT NULL DEFAULT 0,
  `route_visible` int(1) unsigned NOT NULL DEFAULT 1,
  `route_allowed_roles` varchar(255) NOT NULL,
  `route_order` int(2) unsigned NOT NULL DEFAULT 99,
  PRIMARY KEY (`id_route`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

# ------------------------------------------------------------------

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id_theme` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL,
  `theme_dir` varchar(255) NOT NULL,
  `theme_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `themes`
	(`id_theme`, `theme_name`, `theme_dir`, `theme_class`)
VALUES
	(1, 'Default', 'default', 'DefaultTheme');

# ------------------------------------------------------------------