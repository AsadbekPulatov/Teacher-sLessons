<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>
    <link rel="stylesheet" href="{{ asset('quiz/styles.css') }}">
</head>

<body>
<div class="app">
    <div id="my-script" data-json="{{ $questions }}"></div>
    <h1>{{ $course->title }}</h1>
    <div class="quiz">
        <h2 id="question">Question Goes Here</h2>
        <div id="answer-buttons">
            <button class="btn">Answer1</button>
            <button class="btn">Answer2</button>
            <button class="btn">Answer3</button>
            <button class="btn">Answer4</button>
        </div>
        <button id="next-btn">Keyingisi</button>
    </div>
</div>
</body>
<script src="{{ asset('quiz/script.js') }}"></script>
</html>
