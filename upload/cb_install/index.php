<?php
define('THIS_PAGE', 'cb_install');
include_once('../includes/clipbucket.php');

$modes = [
    'agreement',
    'precheck',
    'permission',
    'database',
    'dataimport',
    'adminsettings',
    'sitesettings',
    'finish'
];

$mode = $_POST['mode'] ?? false;

if (!$mode || !in_array($mode, $modes)) {
    $mode = 'agreement';
}

/**
 * Clipbucket modes
 * modes which requires clipbucket core files so installer
 * function file does not create a conflict
 */
$cbarray = ['adminsettings', 'sitesettings', 'finish'];
$baseDir = dirname(dirname(__FILE__));

if (in_array($mode, $cbarray)) {
    chdir('..');
    require_once 'includes/config.inc.php';
    chdir('cb_install');
}

include('functions.php');
include('modes/body.php');
