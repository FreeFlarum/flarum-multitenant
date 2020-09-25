<!doctype html>
<html @if ($direction) dir="{{ $direction }}" @endif
      @if ($language) lang="{{ $language }}" @endif>
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>

        {!! $head !!}
    </head>

    <body>
        {!! $layout !!}

        <div id="modal"></div>
        <div id="alerts"></div>

        <script>
            document.getElementById('flarum-loading').style.display = 'block';
            var flarum = {extensions: {}};
        </script>

        {!! $js !!}

        <script>
            document.getElementById('flarum-loading').style.display = 'none';

            try {
                flarum.core.app.load(@json($payload));
                flarum.core.app.bootExtensions(flarum.extensions);
                flarum.core.app.boot();
            } catch (e) {
                var error = document.getElementById('flarum-loading-error');
                error.innerHTML += document.getElementById('flarum-content').textContent;
                // FreeFlarum start: Stack trace of error for easier debugging.
                error.innerHTML += '<hr style="border: 1px solid red"/><div class="container"><pre><b>Debugging information:</b></br>' + e.stack + '</pre>That\'s all that we know... Please, report this bug <a href="https://discuss.flarum.org/d/7585-free-flarum-hosting-on-an-expert-platform-by-freeflarum-com/1561" target="_blank">on our Discuss thread</a> or <a href="https://github.com/gwillem/freeflarum.com/issues" target="_blank">GitHub</a>.<h4>Don\'t forget to include your FreeFlarum forum name.</h4></div><hr style="border: 1px solid red"/>'
                // FreeFlarum end
                error.style.display = 'block';
                throw e;
            }
        </script>

        {!! $foot !!}
    </body>
</html>
