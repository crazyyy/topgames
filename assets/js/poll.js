function AutosizeMod(ta, options) { // Contain widget fixes
  if (ta == null) {
    return false;
  }
  // default options
  var defaults = {
    height: 0,
    minHeight: 0,
    padding: 0
  };
  // extend default options with user defined
  options = extend(defaults, options);

  var asHlp = ge('autosize_helpers'), helper;
  var oldValue, oldHeight;
  if (!asHlp) {
    asHlp = document.createElement('div');
    asHlp.id = 'autosize_helpers';
    setStyle(asHlp, {position:'absolute',left:-10000,top:-10000});
    document.body.appendChild(asHlp);
  }
  helper = document.createElement('div');
  asHlp.appendChild(helper);
  helper.style.wordWrap = 'break-word';

  var minHeight = intval(options.minHeight) || intval(getStyle(ta, 'height'));
  var maxHeight = intval(options.height);
  var fontSize = intval(getStyle(ta, 'fontSize'));
  ta.style.overflow = 'hidden';
  var w = intval(getStyle(ta, 'width'));
  // fix for hidden textareas
  if (w < 1) {
    if (browser.msie) {
      w = document.body.clientWidth - 65; // Evil fix
    } else {
      w = intval(getStyle(ta, 'width', false));
    }
  }
  if (defaults.padding) w -= defaults.padding * 2;
  setStyle(helper, {width:w < 0 ? 0 : w, fontFamily:getStyle(ta, 'fontFamily'), fontSize:fontSize + 'px', lineHeight: getStyle(ta, 'lineHeight')})

  function updateSize(he) {
    return function(e) {
      var w = intval(getStyle(ta, 'width'));
      // fix for hidden textareas
      if (w < 1) {
        if (browser.msie) {
          w = document.body.clientWidth - 65; // Evil fix
        } else {
          w = intval(getStyle(ta, 'width', false));
        }
      }
      if (defaults.padding) w -= defaults.padding * 2;
      setStyle(helper, {width:w});

      var value = ta.value;
      oldHeight = getSize(ta, true)[1];
      if (he) {
        if (e.keyCode == 13 && !e.ctrlKey && !e.altKey) {
          value += '\n';
        }
      }
      if (value == oldValue && he) {
        return;
      }
      oldValue = value;
      helper.innerHTML = trim(replaceChars(value)).replace(/<br>$/, '<br>&nbsp;');

      var newHeight = getSize(helper, true)[1] + 4;
      if (newHeight < minHeight) {
        newHeight = minHeight;
      }
      if (maxHeight > 0 && newHeight > maxHeight) {
        newHeight = maxHeight;
        setStyle(ta, {overflow:'auto', overflowX:'hidden'});
      } else {
        setStyle(ta, {overflowX:'hidden'});
      }
      if (oldHeight != newHeight) {
        setStyle(ta, {height:(oldHeight = newHeight)});
        if (options.onResize) options.onResize(newHeight);
      }
    }
  }
  addEvent(ta, 'keydown', updateSize(true));
  addEvent(ta, 'keypress', updateSize(true));
  addEvent(ta, 'keyup', updateSize(false));
  return {
    update: updateSize(false)
  }
}

function setupPollShare() {
  placeholderSetup(ge('pollShareText'));
  new AutosizeMod(ge('pollShareText'), {minHeight: 28});
  createButton(ge('pollShare'), sharePollVote);
}


function savePollVote(optionId) {
  if (isVisible('loading')) return;
  if (noAuthVal) return widgetAuth();
  show('loading');
  Ajax.postWithCaptcha("/widget_poll.php", {act: 'a_vote', option_id: optionId, hash: voteHash, app: _aid, poll_id: _pollId}, {
    onSuccess: function(obj, text) {
      var res = eval('('+ text + ')');
      mainDiv.innerHTML = res.html;
      if (res.js) eval(res.js);
      resizeWidget();
    },
    onFail: function() {
      hide('loading');
    },
    onCaptchaHide: function () {
      hide('loading');
    }
  });
}

function resetPollVote(optionId, anchor) {
  if (isVisible('loading')) return;
  hide('revoteLink');
  show('loading');
  Ajax.postWithCaptcha("/widget_poll.php", {act: 'a_unvote', option_id: optionId, hash: voteHash, app: _aid, poll_id: _pollId}, {
    onSuccess: function(obj, text) {
      var res = eval('('+ text + ')');
      mainDiv.innerHTML = res.html;
      if (res.js) eval(res.js);
      resizeWidget();
    },
    onFail: function() {
      hide('loading');
    },
    onCaptchaHide: function () {
      hide('loading');
    }
  });
}

function showStats() {
  if (isVisible('loading')) return;
  hide('revoteLink');
  show('loading');
  Ajax.postWithCaptcha("/widget_poll.php", {act: 'a_stats', app: _aid, poll_id: _pollId}, {
    onSuccess: function(obj, text) {
      var res = eval('('+ text + ')');
      mainDiv.innerHTML = res.html;
      if (res.js) eval(res.js);
      resizeWidget();
    },
    onFail: function() {
      hide('loading');
    },
    onCaptchaHide: function () {
      hide('loading');
    }
  });
}

function sharePollVote() {
  if (isVisible('loading')) return;
  hide('revoteLink');
  show('loading');
  Ajax.postWithCaptcha("/widget_poll.php", {act: 'a_share', message: ge('pollShareText').getValue ? ge('pollShareText').getValue() : ge('pollShareText').value, hash: voteHash, url: pollUrl, app: _aid, poll_id: _pollId}, {
    onSuccess: function(obj, text) {
      hide('loading');
      show('revoteLink');
      ge('pollFooter').innerHTML = text;
      resizeWidget();
      return;
      /*
      var res = eval('('+ text + ')');
      mainDiv.innerHTML = res.html;
      if (res.js) eval(res.js);
      resizeWidget();
      */
    },
    onFail: function() {
      hide('loading');
      show('revoteLink');
    },
    onCaptchaHide: function () {
      hide('loading');
      show('revoteLink');
    }
  });
}

function resizeWidget() {
  if (!window.mainDiv || !window.Rpc) return;
  var size = getSize(window.mainDiv)[1];
  if (browser.msie || browser.opera) size += 15;

  if (window.mentions_mod && size < 150 && window.mention) { // fix for mentions list
    if (mention.select.isVisible()) {
      size += Math.max(getSize(mention.select.list)[1] - 35, 0);
    }
  }
  window.Rpc.callMethod('resize', size);
}

insideVK = location.href.indexOf('&inside_vk=1') != -1;

onDomReady(function() {
  setInterval(resizeWidget, 1000);
  window.mainDiv = ge('pollMain');
  window.Rpc = new fastXDM.Client({onInit: resizeWidget}, {safe: true});
});

function goAway(url) {
  return true;
}

function widgetAuth () {
  if (window.insideVK) {
    try {window.parent.AlertBox('error', 'Authorization works only on another domain.');} catch (e) {}
    return;
  }
  var
    screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
    screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
    outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
    outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
    features = 'width=655,height=479,left=' + parseInt(screenX + ((outerWidth - 655) / 2), 10) + ',top=' + parseInt(screenY + ((outerHeight - 479) / 2.5), 10);
    var active = this.active = window.open(location.protocol + '//oauth.vk.com/authorize?client_id=-1&redirect_uri=close.html&display=widget', 'vk_openapi', features);
    function checkWnd() {
      if (active.closed) {
       window.gotSession(true);
      } else {
       setTimeout(checkWnd, 1000);
      }
    }
    checkWnd();
}

function gotSession (session_data) {
  location.reload();
}
