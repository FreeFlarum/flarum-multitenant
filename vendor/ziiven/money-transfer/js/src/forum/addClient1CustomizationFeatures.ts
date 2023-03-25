import { extend } from "flarum/extend";
import SessionDropdown from 'flarum/forum/components/SessionDropdown';
import TransferMoneyModal from './components/TransferMoneyModal';

const checkTime = 10;

function detachTransferMoneyMenu(){
    const moneyTransferClient1Customization = app.forum.attribute('moneyTransferClient1Customization');

    if(moneyTransferClient1Customization!=='1'){
      return;
    }

    let transferMoneyLabelContainer = document.getElementById("transferMoneyLabelContainer");

    if(transferMoneyLabelContainer!==null){
      $(transferMoneyLabelContainer).remove();
      // $("#app-navigation").css("height","var(--header-height-phone)");
      // $("#content .container .IndexPage-results").css("marginTop","15px");
    }
}

function attachTransferMoneyMenu(vdom: Vnode<any>, user: User): void {
  const isMobileView = $("#drawer").css('visibility')==="hidden";
  const moneyTransferClient1Customization = app.forum.attribute('moneyTransferClient1Customization');

  if(isMobileView===false){ return; }
  if(moneyTransferClient1Customization!=='1'){ return; }

  $("#content .IndexPage-nav .item-nav").css("display","none");
  $("#content .IndexPage-nav .item-newDiscussion").remove();

  let task = setInterval(function(){
    if(vdom.dom){
      clearInterval(task);

      if(vdom.dom!==undefined){
        $("#content .IndexPage-nav .item-nav").css("display","none");
        $("#content .IndexPage-nav .item-newDiscussion").remove();

        let transferMoneyLabelContainer = document.getElementById("transferMoneyLabelContainer");

        if(transferMoneyLabelContainer!==null){
          return;
        }

        $("#content .IndexPage-nav .item-nav .ButtonGroup").removeClass("App-titleControl");
        $("#content .IndexPage-nav .item-nav .ButtonGroup button").addClass("Button--link");
        let itemNav = $("#content .IndexPage-nav .item-nav").clone();

        if(itemNav.length>0){
          $("#itemNavClone").remove();
          $(itemNav).attr('id',"itemNavClone");
          $(itemNav).css('display',"");
          $("#header-secondary .Header-controls").prepend(itemNav);
        }

        const appNavigation = document.getElementById("app-navigation");
        const moneyName = app.forum.attribute('antoinefr-money.moneyname') || '[money]';
        const userMoneyText = moneyName.replace('[money]', app.session.user.attribute("money"));

        transferMoneyLabelContainer = document.createElement("div");
        transferMoneyLabelContainer.id = "transferMoneyLabelContainer";
        transferMoneyLabelContainer.className = "clientCustomizeTransferMoneyButtonContainer";

        const transferMoneyContainer = document.createElement("div");
        transferMoneyContainer.className = "clientCustomizeTransferMoneyHeaderItems clientCustomizeTransferMoneyHeaderTotalMoney";

        const transferMoneyText = document.createElement("div");
        transferMoneyText.innerHTML = '<span style="font-size:16px;"><i class="fab fa-bitcoin" style="padding-right: 8px;color: gold;"></i></span>'+userMoneyText;
        transferMoneyText.className = "clientCustomizeTransferMoneyHeaderText"

        const transferMoneyIcon = document.createElement("div");
        transferMoneyIcon.innerHTML = '<i class="fas fa-wallet"></i>';
        transferMoneyIcon.className = "clientCustomizeTransferMoneyHeaderIcon";

        transferMoneyContainer.appendChild(transferMoneyText);
        transferMoneyContainer.appendChild(transferMoneyIcon);

        const transferMoneyButtonText = document.createElement("div");
        transferMoneyButtonText.innerHTML = app.translator.trans('ziven-transfer-money.forum.transfer-money');
        transferMoneyButtonText.className = "clientCustomizeTransferMoneyHeaderItems clientCustomizeTransferMoneyHeaderTansferMoney";

        $(transferMoneyButtonText).click(function(){
          app.modal.show(TransferMoneyModal);
        });

        const userAvatarContainer = document.createElement("div");
        userAvatarContainer.className = "clientCustomizeTransferMoneyHeaderItems clientCustomizeTransferMoneyHeaderUser";

        const avatarClone = $("#header-secondary .item-session .SessionDropdown").clone();
        $(avatarClone).attr('id',"avatarClone");
        $(avatarClone).addClass("App-primaryControl");

        $(userAvatarContainer).html(avatarClone);

        let hideNavToggle = "";
        $(avatarClone).on('click', function(){
          hideNavToggle = hideNavToggle===""?"none":"";
          $("#content .IndexPage-nav").css("display",hideNavToggle);
        });

        transferMoneyLabelContainer.appendChild(transferMoneyContainer);
        transferMoneyLabelContainer.appendChild(transferMoneyButtonText);
        transferMoneyLabelContainer.appendChild(userAvatarContainer);
        appNavigation.appendChild(transferMoneyLabelContainer);
      }
    }
  },checkTime);
}

export default function () {
  extend(SessionDropdown.prototype, 'view', function (vnode) {
    if (!app.session.user) {
      return;
    }

    const routeName = app.current.get('routeName');

    if(routeName){
      if(routeName!=="tags"){
        detachTransferMoneyMenu();
      }else{
        attachTransferMoneyMenu(vnode,this.attrs.user);
      }
    }
  });
}
