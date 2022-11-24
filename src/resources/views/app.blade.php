<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div id="app">
    <!-- Hello コンポーネント -->
    <v-hello></v-hello>
    <v-hello></v-hello>
    <v-hello></v-hello>

</div>

<!--  この中にVue本体からコンポーネントまで全て入っています -->
<script src="{{ mix('js/app.js') }}"></script>

<script>

    createApp({
        // 省略
    })
    .component('v-hello', HelloComponent) //  ここでセットしています
    .mount('#app');

</script>

</body>
</html>
