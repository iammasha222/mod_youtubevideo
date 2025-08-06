<?php
require(__DIR__.'/../../config.php');

$id = required_param('id', PARAM_INT); // get activity id from the course

// get data about module
$cm = get_coursemodule_from_id('youtubevideo', $id, 0, false, MUST_EXIST); // get info about activity
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$youtubevideo = $DB->get_record('youtubevideo', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);

$PAGE->set_url('/mod/youtubevideo/view.php', ['id' => $id]); // set current page url
$PAGE->set_title($youtubevideo->name); // set page title
$PAGE->set_heading($course->fullname); // set page heading

echo $OUTPUT->header();
echo $OUTPUT->heading($youtubevideo->name);

echo format_module_intro('youtubevideo', $youtubevideo, $cm->id); // show mod description 

// convert browser URL to embedded URL
function convert_to_embed_url($url) {
    // browser URL
    if (preg_match('/youtube\.com\/watch\?v=([^\&]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1]; // converted
    // share URL
    } elseif (preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1]; // converted
    }
    return $url;
}

$embedurl = convert_to_embed_url($youtubevideo->video_url);

$content = html_writer::tag('iframe', '', [
    'width' => '600',
    'height' => '315',
    'src' => $embedurl, 
    'frameborder' => '0',
    'allowfullscreen' => 'true'
]);

// show content
echo html_writer::div($content, 'youtubevideo-center');
echo $OUTPUT->footer();
