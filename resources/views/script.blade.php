<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- all.min.css -->
    <link rel="stylesheet" href="{{ URL::asset('all.min.css') }}">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ URL::asset('scss/main/main.css') }}">
    <!-- Font-Googel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,500;1,500&family=Open+Sans:ital,wght@0,600;1,500;1,600&display=swap"
        rel="stylesheet">
</head>

<body>
<?php $user_session = Session::get("user_session") ?>
    <!-- Start menu -->
    <div class="asid">
        <div class="asid_bag">
            <div class="selct_box">
                <div class="toggle-settings">
                    <i class="settin fas fa-cog fa-spin"></i>
                </div>
                <div class="leftt">
                    <img src="{{ $user_session['avatar'] }}" alt="">
                    <div class="product">
                        <h1>{{ $user_session["name"] }}</h1>
                    </div>
                    <div class="link">
                        <a class="activ" href="#">new script</a>
                        <a href="/actievs">new licence</a>
                        <a href="#">Button LOG</a>
                    </div>
                </div>
            </div>
            <div class="com">
                <div class="nav_Mini-Bots">
                    <h1>{{ $user_session["nickname"] }}</h1>
                    <span></span>
                    <div class="albutton">
                        <a id="new-script" href="#">New script</a>
                        <div class="card_new">
                            <span></span>
                            <div class="contenar">
                                <div class="Icon_d">
                                    <i class="fas fa-times"></i>
                                </div>
                                <h1>New script</h1>
                                <form action="{{ route("scripts_store") }}" method="POST">
                                    @csrf
                                    <input placeholder="New script" type="text" name="script">
                                    <div class="butoon">
                                        <input class="sub" type="submit" value="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="update">
                        <span></span>
                        <div class="contenar">
                            <div class="Icon_d Icon_script_cancle">
                                <i class="fas fa-times"></i>
                            </div>
                            <h1>Update your active here</h1>
                            <form action="{{ route("updatescripts") }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_script" class="id_script">
                                <input placeholder="script name" type="text" class="script_name" name="script_name">
                                <div class="butoon">
                                    <input class="sub" type="submit" value="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

      
                <!-- Stat Card -->
                <section>
                    <form action="{{ route("scripts_delete") }}" method="post">
                    <div class="card_Delete">
                        <span></span>
                    
                            @csrf
                        <div class="contenar">
                            <h1>Are you sure delete</h1>
                                <div class="butoon">
                                    <input id="delete" type="hidden" name="delete_id">
                                    <input class="btne" type="submit" value="yes">
                                    <a id="no_Poppap" href="#">no</a>
                                </div>
                        
                        </div>
                     </div>
                    </form>
                    <div class="contenar">
                        <div id="cards" class="card">
                            <div class="box">
                                <h1>Number of actives</h1>
                                <p>{{count($actives)}}</p>
                            </div>
                            <div class="box">
                                <h1>Number of scripts</h1>
                                <p>{{count($scripts);}}</p>
                            </div>
                        </div>

                        <div class="outputs">
                            <div class="scroll">
            
                                <table>
                                    <tr>
                                        <th>script name</th>
                                        <th>Token</th>
                                        <th>Date created</th>
                                        <th>update</th>
                                        <th>delete</th>
                                    </tr>
                                    <tbody id="tbody">
                                    @foreach ($scripts as $script)
                                        <tr class="alldatascript">
                                            <td style="display:none" class="script_id">{{ $script->id }}</td>
                                            <td class="script_name">{{ $script->script_name }}</td>
                                            <td>{{ $script->script_token }}</td>
                                            <td>{{ $script->created_at }}</td>
                                            <td><button class="update script_script">update</button></td>
                                            <td><button class="yesOrNo delete" value="{{ $script->id }}">delete</button></td>
                                        </tr>           
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        
                    </div>
                </section>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End menu -->


    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script>
  

        document.getElementById("cards").onmousemove = (e) => {
            for (const box of document.querySelectorAll(".box")) {
                const rect = box.getBoundingClientRect(), x = e.clientX - rect.left, y = e.clientY - rect.top;
                box.style.setProperty("--mouse-x", `${x}px`);
                box.style.setProperty("--mouse-y", `${y}px`);
            };
        };
    </script>

</body>

</html>