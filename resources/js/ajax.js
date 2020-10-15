const { result } = require("lodash");

$(() => {
  // $('form').on('submit', (e) => {
  //   e.preventDefault();
    
  //   const url = $(e.target).attr('action');
  //   const id = $(e.target).attr('id');
  //   const type = $(e.target).attr('method') || 'GET';
  //   const data = new FormData(e.target);

  //   $.ajax({
  //     url,
  //     type,
  //     data,
  //     processData: false,
  //     contentType: false,
  //     dataType: "html",
  //     statusCode: {
  //       302: function() {
  //         console.log('redirect');
  //       }
  //     }
  //   })
  //   .done((res) => {
  //     const resultContent = $(res).find('#' + id);
  //     console.log(res.status);
  //     if (resultContent.length > 0) {
  //       $('#' + id).replaceWith(resultContent);
  //     } else {
  //       location.reload();
  //     }
  //   });
  // });
}); 