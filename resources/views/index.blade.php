<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- all.min.css -->
    <link rel="stylesheet" href="{{ URL::asset('all.min.css') }}">
    <link rel="stylesheet" href="/Src/css/all.css">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ URL::asset('scss/welcome/welcome.css') }}">
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
            <span style="--i:1;"></span>
            <span style="--i:5;"></span>
            <span style="--i:12;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:17;"></span>
            <span style="--i:2;"></span>
            <span style="--i:7;"></span>
            <span style="--i:19;"></span>
        </div>
    </div>
    <!--  -->

    <!--  -->
    <div class="effect_container">
        <div class="effect">
            <span style="--i:10;"></span>
            <span style="--i:5;"></span>
            <span style="--i:20;"></span>
            <span style="--i:1;"></span>
            <span style="--i:23;"></span>
            <span style="--i:18;"></span>
            <span style="--i:2;"></span>
            <span style="--i:7;"></span>
            <span style="--i:29;"></span>
        </div>
    </div>
    <!--  -->



    <div class="welcome">
        <div class="contenar">
            <div class="taitel">
                <h1>welcome to our filescr website</h1>
                <p>Our website is macking fivem scripts more secure in license and also we have a dicsord bot controller
                </p>
            </div>
            <div class="shoose">
                @if (!Session::get("user_session"))
                <a class="login" href="/login"><i class="fab fa-discord"></i> Login Discord</a>     
                @endif
                <a class="create" href="/scripts">Create Script</a>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="icon">
            <i id="down" class="fa-regular fa-circle-down"></i>
        </div>

        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4> Company </h4>
                    <ul>
                        <li><a href="#"> About us </a></li>
                        <li><a href="#"> Our services </a></li>
                        <li><a href="#"> Privacy policy </a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4> Get help </h4>
                    <ul>
                        <li><a href="https://discord.gg/3CHC7mXMkm">discord</a></li>
                        <li><a href="https://www.youtube.com/@ai0zstore856">youtube</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Our services</h4>
                    <ul>
                        <li><a href="https://discord.gg/3CHC7mXMkm">scripts</a></li>
                        <li><a href="#">creat script license</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </footer>

    <script>
        // nav bullets
        const effect = document.querySelector(`.effect`).children;
        const span = document.querySelectorAll(`.effect_container .effect span`);

        const width = ['50px', '100px', '30px', '70px', '10px', '20px', '0px', '2px', '4px', '3px', '2px'];
        for (eff of effect) {
            let ran = Math.trunc(Math.random() * 300) + 'px';
            eff.style.width = ran;
            eff.style.height = ran;
        }



        let footer = document.getElementById("footer");
        let down = document.getElementById("down");
        let up = document.getElementById("up");
        let conf = true;
        down.onclick = () => {

            if (conf) {
                conf = false;
                down.classList.add("fa-circle-up");
                footer.style = "height: 200px ; bottom: max(0vw, 0em);"
                down.classList.remove("fa-circle-down");
                
            } else {
                conf = true;
                down.classList.remove("fa-circle-up");
                footer.style = "height: 0px ;bottom: max(-5vw, -5em);"
                down.classList.add("fa-circle-down");
            };
        }

    </script>

</body>
</html>