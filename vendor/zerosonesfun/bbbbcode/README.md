# bbbbcode
**Big Beautiful BBcode**

A Flarum extension which adds additional bbcodes. The code which gets generated is pure HTML and CSS. No JavaScript. I have nothing against JavaScript. I just thought it would be interesting to make all the BBcodes CSS only.

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

`[spoiler="I wanted to make you click something in order to see this just because."]Click here[/spoiler]`

(The hidden part is placed inside the opening tag, and then the word(s) you click on are in between the opening and closing tags.)

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

**Audio:**
~~~
[audio mp3="https://archive.org/download/MLKDream/MLKDream_64kb.mp3" ogg="https://archive.org/download/MLKDream/MLKDream.ogg"]
[audio mp3="https://archive.org/download/MLKDream/MLKDream_64kb.mp3"]
[audio ogg="https://archive.org/download/MLKDream/MLKDream.ogg"]
~~~
(You may put a mp3 and ogg file together for maximum browser compatibility, or just post a mp3 alone or an ogg file alone.)

**Action:** 

`[action]Walks into a wall[/action]`

**Animal:** 

`[animal="ducky"]`

(Currently there are three animals available: ducky, monkey, and squirrel)

**Popup:** 

`[pop button="Click Here" title="Hello" content="Thank you for being a friend."]`

(_Important notice:_ Previous versions had a popup, but this is an updated even more minimally coded version. I also decided to change the verbiage used inside of the BBcode. Which means if you used this extension prior to version 1.0 and used the popup BBcode, if you update, your existing popups will be broken. You will need to rewrite the BBcode in those posts. You don't need to delete everything, but you will need to change "linktext=" to "button=" and "header=" to "title=". Also, I'm sure hardly no one used it, but the "5 step" "tour" style popup has been removed.)

This Flarum post has screenshots: https://discuss.flarum.org/d/18958-big-beautiful-bbcodes
