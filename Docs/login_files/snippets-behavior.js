jQuery(function ($) {

  var latestPackage = {};
  var packages = [];
  var tags = [];

  var $snippetTagInput = $('#snippet-tag-input');
  var $openSnippetModal = $('#modalOpenSnippet');
  var $snippetSettingsModal = $('#modalSnippetSettings');
  var $technologySelect = $('#snippet-package-technology');
  var $versionSelect = $('#snippet-package-version');
  var $typeSelect = $('#snippet-package-type');
  var $statusCheckbox = $('#snippet-status');

  var technology = getTechnology();
  var reservedTags = ['mdb-team', 'trending'];

  if (typeof $.fn.materialChip === 'function') {

    initMaterialChips();
  }

  initFilterBar();

  enableCreateButton();

  $('body').on('click', '[data-target="#modalSnippetSettings"]', function loadPackages(e) {

    e.preventDefault();

    showPreloader();

    loadSortedPackages(function () {

      createOptionsSelects('jquery');

      getReservedTags(function () {

        hidePreloader();
      });
    });
  });

  $('#save-snippet-settings').on('click', function saveSettings(e) {

    e.preventDefault();

    if (!validateCreateForm()) return;

    var $this = $(this);

    showPreloader();

    var technology = encodeURIComponent($technologySelect.val()).toLowerCase();
    var username = $this.attr('data-user-nicename');
    var action = $this.attr('data-action');
    var queryString = buildQueryString(action);

    if (action === 'forum_snippet') {

      window.open('https://mdbootstrap.com/snippets/' + technology + '/' + username + queryString, '_blank');

      hidePreloader();
      $snippetSettingsModal.modal('hide');
    } else {

      window.location.assign('/snippets/' + technology + '/' + username + queryString);
    }
  });

  $technologySelect.on('change', function (e) {

    var technology = $(this).val().toLowerCase();
    createOptionsSelects(technology);

    if (technology !== 'jquery') {

      $typeSelect.val('FREE');
      $typeSelect.attr('disabled', 'true');
    } else {
      $typeSelect.removeAttr('disabled');
    }
  });

  $('main').on('click', '.export-to-snippet', function (e) {

    e.preventDefault();

    var $this = $(this);
    var $navigation = $this.closest('.docs-pills').find('ul');

    if (!$navigation.length) {

      $navigation = $this.closest('.tab-content').siblings('ul');
    }

    var code = getSnippetCode($navigation);

    showPreloader();
    $openSnippetModal.modal();

    $.ajax({
      url: snippets_object.wp_ajaxurl,
      method: 'POST',
      data: {
        action: 'ajax_is_user_logged_in'
      }
    })
      .done(function (response) {

        response = typeof response === 'string' ? JSON.parse(response) : response;

        loadSortedPackages(function (packages) {

          setLatestPackage(packages);

          var snippet = prepareCreatePayload(code);

          if (response.loggedin) {

            if (window.localStorage.getItem('userToken')) {

              saveSnippet(response, snippet);
            } else {

              getUserToken(function () {

                saveSnippet(response, snippet)
              });
            }

          } else {

            saveGuestSnippet(response, snippet);
          }
        });
      })
      .fail(console.error);
  });

  $('a.open-snippet').on('click', function closeModal(e) {

    $openSnippetModal.modal('hide');
  });

  $('.toggle-like').on('click', function () {

    var $this = $(this);

    var likeCount = parseInt($this.find('.count-like').text());
    var snippetId = $this.attr('snippet-id');
    var snippetUsername = $this.attr('snippet-username');
    var snippetUserId = $this.attr('snippet-user-id');
    var snippetTechnology = $this.attr('snippet-technology').toLowerCase();
    var currentUserId = $this.attr('current-user-id');
    var likeAction = $this.find('.like-icon').hasClass('far fa-thumbs-up') ? 'add' : 'delete';

    if (currentUserId === snippetUserId) {

      toastr.warning("You can't like your own snippet!", "Oops!");
      return;
    }

    if ($this.find('.like-icon').hasClass('far fa-thumbs-up')) {

      $this.find('.like-icon').removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
      $this.find('.count-like').text(likeCount + 1)
    } else {

      $this.find('.like-icon').removeClass('fas fa-thumbs-up').addClass('far fa-thumbs-up');
      $this.find('.count-like').text(likeCount - 1)
    }

    $this.addClass('disabled');

    $.ajax({
      url: snippets_object.wp_ajaxurl,
      method: 'POST',
      data: {
        action: 'ajax_is_user_logged_in'
      }
    })
      .done(function (response) {

        response = typeof response === 'string' ? JSON.parse(response) : response;

        var user = response.current_user;

        var token = window.localStorage.getItem('userToken');

        loadSortedPackages(function (packages) {

          setLatestPackage(packages);

          var addSnippetsLikesBehavior = function () {
            $.ajax({
              url: '/api/snippets/' + snippetTechnology + '/' + snippetUsername + '/snippets/like/' + likeAction + '/' + snippetId,
              method: 'POST',
              headers: {
                'Authorization': 'Bearer ' + window.localStorage.getItem('userToken')
              }
            })
              .done(function (response) {

                if (response) {

                  $this.removeClass('disabled');
                } else {

                  getUserToken(function () {

                    $this.removeClass('disabled');
                  });
                }

              })
              .fail(function (error) {

                if ($this.find('.like-icon').hasClass('far fa-thumbs-up')) {

                  $this.find('.like-icon').removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
                  $this.find('.count-like').text(likeCount + 1)
                } else {

                  $this.find('.like-icon').removeClass('fas fa-thumbs-up').addClass('far fa-thumbs-up');
                  $this.find('.count-like').text(likeCount - 1)
                }

                $this.removeClass('disabled');
                console.error(error);
              });
          }

          if (token) {

            addSnippetsLikesBehavior();
          } else {

            getUserToken(function () {

              addSnippetsLikesBehavior();
            });
          }
        });
      })
      .fail(console.error);
  });

  $('#go-pro').on('click', function () {

    window.location.href = '/products/' + $technologySelect.val() + '-ui-kit/';
  });

  function setLatestPackage(packages) {

    const technology = getTechnology();

    latestPackage = packages.filter(function (pack) {

      return pack.type === 'PRO' && pack.technology === technology;
    })[0];
  }

  function getSnippetCode($navigation) {

    var code;
    var result = {
      html: '',
      css: '',
      javascript: ''
    };

    if (technology === 'jQuery') {

      code = result;
    } else if (technology === 'Vue') {

      code = {
        template: '',
        css: '',
        script: ''
      };
    } else {

      throw new Error('Unknown technology');
    }

    $navigation.find('.nav-link').each(function () {

      var $link = $(this);
      code[$link.text().toLowerCase()] = $('#' + $link.attr('href').split('#')[1]).find('pre').text();
    });

    if (technology === 'jQuery') {

      result = code;
    }
    if (technology === 'Vue') {

      result.html = code.template;
      result.css = code.css;
      result.javascript = code.script.replace(/<(|\/)script[^>]*>/g, '');
    }

    return result;
  }

  function prepareCreatePayload(code) {

    return {
      packageId: latestPackage.package_id.toString(),
      title: 'New snippet ' + Date.now().toString().substr(-3),
      description: 'Forked from ' + window.location.href,
      html: code.html,
      css: code.css,
      js: code.javascript,
      status: 3
    };
  }

  function saveGuestSnippet(user, snippet) {

    var technology = encodeURIComponent(latestPackage.technology).toLowerCase();
    var username = 'temp';
    var queryString = '?action=prism_export';

    createGuestSnippet(snippet, function (response) {

      $openSnippetModal.find('a.open-snippet').attr('href', '/snippets/' + technology + '/' + username + '/' + response.insertId + queryString);
      hidePreloader();
    });
  }

  function createGuestSnippet(data, callback) {

    $.ajax({
      url: '/api/snippets/' + latestPackage.technology.toLowerCase() + '/temp/snippets/temp/create',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify(data)
    }).done(callback).fail(console.error);
  }

  function saveSnippet(user, snippet) {

    var technology = encodeURIComponent(latestPackage.technology).toLowerCase();
    var username = user.current_user.user_nicename;

    createSnippet(user.current_user, snippet, function (response) {

      if (response) {

        $openSnippetModal.find('a.open-snippet').attr('href', '/snippets/' + technology + '/' + username + '/' + response.insertId);
        hidePreloader();
      } else {

        getUserToken(function () {

          saveSnippet(user, snippet);
        });
      }
    });
  }

  function createSnippet(user, data, callback) {

    $.ajax({
      url: '/api/snippets/' + latestPackage.technology.toLowerCase() + '/' + user.user_nicename + '/snippets/create',
      method: 'POST',
      contentType: 'application/json',
      headers: {
        'Authorization': 'Bearer ' + window.localStorage.getItem('userToken')
      },
      data: JSON.stringify(data)
    }).done(callback).fail(console.error);
  }

  function getUserToken(callback) {

    $.ajax({
      url: '/api/snippets/user/auth',
      method: 'POST',
      contentType: 'application/json'
    }).done(function (data) {

      window.localStorage.setItem('userToken', data.token);
      callback();
    }).fail(console.error);
  }

  function showPreloader() {

    $(".checkout-preloader-container").removeClass('d-none');
  }

  function hidePreloader() {

    $(".checkout-preloader-container").addClass('d-none');
  }

  function createOptionsSelects(technology) {

    var technologies = [],
      versions = [],
      types = [];

    $technologySelect.empty();
    $versionSelect.empty();
    $typeSelect.empty();

    packages.forEach(function (pack) {

      var belongsToSelectedTechnology = pack.technology.toLowerCase() === technology.toLowerCase();
      var selected = '';

      if (technologies.indexOf(pack.technology) === -1) {

        technologies.push(pack.technology);
        selected = belongsToSelectedTechnology ? ' selected ' : '';
        $technologySelect.append('<option' + selected + '>' + pack.technology + '</option>', {
          value: pack.technology
        });
      }

      if (belongsToSelectedTechnology && versions.indexOf(pack.version) === -1) {

        versions.push(pack.version);
        $versionSelect.append('<option>' + pack.version + '</option>', {
          value: pack.version
        });
      }

      if (belongsToSelectedTechnology && types.indexOf(pack.type) === -1) {

        types.push(pack.type);
        selected = pack.type === 'PRO' ? ' selected ' : '';
        $typeSelect.append('<option' + selected + '>' + pack.type + '</option>', {
          value: pack.type
        });
      }
    });
  }

  function buildQueryString(action) {

    var queryString = '?' + (!!action ? 'action=' + action : '') +
      ($statusCheckbox.is(':checked') ? '&status=4' : '') +
      '&tech=' + encodeURIComponent($technologySelect.val()) +
      '&ver=' + encodeURIComponent($versionSelect.val()) +
      '&type=' + encodeURIComponent($typeSelect.val()) +
      '&title=' + encodeURIComponent($('#snippet-title').val()) +
      '&desc=' + encodeURIComponent($('#snippet-description').val()) +
      '&package=' + packages.filter(function (pack) {

        return pack.technology === $technologySelect.val() &&
          pack.version === $versionSelect.val() &&
          pack.type === $typeSelect.val()
      })[0].package_id;

    if (tags.length) {

      queryString += '&tags=' + tags.slice(0, 10).join(',');
    }

    return queryString;
  }

  function initMaterialChips() {

    $.ajax({
      type: "GET",
      url: `/api/snippets/snippets/tags/readPopular/`,
      success: function (response) {

        var dataChip = response.map(tag => `<span>${tag.name}</span><span class="float-right text-muted">x${tag.used}</span>`);
        // FIXME chip component should have sort option disabled.
        dataChip.sort = () => { };
        dataChip.sort.toLowerCase = () => '';

        $snippetTagInput.materialChip({
          placeholder: 'Max 10 tags with the min length of 2 each',
          secondaryPlaceholder: '+Tag',
          dataChip
        });

        var span = $snippetTagInput.find('span');

        // FIXME chip component should be displayed responsive
        span.removeClass('position-relative');
        $("<style>.chip-position-wrapper > ul { width: 70%!important; left: 10px!important; }</style>").appendTo(document.documentElement);
      },
      fail: function () {

        $snippetTagInput.materialChip({
          placeholder: 'Max 10 tags with the min length of 2 each',
          secondaryPlaceholder: '+Tag'
        });
      }
    });

    $snippetTagInput.on('chip.add', function (e, chip) {

      var cleanName = _stripTagName(chip.tag);

      $(this)
        .find('div.chip')
        .filter(function () {
          return $(this).text() === chip.tag;
        })
        .first()
        .contents()
        .filter(function () {
          return (this.nodeType === Node.TEXT_NODE && this.nodeValue.trim() !== "");
        })
        .replaceWith(cleanName);

      if (reservedTags.indexOf(cleanName) !== -1) {

        $snippetTagInput.data('chips').splice(-1, 1);
        $(this).find('div.chip').last().remove();

        toastr.warning('This tag is reserved', 'Can\'t add ' + cleanName + ' tag');
      } else {

        tags.push(cleanName);
      }
    });

    $snippetTagInput.on('chip.delete', function (e, chip) {

      tags = tags.filter(function (tag) {
        return tag !== chip.tag;
      });
    });
  }

  function _stripTagName(name) {

    return name
      .trim()
      .toLowerCase()
      .replace(/\s/g, '-')
      .replace(/[^a-z0-9+#.\-]/g, '');
  }

  function initFilterBar() {

    $('#top, #sortby').on('change', function (e) {

      var $this = $(this);
      var $query = $this.find("option:selected");
      var updatedUrl = updateUrlParameter(location.href, $this.attr('id'), $query.val());
      location = updateUrlParameter(updatedUrl, 'paginate');
    });

    $('#category').on('change', function (e) {

      var $this = $(this);
      var categoryUrl = $this.find('option:selected').attr('data-url');
      var queryParams = updateUrlParameter(window.location.search, 'paginate');
      window.location.href = categoryUrl + queryParams;
    });
  }

  function enableCreateButton() {

    $('#create-snippet-btn').removeClass("disabled");
  }

  function loadSortedPackages(callback) {

    $.ajax({
      url: '/api/snippets/snippets/packages/read',
      method: 'GET'
    }).done(function (response) {

      var technologiesOptionsOrder = { 'jQuery': 0, 'Angular': 1, 'React': 2, 'Vue': 3 };

      packages = response
        .sort(function (a, b) {

          if (technologiesOptionsOrder[a.technology] < technologiesOptionsOrder[b.technology]) return -1;
          if (technologiesOptionsOrder[a.technology] > technologiesOptionsOrder[b.technology]) return 1;

          return b.version.localeCompare(a.version, undefined, {
            numeric: true
          });
        });

      callback(packages);
    }).fail(console.error);
  }

  function getReservedTags(callback) {

    $.ajax({
      url: '/api/snippets/snippets/tags/readReserved',
      method: 'GET',
    }).done(function (response) {

      reservedTags = response;

      callback(reservedTags);
    }).fail(console.error);
  }

  function updateUrlParameter(uri, param, value = null) {

    var indexOfHash = uri.indexOf('#');
    var hash = indexOfHash === -1 ? '' : uri.substr(indexOfHash);
    uri = indexOfHash === -1 ? uri : uri.substr(0, indexOfHash);

    var regExp = new RegExp("([?&])" + param + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";

    if (value === null) {

      uri = uri.replace(regExp, '$1' + '$2'); // delete
    } else {

      if (uri.match(regExp)) {

        uri = uri.replace(regExp, '$1' + param + "=" + value + '$2');
      } else {

        uri = uri + separator + param + "=" + value;
      }
    }

    return uri + hash;
  }

  function validateCreateForm() {

    var $titleInput = $('#snippet-title');

    var technologyValid = $technologySelect.val() !== '';
    var versionValid = $versionSelect.val() !== '';
    var typeValid = $typeSelect.val() !== '';
    var titleValid = $titleInput.val() && $titleInput.val().length > 3 && $titleInput.val().length < 255;
    var descriptionValid = true;
    var tagsValid = true;

    var formValid = true;

    $snippetSettingsModal.find('.chips div.chip').each(function (index) {

      var name = $(this).text();

      tagsValid = index < 10 && name.length >= 2 && name.length <= 255;
    });

    if (!(technologyValid && versionValid && typeValid && titleValid && descriptionValid && tagsValid)) {

      toastr['warning']('Please fill in the fields with valid values.');

      formValid = false;
    }

    $titleInput[(titleValid ? 'removeClass' : 'addClass')]('is-invalid');
    $('#tags-invalid-feedback')[(tagsValid ? 'addClass' : 'removeClass')]('d-none');

    return formValid;
  }
});

(function () {

  var pathName = window.location.pathname;
  var pathParts = pathName.split('/');
  var forbiddenTechs = ['angular', 'react', 'vue'];
  var technology = getTechnology();

  if (technology !== 'eCommerce' && technology !== 'admin' && forbiddenTechs.indexOf(pathParts[1]) === -1 && forbiddenTechs.indexOf(pathParts[2]) === -1 && forbiddenTechs.indexOf(pathParts[3]) === -1 || technology === 'jQuery') {

    registerPrismButton();
  }
})();

function getTechnology() {

  var pathName = window.location.pathname;

  if ((/docs\/jquery\/ecommerce/g).test(pathName)) {

    return 'eCommerce';
  } else if ((/docs\/jquery\/admin/g).test(pathName)) {

    return 'admin';
  } else if ((/(jquery)|(html)|(css)|(javascript)|(\/bootstrap)/g).test(pathName)) {

    return 'jQuery';
  } else if ((/vue/g).test(pathName)) {

    return 'Vue';
  } else if ((/react/g).test(pathName)) {

    return 'React';
  } else if ((/angular/g).test(pathName)) {

    return 'Angular'
  }

  return undefined;
}

function registerPrismButton() {

  Prism.plugins.toolbar.registerButton('export-to-snippet', function (env) {

    if ($(env.element).closest('pre').data('editor') === false) {
      return;
    }

    var button = document.createElement('a');
    button.innerHTML = '<i class="fas fa-image mr-1"></i> Open in MDB Editor';
    button.classList = 'btn btn-outline-grey btn-sm px-2 waves-effect export-to-snippet';

    return button;
  });

  $(document).on('DOMNodeInserted', function (e) {

    if ($(e.target).hasClass('toolbar')) {

      if ($(e.target).prev().data('editor') === false) {

        return;
      }

      $(e.target).find('.btn-copy-code').css('right', 175);
    }
  });

}
