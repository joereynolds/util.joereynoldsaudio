<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');

error_reporting(0);
ini_set('display_errors', 0);
class Grepper {

    function __construct() {
        $this->htmlTextContent = '';
        $this->rawHtmlTextContent = '';
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
        $this->rawHtmlTextContent = file_get_contents($url);
        return file_get_contents($url);
    }

    /**
     * Returns some surrounding text of the match so you have
     * a better chance of understanding where it's
     * coming from.
     */
    function getContextOfMatch($matchPosition) {
        $contextContent = (!empty($this>rawHtmlTextContent))
            ? $this->rawHtmlTextContent
            : $this->htmlTextContent;
        $context = substr($contextContent, $matchPosition - 25, 50);
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
        $rawHtml = $this->getHTMLAsRawString($url);
        $rawHtmlMatches = [];
        preg_match_all("/$string/i", $rawHtml, $rawHtmlMatches, PREG_OFFSET_CAPTURE);
        $this->visitedLinks[] = $url;

        return $rawHtmlMatches[0];
    }

    function getRawMatches($url, $string) {
    }

    function getTextContentMatches($url, $string) {
    }
}

