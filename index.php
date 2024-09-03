<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link href="/css/toastr.css" rel="stylesheet"/>
    <title>AmoPoint 03.09.24 n1</title>
</head>
<body>
    <div class="box">
        <div class="main-form">
            <h2>Загрузка файла</h2>
            <form id="upload-form" method="post" enctype="multipart/form-data" action="/php/ajax.php" onsubmit="return false;">
                <input type="file" name="file" /><br />
                <button class="main-btn-submit">Загрузить</button>
            </form>
            <div class="main-status">
                <span class="main-status_text">Статус загрузки:</span>
                <div class="main-status_indicator"></div><span class="main-status_indicator_text">Не загружено</span>
            </div>
        </div>

        <div class="output-form"></div>
    </div>
</body>

<script src="/js/jquery.js"></script>
<script src="/js/toastr.js"></script>
<script src="/js/core.js"></script>

</html>