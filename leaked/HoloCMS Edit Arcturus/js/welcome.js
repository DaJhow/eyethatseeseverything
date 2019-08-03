window.FlashExternalInterface.openNews = function() {
    openNews();
}
window.FlashExternalInterface.openMinimail = function() {
    $.get("/minimail.php", function(data, status) {
        document.getElementById("content").innerHTML = data;
        $("#news-habblet-container").draggable();
    });
}
function menuItem() {
    var element = document.getElementById("moreMenu");
    element.classList.toggle("open");
}

function closeWelcome() {
    document.getElementById("draggable").style.display = "none";
}

function closeNews() {
    document.getElementById("news-habblet-container").style.display = "none";
}

function openNews() {
    $.get("/minimail.php", function(data, status) {
        document.getElementById("content").innerHTML = data;
        $("#news-habblet-container").draggable();
    });
}

//function open() {
//}

function openEmoji() {
openLink('habbopages/emoji.txt?1');
}
window.FlashExternalInterface.openAvatars = function() {
    window.open('/account/perfil', '_blank');
}
window.FlashExternalInterface.signoutUrl = "/hotel?action=logout";
window.FlashExternalInterface.disconnect = function() {
    $("#disconnected").show();
}
function expandMenu() {
    var element = document.getElementById("moreMenu");
    element.classList.toggle("open");
}

window.addEventListener("message", processMessage);

function processMessage(data) {
    var client = document.getElementsByName('client')[0];
    if (data && data.data) {
        var call = data.data.call;
        var target = data.data.target;

									if(call == 'navigator-tab')
				            {
				                // official_view, hotel_view, roomads_view, myworld_view etc (any custom tab)
				                return client.openlink('navigator/tab/' + target);
				            }
				            else if(call === 'home-room')
				            {
				                return client.openlink('navigator/goto/home');
				            }
				            else if(call === 'open-room')
				            {
				                // room id
				                return client.openlink('navigator/goto/' + target);
				            }
				            else if(call === 'navigator-search')
				            {
				                // searches hotel_view
				                return client.openlink('navigator/search/' + target);
				            }
				            else if(call === 'navigator-tag')
				            {
				                // searches hotel_view
				                return client.openlink('navigator/tag/' + target);
				            }
				            else if(call === 'navigator-report')
				            {
				                // room id
				                // reason code??
				                return client.openlink('navigator/report/' + target + '/reasoncode');
				            }
				            else if(call === 'open-friends')
				            {
				                return client.openlink('friendlist/open')
				            }
				            else if(call === 'open-chat')
				            {
				                // user id
				                return client.openlink('friendlist/openchat' + target);
				            }
				            else if(call === 'open-group')
				            {
				                // group id
				                return client.openlink('group/' + target);
				            }
				            else if(call == 'inventory-tab')
				            {
				                // furni, badges
				                return client.openlink('inventory/open/' + target);
				            }
				            else if(call === 'avatar-editor')
				            {
				                return client.openlink('avatareditor/open');
				            }
				            else if(call === 'find-friends')
				            {
				                return client.openlink('friendbar/friendfriends');
				            }
				            else if(call === 'open-link')
				            {
				                return client.openlink(target);
				            }
				            else if(call === 'open-achievements')
				            {
				                return client.openlink('questengine/achievements');
				            }
				            else if(call === 'open-guest-calendar')
				            {
				                return client.openlink('questengine/calendar');
				            }
				            else if(call === 'open-quests')
				            {
				                return client.openlink('questengine/quests');
				            }
				            else if(call === 'open-room-thumbnail')
				            {
				                // some string
				                return client.openlink('roomThumbnailCamera/' + target);
				            }
				            else if(call === 'open-tour')
				            {
				                // some string
				                return client.openlink('help/tour');
				            }
				            else if(call === 'report-room')
				            {
				                // room id
				                return client.openlink('help/report/room/' + target);
				            }
				            else if(call === 'open-myprofile')
				            {
				                // room id
				                return client.openlink('toolbar/myprofile');
				            }
				            else if(call === 'highlight-toolbar')
				            {
				                // catalog, navigator, memenu
				                return client.openlink('toolbar/hightlight/' + target);
				            }
							else if(call === 'open-camera')
				            {
				                // catalog, navigator, memenu
				                return client.openlink('roomCamera/open');
				            }
				            else if(call === 'open-game')
				            {
				                // some game
				                return client.openlink('games/open/' + target);
				            }
				            else if(call === 'play-game')
				            {
				                // some game
				                return client.openlink('games/play/' + target);
				            }
				            else if(call === 'open-catalog')
				            {
				                // open catalog
				                return client.openlink('catalog/open');
				            }
				            else if(call === 'open-catalog-page')
				            {
				                // some page
				                return client.openlink('catalog/open/' + target);
				            }
				            else if(call === 'open-warehouse')
				            {
				                // open catalog
				                return client.openlink('catalog/warehouse');
				            }
				            else if(call === 'open-warehouse-page')
				            {
				                // some page
				                return client.openlink('catalog/warehouse/' + target);
				            }
				            else if(call === 'club-buy')
				            {
				                // some page
				                return client.openlink('catalog/club_buy');
				            }
				            else if(call === 'open-nux-lobbyoffer')
				            {
				                // something
				                return client.openlink('nux/lobbyoffer');
				            }
				            else if(call === 'open-nux-lobbyoffer-show')
				            {
				                // something
				                return client.openlink('nux/lobbyoffer/show');
				            }
				            else if(call === 'open-friendbar-user')
				            {
				                // username or id ???
				                return client.openlink('friendbar/open/' + target);
				            }
							else if(call === 'open-user')
				            {
				                // username or id ???
				                return client.openlink('friendbar/open/' + target);
				            }
				            else if(call === 'open-hccenter')
				            {
				                return client.openlink('habboUI/open/hccenter');
				            }
				            else if(call === 'open-habbopages')
				            {
				                return client.openlink('habbopages/' + target);
				            }
				            else if(call === 'open-calendar')
				            {
				                return client.openlink('openView/calendar');
				            }
				            else if(call === 'open-habblet')
				            {
				                // credits else something else..
				                return client.openlink('habblet/open/' + target);
				            }
    }
}

function openNavigator(tab) {
    window.postMessage({
        call: 'navigator-tab',
        target: tab
    });
}
function openRoom(roomId) {
    window.postMessage({
        call: 'open-room',
        target: roomId
    });
}
function goHome() {
    window.postMessage({
        call: 'home-room'
    });
}
function openGroup(groupId) {
    window.postMessage({
        call: 'open-group',
        target: groupId
    });
}

function openInventory(tab) {
    // tab = furni / badges
    window.postMessage({
        call: 'inventory-tab',
        target: tab
    });
}

function openCatalog() {
    window.postMessage({
        call: 'open-catalog'
    });
}

function openCamera() {
    window.postMessage({
        call: 'open-camera'
    });
}

function openFriends() {
    window.postMessage({
        call: 'open-friends'
    });
}

function openFindFriends() {
    window.postMessage({
        call: 'find-friends'
    });
}

function openLink(target) {
    window.postMessage({
        call: 'open-link',
        target: target
    });
}

function naviButtons(thing1)
{
	var thing = thing1;
		if (thing == 'me')
		{
  		$('.me-menu').toggleClass('open');
		}
		else if(thing == 'events')
		{
			window.postMessage({
	        call: 'navigator-tab',
	        target: 'roomads_view'
	    });
		}
	 	else if(thing == 'myrooms')
		{
			window.postMessage({
	        call: 'navigator-tab',
	        target: 'myworld_view'
	    });
		}
		else if (thing == 'achievements')
		{
			window.postMessage({
	        call: 'open-achievements'
	    });
		}
		else if (thing == 'quests')
		{
			window.postMessage({
	        call: 'open-quests'
	    });
		}
		else if (thing == 'clothes')
		{
			window.postMessage({
	        call: 'avatar-editor'
	    });
		}
}
function openPurse(){
	$.get("/templates/flat/habblet/purse.php", function(data, status) {
			document.getElementById("content").innerHTML = data;
			$("#purse").draggable();
	});
}
function openGames(){
	$.get("/templates/flat/habblet/games.php", function(data, status) {
			document.getElementById("content").innerHTML = data;
			$("#games").draggable();
			$("#quacker").draggable();
	});
}


/* Loading Screen*/
window.FlashExternalInterface.logLoginStep = function(b) {
	if (b == "client.init.start") {
		document.getElementById('loader').innerHTML = "10%";
	}
	if (b == "client.init.core.init") {
		document.getElementById('loader').innerHTML = "50%";
	}
	if (b == "client.init.auth.ok") {
		document.getElementById('loader').innerHTML = "65%";
	}
	if (b == "client.init.localization.loaded") {
		document.getElementById('loader').innerHTML = "75%";
	}
    if (b === "client.init.config.loaded") {
				setTimeout(function() {
				document.getElementById('loader').innerHTML = "100%";
				fadeOut();
				}, 3000);
				setTimeout(function() {
				document.getElementById('content').innerHTML = '<iframe src="/js/ding.mp3" allow="autoplay" id="audio" style="display:none"></iframe>';
				}, 4000);
				//setTimeout(function() {
				//document.getElementById('menuzin').innerHTML = 'a';
				//}, 4000);
        setTimeout(function() {
            $('body').addClass('loaded');
			//openLink('habbopages/wulles.txt');
        }, 5000);
    }
}