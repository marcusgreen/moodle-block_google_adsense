<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing Google Adsense block  block instances for Moodle (http://www.moodle.org)
 * @package    block
 * @subpackage google_adsense
 * @copyright 2011 Marcus Green
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * Based on code by  Gennaro Varriale (www.GennaroVarriale.it)
 * And updated for Moodle 2.0 (it appears to work in 2.1 as well)
 */

class block_google_adsense_edit_form extends block_edit_form {
    protected function specific_definition($mform) {

        // Fields for editing block contents.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $group[]= $mform->createElement('text', 'config_ad_title',
        get_string('configtitle', 'block_google_adsense'),
        array('size' => 25));
        $group[]= $mform->createElement('static', 'config_ad_title_label', 'label',
        get_string('leaveblanktohide', 'block_google_adsense'));

        $mform->addGroup($group, 'configtitle', get_string('configtitle', 'block_google_adsense'),
        array(' '), false);
        unset($group);

        //perhaps config_ad_client should be renamed as config_ad_publisher_id or similar?

        $group[]= $mform->createElement('text', 'config_ad_client',
        get_string('ad_client', 'block_google_adsense'), array('size' => 25));

        //static is not good but it will do in the absense of popup ajax style (MDL-26072)
        $group[]= $mform->createElement('static', 'ad_client_text', 'label',
        get_string('insertID', 'block_google_adsense'));

        $mform->addGroup($group, 'publisher_id',
        get_string('ad_client', 'block_google_adsense'), array(' '), false);
        unset($group);

        $mform->addElement('text', 'config_ad_width',
        get_string('ad_width', 'block_google_adsense'), array('size' => 5));
        $mform->setDefault('config_ad_width', '600');

        $mform->addElement('text', 'config_ad_height',
        get_string('ad_height', 'block_google_adsense'), array('size' => 5));

        $mform->setDefault('config_ad_height', '600');
        //might be good to have rules for other fields
        $mform->addRule( 'config_ad_height', get_string('numeric_error',
        'block_google_adsense'), 'numeric');

        $group[]=$mform->createElement('text', 'config_ad_format',
        get_string('ad_format', 'block_google_adsense'), array('size' => 9));
        $format_list=get_string('format_list', 'block_google_adsense').
        '<a href=https://www.google.com/adsense/adformats target=_blank>';
        $format_list=$format_list.get_string('full_list', 'block_google_adsense').'</a>';
        $group[]=$mform->createElement('static', 'format_list', 'label', $format_list);
        $mform->addGroup($group, 'format_fields', get_string('ad_format', 'block_google_adsense'),
        array(' '), false);
        $mform->setDefault('config_ad_format', '160x600_as');

        $mform->addElement('text', 'config_ad_type',
        get_string('ad_type', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_type', 'text');

        $mform->addElement('text', 'config_ad_channel',
        get_string('ad_channel', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_channel', '');

        $mform->addElement('text', 'config_ad_color_border',
        get_string('ad_color_border', 'block_google_adsense'), array('size' => 5));
        $mform->setDefault('config_ad_color_border', 'FFFFFF');

        $mform->addElement('text', 'config_ad_color_bg',
        get_string('ad_color_bg', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_color_bg', 'FFFFFF');

        $mform->addElement('text', 'config_ad_color_link',
        get_string('ad_color_link', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_color_link', '0000FF');
        $mform->addElement('text', 'config_ad_color_text',
        get_string('ad_color_text', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_color_text', '000000');
        $mform->addElement('text', 'config_ad_color_url',
        get_string('ad_color_url', 'block_google_adsense'), array('size' => 4));
        $mform->setDefault('config_ad_color_url', '008000');
        $mform->addElement('html', '<a href=http://www.google.com/adsense target=null>
        http://www.google.com/adsense</a>');
    }

}
