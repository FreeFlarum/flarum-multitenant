# Flarum UiKit
[![latest version](https://img.shields.io/packagist/v/sycho/flarum-uikit.svg?style=flat-square)](https://packagist.org/packages/sycho/flarum-uikit)
![flarum version](https://img.shields.io/badge/flarum-%5E1.0.0-%23e7742e?style=flat-square)
![mit license](https://img.shields.io/badge/license-MIT-green.svg?style=flat-square&color=green)
![downloads](https://img.shields.io/packagist/dt/sycho/flarum-uikit?color=%23f28d1a&style=flat-square)
[![donate](https://img.shields.io/badge/donate-buy%20me%20a%20coffee-%23ffde39?style=flat-square)](https://www.buymeacoffee.com/sycho)

[Flarum](https://flarum.org) UiKit with reusable frontend utilities for extension developers. (***Not An Extension***)

## Usage
Use the package's extender to register its resources.

**extend.php**
```php
return [
    new SychO\UiKit\Extend\Register,
];
```

**example.js**
```jsx
import ProgressBar from 'flarum/uikit/common/ProgressBar';
import Label from 'flarum/uikit/common/Label';
import LabelGroup from 'flarum/uikit/common/LabelGroup';
import Input from 'flarum/uikit/common/Input';

import DiscussionSearch from 'flarum/uikit/forum/DiscussionSearch';

/**
 * @param mini bool           small sized
 * @param alternate bool      works with backgrounds using control-bg background color
 * @param progress number     percentage
 * @param className string
 */
<ProgressBar fancy={true} mini={false} alternate={false} progress={93} />

/**
 * @param color string
 */
<Label color="red">Text</Label>

/**
 * Container for a group of labels
 */
<LabelGroup></LabelGroup>

/**
 * @param icon string         fontawesome icon
 * @param className string
 * ...attrs:    other attributes
 */
<Input icon="fas fa-user" className="Input--example"/>

/**
 * @param state GlobalSearchState
 * @param ignore number
 * @param onSelect (discussion: Discussion) => void
 */
<DiscussionSearch state={} ignore={485} onSelect={(discussion) => ...} />
```

## Installation
```ssh
$ composer require sycho/flarum-uikit:^0.2.0
```

## Updating
```ssh
$ composer update sycho/flarum-uikit:^0.2.0
```

## Links
* [GitHub](https://github.com/SychO9/flarum-uikit)
* [Packagist](https://packagist.org/packages/sycho/flarum-uikit)

## License
The MIT License.
