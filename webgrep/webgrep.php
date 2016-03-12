<?php
error_reporting(-1);
ini_set('display_errors', 'On');

class Grepper {

    function __construct() {
        $this->htmlTextContent = '';
        $this->dom = new DOMDocument;
        $this->visitedLinks = [];
        $this->linksGatheredFromWebsite = [];
    }

    /**
     * Only load the file if it hasn't been already
     */
    private function loadHTMLFromFile($url) {
        if (empty($this->htmlTextContent)) {
            $this->dom->loadHTMLFile($url);
        }
    }
    /**
     * Gathers links to get text from
     */
    function gatherLinks($url) {
        $this->loadHTMLFromFile($url);
        $this->linksGatheredFromWebsite[] = $this->dom->getElementsByTagName('a');
    }

    function getHTMLTextContent($url) {
        $this->loadHTMLFromFile($url);
        $this->htmlTextContent = $this->dom->textContent;
        return $this->htmlTextContent;
    }

    function getHTMLAsRawString($url) {
        return file_get_contents($url);
    }

    /**
     * Returns some surrounding text of the match so you have
     * a better chance of understanding where it's
     * coming from.
     */
    function getContextOfMatch($matchPosition) {
        $context = substr($this->htmlTextContent, $matchPosition - 25, 50);
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
        $html = $this->getHTMLTextContent($url);
        $rawHtml = $this->getHTMLAsRawString($url);
        $htmlMatches = [];
        $rawMatches = [];
        preg_match_all("/$string/i", $html, $htmlMatches, PREG_OFFSET_CAPTURE);
        $this->visitedLinks[] = $url;

        return $htmlMatches[0];
    }
}

