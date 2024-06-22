<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Untuk Zefa</title>
    <style>
        #content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        #pertanyaan {
            opacity: 0;
            transition: opacity 1s ease-in-out; /* Add transition effect */
        }
        #flower {
            display: none;
            transition: opacity 1s ease-in-out; /* Add transition effect */
        }
        #heart {
            display: none;
            transition: opacity 1s ease-in-out; /* Add transition effect */
        }
        #gamau {
            position: absolute;
            right:250px;
            transition: transform .2s ease-in-out;
        }
        .button-container {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }
    </style>
</head>
<body>
<div id="content">
    <button id="btn" type="button">Start!</button>

    <div id="pertanyaan">
        <h1>Sayang koko ga km?</h1>
        <div class="button-container">
            <button id="yes">YES!</button>
            <button id="yes1">ENGGAK TP BOHONG (Jadi sayang)</button>
            <button id="gamau">gamau</button>
        </div>
    </div>

    <div id="heart">
        <img src="https://images.theconversation.com/files/122137/original/image-20160511-18171-kulas4.jpg?ixlib=rb-4.1.0&q=45&auto=format&w=1356&h=668&fit=crop" alt="">
    </div>

    <div id="flower">
        <img src="https://images.tokopedia.net/img/cache/700/VqbcmM/2022/11/3/66281751-e900-46cf-9e9c-d17ce222b7fc.jpg" alt="">
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $('#btn').click(function(){
        $('#btn').animate({opacity:0}, 1000, function() {
            $(this).hide(); // hide the button after fade out
        });
        $('#pertanyaan').show().animate({opacity:1}, 1000); // show the div before fade in
    })

    $('#gamau').hover(function() {
        var maxX = $(window).width() - $(this).outerWidth();
        var maxY = $(window).height() - $(this).outerHeight();
        $(this).css('transform', 'translate(' + Math.random() * maxX + 'px, ' + Math.random() * maxY + 'px)');
    });

    $('#gamau').click(function(){
        alert('ga bole i hueeeee :P');
    })

    $('#yes').click(function(){
        alert('YEYYY SAYANG ZEFA BANYA BANYAK BANYAKK POLL');
        $('#pertanyaan').hide(); // hide the div before fade in
        showFlower();
    })

    $('#yes1').click(function(){
        alert('dah kalo sayang tu tinggal bilang sayang aja :D');
        $('#pertanyaan').hide(); // hide the div before fade in
        showHeart();
    })

    function showFlower(){
        $('#flower').show().animate({opacity:1}, 1000);
    }

    function showHeart(){
        $('#heart').show().animate({opacity:1}, 1000);
    }

</script>
</body>
</html>
