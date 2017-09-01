var app = {
  /**
   * Init
   */
  init: function() {
    app.$quizForm = $('#quiz-form');
    app.$quizForm.on('submit', app.submitQuizForm);
  },

  /**
   * Submit Form
   *  @param : evt -> stop default behavior
   */
  submitQuizForm: function(evt) {
    evt.preventDefault();

    var formData = app.$quizForm.serializeArray();
    var apiUrl = app.$quizForm.attr('action');

    $.ajax({
      url: apiUrl,
      method: 'GET',
      data: formData
    }).done(function(data) {
      var responses = $(data);
      app.showResponse(responses);
    }).fail(function(xhr) {
      console.log(xhr);
    });
  },

  /**
   * Show Response
   *  @param : responses -> data Ajax
   */
  showResponse: function(responses) {
    var response = responses;
    var resLen = response.length;
    var goodResponse = 0;

    for(var i = 0; i < resLen; i++) {
      app.$question = $('#question-' + i);
        if (response[i] === 'prop1') {
          goodResponse++;
          app.changePanel('#3c763d', '#dff0d8', '#d6e9c6');
        } else {
          if (response[i] !== '') {
            if (response[i] === 'prop2' || 'prop3' || 'prop4') {
              app.changePanel('#8a6d3b', '#fcf8e3', '#faebcc');
            };
          }
        }
      };
      app.modifyAlert(goodResponse, resLen);
      app.modifyButton();
    },

    /**
     * Change Panel
     */
    changePanel: function(color, backgroundColor, borderColor) {
      app.$question.find('.panel-heading')
      .css({
        color: color,
        backgroundColor: backgroundColor,
        borderColor: borderColor
      })
      .parent()
      .find('.panel-footer')
      .removeClass('hidden');
    },

    /**
     * Modify Alert
     */
    modifyAlert: function(goodResponse, resLen) {
      $('#quiz-alert')
      .addClass('alert-success')
      .removeClass('alert-info')
      .html('Votre score : ' + goodResponse + ' / ' + resLen + '<br> <a href="" id="reloadGame">Rejouer</a>');
    },

    /**
     * Modify Button
     */
    modifyButton: function() {
      $('#quiz-form button')
      .addClass('btn-success')
      .removeClass('btn-primary')
      .text('Rejouer')
      .attr('id', 'buttonReload');

      var $buttonReload = $('#buttonReload');
      $buttonReload.on('click', app.reloadPage);
    },

    /**
     * Reload Page
     */
    reloadPage: function() {
      location.reload();
    }
};

$(app.init);
