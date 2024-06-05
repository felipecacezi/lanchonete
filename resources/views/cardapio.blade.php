<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="">
        <section class="py-5 relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

                <div class="flex flex-col justify-center items-center rounded-3xl mb-8">
                    <div class="img box mb-5 w-mx h-96 px-5 overflow-hidden flex">
                        <img src="https://www.giroamericana.com.br/arquivos/noticias/9383/billy-boo-lanchonete-tematica-em-americana-lanca-rodizio-de-mini-burgers-nas-tercas-feiras-a-partir-de-r-49-90.jpg" alt="speaker image" class="md:w-max lg:w-max">
                    </div>
                    <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black">
                        Billy Boo
                    </h2>
                    <div>
                        <p>
                            Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis.
                            Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget. Mais vale um bebadis conhecidiss,
                            que um alcoolatra anonimis. Eu nunca mais boto a boca num copo de cachaça, agora eu só uso canudis!
                            Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis.
                            Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget. Mais vale um bebadis conhecidiss,
                            que um alcoolatra anonimis. Eu nunca mais boto a boca num copo de cachaça, agora eu só uso canudis!
                        </p>
                    </div>
                </div>
                
                <livewire:operating-schedule />

                @foreach ($menus[0] as $menu)
                    <div class="mb-5">
                        <h5 class="font-manrope font-bold text-2xl leading-9 text-gray-900">
                            {{ $menu['virtual_menu_title'] }}
                        </h5>
                    </div>

                    @foreach ($menu['products'] as $product)
                        <livewire:product-menu 
                            productName="<?php echo $product['product_name']; ?>" 
                            price="<?php echo $product['product_price']; ?>" 
                            obs="<?php echo $product['product_description']; ?>"/>
                    @endforeach
                @endforeach

                <div class="max-lg:max-w-lg max-lg:mx-auto">
                    <button class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700 ">Checkout</button>
                </div>

            </div>
        </section>
        @livewireScripts
    </body>
</html>
