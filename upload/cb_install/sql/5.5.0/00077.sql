ALTER TABLE `{tbl_prefix}video`
    MODIFY COLUMN `datecreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;