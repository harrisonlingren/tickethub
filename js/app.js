// temp

// reveal showtimes for the selected day
function goToTab(day) {
  switch (day) {
    case 1:
      $('#day1').show();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').hide();
      break;
    case 2:
      $('#day1').hide();
      $('#day2').show();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').hide();
      break;
    case 3:
      $('#day1').hide();
      $('#day2').hide();
      $('#day3').show();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').hide();
      break;
    case 4:
      $('#day1').hide();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').show();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').hide();
      break;
    case 5:
      $('#day1').hide();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').show();
      $('#day6').hide();
      $('#day7').hide();
      break;
    case 6:
      $('#day1').hide();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').show();
      $('#day7').hide();
      break;
    case 7:
      $('#day1').hide();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').show();
      break;
    default:
      $('#day1').show();
      $('#day2').hide();
      $('#day3').hide();
      $('#day4').hide();
      $('#day5').hide();
      $('#day6').hide();
      $('#day7').hide();
      break;
  }
}
