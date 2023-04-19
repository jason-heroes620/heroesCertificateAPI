<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Certificate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js')
</head>

<body>
    <div class='flex w-a4 h-a4 justify-center'>
        <div class='flex w-full h-full bg-contain bg-center ' style='background-image: url( {{ Vite::asset('resources/images/certificate_template.jpg')}})'>
            <div class="flex flex-col w-full justify-center items-center content-center place-content-center">
                <div class='items-center justify-center'>
                    <h1 class='text-8xl text-center font-bold font-greatvibes'>Certificate</h1>
                    <h1 class='text-5xl text-center font-greatvibes'>Of Participation</h1>
                </div>
                <div>
                    <!-- logo here -->
                </div>

                <div class='flex pt-24 justify-center'>
                    <p class="text-2xl text-center font-montserrat">is proud to present</p>
                </div>

                <div class='flex pt-24 items-center justify-center'>
                    <p class='text-red-400 font-montserrat text-4xl'>{{ $name }}</p>
                </div>
                <div class='flex pt-24 justify-center px-6'>
                    <p class='flex text-xl font-montserrat break-normal px-6'>For successfully completing workshop organized by</p>
                </div>

                <div class='flex pt-24 justify-center'>
                    <p class='text-4xl font-montserrat'>{{ $partner }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>