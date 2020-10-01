<div id="app" class="App">

    <div id="app-navigation" class="App-navigation"></div>

    <div id="drawer" class="App-drawer">

        <header id="header" class="App-header">
            <div id="header-navigation" class="Header-navigation"></div>
            <div class="container">
                <h1 class="Header-title">
                    <a href="{{ array_get($forum, 'baseUrl') }}">
                        <?php $title = array_get($forum, 'title'); ?>
                        @if ($logo = array_get($forum, 'logoUrl'))
                            <img src="{{ $logo }}" alt="{{ $title }}" class="Header-logo">
                        @else
                            {{ $title }}
                        @endif
                    </a>
                </h1>
                <div id="header-primary" class="Header-primary"></div>
                <div id="header-secondary" class="Header-secondary"></div>
            </div>

        </header>

    </div>
    

    <main class="App-content">
        <div class="container">
            <div id="admin-navigation" class="App-nav sideNav"></div>
        </div>

        <div id="content" class="sideNavOffset"></div>

        {!! $content !!}
    </main>

</div>
<!-- FreeFlarum Start - Randomly generated tips -->
<footer id="admin-footer">
    <!-- 
        I tried making it as responsive as possible, trust me, it can't be better. It can never be placed in the right sidebar, and it can never be
        positioned well due to the sidebar. So I played with 'right' and 'left' properties for quite some time to make something out of it. This should
        work the best. <a> tags in the tips should have 'target="_blank"' attribute to prevent users from accidentaly clicking there and being taken away
        from the Administrator panel while in middle of their work and losing that. Somewhat made by Kevo, 14. 09. 2020 15:09:00
    -->
    <style>
        @media only screen and (max-width: 991px) {
          #tip, #news {
            width: 95% !important;
            left: 2.5% !important;
          }
        }
    </style>

    <hr/>

    <p id="tip" align="center" style="position: relative; width: 50%; left: 32.5vw; padding: 15px; bottom: -10px;"></p>
    <p id="news" align="center" style="position: relative; width: 50%; left: 32.5vw; padding: 15px; bottom: -10px; border: 1px solid orange; border-radius: 10px;">
        <span style="font-size: 1.1rem; font-weight: 800; text-decoration: underline;">What's new?</span>
        <br/>
        <br/>
        <a href="https://discuss.flarum.org/d/7585-free-flarum-hosting-on-an-expert-platform-by-freeflarum-com/1588" target="_blank"><strong>27/09/2020 - Fixed 404 favicon.ico error & migrated Flagrow Sitemap & Mason</strong></a>
        <br/>
        <a href="https://discuss.flarum.org/d/7585-free-flarum-hosting-on-an-expert-platform-by-freeflarum-com/1579" target="_blank"><strong>25/09/2020 - Flarum Categories & Discussion Templates got removed</strong></a>
    </p>
    <br/>
    <script>
        function nextTip() {
          var tips = [
            'The "Tags" extension is great for creating a forum with traditional "boards & topics" look. Combine it along with "Categories" for even better results!',
            'Did you know that you can request an extension? Yes, that\'s right! Check out our <a href="https://github.com/gwillem/freeflarum.com/issues/" target="_blank">GitHub page</a>!',
            'You can use your own domain name at your <a href="https://freeflarum.com/settings" target="_blank">forum settings</a>!',
            'Your <a href="https://freeflarum.com/settings" target="_blank">forum settings</a> provide you a range of options you can tweak your forum with, including the free ability to use custom domain and to export your forum data!',
            'Looking for a better Administration dashboard? Use the "Dashboard" extension! Don\'t like the new look? Simply disable the extension to revert back to the old design!',
            'Having tough time finding the correct HEX color code to tweak your forum Appearance settings with? Use the "Extended Appearance Settings" extension featuring a visual editor and a color picker!',
            'Are you lost? <a href="https://freeflarum.com/docs" target="_blank">Check out the documentation</a>!',
            'Want an inspiration on how to build your community? <a href="https://www.freeflarum.com/docs/how-to/basics/personalization/" target="_blank">Read this personalization guide</a>!',
            'Have you checked out our <a href="https://discuss.flarum.org/d/7585" target="_blank">official FreeFlarum thread at Discuss</a>?',
            'Want to expand your forum\'s functionality? Use <a href="#/extensions">extensions</a>!'
          ];
          var r = Math.floor(Math.random() * tips.length);
            document.getElementById("tip").innerHTML = "<strong>Tip:</strong> " + tips[r];
          }
        nextTip();
    </script>
</footer>
<!-- FreeFlarum End -->