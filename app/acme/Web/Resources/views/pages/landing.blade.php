<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Whatsapp Clone</title>
    <link rel="stylesheet" href="{{ asset("assets/css/chat.css") }}">
</head>
<body>
<div id="app" class="app">

    <!-- LEFT SECTION -->
    <section id="main-left" class="main-left">
        <!-- header -->
        <div id="header-left" class="header-left">
            Mini Chat
        </div>

{{--        <!-- chat list -->--}}
        <div id="chat-list" class="chat-list">
            <!-- user lists -->
            @foreach($users as $user)
                @php
                    $avatar = "ava".(rand(1,8)).".jpg";
                @endphp
                <div class="friends" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-avatar="{{ asset("assets/images"."/".$avatar) }}">
                    <!-- photo -->
                    <div class="profile friends-photo">
                        <img src="{{ asset("assets/images"."/".$avatar) }}" alt="">
                    </div>

                    <div class="friends-credent">
                        <!-- name -->
                        <span class="friends-name">{{ $user->name }}</span>
                        <!-- last message -->
                        <span class="friends-message friend-status">Offline</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- RIGHT SECTION -->
    <section id="main-empty" class="main-right">
        <p style="text-align: center; font-size: 35px">Welcome to whatsapp clone</p>
    </section>
    <section id="main-right" class="main-right hidden">
        <!-- header -->
        <div id="header-right" class="header-right">
            <!-- profile pict -->
            <div id="header-img" class="profile header-img">
                <img src="{{ asset("assets/images/ava2.jpg") }}" alt="">
            </div>

            <!-- name -->
            <h4 class="name friend-name">Donal Tramp</h4>
        </div>

        <!-- chat area -->
        <div id="chat-area" class="chat-area">
            <!-- chat content -->

        </div>

        <!-- typing area -->
        <div id="typing-area" class="typing-area">
            <!-- input form -->
            <input id="type-area" class="type-area" placeholder="Type something...">
        </div>
    </section>
</div>
<div id="creator" class="creator">
    <p>Login as  <span>{{ auth()->user() }}</span></p>
</div>
@vite('resources/assets/js/app.js')
<script src="{{ asset("assets/js/chat.js") }}"></script>
<script src="{{ asset("assets/js/function.js") }}"></script>
</body>
</html>
