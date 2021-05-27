<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= TITLE ?>
  </title>
  <style>
    input[type="text"],
    input[type="tel"] {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-appearance: button;
      appearance: none;
      border-radius: 0;
      width: 100%;
      font-size: 16px;
      border: 1px solid #aaa;
      padding: 15px
    }

    input[type="submit"] {
      appearance: none;
      border: 0;
      border-radius: 5px;
      background:
        <?= THEME_COLOR ?>
      ;
      color: #fff;
      padding: 8px 16px;
      -webkit-box-sizing: content-box;
      -webkit-appearance: button;
    }

    header {
      background-color:
        <?= THEME_COLOR ?>
      ;
      height: 15vh;
      text-align: center;
    }

    header:first-child {
      display: inline-block;
      line-height: 15vh;
      color: white
    }

    footer {
      background-color:
        <?= THEME_COLOR ?>
      ;
      height: 15vh;
      margin-top: auto
    }

    body {
      display: flex;
      flex-direction: column;
      flex-wrap: nowrap;
      font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
    }

    html,
    body {
      min-height: 100vh;
      margin: 0;
      padding: 0
    }

    .container {
      margin: 1em;
    }
  </style>
</head>

<body>
  <header>
    <div><?= TITLE ?>
    </div>
  </header>
  <div class="container">
    <?= $contents ?>
  </div>
  <footer></footer>
</body>

</html>