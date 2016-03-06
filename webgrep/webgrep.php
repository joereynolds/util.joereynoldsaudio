<?php
error_reporting(-1);
ini_set('display_errors', 'On');

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
     * @STUB
     * Returns all matches of a string rather than just one.
     */
    function getMatches($html, $string) {
        $matches = [];
        while (($lastPosition = strpos($html, $string)) !== false) {
            $matches[] = $lastPosition;
            $lastPosition = $lastPosition + strlen($string);
        }
        return $matches;
    }

    function getMatch($html, $string) {
        $pos = strpos($html, $string);

        if ($pos !== false) {
            return $pos;
        }
    }

}

if ($_POST) {
    $url = $_POST['url'];
    $searchTerm = $_POST['string'];
    $gr = new Grepper();
    $html = $gr->getHTML($url);

    echo '<h1>'. $gr->GetContextOfMatch($gr->getMatch($html, $searchTerm)) . '</h1>';
}
