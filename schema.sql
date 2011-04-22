-- unsyCMS install

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(65) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `datetime` varchar(65) NOT NULL,
  `npost` int(4) default NULL,
  `rank` int(4) default NULL,
  `email` varchar(40) default NULL,
  `website` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `keyword` text NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(4) NOT NULL auto_increment,
  `author` varchar(65) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `category` varchar(65) NOT NULL,
  `testo` text NOT NULL,
  `preview` text NOT NULL,
  `datetime` date NOT NULL default '2010-01-01',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(65) NOT NULL default '',
  `passwd` varchar(40) NOT NULL default '',
  `session_id` varchar(40) NOT NULL default '',
  `grade` int(4) NOT NULL default '1',
  `email` varchar(65) NOT NULL default '',
  `ip` varchar(30) NOT NULL default '',
  `last_visit` varchar(65) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Inserimento dell'amministratore
--

INSERT INTO `users` ('name', 'passwd') VALUES ('nome', 'password criptata');