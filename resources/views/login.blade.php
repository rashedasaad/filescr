<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- all.min.css -->
    <link rel="stylesheet" href="{{ URL::asset('all.min.css') }}">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ URL::asset('scss/login/login.css') }}">
    <!-- Font-Googel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,500;1,500&family=Open+Sans:ital,wght@0,600;1,500;1,600&display=swap"
        rel="stylesheet">
</head>

<body>

    <!--  -->
    <div class="effect_container1">
        <div class="effect">
            <span style="--i:10;"></span>
            <span style="--i:20;"></span>
            <span style="--i:15;"></span>
            <span style="--i:22;"></span>
            <span style="--i:10;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
        </div>
    </div>

    <div class="effect_container">
        <div class="effect">
            <span style="--i:4;"></span>
            <span style="--i:28;"></span>
            <span style="--i:15;"></span>
            <span style="--i:4;"></span>
            <span style="--i:30;"></span>
            <span style="--i:28;"></span>
        </div>
    </div>


    <div class="effect_container2">
        <div class="effect">
            <span style="--i:10;"></span>
            <span style="--i:20;"></span>
            <span style="--i:15;"></span>
            <span style="--i:22;"></span>
            <span style="--i:10;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
        </div>
    </div>
    <!--  -->



    <div class="login">
        <div class="box">
            <div class="imges-taitel">
                <?php $user_session = Session::get("user_session") ?>
                <img src="{{ $user_session["avatar"] }}" alt="">
                <h1 class="uoser-name">{{ $user_session["nickname"] }}</h1>
            </div>
            <div class="link">
                <a href="/scripts"><i class="fab fa-discord"></i> create your scripts</a>
            </div>
        </div>
    </div>


    <script>
        // nav bullets
        const effect = document.querySelector(`.effect`).children;
        const width = ['50px', '100px', '30px', '70px', '10px', '20px', '0px', '2px', '4px', '3px', '2px'];
        for (eff of effect) {
            let ran = Math.trunc(Math.random() * 300) + 'px';
            eff.style.width = ran;
            eff.style.height = ran;
        }

        // nav bullets
        const effect1 = document.querySelector(`.effect_container1 .effect`).children;
        const width1 = ['50px', '100px', '30px', '70px', '10px', '20px', '0px', '2px', '4px', '3px', '2px'];
        for (eff of effect1) {
            let ran = Math.trunc(Math.random() * 300) + 'px';
            eff.style.width = ran;
            eff.style.height = ran;
        }

        // nav bullets
        const effect2 = document.querySelector(`.effect_container2 .effect`).children;
        const width2 = ['50px', '100px', '30px', '70px', '10px', '20px', '0px', '2px', '4px', '3px', '2px'];
        for (eff of effect2) {
            let ran = Math.trunc(Math.random() * 300) + 'px';
            eff.style.width = ran;
            eff.style.height = ran;
        }
        
    </script>
</body>

</html>