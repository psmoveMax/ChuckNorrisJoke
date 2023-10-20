<!DOCTYPE html>
<html>
<head>
    <title>Чак Норрис</title>
</head>
<body style="text-align: center; background-color: beige">
<h1>Случайная шутка про Чака Норриса</h1>
<div id="joke-container">
    <p id="joke-text-en">Нажмите кнопку, чтобы сгенерировать шутку</p>
    <p id="loading-text-en" style="display: none">Я жду, что скажет Чак....</p>
    <hr>
    <p id="joke-text-ru"></p>
    <p id="loading-text-ru" style="display: none">Перевожу на русский....</p>
</div>

<button id="get-joke-button">Сгенерировать шутку!</button>

<script>
    document.getElementById('get-joke-button').addEventListener('click', function() {
        document.getElementById('loading-text-en').style.display = 'block';
        document.getElementById('joke-text-en').textContent = '';
        document.getElementById('joke-text-ru').textContent = '';
        let joke;
        fetch('/chuck', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer 0987654321',
            },
        })
            .then((response) => response.text())
            .then((data) => {
                document.getElementById('loading-text-en').style.display = 'none';
                document.getElementById('joke-text-en').textContent = data;
                joke = data;
                document.getElementById('loading-text-ru').style.display = 'block';
                fetch(`https://api.mymemory.translated.net/get?q='${joke}'&langpair=en|ru`, {
                    method: 'POST',
                })
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById('loading-text-ru').style.display = 'none';
                        document.getElementById('joke-text-ru').textContent = data.responseData.translatedText;
                    })
                    .catch(error => {
                        document.getElementById('loading-text-ru').textContent = 'Перевод не удался';
                        console.error(error);
                    });
            })
            .catch(error=>{
                document.getElementById('loading-text-en').textContent = 'Шутку не получилось получить';
            })

    });
</script>
</body>
</html>
