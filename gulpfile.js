const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');


elixir(mix => {
    mix
    .sass('app.scss')
    .styles([
        "main.css",
        "w3.css",
        "animate.css",
        "font-awesome.css"
    ],'public/css/main.css')
       .webpack('director.js');

});

