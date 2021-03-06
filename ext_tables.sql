#
# Table structure for table 'tx_techradar_domain_model_techradar'
#
CREATE TABLE tx_techradar_domain_model_techradar (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  title varchar(255) DEFAULT '' NOT NULL,
  title_slug varchar(255) DEFAULT '' NOT NULL,
  subtitle varchar(255) DEFAULT '' NOT NULL,
  slugadditional varchar(255) DEFAULT '' NOT NULL,
  teaser text NOT NULL,
  bodytext text NOT NULL,
  bodytext2 text NOT NULL,
  visible int(11) unsigned DEFAULT '0' NOT NULL,
  icon varchar(255) DEFAULT '' NOT NULL,
  tags varchar(255) DEFAULT '' NOT NULL,
  status varchar(255) DEFAULT '' NOT NULL,
  quadrant varchar(255) DEFAULT '' NOT NULL,
  area varchar(255) DEFAULT '' NOT NULL,
  level varchar(255) DEFAULT '' NOT NULL,
  mediabgcolor varchar(255) DEFAULT '' NOT NULL,
  cpid varchar(255) DEFAULT '' NOT NULL,
  baseurl varchar(255) DEFAULT '' NOT NULL,
  url varchar(255) DEFAULT '' NOT NULL,
  media int(11) unsigned DEFAULT '0' NOT NULL,
  promotiomedia int(11) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	fe_group varchar(100) DEFAULT '0' NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_techradar_domain_model_lernplan'
#
CREATE TABLE tx_techradar_domain_model_lernplan (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  title varchar(255) DEFAULT '' NOT NULL,
  title_slug varchar(255) DEFAULT '' NOT NULL,
  subtitle varchar(255) DEFAULT '' NOT NULL,
  slugadditional varchar(255) DEFAULT '' NOT NULL,
  teaser text NOT NULL,
  bodytext text NOT NULL,
  bodytext2 text NOT NULL,
  visible int(11) unsigned DEFAULT '0' NOT NULL,
  icon varchar(255) DEFAULT '' NOT NULL,
  tags varchar(255) DEFAULT '' NOT NULL,
  status varchar(255) DEFAULT '' NOT NULL,
  quadrant varchar(255) DEFAULT '' NOT NULL,
  area varchar(255) DEFAULT '' NOT NULL,
  level varchar(255) DEFAULT '' NOT NULL,
  mediabgcolor varchar(255) DEFAULT '' NOT NULL,
  cpid varchar(255) DEFAULT '' NOT NULL,
  baseurl varchar(255) DEFAULT '' NOT NULL,
  url varchar(255) DEFAULT '' NOT NULL,
  media int(11) unsigned DEFAULT '0' NOT NULL,
  promotiomedia int(11) unsigned DEFAULT '0' NOT NULL,
  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	fe_group varchar(100) DEFAULT '0' NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 	KEY language (l10n_parent,sys_language_uid)
);

CREATE TABLE tx_techradar_domain_model_filereference (
  uid_local int(11) unsigned DEFAULT '0' NOT NULL,
  uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
  media int(11) unsigned DEFAULT '0' NOT NULL,
  pid int(11) unsigned DEFAULT '0' NOT NULL,
  original_file_identifier int(11) unsigned DEFAULT '0' NOT NULL
);