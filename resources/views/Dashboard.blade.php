<?php use App\Models\Free;
 use App\Models\User;
$user_session = Session::get('user_session'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- all.min.css -->
    <link rel="stylesheet" href="{{ URL::asset('all.min.css') }}">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ URL::asset('scss/Dashboard/Dashboard.css') }}">
    <!-- Font-Googel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,500;1,500&family=Open+Sans:ital,wght@0,600;1,500;1,600&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- header -->
    <header>
        <div class="continer">
            <img src="{{ $user_session['avatar'] }}" alt="">
            <h1>{{ $user_session['nickname'] }}</h1>
        </div>
    </header>
    <!-- header -->

    <div class="card_Delete">
        <span></span>
        <div class="contenar">
            <h1>Are you sure delete</h1>
            <form action="{{ route("delete_cpanel") }}" method="post">
                @csrf
            <div class="butoon">
                <input id="delete" type="hidden" name="delete_id">
                <input class="btne" type="submit" value="yes">
                <a class="no_Poppap" href="#">no</a>
            </div>
        </form>
        </div>
    </div>
    
    <!-- cars -->
    <div class="allCars">
        <div class="continer">
            <div id="cards" class="card">
                <div class="box">
                    <h1>The number of people</h1>
                    <p>{{ $usernum }}</p>
                </div>
                <div class="box">
                    <h1>Number of buyers</h1>
                    <p>{{ $buyers }}</p>
                </div>
                <div class="box">
                    <h1>number of scripts</h1>
                    <p>{{ $scripts }}</p>
                </div>
            </div>

            <div class="outputs">
                <div class="allser">

                    <div class="search">
                        <div class="icon">
                            <i class="sear fas fa-search"></i>
                        </div>
                        <div class="input">
                            <input id="Search" type="text" placeholder="Search">
                            <i class="clear fas fa-times"></i>
                        </div>
                    </div>
                    <nav>
                        @if ($users->hasPages())
                            <ul class="pagination">
                                <li class="page-itemlift">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                        rel="prev"aria-label="« Previous">‹</a>
                                </li>


                                @if ($users->currentPage())
                                    <li class="page-item">
                                        <a class="link-number activ">{{ $users->currentPage() }}</a>
                                    </li>
                                    @if ($users->hasMorePages())
                                    <li class="page-item">
                                        <a class="link-number">{{ $users->currentPage()+1 }}</a>
                                    </li>
                                    @endif
                                @else
                                    <li class="page-item">
                                        <a class="link-number activ"
                                            href="{{ $url }}">{{ $users->nextPageUrl() }}</a>
                                    </li>
                                @endif

                                <!--  -->
                                <li class="page-itemlift disabled" aria-disabled="true" aria-label="Next »">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}"
                                        rel="prev"aria-label="« Previous">›</a>
                                </li>
                        @endif
                        </ul>
                    </nav>

                </div>
                <div class="scroll">
                    <table>
                        <tr>
                            <th>person name </th>
                            <th>Discord id</th>
                            <th>email</th>
                            <th>admin</th>
                            <th>delete</th>
                            <th>Date created</th>
                        </tr>
                        <tbody id="tbody">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><button class="update">update</button></td>
                                    <td><button value="{{ $user->id }}" class="yesOrNo delete">delete</button></td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="outputs">
                <div class="allser">
                    <div class="search">
                        <div class="icon">
                            <i class="sear fas fa-search"></i>
                        </div>
                        <div class="input">
                            <input id="Search" type="text" placeholder="Search">
                            <i class="clear fas fa-times"></i>
                        </div>
                    </div>
                    <nav>

                    </nav>
                </div>
                <div class="scroll">
                    <table>
                        <tr>
                            <th>name</th>
                            <th>Discord id</th>
                            <th>email</th>
                            <th>free</th>
                            <th>ban</th>
                        </tr>
                        <tbody id="tbody">

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <form action="{{ route('free') }}" method="post">
                                        @csrf
                                        <td><button value="{{ $user->user_id }}" name="free" class="update">
                                                @php
                                                    $freedb = Free::where('user_id', $user->user_id)->first();
                                                    
                                                    if (empty($freedb)) {
                                                        echo 'not free';
                                                    } elseif ($freedb->is_free == 1) {
                                                        echo 'free';
                                                    } elseif ($freedb->is_free == 0) {
                                                        echo 'not free';
                                                    }
                                                    
                                                @endphp</button></td>
                                    </form>
                                    <form action="" method="post">
                                        @csrf
                                        <td><button value="{{ $user->user_id }}" name="ban" class="update">
                                            @php
                                            $bandb = User::where('user_id', $user->user_id)->first();
                                            
                                            if ($bandb->is_ban == 1) {
                                                echo 'band';
                                            } elseif ($bandb->is_ban == 0) {
                                                echo 'not ban';
                                            }
                                            
                                        @endphp
                                        </button></td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <script src="{{ URL::asset('js/Dashboard.js') }}"></script>

</body>

</html>
