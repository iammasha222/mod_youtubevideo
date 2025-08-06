<?php
/* 
 * Responsible for the form of creating/editing activity on the administrator or teacher side.
*/
defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_youtubevideo_mod_form extends moodleform_mod {

    public function definition(){
        global $CFG;
        
        $mform = $this->_form;

        // activity name
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('youtubevideoname', 'youtubevideo'), array('size' => '64'));
        
        // data type validation 
        if(!empty($CFG->formatstringstriptags)){
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        
        // add description input 
        if($CFG->branch >=29){
            $this->standard_intro_elements(); // for Moodle 2.9 and more
        } else {
            $this->add_intro_editor(); // for old versions 
        }
        
        // YouTube URL
        $mform->addElement('text', 'video_url', get_string('video_url', 'youtubevideo')); // YouTube url
        $mform->setType('video_url', PARAM_URL);
        $mform->addRule('video_url', null, 'required', null, 'client');

        $this->standard_coursemodule_elements();
        $this->add_action_buttons(); 
    }
}
