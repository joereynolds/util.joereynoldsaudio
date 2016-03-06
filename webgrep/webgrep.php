<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');

class Grepper {

    function __construct() {
        $this->visited_links = [];
        $this->html = '';
    }

    /**
     * Returns a DOMDocument of the HTML string.
     */
    function getHTML($url) {
        $HTML = DOMDocument::loadHTML(file_get_contents($url));
        $this->html = $HTML->textContent;
        return $HTML->textContent;
    }

    /**
     * Returns some surrounding text of the match so you have
     * a better chance of understanding where it's
     * coming from.
     */
    function getContextOfMatch($matchPosition) {
        $context = substr($this->html, $matchPosition - 25, 100);
        return $context;
    }

    /**
     * Returns all the matches of a string.
     */
    function getMatches($url, $string) {
        $matches = [];
        $html = $this->getHTML($url);
        preg_match_all("/$string/", $html, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0];
    }

    /**
     * Returns the position of the first match it sees
     */
    function getMatch($html, $string) {
        $pos = strpos($html, $string);

        if ($pos !== false) {
            return $pos;
        }
    }
}

