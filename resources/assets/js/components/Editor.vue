<template>
    <div class="editor" contenteditable="true" @keyup="update"></div>
</template>

<script>
export default {
    methods: {
        update: _.debounce(function (e) {
            console.log(e.target.innerHTML);
        }, 400),
    }
}
</script>
