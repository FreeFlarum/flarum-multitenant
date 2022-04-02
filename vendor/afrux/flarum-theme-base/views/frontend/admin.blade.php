<div id="app" class="App">

    <main class="App-content">
        <div class="sideNavContainer">
            <div class="App-nav sideNav">
                <div class="App-nav-title">
                    <h1 class="ThemeBase-Header-title">
                        @if ($forum['logoUrl'])
                            <img src="{{ $forum['logoUrl'] }}" alt="{{ $forum['title'] }}" class="Header-logo">
                        @else
                            {{ $forum['title'] }}
                        @endif
                    </h1>
                </div>
                <div id="admin-navigation" class="App-nav-content"></div>
            </div>

            <div class="sideNavOffset">

                @yield('separator')

                <div class="App-navigation-container">

                    <div id="app-navigation" class="App-navigation"></div>

                    <div id="drawer" class="App-drawer">

                        <header id="header" class="App-header">
                            <div id="header-navigation" class="Header-navigation"></div>
                            <div class="container">
                                <div id="header-primary" class="Header-primary"></div>
                                <div id="header-secondary" class="Header-secondary"></div>
                            </div>
                        </header>

                    </div>

                </div>
                <div id="content"></div>
            </div>
        </div>

        {!! $content !!}
    </main>

</div>
