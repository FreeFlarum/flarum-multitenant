import Page from 'flarum/common/components/Page';
import IndexPage from 'flarum/components/IndexPage';
import Link from 'flarum/components/Link';
import LoadingIndicator from 'flarum/components/LoadingIndicator';
import listItems from 'flarum/helpers/listItems';
import humanTime from 'flarum/helpers/humanTime';
import Tooltip from "flarum/components/Tooltip";

export default class AchievementsPage extends Page {
  oninit(vnode) {
    this.loading = true;
    super.oninit(vnode);
    if (!app.session.user) {
        m.route.set('/');
    }
    this.achievements_ids = [];
    app.data.resources.map(item => { if (item.type == "achievement_user") this.achievements_ids.push(item.attributes.id) });

    this.achievements_all = [];
    this.html_user = "";
    this.html_all = "";
    this.points = 0;
    this.hidden_count = 0;
    app.store.find('achievements').then(val => {
      this.achievements_all = val;

      this.achievements_all.map(item => {
        var rectangle = item.rectangle().split(',');
        var html = "";
        if (item.image().includes("http")) {
          var style = "background:url(" + item.image() + ");\
            background-position:-"+ rectangle[0] + "px -" + rectangle[1] + "px;\
            height:"+ rectangle[2] + "px;\
            width:"+ rectangle[3] + "px;";
          html = '<li>\
              <div class="AchievementsList-Item">\
                <div class="Badge Achievement" style="'+ style + '" data-toggle="tooltip" title=' + item.name() +'></div>\
                  <table class="AchievementsList-info"><tr><td class="AchievementsList-name">'+ item.name() + '</td><td class="AchievementsList-points">' + app.translator.trans("malago-achievements.forum.achievement_points") + ": " + item.points() +'</td></tr></table>\
                  <div class="AchievementsList-description">'+ item.description() +'</div>\
              </div>\
            </li>';
        } else {
          html='<li>\
              <div class="AchievementsList-Item">\
                <div class="Badge Achievement--Icon"><i class="icon ' + item.image()+'"></i></div>\
                <table class="AchievementsList-info"><tr><td class="AchievementsList-name">'+ item.name() + '</td><td class="AchievementsList-points">' + app.translator.trans("malago-achievements.forum.achievement_points") + ": " + item.points() +'</td></tr></table>\
                <div class="AchievementsList-description">'+ item.description() +'</div>\
              </div>\
            </li>';
        }
        
        if (this.achievements_ids.indexOf(parseInt(item.data.id)) !== -1) {
          this.html_user += html;
          this.points += parseFloat(item.points());
        }else if (item.hidden() == 0)
          this.html_all += html;
        else
          this.hidden_count += 1;
        
      });

      this.loading = false;
      m.redraw();
    });
    // this.achievements = app.forum.data.relationships.achievements_all.data;
  }
  view() {
    if (this.loading) {
      return <LoadingIndicator />;
    }
    return (
      <div className="IndexPage">
        {IndexPage.prototype.hero()}
        <div className="container">
          <div className="sideNavContainer">
            <nav className="IndexPage-nav sideNav">
              <ul>{listItems(IndexPage.prototype.sidebarItems().toArray())}</ul>
            </nav>
            <div className="IndexPage-results sideNavOffset">
              <h2>{app.translator.trans("malago-achievements.forum.your_achievements")}</h2>
              <div className="AchievementsList">
                <ul className="AchievementsList-achievements">
                  {m.trust(this.html_user)}
                  <li>
                    <div class="AchievementsList-Item">
                      <div className="AchievementsList-points AchievementsList-total" style="color: black; border: 2px solid black;">{app.translator.trans("malago-achievements.forum.achievement_total_points") + ": "+this.points}</div>
                    </div>  
                  </li>
                  </ul>
              </div>
                          
              <h2>{app.translator.trans("malago-achievements.forum.other_achievements")}</h2>
              <div className="AchievementsList AchievementsList-Other">
                <ul className="AchievementsList-achievements">
                  {m.trust(this.html_all)}
                  </ul>
              </div>

              <div className="AchievementsHidden">{this.hidden_count>0?app.translator.trans("malago-achievements.forum.hidden_achievements")+": "+this.hidden_count:""}</div>

            </div>
          </div>
        </div>
      </div>
    )
  }
  oncreate(vnode) {
    super.oncreate(vnode);

    app.setTitle(app.translator.trans("malago-achievements.forum.list_heading"));
    app.setTitleCount(0);
  }
}