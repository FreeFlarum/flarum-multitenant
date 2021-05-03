import {extend, override} from 'flarum/common/extend';
import CommentPost from 'flarum/components/CommentPost';
import DiscussionPage from 'flarum/components/DiscussionPage';
import TextEditor from 'flarum/components/TextEditor';
import TextEditorButton from 'flarum/components/TextEditorButton';


var $ = require( "jquery" );
var mathLock = false;
var nextDraw = 0;
var head, script;

function isArray(obj){
  return !!obj && obj.constructor === Array;
}

function renderMath() {
  if(window.hasOwnProperty('MathJax') && typeof MathJax.typeset === 'function') {
    MathJax.typesetPromise().then(() => {
      mathLock = false;
    }).catch((err) => console.log(err.message));
    //MathJax.Hub.Queue(['Typeset', MathJax.Hub, element.dom]);
    mathLock = false;
  } else {
    mathLock = false;
    nextDraw = 0;
  }
}

function loadMathJax() {
  head = document.getElementsByTagName("head")[0];
  script = document.createElement("script");
  script.type = "text/x-mathjax-config";
  script[(window.opera ? "innerHTML" : "text")] =
    "MathJax.Hub.Config({\n" +
    "  tex2jax: { inlineMath: [['$','$'], ['\\\\(','\\\\)']] }\n" +
    "});";
  head.appendChild(script);
  script = document.createElement("script");
  script.type = "text/javascript";
  script.src  = "https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js";
  head.appendChild(script);

  window.MathJax = {
    tex: {
      tags: 'ams',
      inlineMath: [['$', '$'], ['\\(', '\\)']]
    }
  };
}

function resetMathJax() {
  if(window.hasOwnProperty('MathJax')) {
    head = document.getElementsByTagName("head")[0];
    window.MathJax = false;
    head.removeChild (script);
  }
}

setInterval(() => {
  var ts = new Date().getTime()

  if(!mathLock && nextDraw < ts) {
    nextDraw = ts + 20000;
    mathLock = true;
    try {
      renderMath();
    } catch (error) {
      console.error(error);
    }
  }
}, 100);

// We provide our extension code in the form of an "initializer".
// This is a callback that will run after the core has booted.
app.initializers.add('our-extension', function(app) {

  extend(CommentPost.prototype, 'oncreate', function (original, element, b) {
    nextDraw = new Date().getTime() + 100;
  });

  extend(CommentPost.prototype, 'onbeforeupdate', function (original, element, b) {
    nextDraw = new Date().getTime() + 100;
  });

  extend(CommentPost.prototype, 'onupdate', function (original, element, b) {
    nextDraw = new Date().getTime() + 100;
  });

  extend(CommentPost.prototype, 'oninit', function (original, element, b) {
    nextDraw = new Date().getTime() + 100;
  });

  extend(CommentPost.prototype, 'onbeforeremove', function (original, element, b) {
    nextDraw = new Date().getTime() + 100;
  });

  extend(DiscussionPage.prototype, 'oninit', function (original, element, b) {
    resetMathJax();
    loadMathJax();
  });

  if (s9e && s9e.TextFormatter) {

    extend(s9e.TextFormatter, 'preview', function (original, preview, element) {
      nextDraw = new Date().getTime() + 100;

      let el = $(element); 
      
      if(el.parent().hasClass('Post-body')) {
        el.siblings().remove();
      }
    });
  }
});