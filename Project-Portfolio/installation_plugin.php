<?php

global $version;
$version = "3.0";

// Installation Function
function esp_favicon_install()
{
    global $version, $wpdb;

	if (!version_compare($version, '3.0', '>=')) {

        error_log('Please install version greater than 3.0');
        echo 'Please install version greater than 3.0';
    }

    $projectPortFolioTable = $wpdb->prefix . "project_portfolio";
    $createTableSql = "CREATE TABLE `{$projectPortFolioTable}` (
                        `project_portfolio_id` TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                        `project_name` VARCHAR( 100 ) NULL ,
                        `project_image` VARCHAR( 100 ) NULL ,
                        `project_link` TEXT NULL ,
                        `update_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
                        ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

    $insertSql = "INSERT INTO `{$projectPortFolioTable}` (`project_portfolio_id`, `project_name`, `project_image`, `project_link`, `update_date`) VALUES ('1', NULL, NULL, NULL, '0000-00-00 00:00:00'), ('2', NULL, NULL, NULL, '0000-00-00 00:00:00'), ('3', NULL, NULL, NULL, '0000-00-00 00:00:00'), ('4', NULL, NULL, NULL, '0000-00-00 00:00:00'), ('5', NULL, NULL, NULL, '0000-00-00 00:00:00');";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($createTableSql);
    dbDelta($insertSql);
}

// Un-installation Function
function esp_project_portfolio_uninstall()
{
    global $wpdb;

    $projectPortFolioTable = $wpdb->prefix . "project_portfolio";

    if ($wpdb->get_var("show tables like '{$projectPortFolioTable}'") == $projectPortFolioTable) {
        $sql = "DROP TABLE {$projectPortFolioTable}";
        $wpdb->query($sql);
    }
}