<x-mobile-layout :restaurant="$restaurant" :sections="$sections" :activeSectionPage="$activeSectionPage">

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
