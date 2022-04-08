minDate =  new Date();
chambresPrice = [];
disabledArr = [];
let startDate, endDate;

function get_query(param){
    var url = document.location.href;
    var qs = url.substring(url.indexOf('?') + 1).split('&');
    for(var i = 0, result = {}; i < qs.length; i++){
        qs[i] = qs[i].split('=');
        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
    }
    return result[param] ;
}

get_query();

const fetchInfoResaChambre = chambreTo =>  $.getJSON({
    url: "/api/dates/reservations", 
    success: function(result){
        disabledArr = [];
        $(`#reservation_chambre option[value='${chambreTo}']`).prop('selected', true);
        result.forEach(resa => {
            if(resa.chambre.id==chambreTo){
                let debut = new Date(resa.debut);
                let fin =  new Date(resa.fin);
                let duree = (fin - debut)/ 86400000;
                for(d=0;d<duree;d++) {
                    currentMonth = debut.getMonth()+1
                    if (currentMonth < 10) { currentMonth = '0' + currentMonth; }
                    disabledArr.push(currentMonth+'/'+debut.getDate()+'/'+debut.getFullYear());
                    debut.setDate(debut.getDate() + 1)
                }
            }
           
    }); 
    if(chambresPrice.length==0){
                $.getJSON({
                    url: "/api/dates/chambres", 
                    success: function(result){
                        return chambresPrice = result;
                    }
                })
            }
    resetDatePicker();
  }});
  
if(get_query('resa_debut')){
    startDate = new Date(get_query('resa_debut')*1000);
    endDate =  new Date(get_query('resa_fin')*1000);
    setTimeout(function() {$(`#chambreSelector option[value='${get_query('resa_chambre')}']`).attr('selected','') }, 500);
    fetchInfoResaChambre(get_query('resa_chambre'));
}else{
    startDate = moment().startOf('day');
    endDate = moment().startOf('day').add(1, 'day');
}

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
                return true;
            }
        },
      alwaysShowCalendars: true,
      timePicker: true,
      startDate,
      endDate,
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
        startDate = picker.startDate.format('DD/MM/YYYY')
        endDate = picker.endDate.format('DD/MM/YYYY')
    
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
    
            // Alert user!
            alert("Your range selection includes disabled dates!");
        }else{
            $(`#reservation_debut_month option[value='${picker.startDate.format('M')}']`).prop('selected', true);
            $(`#reservation_debut_day option[value='${picker.startDate.format('D')}']`).prop('selected', true);
            $(`#reservation_debut_year option[value='${picker.startDate.format('YYYY')}']`).prop('selected', true);
            $(`#reservation_fin_month option[value='${picker.endDate.format('M')}']`).prop('selected', true);
            $(`#reservation_fin_day option[value='${picker.endDate.format('D')}']`).prop('selected', true);
            $(`#reservation_fin_year option[value='${picker.endDate.format('YYYY')}']`).prop('selected', true);
            start = new Date(picker.startDate);
            end = new Date(picker.endDate); 
            let dayCount = 0
while (end > start) {
dayCount++
start.setDate(start.getDate() + 1)
}
            $(`#nuitee`).text(dayCount + ' ' + (dayCount>1 ? 'nuitées' : 'nuitée'));
            chambresPrice.forEach(chambre => {
                if(chambre.id==$('#chambreSelector').val()){
                    price=chambre.prix
                }
            });
            $(`#montant`).text(dayCount*price + ' €');
        }
    });
    
  });

let initPrice = true; // to update price according chambre changes except on init

const addEventOnChangeOnChambre = () => $(function() {
    $('#chambreSelector').on('change',(event) => {
        //alert( event.target.options[event.target.selectedIndex].text); 
        $(`#nuitee`).text('? nuitée(s)'); 
        $(`#montant`).text('? €');
        startDate, endDate;
        if(initPrice==false){
            showPrice()
        }
        initPrice=false;
        fetchInfoResaChambre(event.target.value);
    });
 });

 const showPrice = () => $(function() {
    $('input[name="datetimes"]').get(0).click();
    $('.applyBtn').get(0).click();
 });

 $( document ).ready(function() {
    if(window.location.href.match('chambres/') && typeof chambre !== "undefined") {
        fetchInfoResaChambre(chambre.id);
    }
    if(window.location.href.match('hotel/')) {
        addEventOnChangeOnChambre();
    }
});

$(document).ready(function(){
    $(function() {
    $('input[name="daterange"]').daterangepicker({
    "startDate": "01/01/2020",
    "endDate": "17/01/2020",
    opens: 'center',
    locale: {
    format: 'DD/MM/YYYY'
    }
    });
    });
    });