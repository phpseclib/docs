var ver = Cookies.get('version');
var parts = window.location.pathname.split('/');
if (ver == '2.0' && parts[2] != '2.0') {
  window.location = parts[0] + '/' + parts[1] + '/2.0/' + parts[2] + window.location.hash;
} else if (ver == '1.0' && parts[2] == '2.0') {
  window.location = parts[0] + '/' + parts[1] + '/' + parts[3] + window.location.hash;
}

var manageSelects = function() {
  options = $('select option').not('#versionsel');
  for (var i = 0; i < options.length; i++) {
   $('.' + options[i].value).hide();
  }

  options = $('select option:selected').not('#versionsel');
  for (var i = 0; i < options.length; i++) {
   $('.' + options[i].value).show();
  }
};

var highlight = function() {
  if ($('.' + this.value).closest('#notes').length == 0) {
    $('.' + this.value).css('background-color', '#ffa');
  }
};

var unhighlight = function() {
  if ($('.' + this.value).closest('#notes').length == 0) {
    $('.' + this.value).css('background-color', '#f5f4ee');
  }
};

var toggleButton = function() {
  buttons = $('button[value="' + this.value + '"]');
  buttons.eq(0).toggle();
  buttons.eq(1).toggle();
  $('.' + this.value).toggle();
};

var permLink = function() {
  attrs = '';
  selected = $('select option:selected,.disableCode:visible').not('#versionsel');
  for (i = 0; i < selected.length; i++) {
    attrs+= selected[i].value + ',';
  }
  hashPos = window.location.href.indexOf('#');
  newURL = hashPos == -1 ? window.location.href : window.location.href.substring(0, hashPos);
  window.location.href = newURL + '#' + attrs;
};

$(document).ready(function() {
  //$('pre span[id]').hide();
  //$('#notes div[id]').hide();

  buttons = $('button:visible').not('#versionnext');
  for (var i = 0; i < buttons.length; i++) {
   $('.' + buttons[i].value).hide();
  }

  options = window.location.href.split('#');
  options = options.length > 1 ? options[1].split(',') : new Array();
  for (var i = 0; i < options.length; i++) {
    options[i] = options[i].replace(/%20/g, ' ');
    $('select option[value="' + options[i] +'"]').prop('selected', true);
    button = $('button[value="' + options[i] +'"]');
    if (button.length) {
      toggleButton.apply(button[0]);
    }
  }

  manageSelects();

  $('select').change(manageSelects);
  //$('select').change(highlight);
  $('select').keyup(manageSelects);
  //$('select').focus(highlight);
  //$('select').blur(unhighlight);
  $('button').not('#versionnext').click(toggleButton);
  $('#permlink span').click(permLink);

  if (!Cookies.get('version')) {
    $('#version').show();
    $('#version').dialog({
      //height: 200,
      modal: true
    });
  }

  $('#versionnext').click(function() {
    var ver = $('#versionsel').val();
    Cookies.set('version', ver, { path: '/' });
    $('#version').dialog('close');
    var parts = window.location.pathname.split('/');
    if (ver == '2.0' && parts[2] != '2.0') {
      window.location = parts[0] + '/' + parts[1] + '/2.0/' + parts[2] + window.location.hash;
    } else if (ver == '1.0' && parts[2] == '2.0') {
      window.location = parts[0] + '/' + parts[1] + '/' + parts[3] + window.location.hash;
    }
  });
});