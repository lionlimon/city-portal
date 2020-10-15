import { setMaxHeight } from './utils.js';

$('.card-img-wrap').on('mousemove', function(e) {
  const resultImg = $(this).find('.card-img-top-resolved');
  resultImg.css('clip-path', `inset(0% 0% 0% ${e.offsetX}px)`);
});

$('.card-img-wrap').on('mouseout', function(e) {
  const resultImg = $(this).find('.card-img-top-resolved');
  
  resultImg.css('clip-path', `none`);
});

// $(() => {
//   setMaxHeight('.main-card .card-body');
// });


