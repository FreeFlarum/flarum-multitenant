{!! array_get($forum, 'headerHtml') !!}

<div id="app" class="App">

    <div id="app-navigation" class="App-navigation"></div>

    <div id="drawer" class="App-drawer">

        <header id="header" class="App-header">
            <div id="header-navigation" class="Header-navigation"></div>
            <div class="container">
                <h1 class="Header-title">
                    <a href="{{ array_get($forum, 'baseUrl') }}" id="home-link">
                        @if ($logo = array_get($forum, 'logoUrl'))
                            <img src="{{ $logo }}" alt="{{ array_get($forum, 'title') }}" class="Header-logo">
                        @else
                            {{ array_get($forum, 'title') }}
                        @endif
                    </a>
                </h1>
                <div id="header-primary" class="Header-primary"></div>
                <div id="header-secondary" class="Header-secondary"></div>
            </div>
        </header>

    </div>

    <main class="App-content">
        <div id="content"></div>

        {!! $content !!}

        <div class="App-composer">
            <div class="container">
                <div id="composer"></div>
            </div>
        </div>
    </main>

</div>

{!! array_get($forum, 'footerHtml') !!}

@php if (!file_exists("/etc/hide_powered_by"))
{ 
    print('<div style="display: block !important; text-align: center; margin: 5px 0;"><p>A free forum powered by <a href="https://www.freeflarum.com" target="_blank">FreeFlarum</a> (<a href="https://www.freeflarum.com/docs/faq/#can-i-pay-to-remove-the-powered-by-freeflarum-footer" target="_blank">remove this footer</a>)</p><p><a href="https://www.freeflarum.com/docs/legal/terms/" target="_blank">Terms of Use</a> | <a href="https://www.freeflarum.com/docs/legal/privacy-policy/" target="_blank">Privacy Policy</a></p></div>');
} 
@endphp