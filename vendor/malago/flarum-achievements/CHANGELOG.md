### 0.5.5
- Fixed a bug with some extensions

### 0.5.4
- Fixed description for average words

### 0.5.3
- Added compatibility Flarum 1.2.0

### 0.5.2
- Removed debug code

### 0.5.1
- Fixed bug with Flarum 1.1.1

### 0.5.0
- Added option to show/hide Achievements link on the sidebar

### 0.4.3
- Fixed bug with new achievement modal

### 0.4.2
- Fixed bug when request is made with no achievements
- Fixed bug with wrong achievement list showing on user card

### 0.4.1
- Fixed no achievements bug

### 0.4.0
- Added two options for where to show the achievements (on post footer and on user card)
- Added a new location for the achievements on the popup user card
- Fixed display of achievements list on users profile
- Fixed bug with achievement for posts on discussion

### 0.3.1
- Fixed Achievements page
- Achievements page link will not show for non registered users
- Changed tooltip to use the Tooltip component

### 0.3.0
- Added a page in the forum with the Achievements list
- Improved the modal for Achievements in the admin
- Added a tooltip to help with the Variable field in the admin
- Changed how the achievement type _posts on tag_ works, now it uses the `slug` of the tag and not the full name. The variable field will need to be changed for this type of achievements.
- Compatible with Flarum 1.0

### 0.2.8
- Fix JS error when receiving an EmptyResponse

### 0.2.6
- Hide points count when points are zero

### 0.2.5
- Removed JS log
- Fixed calculation for comments on discussion achievements

### 0.2.4
- Fixed bug with Likes

### 0.2.3
- Minor changes to achievements list in posts
- Updated compatibility with Flarum beta 16

### 0.2.2
- Fixed compiled JS files

### 0.2.1
- Fixed a bug with likes given calculation

### 0.2.0
- Added the option to use Font Awesome icons instead of an external image for the achievement icon. Use the icon code (e.g. `far fa-comments`) and it will understand that it is not a URL.
- Added two achievement examples in the README
- Solved a problem with the communication with the Middleware and the Listeners

### 0.1.3
- Fixed a bug when posting new discussions. This is a temporary fix until I find a better way to do it, but it works 🙂
- Fixed a bug when creating the first achievement

### 0.1.2 
- Fixed missing comma
- Added some tweaks to the achievements' image size

### 0.1.1
- Fix on migrations was not tagged

### 0.1.0
- First public version
