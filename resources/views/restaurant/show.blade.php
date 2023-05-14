<x-mobile-layout
    :restaurant="$restaurant"
    :sections="$sections"
    :activeSectionPage="$activeSectionPage"
    :back="route('restaurant.index')"
    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"
>

<div
x-data="{
    activeSectionPage: 0,
    restaurantId: {{ $restaurant->id }},
    fetchCategories: function(sectionId){
        fetch('/restaurants/' + '1' + '/sections/' + sectionId + '/categories')
        .then(response => response.text())
        .then(html => {
        document.getElementById('categories').innerHTML = html;
        })
        .catch(error => {
        console.warn('Error fetching HTML:', error);
        });
    }
}"
x-on:update-active-section-page.window="activeSectionPage = $event.detail, fetchCategories($event.detail)"
>

    <div id="categories">

    </div>

</div>
</x-mobile-layout>
