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
 * Google Adsense block block for Moodle
 * Generates the javascript that pulls in Google Adsense adverts based
 * on a publisher-id and other parameters.
 *
 * Based heavily on code by  Gennaro Varriale (should I include him in the copyright notice?)
 * And updated for Moodle 2.0
 *
 * @package    block
 * @subpackage google_adsense
 * @copyright 2011 Marcus Green
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @link http://www.moodle.org
 * @link http://www.GennaroVarriale.it
 */

class block_google_adsense extends block_base {
    /**
     * Sets the title and version
     */
    public function init() {
        $this->title = get_string('title', 'block_google_adsense');
        $this->version = 2007032001;
    }

    /**
     * Ensure an edit icon appears in block header
     * @return boolean
     */
    public function instance_allow_config() {
        return true;
    }

    /**
     * If a title has been saved show that, if not displayed the default,
     * i.e. new Google Adsense Block (in English)
     */
    public function specialization() {
        $this->title = isset($this->config->ad_title) ? $this->config->ad_title:
                get_string('new', 'block_google_adsense');
    }

    /**
     * Allow multiple blocks in a single course
     * @return boolean
     */
    public function instance_allow_multiple() {
        return true;
    }

    /**
     * Content displayed in block, a chunk of Javascript
     * that pulls in the advert from the Google adsense server
     * if content exists show it, otherwise show string
     * indicating the block needs configuring
     * @return string
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        if (empty($this->config->ad_client)) {
            $this->content->text=get_string('configthis', 'block_google_adsense');
        } else {
            /*
             * Begin Normal Display of Block Content the
             * $this-config->varname variables
             * are magically pulled from the configdata
             * field of the block_instances table
            */
            $google_adsense = <<< GOOGLE_ADSENSE
				google_ad_client="{$this->config->ad_client}";
				google_ad_width={$this->config->ad_width};
				google_ad_height={$this->config->ad_height};
				google_ad_format="{$this->config->ad_format}";
				google_ad_type="{$this->config->ad_type}";
				google_ad_channel="{$this->config->ad_channel}";
				google_color_border = "{$this->config->ad_color_border}";
				google_color_bg="{$this->config->ad_color_bg}";
				google_color_link="{$this->config->ad_color_link}";
				google_color_text="{$this->config->ad_color_text}";
				google_color_url="{$this->config->ad_color_url}";
GOOGLE_ADSENSE;
            $google_adsense="\n<script type=\"text/javascript\"><!--\n".$google_adsense."\n//-->\n".
                    "</script>\n".
                    "<script type=\"text/javascript\" \n".
                    " src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n".
                    "</script>\n";

            $this->content->text = $google_adsense;
        }

        $this->content->footer = '';

        return $this->content;
    }
    /**
     * Present a configuration interface (the icons at the top of the block)
     * @return boolean
     */
    public function has_config() {
        return true;
    }
}


