<?php
require('webgrep.php');
?>

<html>
    <head>
        <title>Grep the world!</title>
        <link rel="stylesheet" href="style.css">
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
        <h2>Fake results</h2>
        <table>
          <tr>

            <th>Numbrero</th>
            <th>URL</th>
            <th>Matches</th>
          </tr>
          <tr>
            <td>1</td>
            <td>www.example.com/blarg</td>
            <td>5</td>
          </tr>
          <tr>
            <td>1</td>
            <td>www.example.com/asdasdblarg</td>
            <td>5</td>
          </tr>

        </table>
      </section>
    </main>
</body>
</html>
