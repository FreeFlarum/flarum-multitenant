import Component from 'flarum/common/Component';
import Button from 'flarum/common/components/Button';
import classList from 'flarum/utils/classList';
export default class ScrollButton extends Component {
  oninit(vnode) {
    super.oninit(vnode);

    window.onscroll = () => {
      this.scroll();
    };
  }

  view() {
    const className = classList('Button', 'Button--icon', 'ScrollButtons-button');
    const scrollTopIcon = app.forum.attribute('scrollToTopIcon') || 'fas fa-angle-double-up';
    const scrollBottomIcon = app.forum.attribute('scrollToBottomIcon') || 'fas fa-angle-double-down';
    const scrollToTopButton = app.forum.attribute('scrollToTopButton')
      ? Button.component({
          className,
          icon: scrollTopIcon,
          onclick: () => {
            this.scrollToTop();
          },
        })
      : '';
    const scrollToBottomButton = app.forum.attribute('scrollToBottomButton')
      ? Button.component({
          className,
          icon: scrollBottomIcon,
          onclick: () => {
            this.scrollToBottom();
          },
        })
      : '';

    return (
      <>
        {scrollToTopButton}
        {scrollToBottomButton}
      </>
    );
  }

  scroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const maxScroll = document.body.scrollHeight - window.innerHeight;
    const scrollButtonsClass = document.getElementsByClassName('ScrollButtons')[0];

    if (scrollTop > 0 && scrollTop < maxScroll) {
      scrollButtonsClass.classList.add('is-visible');
    } else {
      scrollButtonsClass.classList.remove('is-visible');
    }
  }

  scrollToTop() {
    if (app.current.get('routeName') === 'discussion.near') {
      app.current.data.stream.goToFirst();
    } else {
      window.scrollTo(0, 0);
    }
  }

  scrollToBottom() {
    if (app.current.get('routeName') === 'discussion.near') {
      app.current.data.stream.goToLast();
    } else {
      window.scrollTo(0, document.body.scrollHeight);
    }
  }
}
