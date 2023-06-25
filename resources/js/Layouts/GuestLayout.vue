<script setup>
import Navigation from '@/Partials/Navigation.vue';
</script>

<template>
    <div class="min-h-screen flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
        <Navigation />


        <img src="/images/background1.png">

        <p class="text-center px-10 text-4xl font-medium leading-normal text-gray-900 dark:text-black">With <span style="color: #E4A11B;">Dmenu</span>, you can enjoy the <span style="color: #E4A11B;">modern way</span> of ordering food in a restaurant.
            </p>
             <p class="text-center text-4xl px-10 font-medium leading-normal text-gray-900 dark:text-black">
             Just <span style="color: #E4A11B;">SCAN</span> the <span style="color: #E4A11B;">QR Code</span> and your food will be at your table in no time.</p>

             <video class="w-full" loop="true" autoplay="autoplay" muted playsinline style="pointer-events: none;">
            <source src="/video/video2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="wrapper">
        <div class="priceplan font-bold text-lg">
            Dmenu service plans
        </div>
        <div class="fee text-sm text-gray-500 font-semibold">
            No hidden fees. No contract.
        </div>
        <div class="services">
            <a href="#">
            <span class="single-img img-one">
                <span class="img-text">
                    <p class="mb-3 text-gray-500 text-sm font-medium">This is plan is best for large businesses.</p>
                    <button>Buy Now</button>
                </span>
            </span>
            </a>
            <a href="#">
            <span class="single-img img-two">
                <span class="img-text">

                    <p class="mb-3 text-gray-500 text-sm font-medium">This is plan is best for entrepreneurs.</p>
                    <button>Buy Now</button>
                </span>
            </span>
            </a>
            <a href="#">
            <span class="single-img img-three">
                <span class="img-text">

                    <p class="mb-3 text-gray-500 text-sm font-medium">This is plan is best for small businesses.</p>
                    <button>Buy Now</button>
                </span>
            </span>
            </a>
        </div>
    </div>
    <div class="priceplan font-bold text-lg">
            Meet Our Amazing Team
        </div>
    <div style="width:100%;">
        <img style="padding: 0; object-fit: cover; height: 100%; width:100%; " src="/images/team.png"
             alt="">
    </div>

    </div>

<!-- Footer -->


<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 sm:mb-0">
                <img src="/images/dmenu.png" class="h-8 mr-3" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dmenu</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="#" class="hover:underline">Dmenu™</a>. All Rights Reserved.</span>
    </div>
</footer>
<!-- Footer -->

</template>
