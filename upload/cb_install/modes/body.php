<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    $cache_key = DEVELOPMENT_MODE ? time() : str_replace('.', '', Update::getInstance()->getCurrentCoreVersion()) . Update::getInstance()->getCurrentCoreRevision();
    ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>ClipBucket v<?php echo Update::getInstance()->getCurrentCoreVersion(); ?> Installer</title>
        <link href="./style<?php if(!DEVELOPMENT_MODE) echo '.min'?>.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="/vendor/components/jquery/jquery.min.js?v=<?php echo $cache_key; ?>"></script>
        <script type="text/javascript" src="/vendor/select2/select2/dist/js/select2.min.js?v=<?php echo $cache_key; ?>"></script>
        <script type="text/javascript" src="./functions<?php if(!DEVELOPMENT_MODE) echo '.min'?>.js?v=<?php echo $cache_key; ?>"></script>
        <link href="./bootstrap/css/bootstrap-theme.min.css?v=<?php echo $cache_key; ?>" rel="stylesheet" type="text/css"/>
        <link href="./bootstrap/css/bootstrap.min.css?v=<?php echo $cache_key; ?>" rel="stylesheet" type="text/css"/>
        <link href="/vendor/fortawesome/font-awesome/css/font-awesome.min.css?v=<?php echo $cache_key; ?>" rel="stylesheet" type="text/css"/>
        <link href="/vendor/select2/select2/dist/css/select2.min.css?v=<?php echo $cache_key; ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div class="top clearfix">
        <div class="top_tabs">
            <ul>
                <li><a href="https://github.com/MacWarrior/clipbucket-v5/issues" target="_blank">Bug Report</a></li>
            </ul>
        </div>
        <p></p> <span id="logo"><span style="color:#09c;">ClipBucketV5</span> Installer v<?php echo Update::getInstance()->getCurrentCoreVersion() . ' - Revision ' . Update::getInstance()->getCurrentCoreRevision(); ?></span>
        <p></p>
    </div>

    <div class="top_nav" style="height:35px;">
        <div class="cb_container">
            <div class="cb_navbar">
                <ul>
                    <li <?php echo selected('agreement'); ?>><?php echo($has_translation ? lang('agreement') : 'Agreement'); ?></li>
                    <li <?php echo selected('precheck'); ?>> <?php echo($has_translation ? lang('pre_check') : 'Pre Check'); ?><span></span></li>
                    <?php if ($need_update || ($_SESSION['needed_update']??false)) { ?><li <?php echo selected('update'); ?>> <?php echo($has_translation ? lang('update') : 'Update'); ?><span></span></li><?php } ?>
                    <li <?php echo selected('permission'); ?>> <?php echo($has_translation ? lang('permission') : 'Permissions'); ?><span></span></li>
                    <li <?php echo selected('database'); ?>> <?php echo($has_translation ? lang('database') : 'Database'); ?><span></span></li>
                    <li <?php echo selected('dataimport'); ?>> <?php echo($has_translation ? lang('data_import') : 'Data import'); ?><span></span></li>
                    <li <?php echo selected('sitesettings'); ?>> <?php echo($has_translation ? lang('site_setting') : 'Site Settings'); ?><span></span></li>
                    <li <?php echo selected('adminsettings'); ?>> <?php echo($has_translation ? lang('admin_account') : 'Admin account'); ?><span></span></li>
                    <li <?php echo selected('finish'); ?>> <?php echo($has_translation ? lang('finish') : 'Finish'); ?><span></span></li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    switch ($mode) {
        case 'agreement':
        case 'precheck':
        case 'update':
        case 'permission':
        case 'database':
        case 'dataimport':
        case 'adminsettings':
        case 'sitesettings':
        case 'finish':
        case 'lock':
            include_once(__DIR__ . '/' . $mode . '.php');
            break;
        default:
            var_dump($mode);
    }
    ?>
    </body>
</html>