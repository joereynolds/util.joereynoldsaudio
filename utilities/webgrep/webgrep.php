<?php

//error_reporting(-1);
//ini_set('display_errors', 'On');

error_reporting(0);
ini_set('display_errors', 0);

class Grepper {

    const LINK_LIMIT = 10;

    function __construct()
    {
        $this->htmlTextContent = '';
        $this->rawHtmlTextContent = '';
        $this->dom = new DOMDocument;
        $this->visitedLinks = [];
        $this->linksGatheredFromWebsite = [];
        $this->domainNameToSearch = '';
    }

    /**
     * Only load the file if it hasn't been already
     */
    private function loadHTMLFromFile($url)
    {
        if (empty($this->htmlTextContent)) {
            $this->dom->loadHTMLFile($url);
        }
    }

    private function setDomainNameToSearch($url)
    {
        if (empty($this->domainNameToSearch)) {
            $this->domainNameToSearch = parse_url($url)['host'];
        }
    }

    function gatherLinks($url, $linkIndex=0)
    {
        if ($this->gatherLinksConditionFail($url)) {
            return;
        }

        $this->loadHTMLFromFile($url);
        $foundLinks = $this->dom->getElementsByTagName('a');
        $this->appendDiscoveredLinks($foundLinks);
        $this->visitedLinks[] = $url;
        $this->gatherLinks($this->linksGatheredFromWebsite[++$linkIndex], $linkIndex);
    }

    private function gatherLinksConditionFail($url)
    {
        if (in_array($url, $this->visitedLinks) ||
            count($this->linksGatheredFromWebsite) >= static::LINK_LIMIT 
        ) {
            return true;
        }
    }

    private function appendDiscoveredLinks($links)
    {
        foreach ($links as $link) {
            $url = $link->getAttribute('href');
           // if (parse_url($url)['host'] !== $this->domainNameToSearch) {
           //     continue;
           // }
            $this->linksGatheredFromWebsite[] = $link->getAttribute('href');
        }
    }

    function getHTMLTextContent($url)
    {
        $this->loadHTMLFromFile($url);
        $this->htmlTextContent = $this->dom->textContent;
        return $this->htmlTextContent;
    }

    function getHTMLAsRawString($url)
    {
        $this->rawHtmlTextContent = file_get_contents($url);
        return file_get_contents($url);
    }

    /**
     * Returns some surrounding text of the match so you have
     * a better chance of understanding where it's
     * coming from.
     */
    function getContextOfMatch($matchPosition)
    {
        $contextContent = (!empty($this->rawHtmlTextContent))
            ? $this->rawHtmlTextContent
            : $this->htmlTextContent;
        $context = substr($contextContent, $matchPosition - 25, 50);
        return $context;
    }

    /**
     * Returns all the matches of a string.
     * Case insensitive
     */
    function getMatches($url, $string, $ignoreHtml = false)
    {
        $this->setDomainNameToSearch($url);

        if (in_array($url, $this->visitedLinks)) {
            return;
        }

        if ($ignoreHtml) {
            return $this->getTextContentMatches($url, $string);
        }

        return $this->getRawMatches($url, $string);
    }

    function getRawMatches($url, $string)
    {
        $rawHtml = $this->getHTMLAsRawString($url);
        $rawHtmlMatches = [];
        preg_match_all("/$string/i", $rawHtml, $rawHtmlMatches, PREG_OFFSET_CAPTURE);
        return $rawHtmlMatches[0];

    }

    function getTextContentMatches($url, $string)
    {
        $html = $this->getHTMLTextContent($url);
        $htmlMatches = [];
        preg_match_all("/$string/i", $html, $htmlMatches, PREG_OFFSET_CAPTURE);
        return $htmlMatches[0];
    }
}

