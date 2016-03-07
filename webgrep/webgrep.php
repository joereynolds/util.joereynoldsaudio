<?php
error_reporting(-1);
ini_set('display_errors', 'On');

class Grepper {

    function __construct() {
        $this->visitedLinks = [];
        $this->html = '';
        $this->matches = [];
    }

    /**
     * Returns a DOMDocument of the HTML string.
     */
    function getHTML($url) {
        $htmlSource = file_get_contents($url);
        $HTML = DOMDocument::loadHTML($htmlSource);
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
        if (in_array($url, $this->visitedLinks)) {
            return;
        }
        $matches = [];
        $html = $this->getHTML($url);
        preg_match_all("/$string/", $html, $matches, PREG_OFFSET_CAPTURE);
        $this->visitedLinks[] = $url;
        $this->matches = $matches;
        return $matches[0];
    }
}

