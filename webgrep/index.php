<?php
require('webgrep.php');

$grepper = new Grepper;
$searchTerm = $_POST['string'];
$url = $_POST['url'];
$matches = $grepper->getMatches($url, $searchTerm);
$grepper->gatherLinks($url);
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
                  <input name="url" placeholder="www.domain.com">
                </div>

                <div>
                  <h2>Search Term</h2>
                  <input name="string" placeholder="Enter the string to search for">
                </div>

                <div>
                  <input class="big-red-button" type="submit" value="GO!">
                </div>
            </form>
        </section>

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
        <h2>Matches for <?php echo $url?></h2>
          <?php foreach($matches as $match): ?>
          <div class="match">
            <?php echo $grepper->getContextOfMatch($match[1]);?>
          </div>
          <?php endforeach;?>
      </section>




      <section class="results">
        <?php foreach($grepper->links as $link):?>
            <?php var_dump($link);?>
        <?php endforeach;?>
test
      </section>



      <section class="debug">
        <h1>Debug info</h1>
        <div>Visited links : <?php var_dump($grepper->visitedLinks); ?></div>
        <div>Matches : <?php var_dump($grepper->matches);?></div>
      </section>
    </main>
</body>
</html>

<script>
    var searchTerm = "<?php echo $_POST['string']; ?>"; //gross
    $('.results').highlight(searchTerm);
</script>
