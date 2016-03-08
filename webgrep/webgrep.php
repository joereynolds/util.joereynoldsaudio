<?php
error_reporting(-1);
ini_set('display_errors', 'On');

class Grepper {

    function __construct() {
        $this->html = '';
        $this->dom = new DOMDocument;
        $this->visitedLinks = [];
        $this->matches = [];
        $this->links = [];
    }

    /**
     * Only load the file if it hasn't been already
     */
    private function loadHTMLFromFile($url) {
        if (empty($this->html)) {
            $this->dom->loadHTMLFile($url);
        }
    }
    /**
     * Gathers links to get text from
     */
    function gatherLinks($url) {
        $this->loadHTMLFromFile($url);
        $this->links = $this->dom->getElementsByTagName('a');
    }

    /**
     * Returns a DOMDocument of the HTML string.
     */
    function getHTML($url) {
        $this->loadHTMLFromFile($url);
        $this->html = $this->dom->textContent;
        return $this->html;
    }

    /**
     * Returns some surrounding text of the match so you have
     * a better chance of understanding where it's
     * coming from.
     */
    function getContextOfMatch($matchPosition) {
        $context = substr($this->html, $matchPosition - 25, 50);
        return $context;
    }

    /**
     * Returns all the matches of a string.
     * Case insensitive
     */
    function getMatches($url, $string) {
        if (in_array($url, $this->visitedLinks)) {
            return;
        }
        $html = $this->getHTML($url);
        preg_match_all("/$string/i", $html, $this->matches, PREG_OFFSET_CAPTURE);
        $this->visitedLinks[] = $url;
        return $this->matches[0];
    }
}

