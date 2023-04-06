<x-mail::message>
    {{-- <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <title>{{ env('APP_NAME') }}</title>
        </head>

        <body class="w-100 vh-100 d-flex justify-content-center bg-light align-items-center">

            <div class="fw-bold badge bg-dark p-3" style="font-size: 21px;letter-spacing: 0.8px" >
                <p>
                    Hi {{ $UserName }} , ur activation code is<span class="text-decoration-underline ms-2">{{ $UserCode }}</span>.
                </p>
            </div>
        </body>
    </html> --}}
    <div class="d-flex justify-content-center">
        <div class="fw-bold badge bg-dark" style="font-size: 21px;letter-spacing: 0.8px" >
            <p class="p-0 m-0">
                Hi {{ $UserName }} , ur activation code is <span class="text-decoration-underline ms-2">{{ $UserCode }}</span>.
            </p>
        </div>
    </div>


</x-mail::message>
