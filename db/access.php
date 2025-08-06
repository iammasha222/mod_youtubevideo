<?php

defined('MOODLE_INTERNAL') || die;

$capabilities = array(
    'mod/youtube:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'guest' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        )
    ),

    'mod/youtube:addinstance' => array(
        'riskbitmask' => RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

    'mod/youtube:view_report' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetype' => array(
            'teacher' =>CAP_ALLOW,
        )
    ),

);