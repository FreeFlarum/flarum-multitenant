import Mithril from 'mithril';

declare global {
  const m: Mithril.Static;

  interface FlarumExports {
    extensions: {
      [key: string]: any;
    };
  }

  const flarum: FlarumExports;
}
