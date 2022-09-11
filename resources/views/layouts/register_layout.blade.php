<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('components.auth.register_welcome')
    <div class="main">
        @include('components.auth.register_header')
        @include('components.auth.register')
        @include('components.auth.register_text')
    </div>
    
    @vite([
    'resources/assets/register/css/welcome.css',
    'resources/assets/register/css/header.css',
    'resources/assets/register/css/register.css',
    'resources/assets/register/css/text.css',
    'resources/assets/register/js/register.js',
    'resources/assets/register/js/text.js'])
</body>

<script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>
<script>
    
    function hidden1(){
        document.getElementById('wrapper').classList.add('hidecontent');
        setTimeout(() => {
            document.getElementById('wrapper').remove()
            document.getElementById('header').style.visibility = 'visible'
            document.getElementById('header').style.margin = "0";
            document.querySelector('.login-wrap').style.visibility = 'visible'
            document.querySelector('.login-wrap').style.top = "254px";
            document.getElementById('stage').style.transition = "opacity 1s";
            document.getElementById('stage').style.opacity = "1";
        }, 2500);
    }
</script>
</html>