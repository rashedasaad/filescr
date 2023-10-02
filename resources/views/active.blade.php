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
    <?php $user_session = Session::get('user_session'); ?>
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
                        <h1>{{ $user_session['name'] }}</h1>
                    </div>
                    <div class="link">
                        <a href="/scripts">new script</a>
                        <a class="activ" href="#">new licence</a>
                        <a href="#">Button LOG</a>
                    </div>
                </div>
            </div>

            <div class="com">
                <div class="nav_Mini-Bots">
                    <h1>{{ $user_session['nickname'] }}</h1>
                    <span></span>
                    <div class="albutton">
                        <a id="new-script" href="#">New active</a>
                        <div class="card_new">
                            <span></span>
                            <div class="contenar">
                                <div class="Icon_d">
                                    <i class="fas fa-times"></i>
                                </div>
                                <h1>New active</h1>
                                <form action="{{ route('actievs') }}" method="POST">
                                    @csrf
                                    <select name="script_id">
                                        @foreach ($scripts as $script)
                                            <option value="{{ $script->script_id }}">{{ $script->script_name }}</option>
                                        @endforeach
                                    </select>

                                    <input placeholder="Server name" type="text" name="server_name">
                                    <input placeholder="Ip server" type="text" name="ip_server">
                                    <input placeholder="Discord id" type="number" name="discord_id">
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
                            <div class="Icon_d update_cancle">
                                <i class="fas fa-times"></i>
                            </div>
                            <h1>Update your active here</h1>
                            <form action="{{ route("updateactievs") }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="id_active">
                                <input placeholder="Server name" type="text" class="server_name" name="server_name">
                                <input placeholder="Ip server" type="text"  class="ip_server" name="ip_server">
                                <input placeholder="Discord id" type="number"  class="discord_id" name="discord_id">
                                <div class="butoon">
                                    <input class="sub" type="submit" value="submit">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Stat Card -->
                <section>
                    <div class="card_Delete">
                        <span></span>
                        <div class="contenar">
                            <h1>are you sure delete</h1>
                            <form action="{{ route('delete') }}" method="POST">
                                @csrf
                                <div class="butoon">
                                    <input id="delete" type="hidden" name="delete_id" value="">
                                    <input class="btne" type="submit" value="yes">
                                    <a id="no_Poppap" href="#">no</a>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="contenar">
                        <div id="cards" class="card">
                            <div class="box">
                                <h1>number of actives</h1>
                                <p>{{ count($actives) }}</p>
                            </div>

                        </div>

                        <div class="outputs">
                            <div class="scroll">

                                <table>
                                    <tr>
                                        <th>Script name</th>
                                        <th>Script owner</th>
                                        <th>IP</th>
                                        <th>Server name</th>
                                        <th>Person licence</th>
                                        <th>Date created</th>
                                        <th>active</th>
                                        <th>update</th>
                                        <th>delete</th>
                                    </tr>
                                    <tbody id="tbody">
                                        @foreach ($actives as $active)
                                            <tr class="alldata">
                                                <td style="display: none" class="scriptid">{{ $active->id }}</td>
                                                <td>{{ $active->script_name }}</td>
                                                <td class="discordid">{{ $active->discord_id }}</td>
                                                <td class="ipserver">{{ $active->ip_server }}</td>
                                                <td class="servername">{{ $active->server_name }}</td>
                                                <td>{{ $active->script_licens }}</td>
                                                <td>{{ $active->created_at }}</td>

                                                <form id="actives_form" action="{{ route('update_actievs') }}" method="POST">
                                                    @csrf
                                                    <td><button type="submit" name="active_id" class="update"
                                                            value="{{ $active->id }}"><?php if ($active->script_status == 1) {
                                                                echo 'online';
                                                            } else {
                                                                echo 'offline';
                                                            } ?></button>
                                                    </td>
                                                </form>
                                                <td><button class="update update_yesornom">update</button></td>
                                                <td><button class="yesOrNo delete" value="{{ $active->id }}"
                                                        class="delete">delete</button></td>
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
                const rect = box.getBoundingClientRect(),
                    x = e.clientX - rect.left,
                    y = e.clientY - rect.top;
                box.style.setProperty("--mouse-x", `${x}px`);
                box.style.setProperty("--mouse-y", `${y}px`);
            };
        };
    </script>

</body>

</html>
