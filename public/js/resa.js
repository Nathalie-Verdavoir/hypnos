minDate = new Date();
chambresPrice = [];
disabledArr = [];
let startDate, endDate;

//reset text of infos about booking waiting real ones
const resetTextBooking = () => {
  $(`#nuitee`).text("? nuitée(s)");
  $(`#montant`).text("? €");
  $("form[name='reservation'] > div > ul").remove();
};

//get infos of early booking from url(set before login redirection)
function get_query(param) {
  var url = document.location.href;
  var qs = url.substring(url.indexOf("?") + 1).split("&");
  for (var i = 0, result = {}; i < qs.length; i++) {
    qs[i] = qs[i].split("=");
    result[qs[i][0]] = decodeURIComponent(qs[i][1]);
  }
  return result[param];
}

//ask infos of existing reservations and prices to API
const fetchInfoResaChambre = (chambreTo) =>
  $.getJSON({
    url: "/api/dates/chambres/" + chambreTo,
    success: function (result) {
      resetTextBooking();
      disabledArr = [];
      //set chambre field
      $(`#reservation_chambre option[value='${chambreTo}']`).prop(
        "selected",
        true
      );
      //set all disabled dates
      result["reservations"].forEach((resa) => {
        let debut = new Date(resa.debut);
        let fin = new Date(resa.fin);
        let duree = (fin - debut) / 86400000;
        for (d = 0; d < duree; d++) {
          currentMonth = debut.getMonth() + 1;
          if (currentMonth < 10) {
            currentMonth = "0" + currentMonth;
          }
          disabledArr.push(
            currentMonth + "/" + debut.getDate() + "/" + debut.getFullYear()
          );
          debut.setDate(debut.getDate() + 1);
        }
      });
      //set price
      chambresPrice = result["prix"];
      emptyDatePicker();
    },
  });

const emptyDatePicker = () =>
  $(function () {
    $('input[name="daterange"]').daterangepicker();
    resetDatePicker();
    showPrice();
  });

//fill hidden booking form with daterange infos (picker = $('#daterange').data('daterangepicker'))
const fillForm = (picker) => {
  $(
    `#reservation_debut_month option[value='${picker.startDate.format("M")}']`
  ).prop("selected", true);
  $(
    `#reservation_debut_day option[value='${picker.startDate.format("D")}']`
  ).prop("selected", true);
  $(
    `#reservation_debut_year option[value='${picker.startDate.format("YYYY")}']`
  ).prop("selected", true);
  $(
    `#reservation_fin_month option[value='${picker.endDate.format("M")}']`
  ).prop("selected", true);
  $(`#reservation_fin_day option[value='${picker.endDate.format("D")}']`).prop(
    "selected",
    true
  );
  $(
    `#reservation_fin_year option[value='${picker.endDate.format("YYYY")}']`
  ).prop("selected", true);
  start = new Date(picker.startDate);
  end = new Date(picker.endDate);
  let dayCount = 0;
  while (end > start) {
    dayCount++;
    start.setDate(start.getDate() + 1);
  }
  $(`#nuitee`).text(dayCount + " " + (dayCount > 1 ? "nuitées" : "nuitée"));
  $(`#montant`).text(dayCount * chambresPrice + " €");
};

const applyRange = (e, picker) => {
  // Get the selected bound dates.
  startDate = picker.startDate.format("DD/MM/YYYY");
  endDate = picker.endDate.format("DD/MM/YYYY");

  // Compare the dates again.
  var clearInput = false;
  for (i = 0; i < disabledArr.length; i++) {
    if (startDate < disabledArr[i] && endDate > disabledArr[i]) {
      clearInput = true;
    }
  }

  // If a disabled date is in between the bounds, clear the range.
  if (clearInput) {
    // To clear selected range (on the calendar).

    const today = new Date().format("DD/MM/YYYY");
    const tomorrow = new Date(today).format("DD/MM/YYYY");
    tomorrow.setDate(tomorrow.getDate() + 1);
    $(this).data("daterangepicker").setStartDate(today);
    $(this).data("daterangepicker").setEndDate(tomorrow);

    // To clear input field and keep calendar opened.
    $(this).val("").focus();

    // Alert user!
    alert("Your range selection includes disabled dates!");
  } else {
    fillForm(picker);
  }
};

//build daterange picker and add event on it
const resetDatePicker = () =>
  $(function () {
    $('input[name="daterange"]')
      .daterangepicker({
        isInvalidDate: function (arg) {
          // Prepare the date comparision
          var thisMonth = arg._d.getMonth() + 1; // Months are 0 based
          if (thisMonth < 10) {
            thisMonth = "0" + thisMonth; // Leading 0
          }
          var thisDate = arg._d.getDate();
          if (thisDate < 10) {
            thisDate = "0" + thisDate; // Leading 0
          }
          var thisYear = arg._d.getYear() + 1900; // Years are 1900 based

          var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;

          if ($.inArray(thisCompare, disabledArr) != -1) {
            return true;
          }
        },
        alwaysShowCalendars: true,
        timePicker: true,
        startDate,
        endDate,
        minDate,
        locale: {
          format: "DD/MM/YYYY",
          applyLabel: "Ok",
          cancelLabel: "Annuler",
          fromLabel: "Du",
          toLabel: "Au",
          customRangeLabel: "Custom",
          separator: " au ",
          monthNames: [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre",
          ],
          daysOfWeek: ["D", "L", "M", "M", "J", "V", "S"],
          firstDay: 1,
        },
      })
      .on("apply.daterangepicker", function (e, picker) {
        // EVENT click 'ok' button
        applyRange(e, picker);
      })
      .on("hide.daterangepicker", function (e, picker) {
        // EVENT close calendars by clicking out of it
        applyRange(e, picker);
      });
  });

let initPrice = true; // to update price according chambre changes except on init

const addEventOnChangeOnChambre = () =>
  $(function () {
    $("#chambreSelector").on("change", (event) => {
      resetTextBooking();
      startDate, endDate;
      if (initPrice == false) {
        showPrice();
      }
      initPrice = false;
      fetchInfoResaChambre(event.target.value);
    });
  });

const showPrice = () =>
  $(function () {
    $('input[name="daterange"]').get(0).click();
    $(".applyBtn").get(0).click();
  });

//fill daterange with infos of early booking from url(set before login redirection)
if (get_query("resa_debut") && !window.location.href.match("login")) {
  startDate = new Date(get_query("resa_debut") * 1000);
  endDate = new Date(get_query("resa_fin") * 1000);
  setTimeout(function () {
    $(`#chambreSelector option[value='${get_query("resa_chambre")}']`).attr(
      "selected",
      ""
    );
  }, 500);
  fetchInfoResaChambre(get_query("resa_chambre"));
} else {
  //or with today and tomorrow dates
  startDate = moment().startOf("day");
  endDate = moment().startOf("day").add(1, "day");
}

$(document).ready(function () {
  if (
    window.location.href.match("chambres/") &&
    typeof chambre !== "undefined"
  ) {
    fetchInfoResaChambre(chambre.id);
  }
  if (window.location.href.match("hotel/")) {
    addEventOnChangeOnChambre();
  }
});
