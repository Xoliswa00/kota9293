<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delicious Kota Center</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            yellow: '#facc15',
                            dark: '#0b0b0b'
                        }
                    }
                }
            }
        }
    </script>

    @livewireStyles
</head>

<body class="bg-brand-dark text-white font-sans">

<!-- HERO -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-black via-zinc-900 to-brand-dark"></div>

    <div class="relative py-28 px-6 text-center">
        <span class="uppercase tracking-widest text-xs text-gray-400">
            Kasi Street Food
        </span>

        <h1 class="mt-4 text-5xl md:text-6xl font-extrabold text-brand-yellow">
            Delicious Kota Center
        </h1>

        <p class="mt-6 text-gray-300 max-w-2xl mx-auto text-lg leading-relaxed">
            Real street food made fresh. Loaded kotas, juicy burgers and crispy chips —
            built for real kasi cravings.
        </p>

        <div class="mt-14 flex justify-center gap-6 flex-wrap">
            <a href="{{ route('customer.orders') }}"
               class="bg-green-500 hover:bg-green-600 px-12 py-4 rounded-2xl font-bold shadow-xl transition transform hover:-translate-y-1">
                Order Now
            </a>

            <a href="#menu"
               class="border-2 border-brand-yellow text-brand-yellow px-12 py-4 rounded-2xl font-bold hover:bg-brand-yellow hover:text-black transition">
                View Menu
            </a>
        </div>
    </div>
</section>

<!-- TODAY'S SPECIAL -->
<section class="py-24 px-6 bg-black">
    <h2 class="text-3xl font-bold text-center text-brand-yellow mb-14">
        Today’s Special
    </h2>

    <div class="max-w-4xl mx-auto bg-zinc-900 rounded-2xl overflow-hidden shadow-xl md:flex">
        <img src="/images/menu/special.jpg"
             class="md:w-1/2 h-72 md:h-auto object-cover">

        <div class="p-8 flex flex-col justify-center">
            <span class="text-xs uppercase text-green-400 font-semibold mb-2">
                Limited Offer
            </span>

            <h3 class="text-2xl font-bold mb-3">
                Double Cheese Kota Combo
            </h3>

            <p class="text-gray-400 mb-4">
                Loaded kota with double cheese, russian, egg, chips and sauce.
            </p>

            <p class="text-3xl font-extrabold text-brand-yellow mb-6">
                R55.00
            </p>

            <a href="{{ route('customer.orders') }}"
               class="inline-block bg-green-500 px-6 py-3 rounded-xl font-bold text-center hover:bg-green-600">
                Order Special
            </a>
        </div>
    </div>
</section>

<!-- MENU PREVIEW -->
<section id="menu" class="py-24 px-6 bg-zinc-900">
    <h2 class="text-3xl font-bold text-center text-brand-yellow mb-16">
        Popular Picks
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
        @foreach ([1,2,3] as $item)
            <div class="bg-black rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition">
                <img src="/images/menu/item{{ $item }}.jpg"
                     class="h-48 w-full object-cover">

                <div class="p-5">
                    <h4 class="font-semibold text-lg">Classic Kota</h4>
                    <p class="text-sm text-gray-400 mt-1">
                        Russian, chips, atchar & sauce
                    </p>

                    <div class="flex justify-between items-center mt-4">
                        <span class="font-bold text-brand-yellow">
                            R35.00
                        </span>

                        <button class="bg-green-500 text-sm px-4 py-2 rounded-lg hover:bg-green-600">
                            Order
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ORDER CTA -->
<section class="py-24 px-6 text-center bg-black">
    <h2 class="text-4xl font-extrabold text-brand-yellow mb-6">
        Hungry Already?
    </h2>

    <p class="text-gray-400 mb-10 max-w-xl mx-auto">
        Don’t wait — place your order now and we’ll start cooking immediately.
    </p>

    <a href="{{ route('customer.orders') }}"
       class="bg-green-500 px-14 py-5 rounded-2xl font-bold text-lg hover:bg-green-600 shadow-xl">
        Start Your Order
    </a>
</section>

<!-- HOW IT WORKS -->
<section class="bg-zinc-900 py-24 px-6">
    <h2 class="text-3xl font-bold text-center text-brand-yellow mb-16">
        How It Works
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto text-center text-gray-300">
        <div>
            <div class="text-5xl mb-4">📍</div>
            <p class="font-semibold">Walk In</p>
            <p class="text-sm text-gray-400">Order directly at the shop.</p>
        </div>

        <div>
            <div class="text-5xl mb-4">📱</div>
            <p class="font-semibold">Order Online</p>
            <p class="text-sm text-gray-400">Quick ordering from your phone.</p>
        </div>

        <div>
            <div class="text-5xl mb-4">🚚</div>
            <p class="font-semibold">Collect or Deliver</p>
            <p class="text-sm text-gray-400">Pickup or get it delivered.</p>
        </div>
    </div>
</section>

<footer class="text-center text-gray-500 text-sm py-10 bg-black">
    © {{ date('Y') }} Delicious Kota Center • Built for the streets
</footer>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts
</body>
</html>
