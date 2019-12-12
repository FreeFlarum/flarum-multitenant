# bbbbcode
**Big Beautiful BBCode**

A Flarum extension which adds additional BBCodes. It is lightweight; all of the BBCodes are HTML and CSS only. However, currently a JavaScript polyfill is added which ensures that the spoiler BBCode will work in IE and Edge browsers.

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

The following BBCodes are available:

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
[audio mp3="song.mp3" ogg="song.ogg"]
[audio mp3="song.mp3"]
[audio ogg="song.ogg"]
[audio m4a="song.m4a"]
[audio wav="song.wav"]
[audio flac="song.flac"]
[audio webm="song.webm"]
[audio mp3="song.mp3" width="50"]
~~~
(You may put a mp3 and ogg file together for maximum browser compatibility, or just post a mp3, ogg, wav, flac, webm or m4a file alone. Also, as the last example shows, you may modify the width. The width will become a percentage and by default, if you choose not to declare a width, the player will be 100% width.)

**Action:** 

`[action]Walks into a wall[/action]`

**Popup:** 

`[pop button="Click Here" title="Hello" content="Thank you for being a friend."]`

**KBD:**

`Please type [kbd]Y[/kbd] for yes.`

**Also included:**

`[background]`, `[font]`, and HTML table BBCodes. Finally, Flarum already comes with a core BBCode extension which adds other standard BBCodes such as bold, strikethrough, image, link, etc.
