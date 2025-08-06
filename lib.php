<?php
defined('MOODLE_INTERNAL') || die();

function youtubevideo_add_instance($data, $mform) {
    global $DB;

    $data->timecreated = time();
    $data->introformat = $data->introformat ?? 0;

    return $DB->insert_record('youtubevideo', $data);
    
}
function youtubevideo_update_instance($data, $mform) {
    global $DB;
    $data->timemodified = time();
    $data->id = $data->instance;
    return $DB->update_record('youtubevideo', $data);
}

function youtubevideo_delete_instance($id) {
    global $DB;
    return $DB->delete_records('youtubevideo', ['id' => $id]);
}

function youtubevideo_css() {
    global $PAGE;
    $PAGE->requires->css('mod/youtubevideo/style.css');
}