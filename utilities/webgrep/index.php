<?php
require('webgrep.php');

$grepper = new Grepper;
$searchTerm = $_POST['string'];
$url = $_POST['url'];
$ignoreHtml = (bool)$_POST['ignoreHtml'];

if ($_POST['url']) {
    $grepper->gatherLinks($url);
}

?>

<html>
    <head>
        <title>Grep the world!</title>
        <link rel="stylesheet" href="style.css">
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="jquery.highlight-5.js"></script>
    </head>
<body>
  <main>
    <section>
      <form method="POST">
        <div>
          <h2>URL</h2>
            <input type="url" required name="url" placeholder="www.domain.com">
        </div>

        <div>
          <h2>Search Term</h2>
          <input required name="string" placeholder="Enter the string to search for">
        </div>

          <label class="match"><input type="checkbox">recurse?</label>
          <label class="match"><input type="checkbox">load ajax?</label>
          <label class="match"><input name="ignoreHtml" type="checkbox">ignore html?</label>
          <label class="match"><input type="checkbox">ignore search?</label>

        <p>Recurse : Recurses through every page on the site (not implemented)</p>
        <p>Load ajax : Attemps to load all dynamic javascript before parsing the page (not implemented)</p>
        <p>Ignore html : If specified, it parses the text content of the DOM, and won't search HTML tags for your search term</p>
        <p>Ignore search : Don't bother searching for search Term, just get all the links you can find (not implemented)</p>




        <div>
          <input class="big-red-button" type="submit" value="GO!">
        </div>
      </form>
    </section>

    <?php if ($_POST['url']):?>
    <section>
      <h2>Results</h2>
        <table>
          <tr>
            <th>Numbrero</th>
            <th>URL</th>
            <th>Matches</th>
          </tr>
          <tr>
            <td>1</td>
            <td><?php echo $url ?></td>
            <td><?php echo count($matches)?>
            </td>
          </tr>
        </table>
    </section>

      <section class="results">
        <?php foreach($grepper->linksGatheredFromWebsite as $link):?>
        <?php $matches = $grepper->getMatches($link, $searchTerm, $ignoreHtml);?>
        <h2>Matches for 
            <a href="<?php echo $link; ?>"><?php echo $link?></a>
        </h2>
          <?php foreach($matches as $match): ?>
          <div class="match">
            <?php echo htmlspecialchars($grepper->getContextOfMatch($match[1]));?>
          </div>
          <?php endforeach;?>
        <?php endforeach;?>
      </section>

      <section class="debug">
        <h1>Debug info</h1>
        <div class="match"><span>Visited links : </span><?php var_dump($grepper->visitedLinks); ?></div>
        <div class="match"><span>Matches : </span><?php var_dump($grepper->matches);?></div>
        <div class="match"><span>Gathered links : </span><?php print_r($grepper->linksGatheredFromWebsite)?>
      </section>
    <?php endif;?>
    </main>
  </body>
</html>

<script>
    var searchTerm = "<?php echo $_POST['string']; ?>"; //gross
    $('.results').highlight(searchTerm);
</script>
