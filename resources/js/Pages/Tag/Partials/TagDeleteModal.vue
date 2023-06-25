<template>
    <form @submit.prevent="destroy">
        <button>
            <i class="fa-solid fa-trash fa-xs text-red-500"></i>
        </button>
    </form>
</template>

<script setup>
    import {defineProps} from "vue";
    import Swal from "sweetalert2";
    import route from "ziggy-js/src/js/index.js";
    import {router, useForm} from "@inertiajs/vue3";

    const props = defineProps({
        tag: Object,
    })

    let form = useForm({
        tag_id: props.tag.id,
    });

    function destroy() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            background: '#1E2836',
            showCancelButton: true,
            confirmButtonColor: '#E4A11B',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                form.delete(route('tags.destroy', props.tag.id),
                    {
                        replace: true,
                        onFinish: () => {
                            Swal.fire({
                                icon: 'success',
                                color: '#fff',
                                title: 'Tag deleted successfully!',
                                confirmButtonText: 'Cool',
                                confirmButtonColor: '#E4A11B',
                                timer: 3000,
                                background: '#1E2836',
                            });
                        },
                    },
                );
            }
        })
;
    }

</script>

<style lang="scss" scoped>

</style>
