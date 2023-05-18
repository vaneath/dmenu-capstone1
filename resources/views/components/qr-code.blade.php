<div
x-data="{
    testSrc: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=test',
}"
x-on:open-qr-code.window="document.getElementById('qr-code-img').src = qrCodeUrl;"
>
    <div x-show="openQrCode" class="bg-blue max-w-[40rem]" @click="openQrCode = false">
        <img
            id="qr-code-img"
            alt=""
        >
    </div>

</div>
