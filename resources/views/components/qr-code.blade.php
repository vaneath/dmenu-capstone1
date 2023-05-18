<div
x-data="{
    qrGeneratorPrefix: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=',
}"
x-on:open-qr-code.window="document.getElementById('qr-code-img').src = qrGeneratorPrefix + qrCodeUrl;"
>
    <div x-show="openQrCode" class="bg-blue max-w-[40rem]" @click="$dispatch('close-qr-code')">
        <img
            id="qr-code-img"
            src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=test"
            alt=""
        >
    </div>

</div>
