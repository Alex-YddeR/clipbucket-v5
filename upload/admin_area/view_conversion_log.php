<?php
global $userquery, $pages, $myquery;
require_once '../includes/admin_config.php';
$userquery->admin_login_check();
$userquery->login_check('video_moderation');
$pages->page_redir();

$file_name = $_GET['file_name'];
$data = get_basic_video_details_from_filename($file_name);

/* Generating breadcrumb */
global $breadcrumb;
$breadcrumb[0] = ['title' => lang('videos'), 'url' => ''];
$breadcrumb[1] = ['title' => lang('videos_manager'), 'url' => ADMIN_BASEURL . '/video_manager.php'];
$breadcrumb[2] = ['title' => 'Editing : ' . display_clean($data['title']), 'url' => ADMIN_BASEURL . '/edit_video.php?video=' . display_clean($data['videoid'])];
$breadcrumb[3] = ['title' => 'Conversion logs', 'url' => ADMIN_BASEURL . '/view_conversion_log.php?file_name=' . display_clean($file_name)];

$file_details = $myquery->file_details($file_name);
if ($file_details) {
    $fileDetailsArray = explode("\n", $file_details);
    $file_details = implode('<br>', $fileDetailsArray);

    $video_details = '[]';
    $start = 0;
    foreach ($fileDetailsArray as $key => $value) {
        if ($start) {
            $start++;
        }

        if ($value == 'videoDetails') {
            $start = 1;
        }

        if ($start == 3) {
            $video_details = $value;
        }
    }
    $videoDetails = json_decode($video_details);
    $videoDetails['file_name'] = $file_name;

    assign('data', $file_details);
    assign('videoDetails', $videoDetails);
}

subtitle("Conversion Log");
template_files('view_conversion_log.html');
display_it();
