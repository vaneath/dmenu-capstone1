{{--<x-mobile-layout--}}
{{--    :restaurant="$restaurant"--}}
{{--    :sections="$sections"--}}
{{--    :activeSectionPage="$activeSectionPage"--}}
{{--    :back="route('restaurant.index')"--}}
{{--    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"--}}
{{-->--}}

{{--<div--}}
{{--x-data="{--}}
{{--    activeSectionPage: 0,--}}
{{--    restaurantName: '{{ $restaurant->name }}',--}}
{{--    fetchCategories: function(sectionId){--}}
{{--        if (sectionId == 0) {--}}
{{--            document.getElementById('display-section').innerHTML = '';--}}
{{--            return;--}}
{{--        }--}}
{{--        fetch('/restaurants/' + this.restaurantName + '/sections/' + sectionId + '/categories')--}}
{{--        .then(response => {--}}
{{--            if (!response.ok) {--}}
{{--                return '';--}}
{{--            }--}}
{{--            return response.text();--}}
{{--        })--}}
{{--        .then(html => {--}}
{{--        document.getElementById('display-section').innerHTML = html;--}}
{{--        })--}}
{{--        .catch(error => {--}}
{{--        console.warn('Error fetching HTML:', error);--}}
{{--        });--}}
{{--    },--}}
{{--    fetchItems: function(categoryId){--}}
{{--        if (categoryId == 0) {--}}
{{--            document.getElementById('display-section').innerHTML = '';--}}
{{--            return;--}}
{{--        }--}}
{{--        fetch('/categories/' + categoryId + '/items')--}}
{{--        .then(response => response.text())--}}
{{--        .then(html => {--}}
{{--        document.getElementById('display-section').innerHTML = html;--}}
{{--        })--}}
{{--        .catch(error => {--}}
{{--        console.warn('Error fetching HTML:', error);--}}
{{--        });--}}
{{--    },--}}
{{--}"--}}
{{--x-on:update-active-section-page.window="activeSectionPage = $event.detail, fetchCategories($event.detail)"--}}
{{--x-on:select-category.window="fetchItems($event.detail)"--}}
{{-->--}}

{{--    <div id="display-section">--}}
{{--    </div>--}}

{{--</div>--}}
{{--</x-mobile-layout>--}}
