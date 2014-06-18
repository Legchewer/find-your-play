{{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/foundation/{$version['foundation']}/js/vendor/jquery.min.js") }}
{{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js") }}
{{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/foundation/{$version['foundation']}/js/foundation.min.js") }}
{{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/select2/{$version['select']}/select2.min.js") }}

<script>
    $(document).foundation();
</script>

{{ HTML::script("js/web/main.js") }}
{{ HTML::script("js/web/foundation-datepicker.js") }}

@yield('userScripts')