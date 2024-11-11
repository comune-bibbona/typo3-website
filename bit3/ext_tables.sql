#
# Aggiunto campi a pages per gestire attributo data-element del link e il JSON Array dei servizi
#
CREATE TABLE pages (
    data_element varchar(255) DEFAULT '' NOT NULL,
    lat double DEFAULT '0' NOT NULL,
    lng double DEFAULT '0' NOT NULL,
    areaServed_name varchar(255) DEFAULT '' NOT NULL,
    audience_audienceType varchar(255) DEFAULT '' NOT NULL,
    serviceLocation_name varchar(255) DEFAULT '' NOT NULL,
    serviceLocation_address_streetAdress varchar(255) DEFAULT '' NOT NULL,
    serviceLocation_address_postalCode varchar(255) DEFAULT '' NOT NULL,
    serviceLocation_address_addressLocality varchar(255) DEFAULT '' NOT NULL,
);

#
# Aggiunto il campo child_item per gestire IRRE di accordion, tab e timeline
#
CREATE TABLE tt_content (
    child_item int(11) unsigned DEFAULT '0',
    timeline_item int(11) unsigned DEFAULT '0',
    data_element varchar(255) DEFAULT '' NOT NULL,
);

#
# Table structure for table 'tx_news_domain_model_news '
#
CREATE TABLE tx_news_domain_model_news (
   price mediumtext,
);

#
# Table structure for table 'tx_bit3_child_item'
#
CREATE TABLE tx_bit3_child_item (
   uid int(11) unsigned NOT NULL auto_increment,
   pid int(11) DEFAULT '0' NOT NULL,
   tt_content int(11) unsigned DEFAULT '0',
   header varchar(255) DEFAULT '' NOT NULL,
   bodytext mediumtext,
   tstamp int(11) unsigned DEFAULT '0' NOT NULL,
   crdate int(11) unsigned DEFAULT '0' NOT NULL,
   cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
   deleted smallint unsigned DEFAULT '0' NOT NULL,
   hidden smallint unsigned DEFAULT '0' NOT NULL,
   starttime int(11) unsigned DEFAULT '0' NOT NULL,
   endtime int(11) unsigned DEFAULT '0' NOT NULL,
   sorting int(11) DEFAULT '0' NOT NULL,

   sys_language_uid int(11) DEFAULT '0' NOT NULL,
   l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
   l10n_diffsource mediumblob NULL,

   t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
   t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
   t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
   t3ver_label varchar(255) DEFAULT '' NOT NULL,
   t3ver_state smallint DEFAULT '0' NOT NULL,
   t3ver_stage int(11) DEFAULT '0' NOT NULL,
   t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
   t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
   t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
   t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

   PRIMARY KEY (uid),
   KEY parent (pid),
   KEY t3ver_oid (t3ver_oid,t3ver_wsid),
   KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_bit3_timeline_item'
#
CREATE TABLE tx_bit3_timeline_item (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext mediumtext,
    date int(10) unsigned DEFAULT '0' NOT NULL,
    durata int(11) unsigned DEFAULT '0' NOT NULL,
    unitaditempo varchar(255) DEFAULT '' NOT NULL,
    link varchar(1024) DEFAULT '' NOT NULL,
    categories int(10) unsigned,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);

#
# Aggiunto il campo layout per gestire le varianti bootstrap italia delle immagini
#
CREATE TABLE sys_file_reference (
    layout tinyint(4) DEFAULT '0' NOT NULL
);