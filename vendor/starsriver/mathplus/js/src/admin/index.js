import {extend, override} from 'flarum/common/extend';

// We provide our extension code in the form of an "initializer".
// This is a callback that will run after the core has booted.
app.initializers.add('our-extension', function(app) {
  // Your Extension Code Here
  console.log("EXTENSION NAME is working!");
});