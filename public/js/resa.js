minDate =  new Date();
disabledArr = ["04/04/2022","04/06/2022","04/08/2022","04/20/2022"];
const resetDatePicker = () => $(function() {
    $('input[name="datetimes"]').daterangepicker({
        isInvalidDate: function(arg){
            // Prepare the date comparision
            var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
            if (thisMonth<10){
                thisMonth = "0"+thisMonth; // Leading 0
            }
            var thisDate = arg._d.getDate();
            if (thisDate<10){
                thisDate = "0"+thisDate; // Leading 0
            }
            var thisYear = arg._d.getYear()+1900;   // Years are 1900 based
   
            var thisCompare = thisMonth +"/"+ thisDate +"/"+ thisYear;
   
            if($.inArray(thisCompare,disabledArr)!=-1){
                console.log(arg);
                return true;
            }
        },
      alwaysShowCalendars: true,
      timePicker: true,
      startDate: moment().startOf('day'),
      endDate: moment().startOf('day').add(1, 'day'),
      minDate,
      locale: {
        format: 'DD/MM/YYYY',
        applyLabel: "Ok",
        cancelLabel: "Annuler",
        fromLabel: "Du",
        toLabel: "Au",
        customRangeLabel: "Custom",
        separator: ' au ',
        monthNames: [
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        ],
        daysOfWeek: [
            "D",
            "L",
            "M",
            "M",
            "J",
            "V",
            "S"
        ],
        firstDay: 1
      }
    }).on("apply.daterangepicker",function(e,picker){

        // Get the selected bound dates.
        var startDate = picker.startDate.format('MM/DD/YYYY')
        var endDate = picker.endDate.format('MM/DD/YYYY')
    
        // Compare the dates again.
        var clearInput = false;
        for(i=0;i<disabledArr.length;i++){
            if(startDate<disabledArr[i] && endDate>disabledArr[i]){
                clearInput = true;
            }
        }
    
        // If a disabled date is in between the bounds, clear the range.
        if(clearInput){
    
            // To clear selected range (on the calendar).
            const today = new Date()
            const tomorrow = new Date(today)
            tomorrow.setDate(tomorrow.getDate() + 1)
            $(this).data('daterangepicker').setStartDate(today);
            $(this).data('daterangepicker').setEndDate(tomorrow);
    
            // To clear input field and keep calendar opened.
            $(this).val("").focus();
            console.log("Cleared the input field...");
    
            // Alert user!
            alert("Your range selection includes disabled dates!");
        }
    });
    
  });

const fetchInfoResaChambre = chambre =>  $.getJSON({url: "/api/dates/reservations?page=1", success: function(result){
    console.log(result);
    resetDatePicker();
  }});
  
const addEventOnChangeOnChambre = () => $(function() {
    $('#chambreSelector').on('change',(event) => {
        alert( event.target.value );  
        //fetchInfoResaChambre();
    });
 });

  addEventOnChangeOnChambre();
