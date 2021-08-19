<?php
include_once 'scremblerf.php';

$task = 'encode';

if ( isset($_GET['task']) && $_GET['task'] !='') {
    $task = $_GET['task'];
}

$key = 'abcdefghijklmnopqrstuvwxyz1234567890';

if ('key' == $task) {
    $key_original = str_split($key);
    shuffle($key_original);
    $key = join( "", $key_original);
} else if (isset($_POST['key']) && $_POST['key'] !='') {
    $key = $_POST['key'];
}

$scrembledData = '';
if ('encode' == $task) {
    $data = $_POST['data'] ?? '';
    if ($data != '' ) {
        $scrembledData = scrembleData($data, $key);
    }
}

if ('decode' == $task) {
    $data = $_POST['data'] ?? '';
    if ($data != '' ) {
        $scrembledData = decodeData($data, $key);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <style>
        body{
            margin-top: 50px;
        }
        #data{
            width: 100%;
            height: 160px;
        }
        #result{
            width: 100%;
            height: 160px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20 ">
                <h1>Data Scrembler</h1>
                <p>Use this application to scrembler your data</p>
                <p>
                    <a href="/index.php?task=encode">Encode</a> |
                    <a href="/index.php?task=decode">Decode</a> |
                    <a href="/index.php?task=key">Generate</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form action="index.php<?php if ('decode' == $task) { echo "?task=decode"; } ?>" method="POST">
                    <label for="key">Key</label>
                    <input type="text" name="key" id="key" <?php displayKey($key) ?> >
                    <label for="data">Data</label>
                    <textarea name="data" id="data"><?php if (isset($_POST['data'])) { echo $_POST['data']; } ?></textarea>
                    <label for="result" >Result</label>
                    <textarea id="result"> <?php echo $scrembledData; ?> </textarea>
                    <button type="submit">Do it for me</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>