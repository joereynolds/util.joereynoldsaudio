<style>
  html {
    background: #f7f7f7;
    font-family: arial;
  }
  body {
    width : 800px;
    margin : auto;
  }
  main {
    background: white;
    border : 1px solid #ccc;
    margin-top : 25px;
    padding : 25px;
  }
  h1, h2, h3 {
    color : red;
    text-decoration: underline;
  }
  input {
    display :block;
    width : 100%;
    padding : 10px;
  }
  section + section {
    margin-top: 25px;
  }

  table {
    width : 100%;
    border : 1px solid #ccc;
    border-collapse: collapse;

  }
  th {
    padding : 5px;
    text-align: left;
  }
  th + th {
    border-left : 1px solid #ccc;
  }
  td {
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding : 5px;
  }
  input[type="submit"] {
    margin-top : 25px;
    border : none;
    background : red;
    color : #fff;
  }
  input[type="submit"]:hover {
    animation: rainbow .1s infinite alternate linear;
  }

  @keyframes rainbow {
    0%   {
      background-color:  red;
      height : 30px;
    }
    10%  {
      background-color:  pink;
      height : 40px;
    }
    20%  {
      background-color:  blue;
      height : 50px;
    }
    30%  {
      background-color:  green
      height : 60px;
    }
    100% {
      background-color:  yellow;
      height : 70px;
    }
  }

</style>

<main>
    <section>
    <div>
      <h2>URL</h2>
      <input placeholder="www.domain.com">
    </div>

    <div>
      <h2>Search Term</h2>
      <input placeholder="Enter the string to search for">
    </div>

    <div>
      <input class="big-red-button" type="submit" value="GO!">
    </div>
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
