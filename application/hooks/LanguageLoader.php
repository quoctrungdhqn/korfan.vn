<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        #Load language
        $ci->cur_lang = "vi";
        //$langs = get_cookie('gt_lang');
        $langs = $ci->session->userdata('languageTT');
        if ($langs && $langs !== "") {
            $langsite = $langs;
        } else {
            $langsite = $ci->config->item('language');
        }
        $ci->cur_lang = $langsite;        
        $ci->lang->load("menu",$langsite);
    }
}