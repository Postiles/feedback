CREATE TABLE IF NOT EXISTS `feedback` (
  `server_timestamp` datetime NOT NULL,
  `client_timestamp` int(10) unsigned NOT NULL,
  `error_list` text NOT NULL,
  `user_agent` tinytext NOT NULL,
  `location` text NOT NULL,
  `ip` tinytext NOT NULL,
  `description` text NOT NULL,
  `mail` tinytext NOT NULL,
  `image` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;