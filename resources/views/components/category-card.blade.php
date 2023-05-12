@props(['url', 'name'])

<a {{ $attributes->merge(['href']) }}>
    <li class="relative mb-5">
        <img
            src="{{ $url }}"
            alt=""
            class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300"
        >
        <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
            {{ $name }}
        </h3>
    </li>
</a>
