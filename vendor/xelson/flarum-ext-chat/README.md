### Styled
The new minimalistic design will make communication more pleasant.  
![Image](https://i.ibb.co/3m4wCV3/b40f10da617c.png)
![Image](https://c.radikal.ru/c15/2201/0f/600cc5faac92.png)

### Media content preview
Send media content to people to make communication brighter!  
![Image](https://sun9-6.userapi.com/eldBF03c5Ys9dt1IYT-Di9KpQNX91sQFPhFEfA/n9KTpymA46U.jpg)

### Groups, PMs and channels
You can create your own conversations and channels, add or remove users, change their rights, and customize the appearance of the chat.

![Image](https://sun9-13.userapi.com/sZjGejXxf0pY8tBOQPgeTGWAnrWOYGqAR8AkCA/L9zBWvw7FPQ.jpg)

### Push and sound notifications  
Stay up to date with the chat discussion and find out about mentions of you via push notifications.  
![Image](https://sun9-16.userapi.com/_LwmU4GtCL8csbq_443Aal13nmtsvMvx6IlveA/SS9-kZS6NQI.jpg)

# Neon Chat

![License](https://img.shields.io/badge/license-MIT-blue.svg) 
[![Latest Release](https://img.shields.io/packagist/v/xelson/flarum-ext-chat)](https://packagist.org/packages/xelson/flarum-ext-chat)   
A [Flarum](http://flarum.org) extension. Adds native realtime chat to your Flarum.

Requires Pusher or [kyrne/websocket](https://extiverse.com/extension/kyrne/websocket)

# Installation

Install extension via composer:
```
composer require xelson/flarum-ext-chat
```
For development builds:
```
composer require xelson/flarum-ext-chat:dev-master
```
Make sure that any socket extension is enabled

# Updating
Via composer:
```
composer update xelson/flarum-ext-chat
php flarum migrate
php flarum cache:clear
```

For development builds:
```
composer require xelson/flarum-ext-chat:dev-master
php flarum migrate
php flarum cache:clear
```

# Roadmap:

* Emoji picker
* [FriendsOfFlarum/upload](https://github.com/FriendsOfFlarum/upload) support
* Chat display mode in a separate browser window
* Forum notifications for missed mentions
* Customizing of notification sounds
* Chat messages history. Finding messages by keywords or name
