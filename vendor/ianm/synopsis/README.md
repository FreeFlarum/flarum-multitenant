# Synopsis by IanM

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/ianm/synopsis.svg)](https://packagist.org/packages/ianm/synopsis)

A [Flarum](https://github.com/flarum/flarum) extension which adds summary excerpts to the discussion list. This is essentially the same as [jordanjay29's](https://discuss.flarum.org/d/2151) [Summaries](https://github.com/jordanjay29/flarum-ext-summaries), with extra customisable options. If you don't need the extra options, I recommend using [Summaries](https://github.com/jordanjay29/flarum-ext-summaries) instead.

## Features
As well as displaying an excerpt as a summary (with configurable length):

 - All display strings are translatable
 - Toggle between displaying plain or rich content in the summary (admin)
 - Choose from using either the first or latest post in the summary (admin)
 - User preference to show/hide summaries
 - User preference to enable summaries on mobile

## Screenshots

#### Admin settings
![image](https://user-images.githubusercontent.com/16573496/103157392-18bd3e80-47aa-11eb-8760-2108fdb68000.png)

#### Rich content in summary
![image](https://user-images.githubusercontent.com/16573496/103157062-4c4a9980-47a7-11eb-9103-327f3aff0690.png)

#### User settings
![image](https://user-images.githubusercontent.com/16573496/103158069-b23c1e80-47b1-11eb-8877-29016b7e4b21.png)
## Installation
```
composer require ianm/synopsis
```

### Updating
```
composer require ianm/synopsis
php flarum migrate
php flarum cache:clear
```

## Links
- [Github](https://github.com/imorland/synopsis)
- [Discuss](https://discuss.flarum.org/)  
- [Packagist](https://packagist.org/packages/ianm/synopsis) 
- [Summaries by jordanjay29 (the original extension)](https://github.com/jordanjay29/flarum-ext-summaries) 
