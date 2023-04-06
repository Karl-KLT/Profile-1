<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body id="body-pd">
    <header class="header" id="header">

        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        {{-- <div class="header_img">
            <div>
                <img src="{{ asset("img.jfif") }}" style="border-radius: 100%;border: 4px solid #B6CDC6">
            </div>
        </div> --}}

    </header>
    <!--Container Main start-->
    <div id="App"></div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    nav.classList.toggle('show')
                    toggle.classList.toggle('bx-x')
                    bodypd.classList.toggle('body-pd')
                    headerpd.classList.toggle('body-pd')
                })
            }
        }
        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')
        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')
        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))
        // Your code to run since DOM is loaded and ready
    });
</script>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");
    .firstBox{
        width: 300px;
        height: auto;
        background-color: #CDE4DD;
        border-radius: 10px;
    }
    /* .Invar{
        font-family: 'Roboto Mono', monospace;
        width: 100%;
        font-weight: bold;
    } */
    :root {
        --header-height: 3rem;
        --nav-width: 68px;
        --first-color: #4723D9;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;
        --body-font: 'Nunito', sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100
    }
    *,
    ::before,
    ::after {
        box-sizing: border-box
    }
    body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 1rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: .5s
    }
    a {
        text-decoration: none
    }
    .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: var(--white-color);
        z-index: var(--z-fixed);
        transition: .5s
    }
    .header_toggle {
        color: var(--first-color);
        font-size: 1.5rem;
        cursor: pointer
    }
    .header_img {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden
    }
    .header_img img {
        width: 40px
    }
    .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background-color: var(--first-color);
        padding: .5rem 1rem 0 0;
        transition: .5s;
        z-index: var(--z-fixed)
    }
    .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden
    }
    .nav_logo,
    .nav_link {
        display: grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding: .5rem 0 .5rem 1.5rem
    }
    .nav_logo {
        margin-bottom: 2rem
    }
    .nav_logo-icon {
        font-size: 1.25rem;
        color: var(--white-color)
    }
    .nav_logo-name {
        color: var(--white-color);
        font-weight: 700
    }
    .nav_link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: 1.5rem;
        transition: .3s
    }
    .nav_link:hover {
        color: var(--white-color)
    }
    .nav_icon {
        font-size: 1.25rem
    }
    .show {
        left: 0
    }
    .body-pd {
        padding-left: calc(var(--nav-width) + 1rem)
    }
    .active {
        color: var(--white-color)
    }
    .active::before {
        content: '';
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--white-color)
    }
    .height-100 {
        height: 100vh
    }
    @media screen and (min-width: 768px) {
        body {

            margin: calc(var(--header-height) + 1rem) 0 0 0;
            padding-left: calc(var(--nav-width) + 2rem)
        }
        .header {
            height: calc(var(--header-height) + 1rem);
            padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
        }
        .header_img {
            width: 40px;
            height: 40px
        }
        .header_img img {
            width: 45px
        }
        .l-navbar {
            left: 0;
            padding: 1rem 1rem 0 0
        }
        .show {
            width: calc(var(--nav-width) + 156px)
        }
        .body-pd {
            padding-left: calc(var(--nav-width) + 188px)
        }
    }
    ::-webkit-scrollbar {
        width: 12px;
        height: 12px;
    }
    ::-webkit-scrollbar-track {
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: #A2CABD;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #86a79d;
    }
    .hide-scroll::-webkit-scrollbar{
        width: 0px;
        height: 0px;
    }
</style>

</html>
