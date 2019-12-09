# bbbbcode
**Big Beautiful BBcode**

A Flarum extension which adds additional bbcodes. It is lightweight; all of the bbcodes are HTML and CSS only. However, currently a JavaScript polyfill is added which ensures that the spoiler bbcode will work in IE and Edge browsers. One day, this small bit of JavaScript may be removed if it is determined that it is no longer necessary.

## Install

`composer require zerosonesfun/bbbbcode`

## Update

1) `composer update zerosonesfun/bbbbcode`

2) Deactivate and reactivate the extension in your admin.

3) Go to your dashboard, click tools, click clear cache.

4) Clear your browser cache, and any other caches like Cloudflare, if applicable.

## Uninstall

`composer remove zerosonesfun/bbbbcode`

## Usage

The following BBcodes are available:

**Tooltip:** 

`[tooltip="your tip here" placement="right"]word[/tooltip]`

(for "placement" you may use: top, bottom, left, right)

**Spoiler:** 

`[spoiler="The text you click on"]The hidden text goes here.[/spoiler]`

**Blurred Hover Spoiler:**

`[blur]This is the blurred secret.[/blur]`

(hover/press for 4 seconds to reveal)

**Accordion:**
~~~
[accordion header="YOUR HEADER TEXT"]The text that is hidden at first but then appears goes here[/accordion]
[accordion header="YOUR NEXT HEADER TEXT"]The text that is hidden at first but then appears goes here[/accordion]
~~~
(repeat the accordion BBcode as many times as needed)

**Chat:**
~~~
[chat-a="Why did the chicken cross the road?" who="Me"]
[chat-b="It was hungry?" who="Mary"]
[chat-a="No! Wrong!" who="Me"]
[space][/space]
~~~
(repeat as many times as needed alternating chat-a and chat-b)

("space" BBcode at end of chat is optional - it adds some extra space)

**Quick font colors:**

`[red]This will be red.[/red]`

(colors included: red, orange, yellow, green, blue, purple)

**Highlighter:**

`[hl]This text will be highlighted.[/hl]`

(That's a "L" not a one; it's hl for highlight.)

**Audio:**
~~~
[audio mp3="https://archive.org/download/MLKDream/MLKDream_64kb.mp3" ogg="https://archive.org/download/MLKDream/MLKDream.ogg"]
[audio mp3="https://archive.org/download/MLKDream/MLKDream_64kb.mp3"]
[audio ogg="https://archive.org/download/MLKDream/MLKDream.ogg"]
~~~
(You may put a mp3 and ogg file together for maximum browser compatibility, or just post a mp3 alone or an ogg file alone.)

**Action:** 

`[action]Walks into a wall[/action]`

**Popup:** 

`[pop button="Click Here" title="Hello" content="Thank you for being a friend."]`

This Flarum post has screenshots: https://discuss.flarum.org/d/18958-big-beautiful-bbcodes
